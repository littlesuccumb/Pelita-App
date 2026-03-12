<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Maintenance</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            font-size: 10px;
            line-height: 1.4;
            color: #333;
        }
        
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid #EA580C;
        }
        
        .header h1 {
            font-size: 18px;
            color: #EA580C;
            margin-bottom: 5px;
        }
        
        .header p {
            font-size: 11px;
            color: #666;
        }
        
        .info-box {
            background: #FFF7ED;
            border: 1px solid #EA580C;
            border-radius: 5px;
            padding: 10px;
            margin-bottom: 15px;
        }
        
        .info-box h3 {
            font-size: 12px;
            color: #EA580C;
            margin-bottom: 8px;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 10px;
        }
        
        .info-item {
            text-align: center;
        }
        
        .info-item .label {
            font-size: 9px;
            color: #666;
            display: block;
            margin-bottom: 3px;
        }
        
        .info-item .value {
            font-size: 14px;
            font-weight: bold;
            color: #EA580C;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        
        table thead {
            background: #EA580C;
            color: white;
        }
        
        table th {
            padding: 8px 5px;
            text-align: left;
            font-size: 9px;
            font-weight: bold;
            border: 1px solid #ddd;
        }
        
        table td {
            padding: 6px 5px;
            border: 1px solid #ddd;
            font-size: 9px;
        }
        
        table tbody tr:nth-child(even) {
            background: #f9f9f9;
        }
        
        .badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 8px;
            font-weight: bold;
        }
        
        .badge-preventif { background: #E0E7FF; color: #3730A3; }
        .badge-korektif { background: #FEF3C7; color: #92400E; }
        .badge-emergency { background: #FEE2E2; color: #991B1B; }
        
        .badge-dijadwalkan { background: #DBEAFE; color: #1E40AF; }
        .badge-dalam_proses { background: #FEF3C7; color: #92400E; }
        .badge-selesai { background: #DCFCE7; color: #166534; }
        .badge-dibatalkan { background: #FEE2E2; color: #991B1B; }
        
        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 1px solid #ddd;
            text-align: center;
            font-size: 9px;
            color: #666;
        }
        
        .text-right { text-align: right; }
        .text-center { text-align: center; }
    </style>
</head>
<body>
    {{-- Header --}}
    <div class="header">
        <h1>LAPORAN DATA MAINTENANCE</h1>
        <p>Cimahi Technopark - Asset Management System</p>
        <p>Dicetak pada: {{ \Carbon\Carbon::now()->format('d/m/Y H:i') }}</p>
    </div>

    {{-- Statistics --}}
    <div class="info-box">
        <h3>Statistik Maintenance</h3>
        <div class="info-grid">
            <div class="info-item">
                <span class="label">Total Maintenance</span>
                <span class="value">{{ $stats['total'] }}</span>
            </div>
            <div class="info-item">
                <span class="label">Sedang Aktif</span>
                <span class="value">{{ $stats['aktif'] }}</span>
            </div>
            <div class="info-item">
                <span class="label">Selesai</span>
                <span class="value">{{ $stats['selesai'] }}</span>
            </div>
            <div class="info-item">
                <span class="label">Total Biaya</span>
                <span class="value">Rp {{ number_format($stats['total_biaya'], 0, ',', '.') }}</span>
            </div>
        </div>
    </div>

    {{-- Filters Info --}}
    @if(array_filter($filters))
    <div style="margin-bottom: 15px; font-size: 9px;">
        <strong>Filter yang diterapkan:</strong>
        @if($filters['status'] !== 'all')
            <span>Status: <strong>{{ ucfirst($filters['status']) }}</strong> • </span>
        @endif
        @if($filters['jenis_maintenance'])
            <span>Jenis: <strong>{{ ucfirst($filters['jenis_maintenance']) }}</strong> • </span>
        @endif
        @if($filters['tanggal_dari'])
            <span>Dari: <strong>{{ \Carbon\Carbon::parse($filters['tanggal_dari'])->format('d/m/Y') }}</strong> • </span>
        @endif
        @if($filters['tanggal_sampai'])
            <span>Sampai: <strong>{{ \Carbon\Carbon::parse($filters['tanggal_sampai'])->format('d/m/Y') }}</strong></span>
        @endif
    </div>
    @endif

    {{-- Table --}}
    <table>
        <thead>
            <tr>
                <th width="3%">NO</th>
                <th width="12%">KODE</th>
                <th width="15%">BARANG</th>
                <th width="10%">KATEGORI</th>
                <th width="8%">JENIS</th>
                <th width="8%">TGL</th>
                <th width="5%">UNIT</th>
                <th width="12%">TEKNISI</th>
                <th width="10%">BIAYA</th>
                <th width="10%">STATUS</th>
                <th width="7%">SELESAI</th>
            </tr>
        </thead>
        <tbody>
            @forelse($maintenance as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>{{ $item->barang?->kode_barang ?? 'N/A' }}</td>
                <td>{{ $item->barang?->nama_barang ?? 'Barang Terhapus' }}</td>
                <td>{{ $item->barang?->kategori?->nama_kategori ?? '-' }}</td>
                <td>
                    <span class="badge badge-{{ $item->jenis_maintenance }}">
                        {{ strtoupper($item->jenis_maintenance) }}
                    </span>
                </td>
                <td>{{ \Carbon\Carbon::parse($item->tanggal)->format('d/m/Y') }}</td>
                <td class="text-center">{{ $item->jumlah ?? 1 }}</td>
                <td>{{ $item->teknisi ?? '-' }}</td>
                <td class="text-right">Rp {{ number_format($item->biaya, 0, ',', '.') }}</td>
                <td>
                    <span class="badge badge-{{ $item->status }}">
                        {{ strtoupper(str_replace('_', ' ', $item->status)) }}
                    </span>
                </td>
                <td class="text-center">
                    {{ $item->tanggal_selesai ? \Carbon\Carbon::parse($item->tanggal_selesai)->format('d/m/Y') : '-' }}
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="11" class="text-center">Tidak ada data</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    {{-- Footer --}}
    <div class="footer">
        <p>Dokumen ini digenerate otomatis oleh sistem Pelita App</p>
        <p>© {{ date('Y') }} Cimahi Technopark. All rights reserved.</p>
    </div>
</body>
</html>