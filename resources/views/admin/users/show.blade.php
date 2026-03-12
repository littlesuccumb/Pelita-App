
@extends('layouts.app')

@section('title', 'Detail User - Super Admin')

@push('styles')
<style>
@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

@keyframes slideUp {
    from { transform: translateY(8px); opacity: 0; }
    to { transform: translateY(0); opacity: 1; }
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.8; }
}

@keyframes slideInRight {
    from {
        transform: translateX(20px);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slideOutRight {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(20px);
        opacity: 0;
    }
}

.animate-fade-in { animation: fadeIn 0.4s ease-out !important; }
.animate-slide-up { animation: slideUp 0.3s ease-out !important; }
.animate-pulse-slow { animation: pulse 3s infinite !important; }

/* Dark mode transitions */
* {
    transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
}

.card-hover {
    transition: all 0.3s ease-in-out;
}

.card-hover:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 25px -8px rgba(0, 0, 0, 0.15);
}

.dark .card-hover:hover {
    box-shadow: 0 10px 25px -8px rgba(0, 0, 0, 0.3);
}

.action-btn {
    transition: all 0.3s ease;
}

.action-btn:hover {
    transform: scale(1.05);
}

.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0,0,0,0.5);
    backdrop-filter: blur(4px);
}

.modal.show {
    display: block !important;
}

.modal-content {
    background-color: white;
    margin: 5% auto;
    padding: 20px;
    border-radius: 12px;
    width: 90%;
    max-width: 500px;
    max-height: 80vh;
    overflow-y: auto;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
}

.dark .modal-content {
    background-color: #1f2937;
}

.close {
    color: #9ca3af;
    float: right;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
    line-height: 20px;
}

.close:hover,
.close:focus {
    color: #374151;
}

.dark .close:hover,
.dark .close:focus {
    color: #d1d5db;
}

.notification {
    backdrop-filter: blur(10px);
    border-left: 4px solid;
    animation: slideInRight 0.5s ease-out;
}

.success { border-left-color: #10b981; }
.error { border-left-color: #ef4444; }
.info { border-left-color: #3b82f6; }

.activity-item {
    transition: all 0.3s ease;
}

.activity-item:hover {
    transform: translateX(2px);
}

.role-badge {
    display: inline-flex;
    align-items: center;
    padding: 0.5rem 1rem;
    border-radius: 9999px;
    font-size: 0.875rem;
    font-weight: 600;
}

.custom-scrollbar::-webkit-scrollbar {
    width: 5px;
}

.custom-scrollbar::-webkit-scrollbar-track {
    background: #f3f4f6;
    border-radius: 10px;
}

.dark .custom-scrollbar::-webkit-scrollbar-track {
    background: #374151;
}

.custom-scrollbar::-webkit-scrollbar-thumb {
    background: linear-gradient(135deg, #3b82f6 0%, #6366f1 100%);
    border-radius: 10px;
}

</style>
@endpush

@section('content')
<div class="w-full">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-2 lg:py-4">
    {{-- Modern Breadcrumb Navigation --}}
    <nav class="mb-8 animate-fade-in" aria-label="Breadcrumb">
        <div class="breadcrumb-modern">
            <a href="{{ route('dashboard') }}" class="breadcrumb-link">
                <i class="fas fa-home"></i>
                <span>Dashboard</span>
            </a>
            
            <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 text-xs"></i>
            
            <a href="{{ route('admin.users.index') }}" class="breadcrumb-link">
                <i class="fas fa-users"></i>
                <span>Kelola User</span>
            </a>
            
            <i class="fas fa-chevron-right text-gray-300 dark:text-gray-600 text-xs"></i>
            
            <span class="breadcrumb-current" title="{{ $user->name }}">
                <i class="fas fa-user"></i>
                <span>{{ Str::limit($user->name, 30) }}</span>
            </span>
        </div>
    </nav>
    
    {{-- Modern Header Section with Enhanced Design --}}
    <div class="mb-8 animate-fade-in">
        <div class="relative overflow-hidden bg-gradient-to-br from-white via-blue-50/30 to-indigo-50/50 dark:from-gray-800 dark:via-gray-800/95 dark:to-gray-800/90 rounded-2xl shadow-xl border border-white/60 dark:border-gray-700 backdrop-blur-sm">
            
            {{-- Decorative Background Elements --}}
            <div class="absolute top-0 right-0 w-64 h-64 bg-gradient-to-br from-blue-400/20 via-indigo-400/20 to-purple-400/20 dark:from-blue-600/10 dark:via-indigo-600/10 dark:to-purple-600/10 rounded-full blur-3xl transform translate-x-32 -translate-y-32"></div>
            <div class="absolute bottom-0 left-0 w-48 h-48 bg-gradient-to-tr from-cyan-400/15 to-blue-400/15 dark:from-cyan-600/10 dark:to-blue-600/10 rounded-full blur-2xl transform -translate-x-24 translate-y-24"></div>
            
            {{-- Animated Particles --}}
            <div class="absolute inset-0 overflow-hidden pointer-events-none">
                <div class="absolute top-10 left-10 w-2 h-2 bg-blue-400 dark:bg-blue-500 rounded-full animate-pulse opacity-60"></div>
                <div class="absolute top-20 right-20 w-1.5 h-1.5 bg-indigo-400 dark:bg-indigo-500 rounded-full animate-pulse opacity-40" style="animation-delay: 0.5s;"></div>
                <div class="absolute bottom-16 left-1/3 w-1 h-1 bg-purple-400 dark:bg-purple-500 rounded-full animate-pulse opacity-50" style="animation-delay: 1s;"></div>
            </div>
            
            {{-- Content Container --}}
            <div class="relative p-8 lg:p-10">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-6">
                    
                    {{-- Left Section: Title & Info --}}
                    <div class="flex items-center space-x-4">
                        {{-- Avatar --}}
                        @if($user->avatar)
                            <img src="{{ Storage::url($user->avatar) }}" 
                                 alt="{{ $user->name }}"
                                 class="w-20 h-20 rounded-2xl border-4 border-white dark:border-gray-700 shadow-xl object-cover">
                        @else
                            <div class="w-20 h-20 rounded-2xl border-4 border-white dark:border-gray-700 shadow-xl bg-gradient-to-br from-purple-500 to-pink-500 flex items-center justify-center">
                                <span class="text-white text-3xl font-bold">{{ strtoupper(substr($user->name, 0, 1)) }}</span>
                            </div>
                        @endif
                        
                        <div class="flex-1">
                            {{-- Icon Badge --}}
                            <div class="inline-flex items-center space-x-2 px-4 py-2 bg-gradient-to-r from-blue-500/10 to-indigo-500/10 dark:from-blue-600/20 dark:to-indigo-600/20 border border-blue-200/50 dark:border-blue-700/50 rounded-full mb-3">
                                <div class="w-2 h-2 bg-blue-500 dark:bg-blue-400 rounded-full animate-pulse"></div>
                                <span class="text-sm font-semibold text-blue-700 dark:text-blue-300">Detail User</span>
                            </div>
                            
                            {{-- Main Title --}}
                            <h1 class="text-3xl lg:text-4xl font-bold mb-2 bg-gradient-to-r from-slate-800 via-blue-800 to-indigo-800 dark:from-slate-100 dark:via-blue-200 dark:to-indigo-200 bg-clip-text text-transparent leading-tight">
                                {{ $user->name }}
                            </h1>
                            
                            {{-- Description --}}
                            <p class="text-slate-600 dark:text-slate-400 flex items-center space-x-2">
                                <i class="fas fa-envelope text-blue-500 dark:text-blue-400"></i>
                                <span>{{ $user->email }}</span>
                            </p>
                            <p class="text-sm text-slate-500 dark:text-slate-500 mt-1">
                                ID: #{{ $user->id }} • Bergabung {{ $user->created_at->format('d M Y') }}
                            </p>
                        </div>
                    </div>
                    
                    {{-- Right Section: Role Badge & Actions --}}
                    <div class="flex flex-col sm:flex-row items-start sm:items-center gap-4">
                        <span class="role-badge
                            @if($user->role === 'super_admin') bg-gradient-to-r from-red-50 to-pink-50 dark:from-red-900/30 dark:to-pink-900/30 text-red-800 dark:text-red-300 border border-red-200 dark:border-red-700
                            @elseif($user->role === 'admin') bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/30 dark:to-indigo-900/30 text-blue-800 dark:text-blue-300 border border-blue-200 dark:border-blue-700
                            @elseif($user->role === 'pengurus_aset') bg-gradient-to-r from-green-50 to-emerald-50 dark:from-green-900/30 dark:to-emerald-900/30 text-green-800 dark:text-green-300 border border-green-200 dark:border-green-700
                            @else bg-gradient-to-r from-gray-50 to-slate-50 dark:from-gray-700 dark:to-slate-700 text-gray-800 dark:text-gray-300 border border-gray-200 dark:border-gray-600 @endif
                            shadow-md">
                            @if($user->role === 'super_admin')
                                <i class="fas fa-crown mr-2"></i>Super Admin
                            @elseif($user->role === 'admin')
                                <i class="fas fa-shield-alt mr-2"></i>Admin
                            @elseif($user->role === 'pengurus_aset')
                                <i class="fas fa-box mr-2"></i>Pengurus Aset
                            @else
                                <i class="fas fa-user mr-2"></i>User
                            @endif
                        </span>
                        
                        {{-- Action Buttons --}}
                        <div class="flex gap-2">
                            <a href="{{ route('admin.users.edit', $user->id) }}"
                               class="action-btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium text-sm rounded-xl hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                                <i class="fas fa-edit mr-2"></i>
                                Edit
                            </a>
                            
                            @if($user->avatar)
                                <button type="button" onclick="openDeleteAvatarModal('{{ $user->id }}', '{{ $user->name }}')"
                                        class="action-btn inline-flex items-center px-4 py-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-medium text-sm rounded-xl hover:from-orange-600 hover:to-orange-700 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl">
                                    <i class="fas fa-trash mr-2"></i>
                                    Hapus Avatar
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Bottom Accent Line --}}
            <div class="h-1.5 bg-gradient-to-r from-blue-500 via-indigo-500 to-purple-500"></div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- Left Column - Main Info -->
        <div class="lg:col-span-2 space-y-6">
            
            <!-- Basic Info -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.1s">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg mr-3">
                            <i class="fas fa-user text-purple-600 dark:text-purple-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Informasi Dasar</h3>
                    </div>
                    <div class="flex items-center space-x-2">
                        <div class="w-2 h-2 bg-emerald-500 rounded-full"></div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">Verified Account</span>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-2">{{ $user->name }}</h2>
                        <p class="text-gray-600 dark:text-gray-400 flex items-center">
                            <i class="fas fa-envelope mr-2 text-gray-400 dark:text-gray-500"></i>
                            {{ $user->email }}
                        </p>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        @if($user->no_telp)
                            <div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg">
                                <div class="text-xs text-blue-600 dark:text-blue-400 mb-1">
                                    <i class="fas fa-phone mr-1"></i>No. Telepon
                                </div>
                                <div class="font-semibold text-blue-800 dark:text-blue-300">{{ $user->no_telp }}</div>
                            </div>
                        @endif
                        
                        @if($user->no_ktp)
                            <div class="p-3 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg">
                                <div class="text-xs text-indigo-600 dark:text-indigo-400 mb-1">
                                    <i class="fas fa-id-card mr-1"></i>No. KTP
                                </div>
                                <div class="font-mono font-semibold text-indigo-800 dark:text-indigo-300 flex items-center">
                                    <span id="ktp-display">{{ substr($user->no_ktp, 0, 4) }}********{{ substr($user->no_ktp, -4) }}</span>
                                    <button type="button" 
                                            onclick="toggleKTP('{{ $user->no_ktp }}')"
                                            class="ml-2 text-xs text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 transition-colors"
                                            title="Tampilkan/Sembunyikan">
                                        <i id="ktp-icon" class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <div class="text-xs text-indigo-500 dark:text-indigo-400 mt-1">
                                    <i class="fas fa-shield-alt mr-1"></i>Data dilindungi
                                </div>
                            </div>
                        @endif
                        
                        @if($user->jabatan)
                            <div class="p-3 bg-green-50 dark:bg-green-900/30 rounded-lg">
                                <div class="text-xs text-green-600 dark:text-green-400 mb-1">
                                    <i class="fas fa-briefcase mr-1"></i>Jabatan
                                </div>
                                <div class="font-semibold text-green-800 dark:text-green-300">{{ $user->jabatan }}</div>
                            </div>
                        @endif
                        
                        @if($user->instansi)
                            <div class="p-3 bg-purple-50 dark:bg-purple-900/30 rounded-lg">
                                <div class="text-xs text-purple-600 dark:text-purple-400 mb-1">
                                    <i class="fas fa-building mr-1"></i>Instansi
                                </div>
                                <div class="font-semibold text-purple-800 dark:text-purple-300">{{ $user->instansi }}</div>
                            </div>
                        @endif
                    </div>
                    
                    @if($user->nama_organisasi)
                        <div class="p-4 bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-900/30 dark:to-orange-900/30 rounded-xl border border-amber-200 dark:border-amber-700">
                            <div class="text-sm text-amber-700 dark:text-amber-400 mb-2 flex items-center">
                                <i class="fas fa-users mr-2"></i>Organisasi
                            </div>
                            <div class="font-semibold text-amber-900 dark:text-amber-300">{{ $user->nama_organisasi }}</div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Address Info -->
            @if($user->alamat || $user->kelurahan || $user->kecamatan || $user->kabupaten || $user->kode_pos)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.2s">
                    <div class="flex items-center mb-6">
                        <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg mr-3">
                            <i class="fas fa-map-marker-alt text-green-600 dark:text-green-400"></i>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Alamat Lengkap</h3>
                    </div>
                    
                    <div class="space-y-4">
                        @if($user->alamat)
                            <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-200 dark:border-gray-600">
                                <div class="text-sm text-gray-500 dark:text-gray-400 mb-2">
                                    <i class="fas fa-home mr-1"></i>Alamat
                                </div>
                                <div class="text-gray-800 dark:text-gray-200">{{ $user->alamat }}</div>
                            </div>
                        @endif
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @if($user->kelurahan)
                                <div class="p-3 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                                    <div class="text-xs text-slate-600 dark:text-slate-400 mb-1">Kelurahan/Desa</div>
                                    <div class="font-semibold text-slate-800 dark:text-slate-200">{{ $user->kelurahan }}</div>
                                </div>
                            @endif
                            
                            @if($user->kecamatan)
                                <div class="p-3 bg-slate-50 dark:bg-slate-700/50 rounded-lg">
                                    <div class="text-xs text-slate-600 dark:text-slate-400 mb-1">Kecamatan</div>
                                    <div class="font-semibold text-slate-800 dark:text-slate-200">{{ $user->kecamatan }}</div>
                                </div>
                            @endif
                            
                            @if($user->kabupaten)
                                <div class="p-3 bg-indigo-50 dark:bg-indigo-900/30 rounded-lg">
                                    <div class="text-xs text-indigo-600 dark:text-indigo-400 mb-1">Kabupaten/Kota</div>
                                    <div class="font-semibold text-indigo-800 dark:text-indigo-300">{{ $user->kabupaten }}</div>
                                </div>
                            @endif
                            
                            @if($user->kode_pos)
                                <div class="p-3 bg-blue-50 dark:bg-blue-900/30 rounded-lg">
                                    <div class="text-xs text-blue-600 dark:text-blue-400 mb-1">Kode Pos</div>
                                    <div class="font-mono font-semibold text-blue-800 dark:text-blue-300">{{ $user->kode_pos }}</div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endif

            <!-- Recent Permohonan -->
            @if($user->role === 'user' && $recentPermohonan && $recentPermohonan->count() > 0)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.3s">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="p-2 bg-blue-100 dark:bg-blue-900/30 rounded-lg mr-3">
                                <i class="fas fa-file-alt text-blue-600 dark:text-blue-400"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Permohonan Terbaru</h3>
                        </div>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $recentPermohonan->count() }} dari {{ $stats['total_permohonan'] }}</span>
                    </div>
                    
                    <div class="space-y-3">
                        @foreach($recentPermohonan as $permohonan)
                            <div class="activity-item p-4 bg-gradient-to-r from-gray-50 to-slate-50 dark:from-gray-700/50 dark:to-slate-700/50 rounded-xl border border-gray-200 dark:border-gray-600 hover:border-blue-300 dark:hover:border-blue-500 transition-all">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-900 dark:text-gray-100 mb-1">
                                            Permohonan #{{ $permohonan->id }}
                                        </div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400 mb-2">
                                            <i class="fas fa-calendar mr-1"></i>
                                            {{ $permohonan->tanggal_mulai->format('d M Y') }} - {{ $permohonan->tanggal_selesai->format('d M Y') }}
                                        </div>
                                        @if($permohonan->items && $permohonan->items->count() > 0)
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                <i class="fas fa-cube mr-1"></i>
                                                {{ $permohonan->items->sum('jumlah') }} unit total
                                            </div>
                                        @endif
                                    </div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                        @if($permohonan->status === 'Disetujui') bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-700
                                        @elseif($permohonan->status === 'Ditolak') bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300 border border-red-200 dark:border-red-700
                                        @else bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300 border border-amber-200 dark:border-amber-700 @endif">
                                        {{ $permohonan->status }}
                                    </span>
                                </div>
                                @if($permohonan->keperluan)
                                    <div class="text-sm text-gray-600 dark:text-gray-400 bg-white dark:bg-gray-800 rounded-lg p-2 mt-2">
                                        <i class="fas fa-info-circle mr-1 text-blue-500 dark:text-blue-400"></i>
                                        {{ Str::limit($permohonan->keperluan, 80) }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    
                    @if($stats['total_permohonan'] > 5)
                        <div class="mt-4 text-center">
                            <a href="{{ route('admin.permohonan.index', ['user' => $user->id]) }}" 
                               class="text-sm text-blue-600 dark:text-blue-400 hover:text-blue-800 dark:hover:text-blue-300 font-medium">
                                Lihat semua permohonan →
                            </a>
                        </div>
                    @endif
                </div>
            @endif

            <!-- Recent Peminjaman -->
            @if($user->role === 'user' && $recentPeminjaman && $recentPeminjaman->count() > 0)
                <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.4s">
                    <div class="flex items-center justify-between mb-6">
                        <div class="flex items-center">
                            <div class="p-2 bg-amber-100 dark:bg-amber-900/30 rounded-lg mr-3">
                                <i class="fas fa-handshake text-amber-600 dark:text-amber-400"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Peminjaman Barang Terbaru</h3>
                        </div>
                        <span class="text-sm text-gray-500 dark:text-gray-400">{{ $recentPeminjaman->count() }} dari {{ $stats['total_peminjaman'] }}</span>
                    </div>
                    
                    <div class="space-y-3">
                        @foreach($recentPeminjaman as $peminjaman)
                            <div class="activity-item p-4 bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-900/30 dark:to-orange-900/30 rounded-xl border border-amber-200 dark:border-amber-700 hover:border-amber-300 dark:hover:border-amber-600 transition-all">
                                <div class="flex items-start justify-between mb-2">
                                    <div class="flex-1">
                                        <div class="font-semibold text-gray-900 dark:text-gray-100 mb-1">
                                            {{ $peminjaman->barang->nama_barang ?? 'Barang tidak tersedia' }}
                                        </div>
                                        <div class="text-sm text-gray-600 dark:text-gray-400 mb-1">
                                            <i class="fas fa-calendar mr-1"></i>
                                            {{ $peminjaman->tanggal_mulai->format('d M Y') }} - {{ $peminjaman->tanggal_selesai->format('d M Y') }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            <i class="fas fa-tag mr-1"></i>
                                            {{ $peminjaman->barang->kategori->nama_kategori ?? 'Kategori' }}
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold
                                        @if($peminjaman->status === 'disetujui') bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300 border border-emerald-200 dark:border-emerald-700
                                        @elseif($peminjaman->status === 'selesai') bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 border border-blue-200 dark:border-blue-700
                                        @elseif($peminjaman->status === 'ditolak') bg-red-100 dark:bg-red-900/30 text-red-800 dark:text-red-300 border border-red-200 dark:border-red-700
                                        @else bg-amber-100 dark:bg-amber-900/30 text-amber-800 dark:text-amber-300 border border-amber-200 dark:border-amber-700 @endif">
                                        {{ ucfirst($peminjaman->status) }}
                                    </span>
                                </div>
                                @if($peminjaman->keperluan)
                                    <div class="text-sm text-gray-600 dark:text-gray-400 bg-white dark:bg-gray-800 rounded-lg p-2 mt-2">
                                        <i class="fas fa-info-circle mr-1 text-amber-500 dark:text-amber-400"></i>
                                        {{ Str::limit($peminjaman->keperluan, 80) }}
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                    
                    @if($stats['total_peminjaman'] > 5)
                        <div class="mt-4 text-center">
                            <a href="{{ route('admin.peminjaman.index', ['user' => $user->id]) }}" 
                               class="text-sm text-amber-600 dark:text-amber-400 hover:text-amber-800 dark:hover:text-amber-300 font-medium">
                                Lihat semua peminjaman →
                            </a>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- Right Column - Stats & Info -->
        <div class="space-y-6">
            
            <!-- Statistics -->
            @if($user->role === 'user')
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.5s">
                <div class="flex items-center mb-6">
                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg mr-3">
                        <i class="fas fa-chart-bar text-indigo-600 dark:text-indigo-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Statistik Aktivitas</h3>
                </div>
                
                <div class="space-y-4">
                    <!-- Permohonan Stats -->
                    <div class="p-4 bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/30 dark:to-indigo-900/30 rounded-xl border border-blue-200 dark:border-blue-700">
                        <div class="text-sm text-blue-700 dark:text-blue-400 mb-3 font-semibold">
                            <i class="fas fa-file-alt mr-2"></i>Permohonan
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-800 dark:text-blue-300">{{ $stats['total_permohonan'] }}</div>
                                <div class="text-xs text-blue-600 dark:text-blue-400">Total</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-emerald-800 dark:text-emerald-300">{{ $stats['permohonan_disetujui'] }}</div>
                                <div class="text-xs text-emerald-600 dark:text-emerald-400">Disetujui</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-amber-800 dark:text-amber-300">{{ $stats['permohonan_pending'] }}</div>
                                <div class="text-xs text-amber-600 dark:text-amber-400">Pending</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-red-800 dark:text-red-300">{{ $stats['permohonan_ditolak'] }}</div>
                                <div class="text-xs text-red-600 dark:text-red-400">Ditolak</div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Peminjaman Stats -->
                    <div class="p-4 bg-gradient-to-r from-amber-50 to-orange-50 dark:from-amber-900/30 dark:to-orange-900/30 rounded-xl border border-amber-200 dark:border-amber-700">
                        <div class="text-sm text-amber-700 dark:text-amber-400 mb-3 font-semibold">
                            <i class="fas fa-handshake mr-2"></i>Peminjaman Barang
                        </div>
                        <div class="grid grid-cols-2 gap-3">
                            <div class="text-center">
                                <div class="text-2xl font-bold text-amber-800 dark:text-amber-300">{{ $stats['total_peminjaman'] }}</div>
                                <div class="text-xs text-amber-600 dark:text-amber-400">Total</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-emerald-800 dark:text-emerald-300">{{ $stats['peminjaman_disetujui'] }}</div>
                                <div class="text-xs text-emerald-600 dark:text-emerald-400">Disetujui</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-blue-800 dark:text-blue-300">{{ $stats['peminjaman_selesai'] }}</div>
                                <div class="text-xs text-blue-600 dark:text-blue-400">Selesai</div>
                            </div>
                            <div class="text-center">
                                <div class="text-2xl font-bold text-red-800 dark:text-red-300">{{ $stats['peminjaman_ditolak'] }}</div>
                                <div class="text-xs text-red-600 dark:text-red-400">Ditolak</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Quick Info -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.6s">
                <div class="flex items-center mb-6">
                    <div class="p-2 bg-purple-100 dark:bg-purple-900/30 rounded-lg mr-3">
                        <i class="fas fa-user-circle text-purple-600 dark:text-purple-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Informasi Akun</h3>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-3 bg-gradient-to-r from-purple-50 to-pink-50 dark:from-purple-900/30 dark:to-pink-900/30 rounded-lg border border-purple-200 dark:border-purple-700">
                        <div>
                            <div class="text-sm text-purple-700 dark:text-purple-400 font-medium">Role</div>
                            <div class="text-lg font-bold text-purple-900 dark:text-purple-300">
                                @if($user->role === 'super_admin')
                                    <i class="fas fa-crown mr-1"></i>Super Admin
                                @elseif($user->role === 'admin')
                                    <i class="fas fa-shield-alt mr-1"></i>Admin
                                @elseif($user->role === 'pengurus_aset')
                                    <i class="fas fa-box mr-1"></i>Pengurus Aset
                                @else
                                    <i class="fas fa-user mr-1"></i>User
                                @endif
                            </div>
                        </div>
                    </div>
                    
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">Status Akun:</span>
                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-semibold bg-emerald-100 dark:bg-emerald-900/30 text-emerald-800 dark:text-emerald-300">
                                <i class="fas fa-check-circle mr-1"></i>Aktif
                            </span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">Email Verified:</span>
                            <span class="font-semibold text-emerald-600 dark:text-emerald-400">
                                <i class="fas fa-check-circle mr-1"></i>Ya
                            </span>
                        </div>
                        <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                            <span class="text-gray-500 dark:text-gray-400">Member Since:</span>
                            <span class="text-slate-600 dark:text-slate-300">{{ $user->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between items-center py-2">
                            <span class="text-gray-500 dark:text-gray-400">Last Updated:</span>
                            <span class="text-slate-600 dark:text-slate-300">{{ $user->updated_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Summary -->
            @if($user->role === 'user')
            <div class="bg-gradient-to-br from-slate-50 to-gray-100 dark:from-slate-800 dark:to-gray-700 rounded-xl p-6 border border-gray-200 dark:border-gray-600 card-hover animate-slide-up" style="animation-delay: 0.7s">
                <div class="flex items-center mb-6">
                    <div class="p-2 bg-slate-100 dark:bg-slate-700 rounded-lg mr-3">
                        <i class="fas fa-history text-slate-600 dark:text-slate-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Ringkasan Aktivitas</h3>
                </div>
                
                <div class="space-y-3">
                    <div class="flex items-center justify-between p-3 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-600">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-file-alt text-blue-600 dark:text-blue-400"></i>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">Total Permohonan</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Semua status</div>
                            </div>
                        </div>
                        <div class="text-2xl font-bold text-blue-600 dark:text-blue-400">{{ $stats['total_permohonan'] }}</div>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-600">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-amber-100 dark:bg-amber-900/30 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-handshake text-amber-600 dark:text-amber-400"></i>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">Total Peminjaman</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Barang dipinjam</div>
                            </div>
                        </div>
                        <div class="text-2xl font-bold text-amber-600 dark:text-amber-400">{{ $stats['total_peminjaman'] }}</div>
                    </div>
                    
                    <div class="flex items-center justify-between p-3 bg-white dark:bg-gray-800 rounded-lg border border-gray-200 dark:border-gray-600">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/30 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-check-circle text-emerald-600 dark:text-emerald-400"></i>
                            </div>
                            <div>
                                <div class="text-sm font-medium text-gray-900 dark:text-gray-100">Tingkat Persetujuan</div>
                                <div class="text-xs text-gray-500 dark:text-gray-400">Permohonan disetujui</div>
                            </div>
                        </div>
                        <div class="text-2xl font-bold text-emerald-600 dark:text-emerald-400 -mr-2">
                            @if($stats['total_permohonan'] > 0)
                                {{ round(($stats['permohonan_disetujui'] / $stats['total_permohonan']) * 100) }}%
                            @else
                                0%
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.8s">
                <div class="flex items-center mb-6">
                    <div class="p-2 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg mr-3">
                        <i class="fas fa-bolt text-indigo-600 dark:text-indigo-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Aksi Cepat</h3>
                </div>
                
                <div class="space-y-3">
                    <a href="{{ route('admin.users.edit', $user->id) }}"
                       class="action-btn w-full flex items-center justify-center px-4 py-3 bg-gradient-to-r from-blue-500 to-blue-600 text-white font-medium text-sm rounded-xl hover:from-blue-600 hover:to-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all duration-200 shadow-lg hover:shadow-xl group">
                        <i class="fas fa-edit mr-2 group-hover:scale-110 transition-transform"></i>
                        Edit Informasi User
                    </a>
                    
                    @if($user->avatar)
                        <button type="button" onclick="openDeleteAvatarModal('{{ $user->id }}', '{{ $user->name }}')"
                                class="action-btn w-full flex items-center justify-center px-4 py-3 bg-white dark:bg-gray-700 text-orange-600 dark:text-orange-400 font-medium text-sm border-2 border-orange-200 dark:border-orange-700 rounded-xl hover:bg-orange-50 dark:hover:bg-orange-900/30 hover:border-orange-300 dark:hover:border-orange-600 focus:outline-none focus:ring-2 focus:ring-orange-500 focus:ring-offset-2 transition-all duration-200 group">
                            <i class="fas fa-trash mr-2 group-hover:scale-110 transition-transform"></i>
                            Hapus Avatar
                        </button>
                    @endif
                    
                    <button type="button" onclick="openDeleteUserModal('{{ $user->id }}', '{{ $user->name }}')"
                            class="action-btn w-full flex items-center justify-center px-4 py-3 bg-white dark:bg-gray-700 text-red-600 dark:text-red-400 font-medium text-sm border border-red-300 dark:border-red-700 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/30 hover:border-red-400 dark:hover:border-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition-all duration-200 group">
                        <i class="fas fa-trash-alt mr-2 group-hover:scale-110 transition-transform"></i>
                        Hapus User
                    </button>
                </div>
            </div>

            <!-- System Info -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 border border-gray-100 dark:border-gray-700 card-hover animate-slide-up" style="animation-delay: 0.9s">
                <div class="flex items-center mb-6">
                    <div class="p-2 bg-gray-100 dark:bg-gray-700 rounded-lg mr-3">
                        <i class="fas fa-info-circle text-gray-600 dark:text-gray-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Informasi Sistem</h3>
                </div>
                
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-gray-500 dark:text-gray-400">User ID:</span>
                        <span class="font-mono text-slate-600 dark:text-slate-300 font-semibold">#{{ $user->id }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-gray-500 dark:text-gray-400">Email:</span>
                        <span class="text-slate-600 dark:text-slate-300 truncate max-w-[150px]" title="{{ $user->email }}">{{ $user->email }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-gray-500 dark:text-gray-400">Role:</span>
                        <span class="font-semibold text-slate-600 dark:text-slate-300">{{ ucfirst(str_replace('_', ' ', $user->role)) }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-gray-500 dark:text-gray-400">Registered:</span>
                        <span class="text-slate-600 dark:text-slate-300">{{ $user->created_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-gray-100 dark:border-gray-700">
                        <span class="text-gray-500 dark:text-gray-400">Last Update:</span>
                        <span class="text-slate-600 dark:text-slate-300">{{ $user->updated_at->format('d M Y, H:i') }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-gray-500 dark:text-gray-400">Has Avatar:</span>
                        <span class="font-semibold {{ $user->avatar ? 'text-emerald-600 dark:text-emerald-400' : 'text-gray-400 dark:text-gray-500' }}">
                            @if($user->avatar)
                                <i class="fas fa-check-circle mr-1"></i>Ya
                            @else
                                <i class="fas fa-times-circle mr-1"></i>Tidak
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal - Delete Avatar -->
    <div id="deleteAvatarModal" class="modal">
        <div class="modal-content">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="p-3 bg-orange-100 dark:bg-orange-900/30 rounded-lg mr-3">
                        <i class="fas fa-trash text-orange-600 dark:text-orange-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Hapus Avatar</h3>
                </div>
                <span class="close" onclick="closeModal('deleteAvatarModal')">&times;</span>
            </div>
            
            <form id="deleteAvatarForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="mb-6 p-4 bg-orange-50 dark:bg-orange-900/20 rounded-lg border border-orange-200 dark:border-orange-800">
                    <p class="text-sm text-orange-800 dark:text-orange-300 mb-1 font-medium">Apakah Anda yakin ingin menghapus avatar untuk user:</p>
                    <p id="deleteAvatarUserName" class="font-semibold text-orange-900 dark:text-orange-200"></p>
                </div>

                <div class="bg-amber-50 dark:bg-amber-900/20 border-l-4 border-amber-400 dark:border-amber-600 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-triangle text-amber-400 dark:text-amber-500"></i>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-amber-700 dark:text-amber-300">
                                Tindakan ini tidak dapat dibatalkan. Avatar akan dihapus secara permanen dari sistem.
                            </p>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="closeModal('deleteAvatarModal')" 
                            class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 border border-gray-300 dark:border-gray-600 rounded-lg font-medium transition-all">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-6 py-2 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-lg font-medium hover:from-orange-600 hover:to-orange-700 transition-all shadow-lg hover:shadow-xl">
                        <i class="fas fa-trash mr-2"></i>
                        Hapus Avatar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal - Delete User -->
    <div id="deleteUserModal" class="modal">
        <div class="modal-content">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="p-3 bg-red-100 dark:bg-red-900/30 rounded-lg mr-3">
                        <i class="fas fa-exclamation-triangle text-red-600 dark:text-red-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Hapus User</h3>
                </div>
                <span class="close" onclick="closeModal('deleteUserModal')">&times;</span>
            </div>
            
            <form id="deleteUserForm" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="mb-6 p-4 bg-red-50 dark:bg-red-900/20 rounded-lg border border-red-200 dark:border-red-800">
                    <p class="text-sm text-red-800 dark:text-red-300 mb-1 font-medium">Apakah Anda yakin ingin menghapus user:</p>
                    <p id="deleteUserName" class="font-semibold text-red-900 dark:text-red-200"></p>
                </div>

                <div class="bg-red-50 dark:bg-red-900/20 border-l-4 border-red-500 dark:border-red-600 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <i class="fas fa-exclamation-circle text-red-500 dark:text-red-400"></i>
                        </div>
                        <div class="ml-3">
                            <h4 class="text-sm font-semibold text-red-800 dark:text-red-300 mb-2">Peringatan!</h4>
                            <ul class="text-sm text-red-700 dark:text-red-400 space-y-1 list-disc list-inside">
                                <li>Tindakan ini tidak dapat dibatalkan</li>
                                <li>Semua data user akan dihapus permanen</li>
                                <li>Riwayat permohonan dan peminjaman akan tetap tersimpan</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end space-x-3">
                    <button type="button" 
                            onclick="closeModal('deleteUserModal')" 
                            class="px-4 py-2 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600 border border-gray-300 dark:border-gray-600 rounded-lg font-medium transition-all">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-6 py-2 bg-gradient-to-r from-red-500 to-red-600 text-white rounded-lg font-medium hover:from-red-600 hover:to-red-700 transition-all shadow-lg hover:shadow-xl">
                        <i class="fas fa-trash-alt mr-2"></i>
                        Hapus User
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Notifications -->
    @if(session('success'))
    <div id="notification" class="fixed top-4 right-4 z-50">
        <div class="notification success bg-white/90 dark:bg-gray-800/90 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 p-4 max-w-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="p-2 bg-green-100 dark:bg-green-900/30 rounded-lg">
                        <i class="fas fa-check-circle text-green-600 dark:text-green-400"></i>
                    </div>
                </div>
                <div class="ml-3">
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Berhasil!</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ session('success') }}</p>
                </div>
                <button onclick="hideNotification()" class="ml-auto text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-1 rounded transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    @endif

    @if(session('error'))
    <div id="notification" class="fixed top-4 right-4 z-50">
        <div class="notification error bg-white/90 dark:bg-gray-800/90 rounded-lg shadow-xl border border-gray-200 dark:border-gray-700 p-4 max-w-sm">
            <div class="flex items-start">
                <div class="flex-shrink-0">
                    <div class="p-2 bg-red-100 dark:bg-red-900/30 rounded-lg">
                        <i class="fas fa-exclamation-circle text-red-600 dark:text-red-400"></i>
                    </div>
                </div>
                <div class="ml-3">
                    <h4 class="text-sm font-semibold text-gray-900 dark:text-gray-100">Error!</h4>
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">{{ session('error') }}</p>
                </div>
                <button onclick="hideNotification()" class="ml-auto text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 p-1 rounded transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection

@push('scripts')
<script>
// KTP Toggle Function
let ktpVisible = false;
function toggleKTP(fullKTP) {
    const display = document.getElementById('ktp-display');
    const icon = document.getElementById('ktp-icon');
    
    if (ktpVisible) {
        // Hide KTP - show masked version
        display.textContent = fullKTP.substring(0, 4) + '********' + fullKTP.substring(fullKTP.length - 4);
        icon.className = 'fas fa-eye';
        ktpVisible = false;
    } else {
        // Show full KTP
        display.textContent = fullKTP;
        icon.className = 'fas fa-eye-slash';
        ktpVisible = true;
        
        // Auto-hide after 10 seconds for security
        setTimeout(() => {
            if (ktpVisible) {
                display.textContent = fullKTP.substring(0, 4) + '********' + fullKTP.substring(fullKTP.length - 4);
                icon.className = 'fas fa-eye';
                ktpVisible = false;
                
                // Show notification
                showSecurityNotification('Nomor KTP disembunyikan kembali untuk keamanan');
            }
        }, 10000);
    }
}

// Security notification for KTP auto-hide
function showSecurityNotification(message) {
    const existingNotif = document.getElementById('security-notif');
    if (existingNotif) existingNotif.remove();
    
    const notif = document.createElement('div');
    notif.id = 'security-notif';
    notif.className = 'fixed bottom-4 right-4 z-50 animate-slide-up';
    notif.innerHTML = `
        <div class="bg-indigo-500 text-white rounded-lg shadow-xl p-4 max-w-sm">
            <div class="flex items-center">
                <i class="fas fa-shield-alt mr-3 text-xl"></i>
                <div>
                    <div class="font-semibold text-sm">Keamanan Data</div>
                    <div class="text-xs mt-1">${message}</div>
                </div>
            </div>
        </div>
    `;
    document.body.appendChild(notif);
    
    setTimeout(() => {
        notif.style.animation = 'slideOutRight 0.5s ease-in forwards';
        setTimeout(() => notif.remove(), 500);
    }, 3000);
}

// Modal Functions
function openDeleteAvatarModal(id, userName) {
    console.log('Opening delete avatar modal for:', userName);
    document.getElementById('deleteAvatarUserName').textContent = userName;
    document.getElementById('deleteAvatarForm').action = `/admin/users/${id}/delete-avatar`;
    document.getElementById('deleteAvatarModal').classList.add('show');
}

function openDeleteUserModal(id, userName) {
    console.log('Opening delete user modal for:', userName);
    document.getElementById('deleteUserName').textContent = userName;
    document.getElementById('deleteUserForm').action = `/admin/users/${id}`;
    document.getElementById('deleteUserModal').classList.add('show');
}

function closeModal(modalId) {
    console.log('Closing modal:', modalId);
    document.getElementById(modalId).classList.remove('show');
    
    // Reset forms
    if (modalId === 'deleteAvatarModal') {
        document.getElementById('deleteAvatarForm').reset();
    } else if (modalId === 'deleteUserModal') {
        document.getElementById('deleteUserForm').reset();
    }
}

function hideNotification() {
    const notification = document.getElementById('notification');
    if (notification) {
        notification.style.animation = 'slideOutRight 0.5s ease-in forwards';
        setTimeout(() => {
            notification.remove();
        }, 500);
    }
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
    const modals = document.querySelectorAll('.modal.show');
    modals.forEach(modal => {
        if (event.target === modal) {
            modal.classList.remove('show');
        }
    });
});

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modals = document.querySelectorAll('.modal.show');
        modals.forEach(modal => {
            modal.classList.remove('show');
        });
    }
});

// Auto hide notifications
@if(session('success') || session('error'))
setTimeout(() => {
    hideNotification();
}, 5000);
@endif

// Keyboard shortcuts
document.addEventListener('keydown', function(e) {   
    // Ctrl/Cmd + E for Edit
    if ((e.ctrlKey || e.metaKey) && e.key === 'e') {
        e.preventDefault();
        window.location.href = '{{ route("admin.users.edit", $user->id) }}';
    }
});

// Enhanced Activity Timeline Animation
document.addEventListener('DOMContentLoaded', function() {
    const activityItems = document.querySelectorAll('.activity-item');
    
    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateX(0)';
            }
        });
    }, {
        threshold: 0.1
    });
    
    activityItems.forEach((item, index) => {
        item.style.opacity = '0';
        item.style.transform = 'translateX(-20px)';
        item.style.transition = `all 0.5s ease ${index * 0.1}s`;
        observer.observe(item);
    });
});


// Console log for debugging
console.log('Admin Users Show - JavaScript loaded successfully');
console.log('User ID:', '{{ $user->id }}');
console.log('User Role:', '{{ $user->role }}');
</script>
@endpush