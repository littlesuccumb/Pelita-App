<?php

namespace App\Exports;

use App\Models\Maintenance;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use Maatwebsite\Excel\Concerns\WithTitle;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class MaintenanceExport implements FromCollection, WithHeadings, WithMapping, WithStyles, WithColumnWidths, WithTitle
{
    protected $filters;
    protected $rowNumber = 0;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Maintenance::with(['barang.kategori']);

        // Apply filters
        if (isset($this->filters['status']) && $this->filters['status'] !== 'all') {
            $query->where('status', $this->filters['status']);
        }

        if (isset($this->filters['jenis_maintenance']) && $this->filters['jenis_maintenance']) {
            $query->where('jenis_maintenance', $this->filters['jenis_maintenance']);
        }

        if (isset($this->filters['tanggal_dari']) && $this->filters['tanggal_dari']) {
            $query->whereDate('tanggal', '>=', $this->filters['tanggal_dari']);
        }

        if (isset($this->filters['tanggal_sampai']) && $this->filters['tanggal_sampai']) {
            $query->whereDate('tanggal', '<=', $this->filters['tanggal_sampai']);
        }

        if (isset($this->filters['search']) && $this->filters['search']) {
            $search = $this->filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('deskripsi', 'LIKE', "%{$search}%")
                  ->orWhere('teknisi', 'LIKE', "%{$search}%")
                  ->orWhereHas('barang', function($subQ) use ($search) {
                      $subQ->where('nama_barang', 'LIKE', "%{$search}%")
                           ->orWhere('kode_barang', 'LIKE', "%{$search}%");
                  });
            });
        }

        return $query->orderBy('tanggal', 'desc')->get();
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'NO',
            'KODE BARANG',
            'NAMA BARANG',
            'KATEGORI',
            'JENIS MAINTENANCE',
            'TANGGAL',
            'JUMLAH UNIT',
            'TEKNISI',
            'BIAYA',
            'STATUS',
            'TANGGAL SELESAI',
            'DESKRIPSI',
            'CATATAN PENYELESAIAN',
        ];
    }

    /**
     * @param mixed $maintenance
     * @return array
     */
    public function map($maintenance): array
    {
        $this->rowNumber++;
        
        $barang = $maintenance->barang;
        
        return [
            $this->rowNumber,
            $barang ? $barang->kode_barang : 'N/A',
            $barang ? $barang->nama_barang : 'Barang Terhapus',
            $barang && $barang->kategori ? $barang->kategori->nama_kategori : '-',
            strtoupper($maintenance->jenis_maintenance),
            Carbon::parse($maintenance->tanggal)->format('d/m/Y'),
            $maintenance->jumlah ?? 1,
            $maintenance->teknisi ?? '-',
            number_format($maintenance->biaya, 0, ',', '.'),
            strtoupper(str_replace('_', ' ', $maintenance->status)),
            $maintenance->tanggal_selesai ? Carbon::parse($maintenance->tanggal_selesai)->format('d/m/Y H:i') : '-',
            $maintenance->deskripsi ?? '-',
            $maintenance->catatan_penyelesaian ?? '-',
        ];
    }

    /**
     * @param Worksheet $sheet
     * @return array
     */
    public function styles(Worksheet $sheet)
    {
        // Style untuk header
        $sheet->getStyle('A1:M1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 11,
            ],
            'fill' => [
                'fillType' => Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'EA580C'], // Orange
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

        // Style untuk semua data
        $lastRow = $this->rowNumber + 1;
        $sheet->getStyle("A2:M{$lastRow}")->applyFromArray([
            'borders' => [
                'allBorders' => [
                    'borderStyle' => Border::BORDER_THIN,
                    'color' => ['rgb' => 'CCCCCC'],
                ],
            ],
            'alignment' => [
                'vertical' => Alignment::VERTICAL_CENTER,
            ],
        ]);

        // Center align untuk kolom tertentu
        $sheet->getStyle("A2:A{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("G2:G{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("J2:J{$lastRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // Set row height
        $sheet->getRowDimension(1)->setRowHeight(25);

        return [];
    }

    /**
     * @return array
     */
    public function columnWidths(): array
    {
        return [
            'A' => 5,   // NO
            'B' => 18,  // KODE BARANG
            'C' => 25,  // NAMA BARANG
            'D' => 20,  // KATEGORI
            'E' => 15,  // JENIS
            'F' => 12,  // TANGGAL
            'G' => 10,  // JUMLAH
            'H' => 20,  // TEKNISI
            'I' => 15,  // BIAYA
            'J' => 15,  // STATUS
            'K' => 18,  // TGL SELESAI
            'L' => 40,  // DESKRIPSI
            'M' => 40,  // CATATAN
        ];
    }

    /**
     * @return string
     */
    public function title(): string
    {
        return 'Data Maintenance';
    }
}