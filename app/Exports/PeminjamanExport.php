<?php

namespace App\Exports;

use App\Models\Peminjaman;
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

class PeminjamanExport implements 
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
     * Ambil collection data peminjaman
     */
    public function collection()
    {
        $query = Peminjaman::with([
            'user', 
            'permohonan', 
            'pembayaran', 
            'peminjamanDetail.barang.kategori'
        ])->where('jenis_aset', 'barang');

        // Apply filters jika ada
        if ($this->request) {
            // Filter status peminjaman
            if (isset($this->request['status']) && !empty($this->request['status'])) {
                $query->where('status', $this->request['status']);
            }
            
            // Filter kategori barang
            if (isset($this->request['kategori']) && !empty($this->request['kategori'])) {
                $kategoriId = $this->request['kategori'];
                $query->whereHas('peminjamanDetail.barang', function($q) use ($kategoriId) {
                    $q->where('kategori_id', $kategoriId);
                });
            }

            // Filter tanggal mulai
            if (isset($this->request['tanggal_mulai']) && !empty($this->request['tanggal_mulai'])) {
                $query->whereDate('tanggal_mulai', '>=', $this->request['tanggal_mulai']);
            }
            
            // Filter tanggal selesai
            if (isset($this->request['tanggal_selesai']) && !empty($this->request['tanggal_selesai'])) {
                $query->whereDate('tanggal_selesai', '<=', $this->request['tanggal_selesai']);
            }

            // Search
            if (isset($this->request['search']) && !empty($this->request['search'])) {
                $search = $this->request['search'];
                $query->where(function($q) use ($search) {
                    // Search user
                    $q->whereHas('user', function($userQuery) use ($search) {
                        $userQuery->where('name', 'LIKE', "%{$search}%")
                                 ->orWhere('email', 'LIKE', "%{$search}%");
                    })
                    // Search barang
                    ->orWhereHas('peminjamanDetail.barang', function($barangQuery) use ($search) {
                        $barangQuery->where('nama_barang', 'LIKE', "%{$search}%")
                                   ->orWhere('kode_barang', 'LIKE', "%{$search}%")
                                   ->orWhere('merk', 'LIKE', "%{$search}%");
                    })
                    // Search keperluan
                    ->orWhere('keperluan', 'LIKE', "%{$search}%");
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
            'Nama Peminjam',
            'Email',
            'No Permohonan',
            'Barang yang Dipinjam',
            'Jumlah Barang',
            'Tanggal Mulai',
            'Tanggal Selesai',
            'Durasi (Hari)',
            'Keperluan',
            'Status Peminjaman',
            'Total Biaya',
            'Status Pembayaran',
            'Metode Pembayaran',
        ];
    }

    /**
     * Mapping data ke row Excel
     */
    public function map($peminjaman): array
    {
        static $no = 0;
        $no++;

        // Ambil semua barang yang dipinjam
        $namaBarang = $peminjaman->peminjamanDetail
            ->map(function($detail) {
                return $detail->barang->nama_barang . ' (' . $detail->jumlah . ' unit)';
            })
            ->implode(', ');

        // Total jumlah barang
        $totalJumlah = $peminjaman->peminjamanDetail->sum('jumlah');

        // Hitung durasi
        $tanggalMulai = \Carbon\Carbon::parse($peminjaman->tanggal_mulai);
        $tanggalSelesai = \Carbon\Carbon::parse($peminjaman->tanggal_selesai);
        $durasi = $tanggalMulai->diffInDays($tanggalSelesai) + 1;

        // Status pembayaran
        $statusPembayaran = $peminjaman->pembayaran ? $peminjaman->pembayaran->status : '-';
        $metodePembayaran = $peminjaman->pembayaran && $peminjaman->pembayaran->metode 
            ? ucfirst($peminjaman->pembayaran->metode) 
            : '-';
        
        return [
            $no,
            $peminjaman->user->name ?? '-',
            $peminjaman->user->email ?? '-',
            $peminjaman->permohonan->no_permohonan ?? '-',
            $namaBarang,
            $totalJumlah,
            $tanggalMulai->format('d/m/Y'),
            $tanggalSelesai->format('d/m/Y'),
            $durasi,
            $peminjaman->keperluan ?? '-',
            ucfirst($peminjaman->status),
            $peminjaman->biaya ?? 0,
            ucfirst($statusPembayaran),
            $metodePembayaran,
        ];
    }

    /**
     * Set lebar kolom
     */
    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 25,  // Nama Peminjam
            'C' => 25,  // Email
            'D' => 20,  // No Permohonan
            'E' => 40,  // Barang yang Dipinjam
            'F' => 12,  // Jumlah Barang
            'G' => 15,  // Tanggal Mulai
            'H' => 15,  // Tanggal Selesai
            'I' => 12,  // Durasi
            'J' => 35,  // Keperluan
            'K' => 15,  // Status Peminjaman
            'L' => 15,  // Total Biaya
            'M' => 15,  // Status Pembayaran
            'N' => 15,  // Metode Pembayaran
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
                        'startColor' => ['rgb' => '2E75B6'],
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

                // Format kolom Total Biaya sebagai currency Rupiah
                $sheet->getStyle('L2:L' . $highestRow)->getNumberFormat()
                    ->setFormatCode('Rp #,##0');

                // Center alignment untuk kolom tertentu
                $centerColumns = ['A', 'F', 'G', 'H', 'I', 'K', 'M', 'N'];
                foreach ($centerColumns as $col) {
                    $sheet->getStyle($col . '2:' . $col . $highestRow)->getAlignment()
                        ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                }

                // Vertical alignment untuk semua data
                $sheet->getStyle('A2:' . $highestColumn . $highestRow)->getAlignment()
                    ->setVertical(Alignment::VERTICAL_CENTER);

                // Warna conditional untuk Status Peminjaman (kolom K)
                for ($row = 2; $row <= $highestRow; $row++) {
                    $status = $sheet->getCell('K' . $row)->getValue();
                    
                    $colorMap = [
                        'Disetujui' => ['bg' => 'C6EFCE', 'text' => '006100'],
                        'Ditolak' => ['bg' => 'FFC7CE', 'text' => '9C0006'],
                        'Menunggu' => ['bg' => 'FFEB9C', 'text' => '9C5700'],
                        'Selesai' => ['bg' => 'D9E1F2', 'text' => '1F4E78'],
                    ];

                    if (isset($colorMap[$status])) {
                        $sheet->getStyle('K' . $row)->applyFromArray([
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

                // Warna conditional untuk Status Pembayaran (kolom M)
                for ($row = 2; $row <= $highestRow; $row++) {
                    $statusPembayaran = $sheet->getCell('M' . $row)->getValue();
                    
                    $colorMap = [
                        'Lunas' => ['bg' => 'C6EFCE', 'text' => '006100'],
                        'Pending' => ['bg' => 'FFEB9C', 'text' => '9C5700'],
                        'Batal' => ['bg' => 'FFC7CE', 'text' => '9C0006'],
                    ];

                    if (isset($colorMap[$statusPembayaran])) {
                        $sheet->getStyle('M' . $row)->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => $colorMap[$statusPembayaran]['bg']],
                            ],
                            'font' => [
                                'bold' => true,
                                'color' => ['rgb' => $colorMap[$statusPembayaran]['text']],
                            ],
                        ]);
                    }
                }

                // Text wrapping untuk kolom Barang dan Keperluan
                $sheet->getStyle('E2:E' . $highestRow)
                    ->getAlignment()
                    ->setWrapText(true);
                    
                $sheet->getStyle('J2:J' . $highestRow)
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
        return 'Data Peminjaman';
    }
}