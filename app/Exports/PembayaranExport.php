<?php

namespace App\Exports;

use App\Models\Pembayaran;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class PembayaranExport implements 
    FromCollection, 
    WithHeadings, 
    WithMapping, 
    WithStyles,
    WithColumnWidths,
    WithEvents,
    WithTitle
{
    protected $request;

    public function __construct($request = null)
    {
        $this->request = $request;
    }

    /**
     * Ambil collection data pembayaran
     */
    public function collection()
    {
        $query = Pembayaran::with([
            'peminjaman.user', 
            'peminjaman.peminjamanDetail.barang.kategori'
        ]);

        // Apply filters jika ada
        if ($this->request) {
            // Filter status pembayaran
            if (isset($this->request['status']) && !empty($this->request['status'])) {
                $query->where('status', $this->request['status']);
            }
            
            // Filter metode pembayaran
            if (isset($this->request['metode']) && !empty($this->request['metode'])) {
                $query->where('metode', $this->request['metode']);
            }

            // Filter tanggal dari
            if (isset($this->request['tanggal_dari']) && !empty($this->request['tanggal_dari'])) {
                $query->whereDate('tanggal_bayar', '>=', $this->request['tanggal_dari']);
            }
            
            // Filter tanggal sampai
            if (isset($this->request['tanggal_sampai']) && !empty($this->request['tanggal_sampai'])) {
                $query->whereDate('tanggal_bayar', '<=', $this->request['tanggal_sampai']);
            }

            // Search
            if (isset($this->request['search']) && !empty($this->request['search'])) {
                $search = $this->request['search'];
                $query->where(function($q) use ($search) {
                    // Search user
                    $q->whereHas('peminjaman.user', function($subQ) use ($search) {
                        $subQ->where('name', 'LIKE', "%{$search}%")
                             ->orWhere('email', 'LIKE', "%{$search}%");
                    })
                    // Search barang
                    ->orWhereHas('peminjaman.peminjamanDetail.barang', function($subQ) use ($search) {
                        $subQ->where('nama_barang', 'LIKE', "%{$search}%")
                             ->orWhere('kode_barang', 'LIKE', "%{$search}%");
                    });
                });
            }
        }

        return $query->latest()->get();
    }

    /**
     * Header kolom Excel
     */
    public function headings(): array
    {
        return [
            'No',
            'ID Pembayaran',
            'Nama Peminjam',
            'Email',
            'No HP',
            'Barang yang Dipinjam',
            'Jumlah Pembayaran',
            'Metode Pembayaran',
            'Status Pembayaran',
            'Tanggal Pembayaran',
            'Tanggal Mulai Pinjam',
            'Tanggal Selesai Pinjam',
            'Bukti Transfer',
        ];
    }

    /**
     * Mapping data ke row Excel
     */
    public function map($pembayaran): array
    {
        static $no = 0;
        $no++;

        $peminjaman = $pembayaran->peminjaman;
        $user = $peminjaman->user ?? null;

        // Ambil semua barang yang dipinjam
        $namaBarang = $peminjaman->peminjamanDetail
            ->map(function($detail) {
                return $detail->barang->nama_barang . ' (' . $detail->jumlah . ' unit)';
            })
            ->implode(', ');

        // Format tanggal
        $tanggalBayar = $pembayaran->tanggal_bayar 
            ? \Carbon\Carbon::parse($pembayaran->tanggal_bayar)->format('d/m/Y H:i') 
            : '-';
        
        $tanggalMulai = $peminjaman->tanggal_mulai 
            ? \Carbon\Carbon::parse($peminjaman->tanggal_mulai)->format('d/m/Y') 
            : '-';
        
        $tanggalSelesai = $peminjaman->tanggal_selesai 
            ? \Carbon\Carbon::parse($peminjaman->tanggal_selesai)->format('d/m/Y') 
            : '-';

        // Bukti transfer
        $buktiTransfer = $pembayaran->bukti_transfer ? 'Ada' : 'Tidak Ada';
        
        return [
            $no,
            $pembayaran->id,
            $user->name ?? '-',
            $user->email ?? '-',
            $user->no_hp ?? '-',
            $namaBarang,
            $pembayaran->jumlah ?? 0,
            $pembayaran->metode ? ucfirst($pembayaran->metode) : '-',
            ucfirst($pembayaran->status),
            $tanggalBayar,
            $tanggalMulai,
            $tanggalSelesai,
            $buktiTransfer,
        ];
    }

    /**
     * Set lebar kolom
     */
    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 12,  // ID Pembayaran
            'C' => 25,  // Nama Peminjam
            'D' => 25,  // Email
            'E' => 15,  // No HP
            'F' => 40,  // Barang yang Dipinjam
            'G' => 18,  // Jumlah Pembayaran
            'H' => 15,  // Metode Pembayaran
            'I' => 15,  // Status Pembayaran
            'J' => 18,  // Tanggal Pembayaran
            'K' => 15,  // Tanggal Mulai
            'L' => 15,  // Tanggal Selesai
            'M' => 15,  // Bukti Transfer
        ];
    }

    /**
     * Style dasar untuk worksheet
     */
    public function styles(Worksheet $sheet)
    {
        return [
            1 => ['font' => ['bold' => true]],
        ];
    }

    /**
     * Event untuk styling lanjutan
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                // Style untuk header (baris 1)
                $sheet->getStyle('A1:' . $highestColumn . '1')->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => ['rgb' => 'FFFFFF'],
                        'size' => 12,
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => '70AD47'],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                ]);

                // Set tinggi header
                $sheet->getRowDimension(1)->setRowHeight(25);

                // Border untuk semua cell data
                $sheet->getStyle('A1:' . $highestColumn . $highestRow)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => ['rgb' => 'CCCCCC'],
                        ],
                    ],
                ]);

                // Zebra striping (warna selang-seling untuk baris data)
                for ($row = 2; $row <= $highestRow; $row++) {
                    if ($row % 2 == 0) {
                        $sheet->getStyle('A' . $row . ':' . $highestColumn . $row)->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => 'F2F2F2'],
                            ],
                        ]);
                    }
                }

                // Format kolom Jumlah Pembayaran sebagai currency Rupiah
                $sheet->getStyle('G2:G' . $highestRow)->getNumberFormat()
                    ->setFormatCode('Rp #,##0');

                // Center alignment untuk kolom tertentu
                $centerColumns = ['A', 'B', 'H', 'I', 'J', 'K', 'L', 'M'];
                foreach ($centerColumns as $col) {
                    $sheet->getStyle($col . '2:' . $col . $highestRow)->getAlignment()
                        ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                }

                // Vertical alignment untuk semua data
                $sheet->getStyle('A2:' . $highestColumn . $highestRow)->getAlignment()
                    ->setVertical(Alignment::VERTICAL_CENTER);

                // Warna conditional untuk Status Pembayaran (kolom I)
                for ($row = 2; $row <= $highestRow; $row++) {
                    $status = $sheet->getCell('I' . $row)->getValue();
                    
                    $colorMap = [
                        'Lunas' => ['bg' => 'C6EFCE', 'text' => '006100'],
                        'Pending' => ['bg' => 'FFEB9C', 'text' => '9C5700'],
                        'Batal' => ['bg' => 'FFC7CE', 'text' => '9C0006'],
                    ];

                    if (isset($colorMap[$status])) {
                        $sheet->getStyle('I' . $row)->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => $colorMap[$status]['bg']],
                            ],
                            'font' => [
                                'bold' => true,
                                'color' => ['rgb' => $colorMap[$status]['text']],
                            ],
                        ]);
                    }
                }

                // Warna conditional untuk Metode Pembayaran (kolom H)
                for ($row = 2; $row <= $highestRow; $row++) {
                    $metode = $sheet->getCell('H' . $row)->getValue();
                    
                    $colorMap = [
                        'Transfer' => ['bg' => 'D9E1F2', 'text' => '1F4E78'],
                        'Cash' => ['bg' => 'E2EFDA', 'text' => '375623'],
                        'Gratis' => ['bg' => 'FFF2CC', 'text' => '7F6000'],
                    ];

                    if (isset($colorMap[$metode])) {
                        $sheet->getStyle('H' . $row)->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => $colorMap[$metode]['bg']],
                            ],
                            'font' => [
                                'bold' => true,
                                'color' => ['rgb' => $colorMap[$metode]['text']],
                            ],
                        ]);
                    }
                }

                // Text wrapping untuk kolom Barang yang Dipinjam
                $sheet->getStyle('F2:F' . $highestRow)
                    ->getAlignment()
                    ->setWrapText(true);

                // Auto-fit height untuk semua baris
                for ($row = 2; $row <= $highestRow; $row++) {
                    $sheet->getRowDimension($row)->setRowHeight(-1);
                }

                // Freeze pane (header tetap saat scroll)
                $sheet->freezePane('A2');

                // Auto-filter untuk header
                $sheet->setAutoFilter('A1:' . $highestColumn . '1');
            },
        ];
    }

    /**
     * Nama sheet Excel
     */
    public function title(): string
    {
        return 'Data Pembayaran';
    }
}