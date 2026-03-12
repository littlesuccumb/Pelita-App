<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Maintenance;
use App\Models\Barang;
use App\Models\LogAktivitas;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class UpdateScheduledMaintenance extends Command
{
    protected $signature = 'maintenance:update-scheduled 
                          {--dry-run : Jalankan tanpa menyimpan perubahan}
                          {--force : Paksa update meskipun stok tidak mencukupi}';
    
    protected $description = 'Update maintenance yang dijadwalkan menjadi dalam_proses jika sudah waktunya';

    public function handle()
    {
        $isDryRun = $this->option('dry-run');
        $isForce = $this->option('force');
        
        $today = Carbon::today();
        
        if ($isDryRun) {
            $this->info('🔍 DRY RUN MODE - Tidak ada perubahan yang disimpan');
        }
        
        // ✅ FIX: Ambil maintenance yang dijadwalkan dan tanggalnya hari ini atau sudah lewat
        $scheduledMaintenance = Maintenance::where('status', 'dijadwalkan')
            ->whereDate('tanggal', '<=', $today)
            ->with('barang') // ✅ EAGER LOAD untuk performa
            ->get();

        if ($scheduledMaintenance->isEmpty()) {
            $this->info('✅ Tidak ada maintenance yang perlu diupdate.');
            return 0;
        }

        $this->info("📋 Ditemukan {$scheduledMaintenance->count()} maintenance yang perlu diupdate");
        $this->newLine();

        $updatedCount = 0;
        $failedCount = 0;
        $skippedCount = 0;

        foreach ($scheduledMaintenance as $maintenance) {
            $maintenanceId = $maintenance->id;
            $tanggalMaintenance = Carbon::parse($maintenance->tanggal)->format('d/m/Y');
            
            try {
                if (!$isDryRun) {
                    DB::beginTransaction();
                }

                $barang = $maintenance->barang;
                
                // ✅ VALIDASI: Barang masih ada?
                if (!$barang) {
                    $this->error("✗ Maintenance ID {$maintenanceId}: Barang tidak ditemukan (sudah dihapus)");
                    
                    if (!$isDryRun) {
                        // ✅ OPTIONAL: Auto-batalkan maintenance jika barang tidak ada
                        $maintenance->status = 'dibatalkan';
                        $maintenance->catatan_penyelesaian = 'DIBATALKAN OTOMATIS: Barang sudah tidak ada';
                        $maintenance->tanggal_selesai = now();
                        $maintenance->save();
                        
                        LogAktivitas::create([
                            'user_id' => 1, // System user
                            'aksi' => 'Auto-Batalkan Maintenance',
                            'detail' => "Maintenance ID: {$maintenanceId} dibatalkan otomatis karena barang tidak ada",
                        ]);
                        
                        DB::commit();
                    }
                    
                    $skippedCount++;
                    continue;
                }

                $jumlah = $maintenance->jumlah ?? 1;
                $namaBarang = $barang->nama_barang;
                $kodeBarang = $barang->kode_barang;

                // ✅ VALIDASI: Cek stok tersedia
                if ($barang->jumlah_tersedia < $jumlah) {
                    $this->warn("⚠ Maintenance ID {$maintenanceId}: Stok tidak cukup!");
                    $this->warn("   Barang: {$namaBarang} ({$kodeBarang})");
                    $this->warn("   Dibutuhkan: {$jumlah} unit, Tersedia: {$barang->jumlah_tersedia} unit");
                    
                    if (!$isDryRun) {
                        // Log aktivitas
                        LogAktivitas::create([
                            'user_id' => 1,
                            'aksi' => 'Auto-Update Maintenance Gagal',
                            'detail' => "Gagal memulai maintenance ID: {$maintenanceId} untuk {$namaBarang} - Stok tidak mencukupi (Tersedia: {$barang->jumlah_tersedia}, Dibutuhkan: {$jumlah})",
                        ]);
                        
                        // ✅ TAMBAHAN: Kirim notifikasi (opsional, bisa pakai email/Slack)
                        // Notification::send($admins, new MaintenanceStockInsufficient($maintenance));
                        
                        DB::commit();
                    }
                    
                    $failedCount++;
                    
                    if (!$isForce) {
                        continue;
                    }
                    
                    $this->warn("   🔨 FORCE MODE: Tetap melanjutkan...");
                }

                // ✅ UPDATE: Status maintenance
                if (!$isDryRun) {
                    $maintenance->status = 'dalam_proses';
                    $maintenance->save();

                    // ✅ UPDATE: Stok barang
                    $barang->jumlah_tersedia -= $jumlah;
                    $barang->jumlah_maintenance += $jumlah;

                    // ✅ UPDATE: Status barang
                    if ($barang->jumlah_tersedia == 0) {
                        $barang->status = 'maintenance';
                    } elseif ($barang->jumlah_maintenance > 0) {
                        $barang->status = 'sebagian_maintenance'; // ✅ Atau tetap 'tersedia'
                    }

                    $barang->save();

                    // ✅ LOG: Aktivitas
                    LogAktivitas::create([
                        'user_id' => 1, // System user
                        'aksi' => 'Auto-Update Maintenance',
                        'detail' => "Maintenance ID: {$maintenanceId} otomatis dimulai untuk {$jumlah} unit barang: {$namaBarang} ({$kodeBarang}) - Tanggal: {$tanggalMaintenance}",
                    ]);

                    DB::commit();
                }

                // ✅ OUTPUT
                $this->info("✓ Maintenance ID {$maintenanceId}:");
                $this->line("  Barang: {$namaBarang} ({$kodeBarang})");
                $this->line("  Jumlah: {$jumlah} unit");
                $this->line("  Tanggal: {$tanggalMaintenance}");
                $this->line("  Status: dijadwalkan → dalam_proses");
                
                if ($isDryRun) {
                    $this->comment("  [DRY RUN - Tidak disimpan]");
                }
                
                $this->newLine();
                
                $updatedCount++;

            } catch (\Exception $e) {
                if (!$isDryRun) {
                    DB::rollBack();
                }
                
                $this->error("✗ Error updating maintenance ID {$maintenanceId}:");
                $this->error("  " . $e->getMessage());
                $this->newLine();
                
                $failedCount++;
            }
        }

        // ✅ SUMMARY
        $this->newLine();
        $this->info("═══════════════════════════════════════");
        $this->info("📊 SUMMARY");
        $this->info("═══════════════════════════════════════");
        $this->line("✅ Berhasil diupdate: {$updatedCount}");
        
        if ($failedCount > 0) {
            $this->line("❌ Gagal (stok tidak cukup): {$failedCount}");
        }
        
        if ($skippedCount > 0) {
            $this->line("⏭  Dilewati (barang tidak ada): {$skippedCount}");
        }
        
        if ($isDryRun) {
            $this->comment("🔍 Mode DRY RUN - Tidak ada perubahan yang disimpan");
            $this->comment("   Jalankan tanpa --dry-run untuk menyimpan perubahan");
        }
        
        $this->info("═══════════════════════════════════════");

        return 0;
    }
}