<?php

namespace App\Services;

use App\Models\LogAktivitas;
use App\Models\User;
use App\Models\Barang;
use Carbon\Carbon;

class NotificationService
{
    /**
     * Helper untuk membuat notifikasi
     */
    private static function create($userId, $aksi, $detail, $url = null)
    {
        return LogAktivitas::create([
            'user_id' => $userId,
            'tipe' => 'notifikasi',
            'aksi' => $aksi,
            'detail' => $detail,
            'url' => $url,
            'is_read' => false
        ]);
    }

    // ==========================================
    // NOTIFIKASI UNTUK USER
    // ==========================================

    /**
     * Notifikasi permohonan disetujui
     */
    public static function permohonanDisetujui($permohonan)
    {
        return self::create(
            $permohonan->user_id,
            'Permohonan Disetujui',
            "Permohonan Anda dengan nomor {$permohonan->no_permohonan} telah disetujui",
            route('permohonan.show', $permohonan->id)
        );
    }

    /**
     * Notifikasi permohonan ditolak
     */
    public static function permohonanDitolak($permohonan)
    {
        return self::create(
            $permohonan->user_id,
            'Permohonan Ditolak',
            "Permohonan Anda dengan nomor {$permohonan->no_permohonan} ditolak. Alasan: {$permohonan->alasan_penolakan}",
            route('permohonan.show', $permohonan->id)
        );
    }

    /**
     * Notifikasi peminjaman disetujui
     */
    public static function peminjamanDisetujui($peminjaman)
    {
        $barang = Barang::find($peminjaman->aset_id);
        return self::create(
            $peminjaman->user_id,
            'Peminjaman Disetujui',
            "Peminjaman {$barang->nama_barang} telah disetujui. Silakan lakukan pembayaran",
            route('peminjaman.show', $peminjaman->id)
        );
    }

    /**
     * Notifikasi peminjaman ditolak
     */
    public static function peminjamanDitolak($peminjaman)
    {
        $barang = Barang::find($peminjaman->aset_id);
        return self::create(
            $peminjaman->user_id,
            'Peminjaman Ditolak',
            "Peminjaman {$barang->nama_barang} ditolak",
            route('peminjaman.show', $peminjaman->id)
        );
    }

    /**
     * Notifikasi pembayaran dikonfirmasi
     */
    public static function pembayaranDikonfirmasi($pembayaran)
    {
        $peminjaman = $pembayaran->peminjaman;
        return self::create(
            $peminjaman->user_id,
            'Pembayaran Dikonfirmasi',
            "Pembayaran Anda sebesar Rp " . number_format($pembayaran->jumlah, 0, ',', '.') . " telah dikonfirmasi",
            route('pembayaran.show', $pembayaran->id)
        );
    }

    /**
     * Notifikasi saat pembayaran ditolak admin
     */
    public static function pembayaranDitolak($pembayaran, $alasanPenolakan)
    {
        $user = $pembayaran->peminjaman->user;
        
        LogAktivitas::create([
            'user_id' => $user->id,
            'tipe' => 'notifikasi',
            'aksi' => 'Pembayaran Ditolak',
            'detail' => "Pembayaran Anda sebesar Rp " . number_format($pembayaran->jumlah, 0, ',', '.') . 
                    " untuk peminjaman telah ditolak oleh admin. Alasan: {$alasanPenolakan}. " .
                    "PENTING: Silakan hubungi admin segera melalui WhatsApp (+62 851-6358-7878) atau Email (Cimahi.technopark@gmail.com) " .
                    "untuk klarifikasi dan instruksi pembayaran selanjutnya.",
            'url' => route('pembayaran.show', $pembayaran->id),
        ]);
    }

    /**
     * Notifikasi peminjaman selesai
     */
    public static function peminjamanSelesai($peminjaman)
    {
        $barang = Barang::find($peminjaman->aset_id);
        return self::create(
            $peminjaman->user_id,
            'Peminjaman Selesai',
            "Peminjaman {$barang->nama_barang} telah selesai. Terima kasih!",
            route('peminjaman.show', $peminjaman->id)
        );
    }

    /**
     * Notifikasi reminder deadline
     */
    public static function reminderDeadline($peminjaman)
    {
        $barang = Barang::find($peminjaman->aset_id);
        $deadline = Carbon::parse($peminjaman->tanggal_selesai);
        
        return self::create(
            $peminjaman->user_id,
            'Reminder Batas Waktu Peminjaman',
            "Peminjaman {$barang->nama_barang} akan berakhir pada {$deadline->format('d M Y H:i')}",
            route('peminjaman.show', $peminjaman->id)
        );
    }

    // ==========================================
    // NOTIFIKASI UNTUK ADMIN
    // ==========================================

    /**
     * Notifikasi ke admin - permohonan baru
     */
    public static function permohonanBaruAdmin($permohonan)
    {
        $admins = User::whereIn('role', ['admin', 'super_admin'])->get();
        
        foreach ($admins as $admin) {
            self::create(
                $admin->id,
                'Permohonan Baru',
                "Permohonan baru dari {$permohonan->nama_pemohon} dengan nomor {$permohonan->no_permohonan}",
                route('admin.permohonan.show', $permohonan->id)
            );
        }
    }

    /**
     * Notifikasi ke admin - pembayaran baru
     */
    public static function pembayaranBaruAdmin($pembayaran)
    {
        $admins = User::whereIn('role', ['admin', 'super_admin'])->get();
        $peminjaman = $pembayaran->peminjaman;
        
        foreach ($admins as $admin) {
            self::create(
                $admin->id,
                'Pembayaran Baru',
                "Pembayaran baru dari {$peminjaman->user->name} sebesar Rp " . number_format($pembayaran->jumlah, 0, ',', '.'),
                route('admin.pembayaran.show', $pembayaran->id)
            );
        }
    }

    // ==========================================
    // UTILITY METHODS
    // ==========================================

    /**
     * Mark all notifications as read
     * ✅ FIXED: Scope dipanggil PERTAMA
     */
    public static function markAllAsRead($userId)
    {
        return LogAktivitas::notifikasi()
            ->where('user_id', $userId)
            ->unread()
            ->update([
                'is_read' => true,
                'read_at' => now()
            ]);
    }

    /**
     * Get unread notification count
     * ✅ FIXED: Scope dipanggil PERTAMA
     */
    public static function getUnreadCount($userId)
    {
        return LogAktivitas::notifikasi()
            ->where('user_id', $userId)
            ->unread()
            ->count();
    }

    /**
     * Get recent notifications
     * ✅ FIXED: Scope dipanggil PERTAMA
     */
    public static function getRecent($userId, $limit = 10)
    {
        return LogAktivitas::notifikasi()
            ->where('user_id', $userId)
            ->latest()
            ->limit($limit)
            ->get();
    }
}