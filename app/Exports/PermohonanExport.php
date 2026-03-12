<?php

namespace App\Exports;

use App\Models\Permohonan;
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

class PermohonanExport implements 
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
     * Ambil collection data permohonan
     */
    public function collection()
    {
        $query = Permohonan::with(['user', 'items.barang']);

        // Apply filters jika ada
        if ($this->request) {
            // Filter status
            if (isset($this->request['status']) && !empty($this->request['status'])) {
                $query->where('status', $this->request['status']);
            }
            
            // Filter search
            if (isset($this->request['search']) && !empty($this->request['search'])) {
                $search = $this->request['search'];
                $query->where(function($q) use ($search) {
                    $q->where('nama_pemohon', 'LIKE', "%{$search}%")
                      ->orWhere('no_permohonan', 'LIKE', "%{$search}%")
                      ->orWhereHas('user', function($userQuery) use ($search) {
                          $userQuery->where('name', 'LIKE', "%{$search}%")
                                   ->orWhere('email', 'LIKE', "%{$search}%");
                      });
                });
            }

            // Filter tanggal mulai
            if (isset($this->request['tanggal_mulai']) && !empty($this->request['tanggal_mulai'])) {
                $query->whereDate('created_at', '>=', $this->request['tanggal_mulai']);
            }
            
            // Filter tanggal selesai
            if (isset($this->request['tanggal_selesai']) && !empty($this->request['tanggal_selesai'])) {
                $query->whereDate('created_at', '<=', $this->request['tanggal_selesai']);
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
            'No Permohonan',
            'Nama Pemohon',
            'Instansi',
            'Email',
            'Tanggal Pengajuan',
            'Status',
            'Jumlah Items',
            'Total Biaya',
            'Keterangan',
        ];
    }

    /**
     * Mapping data ke row Excel
     */
    public function map($permohonan): array
    {
        static $no = 0;
        $no++;
        
        return [
            $no,
            $permohonan->no_permohonan,
            $permohonan->nama_pemohon,
            $permohonan->nama_instansi ?? '-',
            $permohonan->user->email ?? '-',
            $permohonan->created_at->format('d/m/Y H:i'),
            $permohonan->status,
            $permohonan->items->count(),
            $permohonan->total_biaya ?? 0,
            $permohonan->status == 'Ditolak' ? ($permohonan->sub_sektor ?? '-') : '-',
        ];
    }

    /**
     * Set lebar kolom
     */
    public function columnWidths(): array
    {
        return [
            'A' => 5,   // No
            'B' => 20,  // No Permohonan
            'C' => 25,  // Nama Pemohon
            'D' => 30,  // Instansi
            'E' => 25,  // Email
            'F' => 20,  // Tanggal
            'G' => 15,  // Status
            'H' => 12,  // Jumlah Items
            'I' => 15,  // Total Biaya
            'J' => 35,  // Keterangan
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
                        'startColor' => ['rgb' => '4472C4'],
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
                $sheet->getStyle('I2:I' . $highestRow)->getNumberFormat()
                    ->setFormatCode('Rp #,##0');

                // Center alignment untuk kolom tertentu
                $sheet->getStyle('A2:A' . $highestRow)->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);
                
                $sheet->getStyle('G2:H' . $highestRow)->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Vertical alignment untuk semua data
                $sheet->getStyle('A2:' . $highestColumn . $highestRow)->getAlignment()
                    ->setVertical(Alignment::VERTICAL_CENTER);

                // Warna conditional untuk status
                for ($row = 2; $row <= $highestRow; $row++) {
                    $status = $sheet->getCell('G' . $row)->getValue();
                    
                    $colorMap = [
                        'Disetujui' => ['bg' => 'C6EFCE', 'text' => '006100'],
                        'Ditolak' => ['bg' => 'FFC7CE', 'text' => '9C0006'],
                        'Dalam Proses' => ['bg' => 'FFEB9C', 'text' => '9C5700'],
                    ];

                    if (isset($colorMap[$status])) {
                        $sheet->getStyle('G' . $row)->applyFromArray([
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

                // Text wrapping untuk kolom keterangan
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
        return 'Data Permohonan';
    }
}