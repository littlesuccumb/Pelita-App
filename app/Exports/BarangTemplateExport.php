<?php

namespace App\Exports;

use App\Models\KategoriBarang;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

class BarangTemplateExport implements 
    FromArray, 
    WithHeadings, 
    WithStyles, 
    WithColumnWidths,
    WithEvents
{
    /**
     * Data contoh (2 baris untuk panduan)
     */
    public function array(): array
    {
        return [
            [
                'Laptop Asus VivoBook',
                'Komputer',
                'Asus',
                'VivoBook',
                'X441BA',
                '2023',
                'Intel Core i5, RAM 8GB, SSD 256GB',
                'Hitam',
                '2.1',
                '35x24x2 cm',
                '1 Tahun',
                '2023-01-15',
                '8000000',
                '100000',
                'Baik',
                'Ruang Lab 1',
                'Laptop untuk kegiatan workshop',
                '5',
                '5',
                'Ya'
            ],
            [
                'Proyektor Epson EB-X41',
                'Elektronik',
                'Epson',
                'EB-X41',
                'EB-X41-2023',
                '2023',
                '3600 lumens, HDMI, VGA',
                'Putih',
                '3.5',
                '30x25x10 cm',
                '2 Tahun',
                '2023-06-20',
                '5000000',
                '150000',
                'Baik',
                'Ruang Pertemuan',
                'Proyektor HD untuk presentasi',
                '3',
                '3',
                'Ya'
            ],
        ];
    }

    /**
     * Header kolom dengan keterangan (* = wajib)
     */
    public function headings(): array
    {
        return [
            'Nama Barang *',
            'Kategori *',
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
            'Harga Sewa',
            'Kondisi',
            'Lokasi',
            'Deskripsi',
            'Jumlah Total',
            'Jumlah Tersedia',
            'Dapat Dipinjam',
        ];
    }

    /**
     * Style untuk worksheet
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Header row (baris 1)
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                    'size' => 12
                ],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '4472C4']
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    /**
     * Set lebar kolom
     */
    public function columnWidths(): array
    {
        return [
            'A' => 25,  // Nama Barang
            'B' => 15,  // Kategori
            'C' => 15,  // Merk
            'D' => 15,  // Type
            'E' => 15,  // Seri
            'F' => 12,  // Tahun Produksi
            'G' => 35,  // Spesifikasi
            'H' => 12,  // Warna
            'I' => 10,  // Berat
            'J' => 15,  // Dimensi
            'K' => 12,  // Garansi
            'L' => 15,  // Tanggal Pembelian
            'M' => 15,  // Harga Beli
            'N' => 15,  // Harga Sewa
            'O' => 12,  // Kondisi
            'P' => 20,  // Lokasi
            'Q' => 35,  // Deskripsi
            'R' => 12,  // Jumlah Total
            'S' => 12,  // Jumlah Tersedia
            'T' => 15,  // Dapat Dipinjam
        ];
    }

    /**
     * Event untuk styling tambahan dan instruksi
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();
                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                // Set tinggi header
                $sheet->getRowDimension(1)->setRowHeight(25);

                // Border untuk semua cell
                $sheet->getStyle('A1:' . $highestColumn . $highestRow)
                    ->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                                'color' => ['rgb' => 'CCCCCC'],
                            ],
                        ],
                    ]);

                // Zebra striping untuk data contoh
                for ($row = 2; $row <= $highestRow; $row++) {
                    if ($row % 2 == 0) {
                        $sheet->getStyle('A' . $row . ':' . $highestColumn . $row)
                            ->applyFromArray([
                                'fill' => [
                                    'fillType' => Fill::FILL_SOLID,
                                    'startColor' => ['rgb' => 'F2F2F2'],
                                ],
                            ]);
                    }
                }

                // Vertical alignment
                $sheet->getStyle('A1:' . $highestColumn . $highestRow)
                    ->getAlignment()
                    ->setVertical(Alignment::VERTICAL_CENTER);

                // Text wrapping untuk kolom tertentu
                $sheet->getStyle('G:G')->getAlignment()->setWrapText(true); // Spesifikasi
                $sheet->getStyle('Q:Q')->getAlignment()->setWrapText(true); // Deskripsi

                // Freeze pane
                $sheet->freezePane('A2');

                // Auto-filter
                $sheet->setAutoFilter('A1:' . $highestColumn . '1');

                // TAMBAHKAN SHEET INSTRUKSI
                $workbook = $sheet->getParent();
                $instructionSheet = $workbook->createSheet(1);
                $instructionSheet->setTitle('Instruksi');

                // Judul
                $instructionSheet->setCellValue('A1', 'INSTRUKSI PENGGUNAAN TEMPLATE IMPORT BARANG');
                $instructionSheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 16, 'color' => ['rgb' => '4472C4']],
                ]);
                $instructionSheet->mergeCells('A1:D1');

                // Instruksi umum
                $row = 3;
                $instructionSheet->setCellValue('A' . $row, 'LANGKAH-LANGKAH:');
                $instructionSheet->getStyle('A' . $row)->getFont()->setBold(true);
                
                $row++;
                $instructionSheet->setCellValue('A' . $row, '1. Isi data di sheet "Template Barang" sesuai format yang ada');
                $row++;
                $instructionSheet->setCellValue('A' . $row, '2. Hapus 2 baris contoh data sebelum mengupload');
                $row++;
                $instructionSheet->setCellValue('A' . $row, '3. Kolom dengan tanda (*) wajib diisi');
                $row++;
                $instructionSheet->setCellValue('A' . $row, '4. Simpan file dan upload ke sistem');
                
                $row += 2;
                $instructionSheet->setCellValue('A' . $row, 'PENJELASAN KOLOM:');
                $instructionSheet->getStyle('A' . $row)->getFont()->setBold(true);

                // Tabel penjelasan
                $row++;
                $explanations = [
                    ['Nama Barang *', 'Wajib diisi, maksimal 255 karakter'],
                    ['Kategori *', 'Wajib diisi, harus sesuai dengan kategori yang ada di sistem'],
                    ['Merk', 'Opsional, contoh: Asus, Epson, Canon'],
                    ['Type', 'Opsional, contoh: VivoBook, EB-X41'],
                    ['Seri', 'Opsional, nomor seri produk'],
                    ['Tahun Produksi', 'Opsional, contoh: 2023'],
                    ['Spesifikasi', 'Opsional, detail teknis barang'],
                    ['Warna', 'Opsional, warna barang'],
                    ['Berat (kg)', 'Opsional, dalam kilogram (angka saja)'],
                    ['Dimensi', 'Opsional, contoh: 35x24x2 cm'],
                    ['Garansi', 'Opsional, contoh: 1 Tahun, 2 Tahun'],
                    ['Tanggal Pembelian', 'Opsional, format: YYYY-MM-DD atau DD/MM/YYYY'],
                    ['Harga Beli', 'Opsional, angka saja (tanpa Rp, titik, atau koma)'],
                    ['Harga Sewa', 'Opsional, angka saja (tanpa Rp, titik, atau koma)'],
                    ['Kondisi', 'Pilihan: Baik, Rusak Ringan, Rusak Berat (default: Baik)'],
                    ['Lokasi', 'Opsional, lokasi penyimpanan barang'],
                    ['Deskripsi', 'Opsional, keterangan tambahan'],
                    ['Jumlah Total', 'Opsional, jumlah total barang (default: 1)'],
                    ['Jumlah Tersedia', 'Opsional, jumlah yang tersedia (default: sama dengan Jumlah Total)'],
                    ['Dapat Dipinjam', 'Pilihan: Ya / Tidak (default: Ya)'],
                ];

                $instructionSheet->setCellValue('A' . $row, 'Kolom');
                $instructionSheet->setCellValue('B' . $row, 'Keterangan');
                $instructionSheet->getStyle('A' . $row . ':B' . $row)->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'D9E1F2']
                    ],
                ]);

                foreach ($explanations as $exp) {
                    $row++;
                    $instructionSheet->setCellValue('A' . $row, $exp[0]);
                    $instructionSheet->setCellValue('B' . $row, $exp[1]);
                }

                // Border untuk tabel penjelasan
                $lastRow = $row;
                $instructionSheet->getStyle('A' . ($row - count($explanations)) . ':B' . $lastRow)
                    ->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                            ],
                        ],
                    ]);

                // Set column width
                $instructionSheet->getColumnDimension('A')->setWidth(25);
                $instructionSheet->getColumnDimension('B')->setWidth(70);

                // TAMBAHKAN SHEET DAFTAR KATEGORI
                $categorySheet = $workbook->createSheet(2);
                $categorySheet->setTitle('Daftar Kategori');

                $categorySheet->setCellValue('A1', 'DAFTAR KATEGORI YANG TERSEDIA');
                $categorySheet->getStyle('A1')->applyFromArray([
                    'font' => ['bold' => true, 'size' => 14, 'color' => ['rgb' => '4472C4']],
                ]);

                $categorySheet->setCellValue('A3', 'No');
                $categorySheet->setCellValue('B3', 'Nama Kategori');
                $categorySheet->getStyle('A3:B3')->applyFromArray([
                    'font' => ['bold' => true],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => ['rgb' => 'D9E1F2']
                    ],
                ]);

                // Ambil semua kategori dari database
                $categories = KategoriBarang::select('nama_kategori')->orderBy('nama_kategori')->get();
                $catRow = 4;
                foreach ($categories as $index => $category) {
                    $categorySheet->setCellValue('A' . $catRow, $index + 1);
                    $categorySheet->setCellValue('B' . $catRow, $category->nama_kategori);
                    $catRow++;
                }

                // Border untuk tabel kategori
                $categorySheet->getStyle('A3:B' . ($catRow - 1))
                    ->applyFromArray([
                        'borders' => [
                            'allBorders' => [
                                'borderStyle' => Border::BORDER_THIN,
                            ],
                        ],
                    ]);

                $categorySheet->getColumnDimension('A')->setWidth(8);
                $categorySheet->getColumnDimension('B')->setWidth(35);

                // Kembali ke sheet pertama sebagai default
                $workbook->setActiveSheetIndex(0);
            },
        ];
    }
}