@extends('layouts.user')

@section('title', 'Edit Permohonan - Pelita App')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50/30 to-indigo-50/50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8 space-y-8">
        
        <!-- Breadcrumb -->
        <nav class="flex items-center space-x-2 text-sm text-slate-600 mb-6" aria-label="Breadcrumb">
            <a href="{{ route('dashboard') }}" class="hover:text-amber-600 transition-colors duration-200">
                Dashboard
            </a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <a href="{{ route('permohonan.index') }}" class="hover:text-amber-600 transition-colors duration-200">
                Permohonan
            </a>
            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
            <span class="text-slate-800 font-medium">Edit Permohonan</span>
        </nav>
        
        <!-- Header Section -->
        <div class="relative bg-white rounded-2xl border border-slate-200 shadow-lg">
            <div class="p-6 md:p-8">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex items-start md:items-center space-x-4 md:space-x-6">
                        <div class="flex-shrink-0">
                            <div class="w-16 h-16 md:w-20 md:h-20 bg-gradient-to-br from-amber-600 to-orange-600 rounded-xl flex items-center justify-center text-white shadow-md">
                                <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                        </div>
                        
                        <div class="min-w-0 flex-1">
                            <h1 class="text-2xl md:text-3xl font-bold text-slate-800 leading-tight">
                                Edit Permohonan
                            </h1>
                            <p class="text-slate-600 mt-1 md:mt-2 text-base md:text-lg">Perbarui informasi permohonan peminjaman barang Anda</p>
                            
                            <div class="flex flex-wrap items-center gap-3 md:gap-4 mt-3 md:mt-4">
                                <div class="inline-flex items-center px-3 py-1 bg-amber-100 text-amber-800 rounded-full text-sm font-medium">
                                    <span class="w-2 h-2 bg-amber-500 rounded-full mr-2"></span>
                                    #{{ $permohonan->no_permohonan }}
                                </div>
                                <div class="inline-flex items-center px-3 py-1 bg-slate-100 text-slate-700 rounded-full text-sm">
                                    <svg class="w-3 h-3 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    {{ now()->format('d M Y, H:i') }}
                                </div>
                                <div class="inline-flex items-center px-3 py-1 bg-orange-100 text-orange-800 rounded-full text-sm font-medium">
                                    <span class="w-2 h-2 bg-orange-500 rounded-full mr-2"></span>
                                    Mode Edit
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-6 lg:mt-0 flex items-center space-x-3">
                        <a href="{{ route('permohonan.show', $permohonan) }}" 
                           class="inline-flex items-center px-4 py-2 text-slate-600 hover:text-slate-800 bg-white hover:bg-slate-50 rounded-lg border border-slate-200 hover:border-slate-300 shadow-sm">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>
                        <div class="h-6 w-px bg-slate-300"></div>
                        <div class="text-sm text-slate-600 font-medium">
                            Status: <span class="text-amber-600">{{ $permohonan->status }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Info Alert: Draft Surat Auto-Generate -->
        <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6">
            <div class="flex items-start space-x-4">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="text-blue-800 font-semibold mb-2">Informasi Penting</h3>
                    <ul class="text-blue-700 text-sm space-y-1">
                        <li class="flex items-start">
                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Draft surat permohonan akan <strong>di-generate ulang otomatis</strong> setelah Anda menyimpan perubahan</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Jika Anda mengganti <strong>kop surat</strong>, draft surat akan menggunakan kop surat yang baru</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-4 h-4 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span>Download draft surat terbaru setelah menyimpan perubahan untuk mendapatkan versi terkini</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Progress Steps Wizard -->
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <!-- Step 1 -->
                <div class="flex items-center step-item active" data-step="1">
                    <div class="flex items-center justify-center w-10 h-10 bg-blue-600 text-white rounded-full font-semibold step-circle">
                        1
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-blue-600 step-title">Data & Kop Surat</p>
                        <p class="text-xs text-gray-500 step-desc">Data instansi & peminjaman</p>
                    </div>
                </div>
                
                <!-- Connector -->
                <div class="flex-1 h-1 bg-gray-200 mx-4 step-connector">
                    <div class="h-full bg-gray-200 transition-all duration-300 connector-progress" style="width: 0%"></div>
                </div>
                
                <!-- Step 2 -->
                <div class="flex items-center step-item" data-step="2">
                    <div class="flex items-center justify-center w-10 h-10 bg-gray-300 text-gray-600 rounded-full font-semibold step-circle">
                        2
                    </div>
                    <div class="ml-3">
                        <p class="text-sm font-medium text-gray-600 step-title">Pilih Barang</p>
                        <p class="text-xs text-gray-500 step-desc">Edit & tambah barang</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form Container -->
        <div class="bg-white rounded-2xl border border-slate-200 shadow-lg">
            <div class="p-6 border-b border-slate-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-slate-800">Form Edit Permohonan</h2>
                    <span class="text-xs text-amber-600 font-medium uppercase tracking-wide">Editing Mode</span>
                </div>
            </div>

            <form method="POST" action="{{ route('permohonan.update', $permohonan) }}" enctype="multipart/form-data" class="p-6 space-y-8" id="edit-form">
                @csrf
                @method('patch')

            <!-- STEP 1: Data Instansi + Kop Surat + Data Peminjaman -->
            <div id="step1" class="form-step active">
                <!-- Step 1: Data Instansi -->
                <div class="space-y-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-amber-500 to-orange-600 rounded-full flex items-center justify-center text-white text-sm font-bold">1</div>
                        <h3 class="text-lg font-semibold text-slate-800">Data Instansi</h3>
                        <div class="flex-1 h-px bg-gradient-to-r from-amber-200 to-transparent"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Instansi -->
                        <div>
                            <label for="nama_instansi" class="block text-sm font-semibold text-slate-700 mb-2">
                                Nama Instansi
                                <span class="text-slate-400 font-normal">(Opsional)</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <input type="text" 
                                    id="nama_instansi" 
                                    name="nama_instansi" 
                                    value="{{ old('nama_instansi', $permohonan->nama_instansi) }}"
                                    placeholder="Masukkan nama instansi..."
                                    class="block w-full pl-10 pr-3 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 bg-white @error('nama_instansi') border-red-300 @enderror">
                            </div>
                            @error('nama_instansi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jabatan -->
                        <div>
                            <label for="jabatan" class="block text-sm font-semibold text-slate-700 mb-2">
                                Jabatan
                                <span class="text-slate-400 font-normal">(Opsional)</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input type="text" 
                                    id="jabatan" 
                                    name="jabatan" 
                                    value="{{ old('jabatan', $permohonan->jabatan) }}"
                                    placeholder="Contoh: Kepala Divisi..."
                                    class="block w-full pl-10 pr-3 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 bg-white @error('jabatan') border-red-300 @enderror">
                            </div>
                            @error('jabatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bidang Instansi -->
                        <div>
                            <label for="bidang_instansi" class="block text-sm font-semibold text-slate-700 mb-2">
                                Bidang Instansi
                                <span class="text-slate-400 font-normal">(Opsional)</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                    </svg>
                                </div>
                                <input type="text" 
                                    id="bidang_instansi" 
                                    name="bidang_instansi" 
                                    value="{{ old('bidang_instansi', $permohonan->bidang_instansi) }}"
                                    placeholder="Contoh: Pendidikan, Teknologi..."
                                    class="block w-full pl-10 pr-3 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 bg-white @error('bidang_instansi') border-red-300 @enderror">
                            </div>
                            @error('bidang_instansi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Alamat Instansi -->
                        <div>
                            <label for="alamat_instansi" class="block text-sm font-semibold text-slate-700 mb-2">
                                Alamat Instansi
                                <span class="text-slate-400 font-normal">(Opsional)</span>
                            </label>
                            <div class="relative">
                                <div class="absolute top-3 left-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <textarea id="alamat_instansi" 
                                        name="alamat_instansi" 
                                        rows="3"
                                        placeholder="Masukkan alamat lengkap instansi..."
                                        class="block w-full pl-10 pr-3 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 bg-white resize-none @error('alamat_instansi') border-red-300 @enderror">{{ old('alamat_instansi', $permohonan->alamat_instansi) }}</textarea>
                            </div>
                            @error('alamat_instansi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Step 2: Upload Kop Surat -->
                <div class="space-y-6 mt-8">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-amber-500 to-orange-600 rounded-full flex items-center justify-center text-white text-sm font-bold">2</div>
                        <h3 class="text-lg font-semibold text-slate-800">Kop Surat</h3>
                        <div class="flex-1 h-px bg-gradient-to-r from-amber-200 to-transparent"></div>
                    </div>

                    <!-- Current Kop Surat Display -->
                    @if($permohonan->kop_surat)
                    <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-xl border border-emerald-200 p-6">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-emerald-100 rounded-full flex items-center justify-center">
                                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h4 class="text-emerald-800 font-semibold mb-2">Kop Surat Saat Ini</h4>
                                <div class="bg-white rounded-lg p-4 border border-emerald-200">
                                    <img src="{{ asset('storage/' . $permohonan->kop_surat) }}" 
                                        alt="Kop Surat" 
                                        class="max-w-full h-auto rounded-lg shadow-sm">
                                </div>
                                <p class="text-sm text-emerald-600 mt-2">
                                    <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Upload file baru jika ingin mengganti kop surat
                                </p>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Upload New Kop Surat -->
                    <div>
                        <label for="kop_surat" class="block text-sm font-semibold text-slate-700 mb-2">
                            {{ $permohonan->kop_surat ? 'Ganti Kop Surat' : 'Upload Kop Surat' }}
                            <span class="text-slate-400 font-normal">(Opsional)</span>
                        </label>
                        <div class="relative">
                            <input type="file" 
                                id="kop_surat" 
                                name="kop_surat" 
                                accept="image/jpeg,image/jpg,image/png"
                                class="block w-full text-sm text-slate-500 file:mr-4 file:py-3 file:px-6 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-amber-50 file:text-amber-700 hover:file:bg-amber-100 border border-slate-300 rounded-lg cursor-pointer bg-white @error('kop_surat') border-red-300 @enderror">
                        </div>
                        @error('kop_surat')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-xs text-slate-500">
                            Format: JPG, JPEG, atau PNG. Ukuran maksimal 2MB. 
                            <span class="font-medium text-amber-600">Ukuran optimal: 1500x400px</span> (akan otomatis di-resize)
                        </p>

                        <!-- New File Preview -->
                        <div id="kop-preview" class="mt-4 bg-white rounded-xl border border-slate-200 p-4 hidden">
                            <div class="flex items-start space-x-4">
                                <div class="flex-shrink-0">
                                    <svg class="w-10 h-10 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div class="flex-1">
                                    <p class="text-sm font-medium text-slate-700">File baru dipilih:</p>
                                    <p id="kop-name" class="text-sm text-slate-600 mt-1"></p>
                                    <div class="mt-3">
                                        <img id="kop-image" src="" alt="Preview" class="max-w-full h-auto rounded-lg shadow-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Data Peminjaman -->
                <div class="space-y-6 mt-8">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-amber-500 to-orange-600 rounded-full flex items-center justify-center text-white text-sm font-bold">3</div>
                        <h3 class="text-lg font-semibold text-slate-800">Data Peminjaman</h3>
                        <div class="flex-1 h-px bg-gradient-to-r from-amber-200 to-transparent"></div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Tanggal Mulai -->
                        <div>
                            <label for="tanggal_mulai" class="block text-sm font-semibold text-slate-700 mb-2">
                                Tanggal Mulai Peminjaman
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input type="date" 
                                    id="tanggal_mulai" 
                                    name="tanggal_mulai" 
                                    value="{{ old('tanggal_mulai', \Carbon\Carbon::parse($permohonan->tanggal_mulai)->format('Y-m-d')) }}"
                                    min="{{ date('Y-m-d') }}"
                                    class="block w-full pl-10 pr-3 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 bg-white @error('tanggal_mulai') border-red-300 @enderror"
                                    required>
                            </div>
                            @error('tanggal_mulai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Selesai -->
                        <div>
                            <label for="tanggal_selesai" class="block text-sm font-semibold text-slate-700 mb-2">
                                Tanggal Selesai Peminjaman
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input type="date" 
                                    id="tanggal_selesai" 
                                    name="tanggal_selesai" 
                                    value="{{ old('tanggal_selesai', \Carbon\Carbon::parse($permohonan->tanggal_selesai)->format('Y-m-d')) }}"
                                    min="{{ date('Y-m-d') }}"
                                    class="block w-full pl-10 pr-3 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 bg-white @error('tanggal_selesai') border-red-300 @enderror"
                                    required>
                            </div>
                            @error('tanggal_selesai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-slate-500" id="duration-info"></p>
                        </div>

                        <!-- Keperluan -->
                        <div class="md:col-span-2">
                            <label for="keperluan" class="block text-sm font-semibold text-slate-700 mb-2">
                                Keperluan Peminjaman
                                <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <div class="absolute top-3 left-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                </div>
                                <textarea id="keperluan" 
                                        name="keperluan" 
                                        rows="4"
                                        placeholder="Jelaskan keperluan peminjaman barang (contoh: untuk kegiatan workshop, seminar, dll)..."
                                        class="block w-full pl-10 pr-3 py-3 border border-slate-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-amber-500 focus:border-amber-500 bg-white resize-none @error('keperluan') border-red-300 @enderror"
                                        required>{{ old('keperluan', $permohonan->keperluan) }}</textarea>
                            </div>
                            @error('keperluan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-slate-500">Minimal 10 karakter, maksimal 1000 karakter</p>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END STEP 1 -->

            <!-- STEP 2: Pilih Barang -->
            <div id="step2" class="form-step hidden">
                <!-- Konten step 2 tetap sama seperti yang sudah ada -->
                <div class="space-y-6">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-gradient-to-br from-amber-500 to-orange-600 rounded-full flex items-center justify-center text-white text-sm font-bold">4</div>
                        <h3 class="text-lg font-semibold text-slate-800">Pilih & Edit Barang</h3>
                        <div class="flex-1 h-px bg-gradient-to-r from-amber-200 to-transparent"></div>
                    </div>

                    <!-- Items Container dengan foto dan detail -->
                    <div id="items-container" class="space-y-4">
                        <!-- Items akan di-generate via JavaScript -->
                    </div>

                    <!-- Add Item Button -->
                    <button type="button" id="add-item" 
                            class="w-full py-4 border-2 border-dashed border-amber-300 rounded-lg text-amber-600 hover:text-amber-700 hover:border-amber-400 bg-amber-50/50 hover:bg-amber-50 flex items-center justify-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Tambah Barang Lain
                    </button>

                    <!-- Total Estimasi -->
                    <div id="total-estimasi" class="bg-amber-50 rounded-lg border border-amber-200 p-6">
                        <div class="flex items-center justify-between flex-wrap gap-4">
                            <div>
                                <h4 class="text-lg font-semibold text-amber-800">Estimasi Total</h4>
                                <p class="text-sm text-amber-600 mt-1">Berdasarkan durasi peminjaman</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-amber-600 mb-1">Per hari: <span id="total-per-day" class="font-semibold">Rp 0</span></p>
                                <p id="total-amount" class="text-2xl font-bold text-amber-800">Rp 0</p>
                                <p class="text-xs text-amber-600 mt-1" id="duration-days">0 hari</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END STEP 2 -->

                <!-- Navigation Buttons -->
                <div class="flex items-center justify-between pt-8 border-t border-slate-200">
                    <div class="flex items-center space-x-3">
                        <a href="{{ route('permohonan.show', $permohonan) }}" 
                        class="inline-flex items-center px-6 py-3 text-slate-600 hover:text-slate-800 bg-slate-100 hover:bg-slate-200 rounded-lg group">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Kembali
                        </a>

                        <button type="button" 
                                id="prevBtn" 
                                class="hidden inline-flex items-center px-6 py-3 text-slate-600 hover:text-slate-800 bg-slate-100 hover:bg-slate-200 rounded-lg group">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Sebelumnya
                        </button>
                    </div>

                    <div class="flex items-center space-x-3">
                        <button type="button" 
                                id="nextBtn"
                                class="inline-flex items-center px-8 py-3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl">
                            <span id="nextBtnText">Pilih Barang</span>
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>

                        <button type="submit" 
                                id="submit-btn"
                                class="hidden inline-flex items-center px-8 py-3 bg-gradient-to-r from-amber-600 to-orange-600 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span id="submit-text">Simpan Perubahan</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Enhanced Permohonan Edit JavaScript
class PermohonanEdit {
    constructor() {
        this.itemCounter = 0;
        this.barangData = @json($barang);
        this.currentStep = 1;
        this.totalSteps = 2;
        this.init();
    }

    init() {
        this.bindEvents();
        this.initFormValidation();
        this.initWizard(); // Initialize wizard
        this.loadExistingItems(); // Load existing items SETELAH wizard
        this.calculateTotal();
        this.updateDuration();
        this.showLoadingComplete();
    }

    bindEvents() {
    // Kop Surat file upload handling
    const kopInput = document.getElementById('kop_surat');
        if (kopInput) {
            kopInput.addEventListener('change', this.handleKopSelect.bind(this));
        }

    // Date inputs for duration calculation
    const tanggalMulai = document.getElementById('tanggal_mulai');
    const tanggalSelesai = document.getElementById('tanggal_selesai');
        
        if (tanggalMulai) {
            tanggalMulai.addEventListener('change', () => {
                this.updateMaxEndDate();
                this.updateDuration();
                this.validateDates();
            });
        }
        
        if (tanggalSelesai) {
            tanggalSelesai.addEventListener('change', () => {
                this.updateDuration();
                this.validateDates();
            });
        }
        
        // Set initial max date on page load
        this.updateMaxEndDate();

        // Add item button
        const addItemBtn = document.getElementById('add-item');
        if (addItemBtn) {
            addItemBtn.addEventListener('click', this.addItem.bind(this));
        }

        // Remove item buttons (delegated)
        document.addEventListener('click', (e) => {
            if (e.target.closest('.remove-item')) {
                e.preventDefault();
                this.removeItem(e.target.closest('.item-row'));
            }
        }, { passive: false });

        // Barang card selection (delegated)
        document.addEventListener('click', (e) => {
            const barangOption = e.target.closest('.barang-option');
            if (barangOption && !e.target.closest('.remove-item')) {
                const itemRow = barangOption.closest('.item-row');
                const barangInput = itemRow.querySelector('.barang-input');
                const barangId = barangOption.dataset.barangId;
                
                // Deselect all options in this row
                itemRow.querySelectorAll('.barang-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
                
                // Select this option
                barangOption.classList.add('selected');
                barangInput.value = barangId;
                
                // Update item info and show jumlah container
                this.updateItemInfoFromCard(itemRow, barangOption);
                this.calculateTotal();
            }
        });

        // Increase/Decrease buttons (delegated)
        document.addEventListener('click', (e) => {
            const increaseBtn = e.target.closest('.increase-btn');
            const decreaseBtn = e.target.closest('.decrease-btn');
            
            if (increaseBtn) {
                const itemRow = increaseBtn.closest('.item-row');
                const jumlahInput = itemRow.querySelector('.jumlah-input');
                const max = parseInt(jumlahInput.max) || 100;
                const current = parseInt(jumlahInput.value) || 1;
                
                if (current < max) {
                    jumlahInput.value = current + 1;
                    this.updateSubtotalFromInput(jumlahInput);
                    this.calculateTotal();
                }
            }
            
            if (decreaseBtn) {
                const itemRow = decreaseBtn.closest('.item-row');
                const jumlahInput = itemRow.querySelector('.jumlah-input');
                const current = parseInt(jumlahInput.value) || 1;
                
                if (current > 1) {
                    jumlahInput.value = current - 1;
                    this.updateSubtotalFromInput(jumlahInput);
                    this.calculateTotal();
                }
            }
        });

        // Jumlah input changes (delegated) - debounce untuk performa
        let inputTimeout;
        document.addEventListener('input', (e) => {
            if (e.target.classList.contains('jumlah-input')) {
                clearTimeout(inputTimeout);
                inputTimeout = setTimeout(() => {
                    this.updateSubtotalFromInput(e.target);
                    this.calculateTotal();
                }, 150); // Debounce 150ms
            }
        });

        // Form submission
        const form = document.getElementById('edit-form');
        if (form) {
            form.addEventListener('submit', this.handleSubmit.bind(this));
        }
    }

    loadExistingItems() {
    const container = document.getElementById('items-container');
    container.innerHTML = '';
    
    // Load dari data PHP yang sudah disiapkan controller
    const existingItems = @json($existingItems ?? []);
    
    console.log('Loading existing items:', existingItems); // Debug
    
    if (existingItems.length > 0) {
        existingItems.forEach((item, index) => {
            const itemHtml = this.generateItemHtml(index, item.barang_id, item.jumlah);
            const itemDiv = document.createElement('div');
            itemDiv.innerHTML = itemHtml;
            const itemElement = itemDiv.firstElementChild;
            container.appendChild(itemElement);
            
            // Set info untuk barang yang sudah terpilih
            setTimeout(() => {
                const selectedOption = itemElement.querySelector(`.barang-option[data-barang-id="${item.barang_id}"]`);
                if (selectedOption) {
                    this.updateItemInfoFromCard(itemElement, selectedOption);
                }
            }, 10);
        });
        
        this.itemCounter = existingItems.length;
    } else {
        // Jika tidak ada existing items, tambahkan 1 row kosong
        this.addItem();
    }
    
    // Calculate total after loading
    setTimeout(() => {
        this.calculateTotal();
    }, 50);
}

    initWizard() {
        const updateStepDisplay = () => {
            // Hide all steps
            document.querySelectorAll('.form-step').forEach(step => {
                step.classList.add('hidden');
            });
            
            // Show current step
            document.getElementById(`step${this.currentStep}`).classList.remove('hidden');
            
            // Update progress
            document.querySelectorAll('.step-item').forEach((item, index) => {
                const stepNum = index + 1;
                const circle = item.querySelector('.step-circle');
                const title = item.querySelector('.step-title');
                
                if (stepNum < this.currentStep) {
                    circle.className = 'flex items-center justify-center w-10 h-10 bg-green-600 text-white rounded-full font-semibold step-circle';
                    circle.innerHTML = '✓';
                    title.className = 'text-sm font-medium text-green-600 step-title';
                    item.classList.remove('active');
                } else if (stepNum === this.currentStep) {
                    circle.className = 'flex items-center justify-center w-10 h-10 bg-blue-600 text-white rounded-full font-semibold step-circle';
                    circle.innerHTML = stepNum;
                    title.className = 'text-sm font-medium text-blue-600 step-title';
                    item.classList.add('active');
                } else {
                    circle.className = 'flex items-center justify-center w-10 h-10 bg-gray-300 text-gray-600 rounded-full font-semibold step-circle';
                    circle.innerHTML = stepNum;
                    title.className = 'text-sm font-medium text-gray-600 step-title';
                    item.classList.remove('active');
                }
            });
            
            // Update connector progress
            const connector = document.querySelector('.connector-progress');
            if (connector) {
                connector.style.width = this.currentStep === 2 ? '100%' : '0%';
                connector.className = this.currentStep === 2 
                    ? 'h-full bg-green-600 transition-all duration-300 connector-progress'
                    : 'h-full bg-gray-200 transition-all duration-300 connector-progress';
            }
            
            // Update buttons
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const submitBtn = document.getElementById('submit-btn');
            const nextBtnText = document.getElementById('nextBtnText');
            
            if (this.currentStep === 1) {
                prevBtn.classList.add('hidden');
                nextBtn.classList.remove('hidden');
                submitBtn.classList.add('hidden');
                if (nextBtnText) nextBtnText.textContent = 'Pilih Barang';
            } else if (this.currentStep === 2) {
                prevBtn.classList.remove('hidden');
                nextBtn.classList.add('hidden');
                submitBtn.classList.remove('hidden');
            }
            
            // Scroll to top
            window.scrollTo({ top: 0, behavior: 'smooth' });
        };
        
        // Next button
        const nextBtn = document.getElementById('nextBtn');
        if (nextBtn) {
            nextBtn.addEventListener('click', () => {
                if (this.validateStep1()) {
                    if (this.currentStep < this.totalSteps) {
                        this.currentStep++;
                        updateStepDisplay();
                    }
                }
            });
        }
        
        // Prev button
        const prevBtn = document.getElementById('prevBtn');
        if (prevBtn) {
            prevBtn.addEventListener('click', () => {
                if (this.currentStep > 1) {
                    this.currentStep--;
                    updateStepDisplay();
                }
            });
        }
        
        // Initial display
        updateStepDisplay();
    }

    validateStep1() {
        // Validate tanggal
        if (!this.validateDates()) {
            return false;
        }

        // Validate keperluan
        const keperluan = document.getElementById('keperluan');
        if (!keperluan.value.trim()) {
            this.showError('Keperluan peminjaman wajib diisi');
            keperluan.focus();
            return false;
        }

        if (keperluan.value.trim().length < 10) {
            this.showError('Keperluan minimal 10 karakter');
            keperluan.focus();
            return false;
        }

        return true;
    }

    handleKopSelect(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('kop-preview');
        const fileName = document.getElementById('kop-name');
        const imagePreview = document.getElementById('kop-image');

        if (file) {
            // Validate file
            const validTypes = ['image/jpeg', 'image/jpg', 'image/png'];
            const maxSize = 2 * 1024 * 1024; // 2MB

            if (!validTypes.includes(file.type)) {
                this.showError('File harus berformat JPG, JPEG, atau PNG');
                event.target.value = '';
                return;
            }

            if (file.size > maxSize) {
                this.showError('Ukuran file maksimal 2MB');
                event.target.value = '';
                return;
            }

            // Show preview
            fileName.textContent = file.name;
            
            // Create image preview
            const reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
            
            preview.classList.remove('hidden');
        } else {
            preview.classList.add('hidden');
        }
    }

    validateDates() {
        const tanggalMulai = document.getElementById('tanggal_mulai');
        const tanggalSelesai = document.getElementById('tanggal_selesai');
        
        if (!tanggalMulai.value) {
            this.showError('Tanggal mulai peminjaman wajib diisi');
            tanggalMulai.focus();
            return false;
        }

        if (!tanggalSelesai.value) {
            this.showError('Tanggal selesai peminjaman wajib diisi');
            tanggalSelesai.focus();
            return false;
        }
        
        if (tanggalMulai.value && tanggalSelesai.value) {
            const startDate = new Date(tanggalMulai.value);
            const endDate = new Date(tanggalSelesai.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            if (endDate < startDate) {
                tanggalSelesai.setCustomValidity('Tanggal selesai harus setelah tanggal mulai');
                tanggalSelesai.classList.add('border-red-300');
                this.showError('Tanggal selesai harus setelah tanggal mulai');
                return false;
            }
            
            // Check max 3 days duration
            const diffTime = Math.abs(endDate - startDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
            
            if (diffDays > 3) {
                tanggalSelesai.setCustomValidity('Durasi peminjaman maksimal 3 hari');
                tanggalSelesai.classList.add('border-red-300');
                this.showError('Durasi peminjaman maksimal 3 hari');
                return false;
            }
            
            tanggalSelesai.setCustomValidity('');
            tanggalSelesai.classList.remove('border-red-300');
            return true;
        }
        return true;
    }

    updateMaxEndDate() {
        const tanggalMulai = document.getElementById('tanggal_mulai');
        const tanggalSelesai = document.getElementById('tanggal_selesai');
        
        if (tanggalMulai && tanggalMulai.value && tanggalSelesai) {
            const startDate = new Date(tanggalMulai.value);
            
            // Add 2 days to start date (so including start date = 3 days total)
            const maxDate = new Date(startDate);
            maxDate.setDate(maxDate.getDate() + 2);
            
            // Format to YYYY-MM-DD
            const maxDateStr = maxDate.toISOString().split('T')[0];
            
            // Set min and max for tanggal selesai
            tanggalSelesai.min = tanggalMulai.value;
            tanggalSelesai.max = maxDateStr;
            
            // If current end date is beyond max, reset it
            if (tanggalSelesai.value) {
                const currentEndDate = new Date(tanggalSelesai.value);
                if (currentEndDate > maxDate) {
                    tanggalSelesai.value = maxDateStr;
                    this.updateDuration();
                }
            }
        }
    }

    updateDuration() {
        const tanggalMulai = document.getElementById('tanggal_mulai');
        const tanggalSelesai = document.getElementById('tanggal_selesai');
        const durationInfo = document.getElementById('duration-info');
        const durationDays = document.getElementById('duration-days');
        
        if (tanggalMulai.value && tanggalSelesai.value) {
            const startDate = new Date(tanggalMulai.value);
            const endDate = new Date(tanggalSelesai.value);
            const diffTime = Math.abs(endDate - startDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
            
            if (diffDays > 0 && diffDays <= 4) {
                const durationText = `Durasi: ${diffDays} hari`;
                durationInfo.textContent = durationText;
                durationInfo.classList.remove('text-red-500');
                durationInfo.classList.add('text-emerald-600');
                
                if (durationDays) {
                    durationDays.textContent = `${diffDays} hari`;
                }
                
                if (diffDays > 3) {
                    durationInfo.textContent += ' ⚠️ Melebihi batas maksimal';
                    durationInfo.classList.remove('text-emerald-600');
                    durationInfo.classList.add('text-red-500');
                }
                
                this.calculateTotal();
            } else {
                durationInfo.textContent = 'Tanggal tidak valid';
                durationInfo.classList.add('text-red-500');
            }
        } else {
            durationInfo.textContent = '';
            if (durationDays) {
                durationDays.textContent = '0 hari';
            }
        }
    }

    updateDuration() {
        const tanggalMulai = document.getElementById('tanggal_mulai');
        const tanggalSelesai = document.getElementById('tanggal_selesai');
        const durationInfo = document.getElementById('duration-info');
        const durationDays = document.getElementById('duration-days');
        
        if (tanggalMulai.value && tanggalSelesai.value) {
            const startDate = new Date(tanggalMulai.value);
            const endDate = new Date(tanggalSelesai.value);
            const diffTime = Math.abs(endDate - startDate);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
            
            if (diffDays > 0 && diffDays <= 4) {
                const durationText = `Durasi: ${diffDays} hari`;
                durationInfo.textContent = durationText;
                durationInfo.classList.remove('text-red-500');
                durationInfo.classList.add('text-emerald-600');
                
                if (durationDays) {
                    durationDays.textContent = `${diffDays} hari`;
                }
                
                if (diffDays > 3) {
                    durationInfo.textContent += ' ⚠️ Melebihi batas maksimal';
                    durationInfo.classList.remove('text-emerald-600');
                    durationInfo.classList.add('text-red-500');
                }
                
                this.calculateTotal();
            } else {
                durationInfo.textContent = 'Tanggal tidak valid';
                durationInfo.classList.add('text-red-500');
            }
        } else {
            durationInfo.textContent = '';
            if (durationDays) {
                durationDays.textContent = '0 hari';
            }
        }
    }

    addItem() {
        const container = document.getElementById('items-container');
        const itemHtml = this.generateItemHtml(this.itemCounter);
        
        const itemDiv = document.createElement('div');
        itemDiv.innerHTML = itemHtml;
        
        container.appendChild(itemDiv.firstElementChild);
        this.itemCounter++;
        this.updateItemNumbers();
    }

    removeItem(itemRow) {
        if (document.querySelectorAll('.item-row').length <= 1) {
            this.showError('Minimal harus ada satu barang yang dipilih');
            return;
        }

        itemRow.remove();
        this.updateItemNumbers();
        this.calculateTotal();
    }

    generateItemHtml(index, selectedBarangId = null, selectedJumlah = 1) {
        return `
            <div class="item-row bg-white border border-gray-200 rounded-lg overflow-hidden hover:border-blue-300 transition-all duration-200">
                <div class="flex items-center justify-between p-4 border-b border-gray-100">
                    <h4 class="text-sm font-semibold text-slate-700">Barang ${index + 1}</h4>
                    ${document.querySelectorAll('.item-row').length > 0 || index > 0 ? `
                        <button type="button" class="remove-item text-red-500 hover:text-red-700 p-1">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                            </svg>
                        </button>
                    ` : ''}
                </div>

                <!-- Barang Selection Grid -->
                <div class="p-4">
                    <label class="block text-sm font-medium text-slate-700 mb-3">
                        Pilih Barang 
                        ${selectedBarangId ? '<span class="text-blue-600 font-bold">(Barang terpilih di atas - Klik untuk mengganti)</span>' : '<span class="text-gray-500">(Pilih salah satu)</span>'}
                    </label>
                    <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-3 barang-grid">
                        ${this.sortBarangBySelection(selectedBarangId).map(barang => {
                            const isSelected = selectedBarangId == barang.id;
                            const hargaText = barang.harga_sewa > 0 
                                ? `Rp ${this.formatNumber(barang.harga_sewa)}/hari`
                                : 'Gratis';
                            
                            const kategoriNama = barang.kategori_barang ? barang.kategori_barang.nama_kategori : 'N/A';
                            const fotoUrl = barang.foto_primary ? `/storage/${barang.foto_primary.foto}` : null;
                            
                            return `
                                <div class="barang-option ${isSelected ? 'selected' : ''}" data-barang-id="${barang.id}" data-harga="${barang.harga_sewa}" data-stok="${barang.jumlah_tersedia}">
                                    <!-- Image Container - Square 1:1 Ratio -->
                                    <div class="relative w-full aspect-square bg-gray-100 overflow-hidden rounded-t-lg">
                                        ${fotoUrl ? `
                                            <img src="${fotoUrl}" 
                                                alt="${barang.nama_barang}" 
                                                class="w-full h-full object-cover"
                                                loading="lazy">
                                        ` : `
                                            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-200 to-gray-300">
                                                <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                </svg>
                                            </div>
                                        `}
                                        
                                        <!-- Badge Kategori -->
                                        <div class="absolute top-2 left-2">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 shadow-sm">
                                                ${kategoriNama}
                                            </span>
                                        </div>

                                        <!-- Badge Stok -->
                                        <div class="absolute top-2 right-2">
                                            <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 shadow-sm">
                                                ${barang.jumlah_tersedia} unit
                                            </span>
                                        </div>

                                        <!-- Checkmark Overlay -->
                                        <div class="absolute inset-0 bg-blue-600 bg-opacity-0 checkmark-overlay flex items-center justify-center transition-all">
                                            <svg class="w-12 h-12 text-white opacity-0 checkmark-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="p-2 bg-white rounded-b-lg">
                                        <h5 class="font-semibold text-gray-900 text-xs mb-1 line-clamp-2 min-h-[2rem]" title="${barang.nama_barang}">
                                            ${barang.nama_barang}
                                        </h5>
                                        
                                        <p class="text-sm font-bold text-blue-600 truncate">
                                            ${hargaText}
                                        </p>
                                    </div>
                                </div>
                            `;
                        }).join('')}
                    </div>

                    <!-- Hidden input for selected barang -->
                    <input type="hidden" name="items[${index}][barang_id]" class="barang-input" value="${selectedBarangId || ''}" required>

                    <!-- Jumlah Input (Show if item selected) -->
                    <div class="jumlah-container mt-4 pt-4 border-t border-gray-200 ${selectedBarangId ? '' : 'hidden'}">
                        <label class="block text-sm font-medium text-slate-700 mb-3">Jumlah Unit</label>
                        <div class="flex items-center space-x-3 max-w-xs">
                            <button type="button" 
                                    class="decrease-btn flex-shrink-0 w-10 h-10 rounded-lg border border-gray-300 bg-white hover:bg-gray-50 flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                </svg>
                            </button>
                            
                            <input type="number" 
                                name="items[${index}][jumlah]" 
                                value="${selectedJumlah}"
                                min="1" 
                                max="100"
                                class="jumlah-input flex-1 text-center px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 font-semibold" 
                                required>
                            
                            <button type="button" 
                                    class="increase-btn flex-shrink-0 w-10 h-10 rounded-lg border border-gray-300 bg-white hover:bg-gray-50 flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                </svg>
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 mt-2 stok-info">
                            Maksimal: <span class="font-semibold">100</span> unit
                        </p>
                    </div>

                    <!-- Item Info Summary -->
                    <div class="item-info mt-4 p-4 bg-amber-50 rounded-lg border border-amber-200 ${selectedBarangId ? '' : 'hidden'}">
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="font-medium text-slate-700">Harga sewa:</span>
                                <p class="harga-info text-amber-700 font-semibold mt-1">Rp 0/hari</p>
                            </div>
                            <div class="text-right">
                                <span class="font-medium text-slate-700">Subtotal per hari:</span>
                                <p class="subtotal-info text-amber-800 font-bold text-lg mt-1">Rp 0</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
    }

    updateItemInfoFromCard(itemRow, barangOption) {
        const jumlahContainer = itemRow.querySelector('.jumlah-container');
        const itemInfo = itemRow.querySelector('.item-info');
        const stokInfo = itemRow.querySelector('.stok-info span');
        const hargaInfo = itemRow.querySelector('.harga-info');
        const jumlahInput = itemRow.querySelector('.jumlah-input');
        
        const harga = parseInt(barangOption.dataset.harga) || 0;
        const stok = parseInt(barangOption.dataset.stok) || 0;
        
        // Show containers
        jumlahContainer.classList.remove('hidden');
        itemInfo.classList.remove('hidden');
        
        // Update info
        stokInfo.textContent = stok;
        hargaInfo.textContent = harga > 0 ? `Rp ${this.formatNumber(harga)}/hari` : 'Gratis';
        
        // Update max value
        jumlahInput.max = stok;
        if (parseInt(jumlahInput.value) > stok) {
            jumlahInput.value = stok;
        }
        
        // Calculate subtotal
        this.updateSubtotalFromInput(jumlahInput);
    }

    updateSubtotalFromInput(jumlahInput) {
        const itemRow = jumlahInput.closest('.item-row');
        const selectedOption = itemRow.querySelector('.barang-option.selected');
        
        if (selectedOption) {
            const harga = parseInt(selectedOption.dataset.harga) || 0;
            const jumlah = parseInt(jumlahInput.value) || 0;
            const subtotal = harga * jumlah;
            
            const subtotalElement = itemRow.querySelector('.subtotal-info');
            subtotalElement.textContent = subtotal > 0 ? `Rp ${this.formatNumber(subtotal)}` : 'Gratis';
        }
    }

    calculateTotal() {
        let totalPerDay = 0;
        const itemRows = document.querySelectorAll('.item-row');
        
        itemRows.forEach(row => {
            const selectedOption = row.querySelector('.barang-option.selected');
            const jumlahInput = row.querySelector('.jumlah-input');
            
            if (selectedOption) {
                const harga = parseInt(selectedOption.dataset.harga) || 0;
                const jumlah = parseInt(jumlahInput.value) || 0;
                totalPerDay += harga * jumlah;
            }
        });

        // Calculate duration in days
        const tanggalMulai = document.getElementById('tanggal_mulai');
        const tanggalSelesai = document.getElementById('tanggal_selesai');
        let duration = 0;
        
        if (tanggalMulai.value && tanggalSelesai.value) {
            const startDate = new Date(tanggalMulai.value);
            const endDate = new Date(tanggalSelesai.value);
            const diffTime = Math.abs(endDate - startDate);
            duration = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
        }

        const totalAmount = totalPerDay * (duration || 1);
        
        const totalPerDayElement = document.getElementById('total-per-day');
        const totalElement = document.getElementById('total-amount');
        
        if (totalPerDayElement) {
            totalPerDayElement.textContent = totalPerDay > 0 ? `Rp ${this.formatNumber(totalPerDay)}` : 'Gratis';
        }
        
        if (totalElement) {
            totalElement.textContent = totalAmount > 0 ? `Rp ${this.formatNumber(totalAmount)}` : 'Gratis';
        }
    }

    updateItemNumbers() {
        const itemRows = document.querySelectorAll('.item-row');
        itemRows.forEach((row, index) => {
            const title = row.querySelector('h4');
            title.textContent = `Barang ${index + 1}`;
            
            // Update input names to maintain sequential indexing
            const barangInput = row.querySelector('.barang-input');
            const jumlahInput = row.querySelector('.jumlah-input');
            
            if (barangInput) barangInput.name = `items[${index}][barang_id]`;
            if (jumlahInput) jumlahInput.name = `items[${index}][jumlah]`;
        });
    }

    sortBarangBySelection(selectedId) {
        if (!selectedId) return this.barangData;
        
        // Pisahkan barang yang dipilih dan yang tidak
        const selected = this.barangData.filter(b => b.id == selectedId);
        const others = this.barangData.filter(b => b.id != selectedId);
        
        // Gabungkan: selected di depan, others di belakang
        return [...selected, ...others];
    }

    formatNumber(number) {
        return new Intl.NumberFormat('id-ID').format(number);
    }

    initFormValidation() {
        const form = document.getElementById('edit-form');
        const inputs = form.querySelectorAll('input, select, textarea');
        
        inputs.forEach(input => {
            input.addEventListener('blur', () => {
                this.validateField(input);
            });

            input.addEventListener('input', () => {
                this.clearFieldError(input);
            });
        });
    }

    validateField(field) {
        const value = field.value.trim();
        let isValid = true;
        let errorMessage = '';

        // Required field validation
        if (field.hasAttribute('required') && !value) {
            isValid = false;
            errorMessage = 'Field ini wajib diisi';
        }

        // Number validation
        if (field.type === 'number' && value) {
            const num = parseInt(value);
            const min = parseInt(field.getAttribute('min')) || 0;
            const max = parseInt(field.getAttribute('max')) || Infinity;
            
            if (num < min) {
                isValid = false;
                errorMessage = `Minimal ${min}`;
            } else if (num > max) {
                isValid = false;
                errorMessage = `Maksimal ${max}`;
            }
        }

        // Textarea min length validation (for keperluan)
        if (field.id === 'keperluan' && value && value.length < 10) {
            isValid = false;
            errorMessage = 'Keperluan minimal 10 karakter';
            }
        // Apply validation styles
    if (!isValid) {
        field.classList.add('border-red-300', 'focus:ring-red-500', 'focus:border-red-500');
        field.classList.remove('border-slate-300', 'focus:ring-amber-500', 'focus:border-amber-500');
        this.showFieldError(field, errorMessage);
    } else {
        this.clearFieldError(field);
    }

    return isValid;
}

showFieldError(field, message) {
    // Remove existing error message if any
    this.clearFieldError(field);

    // Create error message element
    const errorDiv = document.createElement('p');
    errorDiv.className = 'mt-1 text-sm text-red-600 field-error';
    errorDiv.textContent = message;
    
    // Insert after the field's parent (to avoid issues with relative positioning)
    const parentContainer = field.closest('.relative') || field.parentNode;
    if (parentContainer) {
        parentContainer.parentNode.insertBefore(errorDiv, parentContainer.nextSibling);
    }
}

clearFieldError(field) {
    field.classList.remove('border-red-300', 'focus:ring-red-500', 'focus:border-red-500');
    field.classList.add('border-slate-300', 'focus:ring-amber-500', 'focus:border-amber-500');
    
    // Remove error message
    const parentContainer = field.closest('.relative') || field.parentNode;
    const errorElement = parentContainer?.parentNode?.querySelector('.field-error');
    if (errorElement) {
        errorElement.remove();
    }
}

handleSubmit(event) {
    event.preventDefault();
    
    // Validate all required fields
    const form = document.getElementById('edit-form');
    const inputs = form.querySelectorAll('input[required], select[required], textarea[required]');
    let isValid = true;

    inputs.forEach(input => {
        if (!this.validateField(input)) {
            isValid = false;
        }
    });

    // Validate dates
    if (!this.validateDates()) {
        isValid = false;
    }

    // Check if at least one item is selected
    const itemRows = document.querySelectorAll('.item-row');
    if (itemRows.length === 0) {
        this.showError('Minimal harus ada satu barang yang dipilih');
        isValid = false;
    }

    // Validate each item
    itemRows.forEach((row, index) => {
        const barangInput = row.querySelector('.barang-input');
        const jumlahInput = row.querySelector('.jumlah-input');
        
        if (!barangInput.value) {
            this.showError(`Barang ${index + 1}: Pilih barang terlebih dahulu`);
            isValid = false;
        }
        
        const jumlah = parseInt(jumlahInput.value);
        if (!jumlah || jumlah < 1) {
            this.showError(`Barang ${index + 1}: Jumlah tidak valid`);
            isValid = false;
        }

        // Check stock availability
        const selectedOption = row.querySelector('.barang-option.selected');
        if (selectedOption) {
            const stok = parseInt(selectedOption.dataset.stok);
            if (jumlah > stok) {
                this.showError(`Barang ${index + 1}: Jumlah melebihi stok tersedia (${stok} unit)`);
                isValid = false;
            }
        }
    });

    if (!isValid) {
        this.showError('Mohon lengkapi semua field yang wajib diisi dengan benar');
        // Scroll to first error
        const firstError = form.querySelector('.border-red-300');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        return false;
    }

    // Show loading state
    this.showLoadingState();

    // Submit form
    form.submit();
}

showLoadingState() {
    const submitBtn = document.getElementById('submit-btn');
    const submitText = document.getElementById('submit-text');
    
    if (submitBtn && submitText) {
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-75', 'cursor-not-allowed');
        
        submitText.innerHTML = `
            <svg class="animate-spin h-5 w-5 mr-2 inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
            </svg>
            Menyimpan...
        `;
    }
}

showLoadingComplete() {
    // No animation needed - instant load
}

showError(message) {
    // Create toast notification
    const toast = document.createElement('div');
    toast.className = 'fixed top-4 right-4 bg-red-500 text-white px-6 py-4 rounded-xl shadow-lg z-50 flex items-center space-x-3 animate-slideIn max-w-md';
    toast.innerHTML = `
        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span class="flex-1">${message}</span>
        <button onclick="this.parentElement.remove()" class="text-white hover:text-gray-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    `;
    
    document.body.appendChild(toast);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        toast.remove();
    }, 5000);
}

showSuccess(message) {
    // Create success toast notification
    const toast = document.createElement('div');
    toast.className = 'fixed top-4 right-4 bg-green-500 text-white px-6 py-4 rounded-xl shadow-lg z-50 flex items-center space-x-3 animate-slideIn max-w-md';
    toast.innerHTML = `
        <svg class="w-6 h-6 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
        <span class="flex-1">${message}</span>
        <button onclick="this.parentElement.remove()" class="text-white hover:text-gray-200">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
    `;
    
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.remove();
    }, 5000);
}
}
// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
new PermohonanEdit();
});
// Add CSS for barang selection and animations
const style = document.createElement('style');
style.textContent = `
/* Performance optimizations */
* {
-webkit-font-smoothing: antialiased;
-moz-osx-font-smoothing: grayscale;
}
/* Smooth scrolling only */
html {
    scroll-behavior: smooth;
}

/* Barang Option Styling - SQUARE CARDS */
.barang-option {
    cursor: pointer;
    transition: all 0.2s ease;
    border: 2px solid transparent;
    border-radius: 0.5rem;
    overflow: hidden;
    display: flex;
    flex-direction: column;
}

.barang-option:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 16px -2px rgba(0, 0, 0, 0.15);
    border-color: #3b82f6;
}

.barang-option.selected {
    border-color: #2563eb;
    box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
    transform: scale(1.02);
}

.barang-option.selected .checkmark-overlay {
    background-opacity: 0.4;
}

.barang-option.selected .checkmark-icon {
    opacity: 1;
}

/* Square aspect ratio untuk foto */
.aspect-square {
    aspect-ratio: 1 / 1;
}

/* Badge positioning untuk square cards */
.barang-option .absolute.top-2.left-2,
.barang-option .absolute.top-2.right-2 {
    z-index: 10;
}

.barang-option.selected .checkmark-icon {
    opacity: 1;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Step Connector */
.step-connector {
    position: relative;
}

.form-step {
    animation: fadeIn 0.3s ease-in;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(10px); }
    to { opacity: 1; transform: translateY(0); }
}

/* Toast animation only - simple fade in */
.animate-slideIn {
    animation: slideInRight 0.3s ease-out;
}

@keyframes slideInRight {
    from { 
        opacity: 0; 
        transform: translateX(100%);
    }
    to { 
        opacity: 1; 
        transform: translateX(0);
    }
}

/* Loading spinner only */
@keyframes spin {
    from { transform: rotate(0deg); }
    to { transform: rotate(360deg); }
}

.animate-spin {
    animation: spin 1s linear infinite;
}

/* Mobile responsive untuk barang grid */
@media (max-width: 640px) {
    .barang-grid {
        grid-template-columns: 1fr !important;
    }
}
    `;
document.head.appendChild(style);
</script>

@endpush

@endsection