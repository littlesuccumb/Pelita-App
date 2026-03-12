<?php

namespace App\Exports;

use App\Models\Barang;
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

class BarangExport implements 
    FromCollection, 
    WithHeadings, 
    WithMapping, 
    WithStyles,
    WithColumnWidths,
    WithEvents,
    WithTitle
{
    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * Ambil collection data barang
     */
    public function collection()
    {
        $query = Barang::with('kategori');
        
        // Apply filters
        if (!empty($this->filters['kategori_id'])) {
            $query->where('kategori_id', $this->filters['kategori_id']);
        }

        if (!empty($this->filters['status'])) {
            $query->where('status', $this->filters['status']);
        }

        if (!empty($this->filters['kondisi'])) {
            $query->where('kondisi', $this->filters['kondisi']);
        }

        if (!empty($this->filters['search'])) {
            $search = $this->filters['search'];
            $query->where(function($q) use ($search) {
                $q->where('nama_barang', 'LIKE', "%{$search}%")
                  ->orWhere('kode_barang', 'LIKE', "%{$search}%")
                  ->orWhere('merk', 'LIKE', "%{$search}%");
            });
        }
        
        return $query->get();
    }

    /**
     * Header kolom Excel
     */
    public function headings(): array
    {
        return [
            'No',
            'Kode Barang',
            'Nama Barang',
            'Kategori',
            'Merk',
            'Type',
            'Seri',
            'Tahun Produksi',
            'Spesifikasi',
            'Warna',
            'Berat (kg)',
            'Dimensi',
            'Garansi',
            'Tanggal Pembelian',
            'Harga Beli',
            'Jumlah Total',
            'Jumlah Tersedia',
            'Kondisi',
            'Lokasi',
            'Harga Sewa',
            'Status',
            'Dapat Dipinjam', // ✅ KOLOM BARU
            'Deskripsi',
        ];
    }

    /**
     * Mapping data ke row Excel
     */
    public function map($barang): array
    {
        static $no = 0;
        $no++;
        
        return [
            $no,
            $barang->kode_barang ?? '-',
            $barang->nama_barang ?? '-',
            $barang->kategori->nama_kategori ?? '-',
            $barang->merk ?? '-',
            $barang->type ?? '-',
            $barang->seri ?? '-',
            $barang->tahun_produksi ?? '-',
            $barang->spesifikasi ?? '-',
            $barang->warna ?? '-',
            $barang->berat ?? '-',
            $barang->dimensi ?? '-',
            $barang->garansi ?? '-',
            $barang->tanggal_pembelian ?? '-',
            $barang->harga_beli ?? 0,
            $barang->jumlah_total ?? 0,
            $barang->jumlah_tersedia ?? 0,
            $barang->kondisi ?? '-',
            $barang->lokasi ?? '-',
            $barang->harga_sewa ?? 0,
            $barang->status ?? '-',
            $barang->dapat_dipinjam ? 'Ya' : 'Tidak', // ✅ DATA BARU
            $barang->deskripsi ?? '-',
        ];
    }

    /**
     * Set lebar kolom
     */
    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 15,  // Kode Barang
            'C' => 25,  // Nama Barang
            'D' => 20,  // Kategori
            'E' => 15,  // Merk
            'F' => 15,  // Type
            'G' => 15,  // Seri
            'H' => 12,  // Tahun Produksi
            'I' => 30,  // Spesifikasi
            'J' => 12,  // Warna
            'K' => 10,  // Berat
            'L' => 15,  // Dimensi
            'M' => 12,  // Garansi
            'N' => 15,  // Tanggal Pembelian
            'O' => 15,  // Harga Beli
            'P' => 12,  // Jumlah Total
            'Q' => 12,  // Jumlah Tersedia
            'R' => 12,  // Kondisi
            'S' => 20,  // Lokasi
            'T' => 15,  // Harga Sewa
            'U' => 12,  // Status
            'W' => 15,  // Dapat Dipinjam ✅ KOLOM BARU
            'X' => 35,  // Deskripsi
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
                        'startColor' => ['rgb' => '2E7D32'], // Hijau untuk barang
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

                // Format kolom Harga Beli dan Harga Sewa sebagai currency Rupiah
                $sheet->getStyle('O2:O' . $highestRow)->getNumberFormat()
                    ->setFormatCode('Rp #,##0');
                    
                $sheet->getStyle('T2:T' . $highestRow)->getNumberFormat()
                    ->setFormatCode('Rp #,##0');

                // Format kolom jumlah sebagai number
                $sheet->getStyle('P2:Q' . $highestRow)->getNumberFormat()
                    ->setFormatCode('0');

                // Center alignment untuk kolom tertentu
                $sheet->getStyle('A2:A' . $highestRow)->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                
                $sheet->getStyle('H2:H' . $highestRow)->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                    
                $sheet->getStyle('P2:Q' . $highestRow)->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle('R2:R' . $highestRow)->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                $sheet->getStyle('U2:U' . $highestRow)->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // ✅ Center alignment untuk kolom Dapat Dipinjam
                $sheet->getStyle('W2:W' . $highestRow)->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Vertical alignment untuk semua data
                $sheet->getStyle('A2:' . $highestColumn . $highestRow)->getAlignment()
                    ->setVertical(Alignment::VERTICAL_CENTER);

                // Warna conditional untuk status
                for ($row = 2; $row <= $highestRow; $row++) {
                    $status = $sheet->getCell('U' . $row)->getValue();
                    
                    $statusColorMap = [
                        'tersedia' => ['bg' => 'C6EFCE', 'text' => '006100'],
                        'dipinjam' => ['bg' => 'FFEB9C', 'text' => '9C5700'],
                        'rusak' => ['bg' => 'FFC7CE', 'text' => '9C0006'],
                        'maintenance' => ['bg' => 'DDEBF7', 'text' => '1F4E78'],
                    ];

                    if (isset($statusColorMap[$status])) {
                        $sheet->getStyle('U' . $row)->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => $statusColorMap[$status]['bg']],
                            ],
                            'font' => [
                                'bold' => true,
                                'color' => ['rgb' => $statusColorMap[$status]['text']],
                            ],
                        ]);
                    }
                }

                // Warna conditional untuk kondisi
                for ($row = 2; $row <= $highestRow; $row++) {
                    $kondisi = $sheet->getCell('R' . $row)->getValue();
                    
                    $kondisiColorMap = [
                        'baik' => ['bg' => 'C6EFCE', 'text' => '006100'],
                        'rusak ringan' => ['bg' => 'FFEB9C', 'text' => '9C5700'],
                        'rusak berat' => ['bg' => 'FFC7CE', 'text' => '9C0006'],
                    ];

                    if (isset($kondisiColorMap[$kondisi])) {
                        $sheet->getStyle('R' . $row)->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => $kondisiColorMap[$kondisi]['bg']],
                            ],
                            'font' => [
                                'bold' => true,
                                'color' => ['rgb' => $kondisiColorMap[$kondisi]['text']],
                            ],
                        ]);
                    }
                }

                // ✅ Warna conditional untuk Dapat Dipinjam
                for ($row = 2; $row <= $highestRow; $row++) {
                    $dapatDipinjam = $sheet->getCell('W' . $row)->getValue();
                    
                    if ($dapatDipinjam === 'Ya') {
                        $sheet->getStyle('W' . $row)->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => 'C6EFCE'], // Hijau muda
                            ],
                            'font' => [
                                'bold' => true,
                                'color' => ['rgb' => '006100'], // Hijau tua
                            ],
                        ]);
                    } else {
                        $sheet->getStyle('W' . $row)->applyFromArray([
                            'fill' => [
                                'fillType' => Fill::FILL_SOLID,
                                'startColor' => ['rgb' => 'FFC7CE'], // Merah muda
                            ],
                            'font' => [
                                'bold' => true,
                                'color' => ['rgb' => '9C0006'], // Merah tua
                            ],
                        ]);
                    }
                }

                // Text wrapping untuk kolom spesifikasi dan deskripsi
                $sheet->getStyle('I2:I' . $highestRow)
                    ->getAlignment()
                    ->setWrapText(true);
                    
                $sheet->getStyle('X2:X' . $highestRow)
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
        return 'Data Barang';
    }
}