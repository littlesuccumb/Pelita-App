@extends('layouts.user')

@section('title', 'Ajukan Permohonan')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-8 overflow-x-hidden">
    <!-- Header -->
    <div class="mb-8">
        <nav class="flex mb-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('permohonan.index') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Permohonan
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-500 md:ml-2">Ajukan Permohonan</span>
                    </div>
                </li>
            </ol>
        </nav>
        
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Ajukan Permohonan Peminjaman Barang</h1>
                <p class="text-gray-600">Lengkapi data dengan benar untuk mengajukan peminjaman barang</p>
            </div>
        </div>

        {{-- Alert jika dari Cart --}}
        @if(!empty($cartItems))
        <div class="mt-4 bg-blue-50 border-l-4 border-blue-400 p-4 rounded-r-lg">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-blue-700">
                        <span class="font-medium">Checkout dari Keranjang</span> - {{ count($cartItems) }} barang telah dipilih dengan durasi <strong class="text-blue-900">{{ $duration }} hari</strong>. Tanggal peminjaman akan diisi otomatis di Step 3. Anda dapat mengubah data sesuai kebutuhan.
                    </p>
                </div>
            </div>
        </div>
        @endif
    </div>

    <!-- Progress Steps -->
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <!-- Step 1 -->
            <div class="flex items-center step-item active" data-step="1">
                <div class="flex items-center justify-center w-10 h-10 bg-blue-600 text-white rounded-full font-semibold step-circle">
                    1
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-blue-600 step-title">Upload Kop Surat</p>
                    <p class="text-xs text-gray-500 step-desc">Upload kop surat instansi</p>
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
                    <p class="text-sm font-medium text-gray-600 step-title">Data Permohonan</p>
                    <p class="text-xs text-gray-500 step-desc">Pilih barang & data instansi</p>
                </div>
            </div>
            
            <!-- Connector -->
            <div class="flex-1 h-1 bg-gray-200 mx-4 step-connector">
                <div class="h-full bg-gray-200 transition-all duration-300 connector-progress" style="width: 0%"></div>
            </div>
            
            <!-- Step 3 -->
            <div class="flex items-center step-item" data-step="3">
                <div class="flex items-center justify-center w-10 h-10 bg-gray-300 text-gray-600 rounded-full font-semibold step-circle">
                    3
                </div>
                <div class="ml-3">
                    <p class="text-sm font-medium text-gray-600 step-title">Detail Peminjaman</p>
                    <p class="text-xs text-gray-500 step-desc">Tanggal & keperluan</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Card -->
    <div class="bg-white rounded-xl shadow-sm border border-gray-100">
        <form id="permohonanForm" action="{{ route('permohonan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Error Alert -->
            @if ($errors->any())
                <div class="bg-red-50 border border-red-200 rounded-lg p-4 m-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                            </svg>
                        </div>
                        <div class="ml-3">
                            <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan dalam pengisian form:</h3>
                            <div class="mt-2 text-sm text-red-700">
                                <ul class="list-disc list-inside">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- STEP 1: Upload Kop Surat -->
            <div id="step1" class="form-step active">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Step 1: Upload Kop Surat Instansi</h2>
                    <p class="text-sm text-gray-600 mt-1">Upload kop surat instansi Anda terlebih dahulu</p>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Upload Kop Surat -->
                    <div class="space-y-4">
                        <label for="kop_surat" class="block text-sm font-medium text-gray-700">
                            Kop Surat Instansi <span class="text-red-500">*</span>
                        </label>
                        <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-blue-400 transition-colors duration-200">
                            <div class="space-y-1 text-center">
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <div class="flex text-sm text-gray-600">
                                    <label for="kop_surat" class="relative cursor-pointer bg-white rounded-md font-medium text-blue-600 hover:text-blue-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-blue-500">
                                        <span>Upload kop surat</span>
                                        <input id="kop_surat" name="kop_surat" type="file" class="sr-only" accept="image/*" required>
                                    </label>
                                    <p class="pl-1">atau drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">PNG, JPG, JPEG up to 2MB</p>
                            </div>
                        </div>
                        @error('kop_surat')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror

                        <!-- Preview Kop Surat -->
                        <div id="kop-preview-container" class="hidden mt-4">
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <div class="flex items-center justify-between mb-2">
                                    <h4 class="text-sm font-medium text-blue-800">Preview Kop Surat:</h4>
                                    <button type="button" onclick="clearKopSurat()" class="text-red-500 hover:text-red-700">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </div>
                                <div class="flex justify-center">
                                    <img id="kop-preview" src="" alt="Preview Kop Surat" class="max-h-40 border border-gray-300 rounded shadow-sm">
                                </div>
                                <p id="kop-file-info" class="text-xs text-blue-600 text-center mt-2"></p>
                            </div>
                        </div>

                        <div class="text-sm text-gray-600 bg-yellow-50 p-3 rounded-lg border border-yellow-200">
                            <div class="flex items-start">
                                <svg class="w-4 h-4 text-yellow-600 mt-0.5 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                <div>
                                    <p class="font-medium text-yellow-800">Catatan Penting tentang Kop Surat:</p>
                                    <ul class="mt-1 list-disc list-inside text-yellow-700 space-y-1">
                                        <li>Upload kop surat resmi instansi/organisasi Anda</li>
                                        <li>Kop surat akan digunakan untuk membuat draft surat permohonan otomatis</li>
                                        <li>Pastikan kop surat jelas dan berkualitas baik</li>
                                        <li>Format yang diterima: PNG, JPG, JPEG (maksimal 2MB)</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Instansi Preview dari User -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Data Pemohon
                        </h3>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
                                <div class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-800">
                                    {{ auth()->user()->name }}
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <div class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-800">
                                    {{ auth()->user()->email }}
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Instansi</label>
                                <div class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-800">
                                    {{ auth()->user()->instansi ?? 'Belum diisi' }}
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jabatan</label>
                                <div class="w-full px-3 py-2 bg-gray-50 border border-gray-300 rounded-lg text-gray-800">
                                    {{ auth()->user()->jabatan ?? 'Belum diisi' }}
                                </div>
                            </div>
                        </div>

                        <!-- Info Alert -->
                        <div class="mt-4 bg-green-50 border border-green-200 rounded-lg p-3">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                </svg>
                                <p class="text-sm text-green-700">
                                    Data ini akan digunakan dalam surat permohonan. Anda bisa mengubah data instansi di step berikutnya jika diperlukan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- STEP 2: Data Permohonan -->
            <div id="step2" class="form-step hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Step 2: Data Permohonan</h2>
                    <p class="text-sm text-gray-600 mt-1">Pilih barang yang ingin dipinjam dan sesuaikan data instansi</p>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Data Instansi (Override) -->
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                            </svg>
                            Data Instansi (Opsional - Override)
                        </h3>
                        <p class="text-sm text-gray-600 mb-4">Kosongkan jika ingin menggunakan data dari profil Anda</p>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div>
                                <label for="nama_instansi" class="block text-sm font-medium text-gray-700 mb-2">
                                    Nama Instansi
                                </label>
                                <input type="text" 
                                       name="nama_instansi" 
                                       id="nama_instansi"
                                       value="{{ old('nama_instansi') }}"
                                       placeholder="Contoh: PT. Digital Kreatif Indonesia"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                @error('nama_instansi')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-2">
                                    Jabatan
                                </label>
                                <input type="text" 
                                       name="jabatan" 
                                       id="jabatan"
                                       value="{{ old('jabatan') }}"
                                       placeholder="Contoh: Manager Marketing"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                @error('jabatan')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="bidang_instansi" class="block text-sm font-medium text-gray-700 mb-2">
                                    Bidang Instansi
                                </label>
                                <input type="text" 
                                       name="bidang_instansi" 
                                       id="bidang_instansi"
                                       value="{{ old('bidang_instansi') }}"
                                       placeholder="Contoh: Teknologi Informasi"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                @error('bidang_instansi')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label for="alamat_instansi" class="block text-sm font-medium text-gray-700 mb-2">
                                    Alamat Instansi
                                </label>
                                <input type="text" 
                                       name="alamat_instansi" 
                                       id="alamat_instansi"
                                       value="{{ old('alamat_instansi') }}"
                                       placeholder="Alamat lengkap instansi"
                                       class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                @error('alamat_instansi')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    {{-- Cart Items Preview (jika ada) --}}
                    @if(!empty($cartItems))
                    <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                Barang dari Keranjang ({{ count($cartItems) }} items)
                            </h3>
                            <button type="button" onclick="clearCartItems()" class="text-sm text-red-600 hover:text-red-800 font-medium">
                                Batal & Pilih Manual
                            </button>
                        </div>

                        <div class="space-y-3">
                            @foreach($cartItems as $item)
                            <div class="bg-white border border-green-200 rounded-lg p-4">
                                <div class="flex items-start space-x-3">
                                    @if($item['foto'])
                                    <img src="{{ $item['foto'] }}" alt="{{ $item['nama_barang'] }}" class="w-16 h-16 object-cover rounded">
                                    @else
                                    <div class="w-16 h-16 bg-gray-200 rounded flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                        </svg>
                                    </div>
                                    @endif
                                    
                                    <div class="flex-1">
                                        <h4 class="font-medium text-gray-900">{{ $item['nama_barang'] }}</h4>
                                        <p class="text-sm text-gray-600">{{ $item['kategori'] }}</p>
                                        <div class="mt-2 flex items-center justify-between">
                                            <div class="text-sm">
                                                <span class="text-gray-600">Jumlah:</span>
                                                <span class="font-medium text-gray-900">{{ $item['quantity'] }} unit</span>
                                                <span class="text-gray-400 mx-1">×</span>
                                                <span class="text-gray-600">{{ $duration }} hari</span>
                                            </div>
                                            <div class="text-right">
                                                <p class="text-xs text-gray-500">Subtotal</p>
                                                <p class="font-semibold text-green-700">
                                                    @if($item['harga_sewa'] > 0)
                                                        Rp {{ number_format($item['subtotal'], 0, ',', '.') }}
                                                    @else
                                                        GRATIS
                                                    @endif
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                {{-- Hidden inputs untuk submit --}}
                                <input type="hidden" name="selected_barang[]" value="{{ $item['barang_id'] }}" class="cart-barang-id">
                                <input type="hidden" name="jumlah[{{ $item['barang_id'] }}]" value="{{ $item['quantity'] }}">
                            </div>
                            @endforeach
                        </div>

                        <div class="mt-4 pt-4 border-t border-green-300">
                            <div class="flex justify-between items-center">
                                <span class="font-semibold text-gray-900">Total Estimasi Biaya:</span>
                                <span class="text-xl font-bold text-green-700">
                                    @if($totalEstimasi > 0)
                                        Rp {{ number_format($totalEstimasi, 0, ',', '.') }}
                                    @else
                                        GRATIS
                                    @endif
                                </span>
                            </div>
                            <p class="text-xs text-gray-600 text-right mt-1">Untuk durasi {{ $duration }} hari</p>
                        </div>
                    </div>

                    {{-- Hidden flag untuk menandai ini dari cart --}}
                    <input type="hidden" id="from-cart-flag" value="1">
                    @endif

                    <!-- Pilih Barang Manual (akan disembunyikan jika dari cart) -->
                    <div id="manual-selection-container" class="{{ !empty($cartItems) ? 'hidden' : '' }}">
                        <div class="space-y-4">
                            <h3 class="text-lg font-medium text-gray-900 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                                Pilih Barang <span class="text-red-500">*</span>
                            </h3>
                            <p class="text-sm text-gray-600">Centang barang yang ingin Anda pinjam dan tentukan jumlahnya</p>

                            <!-- Filter & Search Bar -->
                            <div class="bg-gray-50 p-4 rounded-lg space-y-3">
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                                    <!-- Filter Kategori -->
                                    <div>
                                        <label for="kategori_filter" class="block text-sm font-medium text-gray-700 mb-2">
                                            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                                            </svg>
                                            Filter Kategori
                                        </label>
                                        <select id="kategori_filter" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                                            <option value="">Semua Kategori</option>
                                            @foreach($kategori as $kat)
                                                <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Search Bar -->
                                    <div>
                                        <label for="search_barang" class="block text-sm font-medium text-gray-700 mb-2">
                                            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                                            </svg>
                                            Cari Barang
                                        </label>
                                        <input type="text" 
                                            id="search_barang" 
                                            placeholder="Ketik nama barang..."
                                            class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                                    </div>

                                    <!-- Limit Filter - NEW -->
                                    <div>
                                        <label for="limit_filter" class="block text-sm font-medium text-gray-700 mb-2">
                                            <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"/>
                                            </svg>
                                            Tampilkan
                                        </label>
                                        <select id="limit_filter" class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 text-sm">
                                            <option value="6">6 barang</option>
                                            <option value="9" selected>9 barang</option>
                                            <option value="12">12 barang</option>
                                            <option value="18">18 barang</option>
                                            <option value="24">24 barang</option>
                                            <option value="all">Semua barang</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Quick Info -->
                                <div class="flex items-center justify-between text-xs text-gray-600 pt-2 border-t border-gray-200">
                                    <span id="barang-count">Menampilkan <strong id="showing-count">9</strong> dari <strong id="total-count">{{ count($barang) }}</strong> barang</span>
                                    <button type="button" onclick="resetFilters()" class="text-blue-600 hover:text-blue-800 font-medium">
                                        Reset Filter
                                    </button>
                                </div>
                            </div>

                            <!-- Barang Grid - tetap sama -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4" id="barang-container">
                                @foreach($barang as $item)
                                    <div class="barang-card bg-white border border-gray-200 rounded-lg overflow-hidden hover:border-blue-300 hover:shadow-lg transition-all duration-200 cursor-pointer" 
                                        data-kategori="{{ $item->kategori_id }}"
                                        data-nama="{{ strtolower($item->nama_barang) }}"
                                        data-index="{{ $loop->index }}">
                                        
                                        <!-- Image Container -->
                                        <div class="relative h-48 bg-gray-100 overflow-hidden">
                                            @if($item->fotoPrimary)
                                                <img src="{{ asset('storage/' . $item->fotoPrimary->foto) }}" 
                                                    alt="{{ $item->nama_barang }}" 
                                                    class="w-full h-full object-cover"
                                                    loading="lazy">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-gray-200 to-gray-300">
                                                    <svg class="w-20 h-20 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                                    </svg>
                                                </div>
                                            @endif
                                            
                                            <!-- Badge Kategori -->
                                            @if($item->kategoriBarang)
                                                <div class="absolute top-2 left-2">
                                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 shadow-sm">
                                                        {{ $item->kategoriBarang->nama_kategori }}
                                                    </span>
                                                </div>
                                            @endif

                                            <!-- Badge Tersedia -->
                                            <div class="absolute top-2 right-2">
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800 shadow-sm">
                                                    {{ $item->jumlah_tersedia }} unit
                                                </span>
                                            </div>

                                            <!-- Checkbox Overlay -->
                                            <div class="absolute bottom-2 right-2">
                                                <input type="checkbox" 
                                                    name="selected_barang[]" 
                                                    value="{{ $item->id }}" 
                                                    id="barang_{{ $item->id }}"
                                                    class="w-6 h-6 barang-checkbox rounded-lg border-2 border-white shadow-lg text-blue-600 focus:ring-blue-500 focus:ring-2 cursor-pointer"
                                                    data-harga="{{ $item->harga_sewa }}"
                                                    data-nama="{{ $item->nama_barang }}"
                                                    data-tersedia="{{ $item->jumlah_tersedia }}">
                                            </div>
                                        </div>

                                        <!-- Content -->
                                        <div class="p-4">
                                            <label for="barang_{{ $item->id }}" class="cursor-pointer">
                                                <h4 class="font-semibold text-gray-900 text-base mb-1 line-clamp-2 min-h-[3rem]">
                                                    {{ $item->nama_barang }}
                                                </h4>
                                                
                                                <div class="flex items-center justify-between mb-3">
                                                    <p class="text-lg font-bold text-blue-600">
                                                        @if($item->harga_sewa > 0)
                                                            Rp {{ number_format($item->harga_sewa, 0, ',', '.') }}
                                                            <span class="text-xs text-gray-500 font-normal">/hari</span>
                                                        @else
                                                            <span class="text-green-600">GRATIS</span>
                                                        @endif
                                                    </p>
                                                </div>
                                            </label>
                                            
                                            <!-- Jumlah Input - Initially Hidden -->
                                            <div class="jumlah-container hidden mt-3 pt-3 border-t border-gray-200 animate-fade-in">
                                                <label class="block text-sm font-medium text-gray-700 mb-2">
                                                    Jumlah Unit
                                                </label>
                                                <div class="flex items-center space-x-2">
                                                    <button type="button" 
                                                            class="decrease-btn flex-shrink-0 w-9 h-9 rounded-lg border border-gray-300 bg-white hover:bg-gray-50 flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors"
                                                            data-target="jumlah_{{ $item->id }}">
                                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/>
                                                        </svg>
                                                    </button>
                                                    
                                                    <input type="number" 
                                                        name="jumlah[{{ $item->id }}]" 
                                                        id="jumlah_{{ $item->id }}"
                                                        min="1" 
                                                        max="{{ $item->jumlah_tersedia }}" 
                                                        value="1"
                                                        class="flex-1 text-center px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 jumlah-input font-semibold">
                                                    
                                                    <button type="button" 
                                                            class="increase-btn flex-shrink-0 w-9 h-9 rounded-lg border border-gray-300 bg-white hover:bg-gray-50 flex items-center justify-center focus:outline-none focus:ring-2 focus:ring-blue-500 transition-colors"
                                                            data-target="jumlah_{{ $item->id }}"
                                                            data-max="{{ $item->jumlah_tersedia }}">
                                                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    Maks: {{ $item->jumlah_tersedia }} unit
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Pagination Controls - NEW -->
                            <div id="pagination-controls" class="mt-6 flex items-center justify-between bg-white border border-gray-200 rounded-lg p-4">
                                <button type="button" 
                                        id="prev-page-btn" 
                                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
                                        onclick="changePage(-1)">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                                    </svg>
                                    Sebelumnya
                                </button>

                                <div class="flex items-center space-x-2">
                                    <span class="text-sm text-gray-700">
                                        Halaman <strong id="current-page">1</strong> dari <strong id="total-pages">1</strong>
                                    </span>
                                </div>

                                <button type="button" 
                                        id="next-page-btn"
                                        class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-lg text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
                                        onclick="changePage(1)">
                                    Selanjutnya
                                    <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                                    </svg>
                                </button>
                            </div>

                            <!-- Empty State - tetap sama -->
                            <div id="empty-state" class="hidden text-center py-12">
                                <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M12 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada barang ditemukan</h3>
                                <p class="mt-1 text-sm text-gray-500">Coba ubah filter atau kata kunci pencarian</p>
                            </div>

                            @error('selected_barang')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            <!-- Selected Items Summary - Improved -->
                            <div id="selected-summary" class="hidden mt-6 bg-gradient-to-r from-green-50 to-emerald-50 border border-green-200 rounded-lg p-6 shadow-sm animate-fade-in">
                                <div class="flex items-start justify-between mb-4">
                                    <h4 class="font-semibold text-green-800 flex items-center text-lg">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Barang yang Dipilih
                                    </h4>
                                    <span id="selected-count-badge" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-600 text-white">
                                        0 item
                                    </span>
                                </div>
                                
                                <div id="selected-items" class="space-y-2 mb-4"></div>
                                
                                <div class="pt-4 border-t border-green-300">
                                    <div class="flex justify-between items-center">
                                        <span class="font-semibold text-gray-700">Total Estimasi:</span>
                                        <div class="text-right">
                                            <p class="text-2xl font-bold text-green-700" id="total-biaya">Rp 0</p>
                                            <p class="text-xs text-gray-600">per hari</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- STEP 3: Detail Peminjaman -->
            <div id="step3" class="form-step hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-900">Step 3: Detail Peminjaman</h2>
                    <p class="text-sm text-gray-600 mt-1">Tentukan tanggal peminjaman dan keperluan penggunaan</p>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Tanggal Peminjaman -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="tanggal_mulai" class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Mulai <span class="text-red-500">*</span>
                            </label>
                            <input type="date" 
                                   name="tanggal_mulai" 
                                   id="tanggal_mulai"
                                   value="{{ old('tanggal_mulai') }}"
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                   required>
                            @error('tanggal_mulai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="tanggal_selesai" class="block text-sm font-medium text-gray-700 mb-2">
                                Tanggal Selesai <span class="text-red-500">*</span>
                            </label>
                            <input type="date" 
                                   name="tanggal_selesai" 
                                   id="tanggal_selesai"
                                   value="{{ old('tanggal_selesai') }}"
                                   min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                   required>
                            @error('tanggal_selesai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Keperluan -->
                    <div>
                        <label for="keperluan" class="block text-sm font-medium text-gray-700 mb-2">
                            Keperluan/Tujuan Peminjaman <span class="text-red-500">*</span>
                        </label>
                        <textarea name="keperluan" 
                                  id="keperluan"
                                  rows="4"
                                  placeholder="Jelaskan secara detail keperluan atau tujuan peminjaman barang ini..."
                                  class="w-full px-3 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                  required>{{ old('keperluan') }}</textarea>
                        @error('keperluan')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Summary Peminjaman -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            Ringkasan Permohonan
                        </h3>

                        <!-- Tampilkan durasi dari cart jika ada -->
                        @if(!empty($cartItems))
                        <div class="mb-4 p-3 bg-white rounded-lg border border-blue-300">
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Durasi dari Keranjang:</span>
                                <span class="font-bold text-blue-700 text-lg">{{ $duration }} Hari</span>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Tanggal telah otomatis terisi sesuai durasi ini</p>
                        </div>
                        @endif

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <p class="text-sm text-gray-600">Nama Pemohon:</p>
                                <p class="font-medium text-gray-900">{{ auth()->user()->name }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Email:</p>
                                <p class="font-medium text-gray-900">{{ auth()->user()->email }}</p>
                            </div>
                            <div id="summary-tanggal-mulai">
                                <p class="text-sm text-gray-600">Tanggal Mulai:</p>
                                <p class="font-medium text-gray-900">-</p>
                            </div>
                            <div id="summary-tanggal-selesai">
                                <p class="text-sm text-gray-600">Tanggal Selesai:</p>
                                <p class="font-medium text-gray-900">-</p>
                            </div>
                            <div class="md:col-span-2" id="summary-barang">
                                <p class="text-sm text-gray-600">Barang yang Dipinjam:</p>
                                <div class="font-medium text-gray-900">-</div>
                            </div>
                            <div class="md:col-span-2" id="summary-biaya">
                                <p class="text-sm text-gray-600">Total Estimasi Biaya:</p>
                                <p class="font-semibold text-blue-600 text-lg">-</p>
                            </div>
                        </div>
                    </div>

                    <!-- Info Surat Otomatis -->
                    <div class="bg-green-50 border border-green-200 rounded-lg p-6">
                        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Draft Surat Permohonan Otomatis
                        </h3>
                        <div class="text-sm text-green-700">
                            <p class="mb-2">Setelah submit, sistem akan otomatis:</p>
                            <ul class="list-disc list-inside space-y-1 ml-4">
                                <li>Membuat draft surat permohonan menggunakan kop surat yang Anda upload</li>
                                <li>Mengisi data permohonan secara otomatis berdasarkan input Anda</li>
                                <li>Menampilkan daftar barang yang dipinjam dalam format tabel</li>
                                <li>Menyediakan link download untuk dicetak dan ditandatangani</li>
                            </ul>
                            <p class="mt-3 font-medium">Setelah download, cetak surat → tanda tangan → upload kembali di halaman detail permohonan.</p>
                        </div>
                    </div>

                    <!-- Syarat dan Ketentuan -->
                    <div class="bg-gray-50 border border-gray-200 rounded-lg p-6">
                        <h3 class="text-sm font-medium text-gray-900 mb-3 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Syarat dan Ketentuan Peminjaman Barang
                        </h3>
                        
                        <div class="text-sm text-gray-700 space-y-3 max-h-96 overflow-y-auto border border-gray-200 rounded-lg p-4 bg-white">
                            <!-- 1. Umum -->
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">1. Umum</h4>
                                <ul class="list-disc list-inside space-y-1 text-gray-600 ml-2">
                                    <li>Barang yang dapat dipinjam merupakan aset milik Cimahi Techno Park (CTP) yang tercatat secara resmi dalam daftar inventaris.</li>
                                    <li>Peminjaman hanya diperbolehkan untuk kepentingan kegiatan resmi, program, proyek, atau kerja sama yang berkaitan dengan CTP.</li>
                                    <li>Segala bentuk peminjaman bersifat sementara, tidak dapat diperjualbelikan, dan harus dikembalikan dalam kondisi semula.</li>
                                </ul>
                            </div>

                            <!-- 2. Persyaratan Peminjaman -->
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">2. Persyaratan Peminjaman</h4>
                                <p class="text-gray-600 mb-2">Pemohon wajib:</p>
                                <ul class="list-disc list-inside space-y-1 text-gray-600 ml-2">
                                    <li>Mengisi Formulir Peminjaman Barang lengkap dengan data diri, instansi, dan tujuan peminjaman.</li>
                                    <li>Menyertakan surat permohonan resmi dari instansi/lembaga (bagi pihak eksternal).</li>
                                    <li>Menunjukkan identitas diri yang sah (KTP/ID Pegawai).</li>
                                </ul>
                                <p class="text-gray-600 mt-2 mb-2">Peminjaman hanya dapat dilakukan setelah disetujui secara tertulis oleh:</p>
                                <ul class="list-disc list-inside space-y-1 text-gray-600 ml-2">
                                    <li>Kepala Unit/Penanggung Jawab Aset CTP, dan</li>
                                    <li>Kepala Subbagian Umum dan Keuangan (atau pejabat setara).</li>
                                </ul>
                                <p class="text-gray-600 mt-2">Pemohon wajib menandatangani Berita Acara Serah Terima Barang (BAST) sebelum barang dibawa keluar.</p>
                            </div>

                            <!-- 3. Jangka Waktu dan Penggunaan -->
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">3. Jangka Waktu dan Penggunaan</h4>
                                <ul class="list-disc list-inside space-y-1 text-gray-600 ml-2">
                                    <li><strong class="text-red-600">Jangka waktu peminjaman maksimal 3 (tiga) hari kerja</strong>, kecuali ada persetujuan tertulis untuk perpanjangan.</li>
                                    <li>Barang hanya boleh digunakan sesuai dengan tujuan dan lokasi yang tercantum dalam formulir.</li>
                                </ul>
                                <p class="text-gray-600 mt-2 font-medium">Dilarang:</p>
                                <ul class="list-disc list-inside space-y-1 text-gray-600 ml-2">
                                    <li>Meminjamkan kembali kepada pihak lain tanpa izin tertulis.</li>
                                    <li>Mengubah, membongkar, menempel stiker, atau memodifikasi barang.</li>
                                    <li>Menggunakan barang untuk kegiatan pribadi, politik, atau komersial tanpa persetujuan.</li>
                                </ul>
                            </div>

                            <!-- 4. Tanggung Jawab dan Kerusakan -->
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">4. Tanggung Jawab dan Kerusakan</h4>
                                <ul class="list-disc list-inside space-y-1 text-gray-600 ml-2">
                                    <li>Pemohon bertanggung jawab penuh atas kondisi, keamanan, dan keberadaan barang selama masa peminjaman.</li>
                                    <li>Jika barang hilang, rusak, atau tidak berfungsi akibat kelalaian, peminjam wajib:
                                        <ul class="list-circle list-inside ml-4 mt-1 space-y-1">
                                            <li>Mengganti barang dengan barang sejenis dan kondisi setara, atau</li>
                                            <li>Membayar biaya ganti rugi sesuai nilai barang yang ditetapkan oleh CTP.</li>
                                        </ul>
                                    </li>
                                    <li>Semua penggantian harus diselesaikan maksimal 3 (tiga) hari kerja setelah kejadian dilaporkan.</li>
                                    <li>Peminjam wajib melaporkan setiap kerusakan atau kehilangan secara tertulis kepada pengelola aset dalam waktu 24 jam sejak kejadian.</li>
                                </ul>
                            </div>

                            <!-- 5. Pengembalian Barang -->
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">5. Pengembalian Barang</h4>
                                <p class="text-gray-600 mb-2">Barang harus dikembalikan tepat waktu dengan kondisi:</p>
                                <ul class="list-disc list-inside space-y-1 text-gray-600 ml-2">
                                    <li>Bersih, lengkap, dan berfungsi normal.</li>
                                    <li>Disertai BAST Pengembalian yang ditandatangani kedua belah pihak.</li>
                                </ul>
                                <p class="text-gray-600 mt-2">Keterlambatan pengembalian tanpa pemberitahuan lebih dari 1 (satu) hari kerja akan dikenakan:</p>
                                <ul class="list-disc list-inside space-y-1 text-gray-600 ml-2">
                                    <li>Sanksi administratif, dan/atau</li>
                                    <li>Pembatasan hak peminjaman di masa mendatang.</li>
                                </ul>
                                <p class="text-gray-600 mt-2">Barang yang tidak dikembalikan dalam waktu 3 (tiga) hari setelah jatuh tempo dianggap hilang, dan peminjam wajib melakukan penggantian penuh.</p>
                            </div>

                            <!-- 6. Sanksi dan Penegakan -->
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">6. Sanksi dan Penegakan</h4>
                                <p class="text-gray-600 mb-2">Setiap pelanggaran atas ketentuan ini dapat dikenai:</p>
                                <ul class="list-disc list-inside space-y-1 text-gray-600 ml-2">
                                    <li>Teguran tertulis,</li>
                                    <li>Pembatasan atau pencabutan hak peminjaman,</li>
                                    <li>Tuntutan ganti rugi sesuai peraturan yang berlaku.</li>
                                </ul>
                                <p class="text-gray-600 mt-2">Bagi pihak eksternal, CTP berhak menolak permohonan peminjaman berikutnya tanpa pemberitahuan jika pernah melakukan pelanggaran.</p>
                            </div>

                            <!-- 7. Penutup -->
                            <div>
                                <h4 class="font-semibold text-gray-900 mb-2">7. Penutup</h4>
                                <ul class="list-disc list-inside space-y-1 text-gray-600 ml-2">
                                    <li>Dengan menandatangani formulir peminjaman dan BAST, peminjam dianggap telah membaca, memahami, dan menyetujui seluruh ketentuan ini tanpa syarat.</li>
                                    <li>Ketentuan ini dapat diperbarui sewaktu-waktu oleh pihak Cimahi Techno Park tanpa pemberitahuan sebelumnya.</li>
                                </ul>
                            </div>
                        </div>
                        
                        <div class="mt-4">
                            <label class="flex items-start">
                                <input type="checkbox" id="agree_terms" class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50 mt-1" required>
                                <span class="ml-2 text-sm text-gray-700">
                                    Saya telah membaca dan memahami seluruh <strong>Syarat dan Ketentuan Peminjaman Barang di Cimahi Techno Park (CTP)</strong> dan dengan ini menyetujui untuk mematuhi semua ketentuan yang berlaku.
                                </span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation Buttons - SESUDAH -->
            <div class="bg-white dark:bg-gray-800 rounded-xl shadow-sm border border-gray-100 dark:border-gray-700 mb-8">
                <div class="p-4 sm:p-6">
                    <!-- Info Text - Hidden on Mobile -->
                    <div class="hidden sm:flex items-center text-sm text-gray-600 dark:text-gray-400 mb-4">
                        <i class="fas fa-info-circle text-blue-500 dark:text-blue-400 mr-2"></i>
                        <span>Pastikan semua informasi sudah benar sebelum menyimpan</span>
                    </div>
                    
                    <!-- Button Container -->
                    <div class="flex flex-col sm:flex-row sm:justify-end gap-3">
                        <!-- Kembali ke Daftar Button - Full Width on Mobile -->
                        <a href="{{ route('permohonan.index') }}" 
                        class="order-3 sm:order-1 group inline-flex items-center justify-center px-5 py-3 sm:py-2.5 text-sm font-medium rounded-xl bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 text-gray-700 dark:text-gray-200 border border-gray-300 dark:border-gray-500 shadow-md hover:shadow-lg hover:from-gray-200 hover:to-gray-300 dark:hover:from-gray-600 dark:hover:to-gray-500 transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 w-full sm:w-auto">
                            <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-300"></i>
                            <span class="sm:inline">Kembali ke Daftar</span>
                        </a>
                        
                        <!-- Previous Step Button - Full Width on Mobile -->
                        <button type="button" 
                                id="prevBtn" 
                                class="hidden order-2 sm:order-2 group inline-flex items-center justify-center px-5 py-3 sm:py-2.5 text-sm font-medium rounded-xl bg-gradient-to-r from-gray-100 to-gray-200 dark:from-gray-700 dark:to-gray-600 text-gray-700 dark:text-gray-200 border border-gray-300 dark:border-gray-500 shadow-md hover:shadow-lg hover:from-gray-200 hover:to-gray-300 dark:hover:from-gray-600 dark:hover:to-gray-500 transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 w-full sm:w-auto">
                            <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition-transform duration-300"></i>
                            Sebelumnya
                        </button>
                        
                        <!-- Next Step Button - Full Width on Mobile -->
                        <button type="button" 
                                id="nextBtn" 
                                class="order-1 sm:order-3 group inline-flex items-center justify-center px-6 py-3 sm:py-2.5 text-sm font-medium rounded-xl bg-gradient-to-r from-blue-600 to-indigo-600 text-white shadow-md hover:shadow-lg hover:shadow-blue-500/30 hover:from-blue-500 hover:to-indigo-500 transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 w-full sm:w-auto">
                            <span id="nextBtnText">Pilih Barang</span>
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                        </button>
                        
                        <!-- Submit Button - Full Width on Mobile -->
                        <button type="submit" 
                                id="submitBtn" 
                                class="hidden order-1 sm:order-3 group inline-flex items-center justify-center px-6 py-3 sm:py-2.5 text-sm font-medium rounded-xl bg-gradient-to-r from-green-600 to-emerald-600 text-white shadow-md hover:shadow-lg hover:shadow-green-500/30 hover:from-green-500 hover:to-emerald-500 transform hover:-translate-y-0.5 active:translate-y-0 transition-all duration-300 w-full sm:w-auto">
                            <i class="fas fa-paper-plane mr-2 group-hover:scale-110 transition-transform duration-300"></i>
                            Ajukan Permohonan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('styles')
<style>
/* ==================== MOBILE RESPONSIVE FIXES ==================== */

/* Container utama */
@media (max-width: 640px) {
    .max-w-4xl {
        max-width: 100%;
        padding-left: 0;
        padding-right: 0;
    }
    
    /* Remove rounded corners on mobile for full width */
    .bg-white.rounded-xl {
        border-radius: 0;
        margin-left: 0;
        margin-right: 0;
    }
    
    /* Header Breadcrumb - Smaller font */
    nav[aria-label="Breadcrumb"] {
        font-size: 0.75rem;
        margin-bottom: 0.75rem;
        padding: 0 1rem;
    }
    
    nav[aria-label="Breadcrumb"] svg {
        width: 0.875rem;
        height: 0.875rem;
    }
    
    /* Header Title - Compact */
    .mb-8 {
        padding: 0 1rem;
    }
    
    .mb-8 > .flex.items-center {
        flex-direction: column;
        align-items: flex-start !important;
        gap: 0.5rem;
    }
    
    h1.text-3xl {
        font-size: 1.25rem !important;
        line-height: 1.75rem !important;
        margin-bottom: 0.25rem !important;
    }
    
    .text-gray-600 {
        font-size: 0.813rem;
    }
    
    /* ==================== PROGRESS STEPS - VERTICAL LAYOUT ==================== */
    .mb-8 > div > .flex.items-center.justify-between {
        flex-direction: column;
        align-items: stretch !important;
        gap: 0.75rem;
        padding: 0 1rem;
    }
    
    .step-item {
        flex-direction: row !important;
        align-items: center !important;
        width: 100%;
        padding: 0.75rem;
        background: white;
        border-radius: 0.5rem;
        border: 1px solid #e5e7eb;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    
    .step-item.active {
        background: #eff6ff;
        border-color: #3b82f6;
    }
    
    .step-item .step-circle {
        width: 2.5rem !important;
        height: 2.5rem !important;
        font-size: 1rem;
        flex-shrink: 0;
    }
    
    .step-item .ml-3 {
        margin-left: 0.75rem !important;
        margin-top: 0 !important;
        text-align: left;
        flex: 1;
    }
    
    .step-item .step-title {
        font-size: 0.875rem;
        font-weight: 600;
    }
    
    .step-item .step-desc {
        font-size: 0.75rem;
        margin-top: 0.125rem;
    }
    
    /* Hide connectors completely on mobile */
    .step-connector {
        display: none !important;
    }
    
    /* ==================== ALERTS ==================== */
    .bg-blue-50.border-l-4,
    .bg-red-50.border {
        margin: 1rem;
        padding: 0.75rem;
        font-size: 0.813rem;
    }
    
    .bg-blue-50 .flex,
    .bg-red-50 .flex {
        flex-direction: row;
        align-items: flex-start;
        gap: 0.5rem;
    }
    
    .bg-blue-50 svg,
    .bg-red-50 svg {
        width: 1.25rem;
        height: 1.25rem;
        flex-shrink: 0;
        margin-top: 0.125rem;
    }
    
    /* ==================== FORM SECTIONS ==================== */
    .px-6.py-4 {
        padding: 1rem;
    }
    
    .p-6 {
        padding: 1rem;
    }
    
    .space-y-6 > * + * {
        margin-top: 1rem;
    }
    
    /* Section Headers */
    h2.text-lg {
        font-size: 1rem;
    }
    
    h3.text-lg {
        font-size: 0.938rem;
    }
    
    /* ==================== UPLOAD KOP SURAT ==================== */
    .border-2.border-dashed {
        padding: 1.5rem 1rem;
        margin-top: 0.5rem;
    }
    
    .border-2.border-dashed svg {
        width: 2.5rem;
        height: 2.5rem;
    }
    
    .border-2.border-dashed .text-sm {
        font-size: 0.813rem;
    }
    
    .border-2.border-dashed .text-xs {
        font-size: 0.688rem;
    }
    
    #kop-preview {
        max-height: 10rem;
        width: 100%;
        object-fit: contain;
    }
    
    /* ==================== GRID LAYOUTS ==================== */
    .grid.grid-cols-1.md\\:grid-cols-2 {
        grid-template-columns: 1fr !important;
        gap: 1rem;
    }
    
    /* ==================== DATA INSTANSI ==================== */
    .bg-blue-50.border-blue-200,
    .bg-gray-50.border-gray-200,
    .bg-green-50.border-green-200 {
        padding: 1rem;
        margin: 1rem 0;
    }
    
    /* ==================== BARANG SELECTION ==================== */
    #kategori_filter {
        width: 100%;
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }
    
    .grid.lg\\:grid-cols-3 {
        grid-template-columns: 1fr !important;
        gap: 0.75rem;
    }
    
    .barang-card {
        padding: 0.875rem;
        cursor: pointer;
        -webkit-tap-highlight-color: transparent;
    }
    
    .barang-card .flex.items-start {
        gap: 0.75rem;
    }
    
    .barang-card h4 {
        font-size: 0.875rem;
    }
    
    .barang-card .text-sm {
        font-size: 0.75rem;
    }
    
    .barang-card .text-xs {
        font-size: 0.688rem;
    }
    
    /* ==================== CART ITEMS ==================== */
    .bg-green-50 .space-y-3 > div {
        padding: 0.875rem;
    }
    
    .bg-green-50 .flex.items-start {
        flex-direction: row;
        gap: 0.75rem;
    }
    
    .bg-green-50 img {
        width: 4rem !important;
        height: 4rem !important;
        object-fit: cover;
        flex-shrink: 0;
        border-radius: 0.375rem;
    }
    
    .bg-green-50 .w-16.h-16 {
        width: 4rem !important;
        height: 4rem !important;
        flex-shrink: 0;
    }
    
    /* ==================== SUMMARY & INFO BOXES ==================== */
    .bg-yellow-50,
    .bg-green-50 {
        font-size: 0.813rem;
    }
    
    .bg-yellow-50 ul,
    .bg-green-50 ul {
        font-size: 0.75rem;
        margin-left: 1rem;
    }
    
    /* ==================== SYARAT DAN KETENTUAN ==================== */
    .max-h-96 {
        max-height: 16rem;
    }
    
    .max-h-96 .text-sm {
        font-size: 0.75rem;
        line-height: 1.25rem;
    }
    
    .max-h-96 h4 {
        font-size: 0.813rem;
    }
    
    .max-h-96 ul {
        margin-left: 1rem;
    }
    
    /* ==================== NAVIGATION BUTTONS ==================== */
/* Container padding */
.bg-white.rounded-xl .p-4 {
    padding: 1rem;
}

.bg-white.rounded-xl .sm\\:p-6 {
    padding: 1rem;
}

/* Button container - Full width stacked on mobile */
.flex.flex-col.sm\\:flex-row.sm\\:justify-end {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
    width: 100%;
}

/* All buttons full width with better padding on mobile */
.flex.flex-col.sm\\:flex-row.sm\\:justify-end button,
.flex.flex-col.sm\\:flex-row.sm\\:justify-end a {
    width: 100% !important;
    justify-content: center;
    padding: 0.875rem 1rem;
    font-size: 0.875rem;
    font-weight: 600;
}

/* Icon spacing - prevent shrinking */
.flex.flex-col.sm\\:flex-row.sm\\:justify-end button i,
.flex.flex-col.sm\\:flex-row.sm\\:justify-end a i {
    flex-shrink: 0;
}

/* Primary action buttons (Next/Submit) - More prominent shadow */
#nextBtn,
#submitBtn {
    box-shadow: 0 4px 6px -1px rgba(59, 130, 246, 0.3), 
                0 2px 4px -1px rgba(59, 130, 246, 0.2) !important;
}

#submitBtn {
    box-shadow: 0 4px 6px -1px rgba(16, 185, 129, 0.3), 
                0 2px 4px -1px rgba(16, 185, 129, 0.2) !important;
}

/* Info text hidden on mobile */
.hidden.sm\\:flex {
    display: none !important;
}

/* Button order on mobile - primary action on top */
.order-1 {
    order: 1;
}

.order-2 {
    order: 2;
}

.order-3 {
    order: 3;
}
    
    /* ==================== FORM INPUTS ==================== */
    input[type="text"],
    input[type="date"],
    input[type="number"],
    input[type="email"],
    textarea,
    select {
        font-size: 16px !important; /* Prevents iOS zoom */
        padding: 0.625rem 0.75rem;
    }
    
    textarea {
        min-height: 6rem;
    }
    
    /* ==================== SELECTED SUMMARY ==================== */
    #selected-summary {
        padding: 0.875rem;
        margin: 1rem;
    }
    
    #selected-items > div {
        font-size: 0.813rem;
    }
    
    #total-biaya {
        font-size: 1rem;
    }
}

/* ==================== EXTRA SMALL DEVICES (iPhone SE) ==================== */
@media (max-width: 375px) {
    .px-4 {
        padding-left: 0.5rem;
        padding-right: 0.5rem;
    }
    
    h1.text-3xl {
        font-size: 1.125rem !important;
    }
    
    .step-item {
        padding: 0.625rem;
    }
    
    .step-circle {
        width: 2rem !important;
        height: 2rem !important;
        font-size: 0.875rem !important;
    }
    
    .p-6 {
        padding: 0.875rem;
    }
    
    button,
    a.inline-flex {
        font-size: 0.813rem !important;
        padding: 0.625rem 0.875rem !important;
    }
}

/* ==================== LANDSCAPE MODE ==================== */
@media (max-width: 896px) and (orientation: landscape) {
    .max-h-96 {
        max-height: 10rem;
    }
    
    #kop-preview {
        max-height: 6rem;
    }
    
    .step-item {
        padding: 0.5rem;
    }
}

/* ==================== GENERAL MOBILE IMPROVEMENTS ==================== */
html {
    scroll-behavior: smooth;
}

body {
    overflow-x: hidden;
}

/* Better touch targets */
@media (max-width: 640px) {
    input[type="checkbox"],
    input[type="radio"] {
        width: 1.25rem;
        height: 1.25rem;
    }
    
    label {
        cursor: pointer;
        -webkit-tap-highlight-color: transparent;
    }
}

/* Loading states */
button:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

/* Animations */
@keyframes slide-in {
    from {
        transform: translateX(400px);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slide-out {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(400px);
        opacity: 0;
    }
}

.animate-slide-in {
    animation: slide-in 0.3s ease-out;
}

@keyframes fade-in {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.animate-fade-in {
    animation: fade-in 0.3s ease-out;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Improve checkbox visibility on image */
.barang-checkbox {
    transition: all 0.2s ease;
}

.barang-checkbox:checked {
    transform: scale(1.1);
}

/* Smooth transitions for card hover */
.barang-card {
    transition: all 0.3s ease;
}

.barang-card:hover {
    transform: translateY(-4px);
}

/* Mobile optimizations */
@media (max-width: 640px) {
    .barang-card .h-48 {
        height: 12rem;
    }
    
    .line-clamp-2 {
        min-height: 2.5rem;
    }
}
/* ==================== VALIDASI STYLES ==================== */

/* Error Border */
.error-border {
    border-color: #ef4444 !important;
    border-width: 2px !important;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1) !important;
}

.dark .error-border {
    border-color: #f87171 !important;
    box-shadow: 0 0 0 3px rgba(248, 113, 113, 0.2) !important;
}

/* Validation Error Message */
.validation-error {
    animation: slideDown 0.3s ease-out;
}

@keyframes slideDown {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fade-out {
    from {
        opacity: 1;
        transform: translateY(0);
    }
    to {
        opacity: 0;
        transform: translateY(-10px);
    }
}

/* Shake Animation for Validation */
@keyframes shake {
    0%, 100% {
        transform: translateX(0);
    }
    10%, 30%, 50%, 70%, 90% {
        transform: translateX(-5px);
    }
    20%, 40%, 60%, 80% {
        transform: translateX(5px);
    }
}

.shake-animation {
    animation: shake 0.5s ease-in-out;
}

/* Pulse Animation */
@keyframes pulse-warning {
    0%, 100% {
        box-shadow: 0 0 0 0 rgba(251, 191, 36, 0.7);
    }
    50% {
        box-shadow: 0 0 0 15px rgba(251, 191, 36, 0);
    }
}

.pulse-animation {
    animation: pulse-warning 1.5s ease-out 3;
}

/* Toast Notification Animations */
@keyframes slide-in-right {
    from {
        transform: translateX(100%);
        opacity: 0;
    }
    to {
        transform: translateX(0);
        opacity: 1;
    }
}

@keyframes slide-out-right {
    from {
        transform: translateX(0);
        opacity: 1;
    }
    to {
        transform: translateX(100%);
        opacity: 0;
    }
}

.animate-slide-in-right {
    animation: slide-in-right 0.3s ease-out;
}

/* Toast Notification Styles */
.toast-notification {
    z-index: 9999;
}

/* Fade In Animation */
.animate-fade-in {
    animation: fadeIn 0.3s ease-out;
}

@keyframes fadeIn {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

/* Success Checkmark Animation */
@keyframes checkmark {
    0% {
        stroke-dashoffset: 50;
    }
    100% {
        stroke-dashoffset: 0;
    }
}

.checkmark-animation {
    stroke-dasharray: 50;
    stroke-dashoffset: 0;
    animation: checkmark 0.5s ease-in-out;
}

/* Focus state untuk input yang error */
input.error-border:focus,
textarea.error-border:focus,
select.error-border:focus {
    border-color: #ef4444 !important;
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.2) !important;
}

/* Hover state untuk area upload dengan error */
.error-border.border-dashed:hover {
    border-color: #dc2626 !important;
    background-color: rgba(239, 68, 68, 0.05);
}

/* Dark mode validation error */
.dark .validation-error {
    background-color: rgba(239, 68, 68, 0.1);
    border-color: #f87171;
}

.dark .validation-error.bg-yellow-50 {
    background-color: rgba(251, 191, 36, 0.1);
    border-color: #fbbf24;
}

.dark .validation-error.bg-blue-50 {
    background-color: rgba(59, 130, 246, 0.1);
    border-color: #3b82f6;
}

/* Mobile Responsive Validasi */
@media (max-width: 640px) {
    .toast-notification {
        left: 1rem;
        right: 1rem;
        top: 1rem;
    }
    
    .validation-error {
        font-size: 0.813rem;
        padding: 0.75rem;
    }
    
    .validation-error svg {
        width: 1rem;
        height: 1rem;
    }
}

/* Progress indicator when validation passes */
.validation-success {
    border-color: #10b981 !important;
    box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1) !important;
}

.dark .validation-success {
    border-color: #34d399 !important;
    box-shadow: 0 0 0 3px rgba(52, 211, 153, 0.2) !important;
}

/* Disabled state untuk next button ketika validasi gagal */
button:disabled {
    opacity: 0.5;
    cursor: not-allowed;
    transform: none !important;
}

button:disabled:hover {
    transform: none !important;
    box-shadow: none !important;
}
</style>
@endpush


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // ==================== STEP MANAGEMENT ====================
    let currentStep = 1;
    const totalSteps = 3;

    // Elements
    const form = document.getElementById('permohonanForm');
    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');
    const submitBtn = document.getElementById('submitBtn');
    const nextBtnText = document.getElementById('nextBtnText');

    // File inputs
    const kopSuratInput = document.getElementById('kop_surat');

    // Barang selection
    const barangCheckboxes = document.querySelectorAll('.barang-checkbox');
    const kategoriFilter = document.getElementById('kategori_filter');
    const selectedSummary = document.getElementById('selected-summary');
    const selectedItems = document.getElementById('selected-items');
    const totalBiaya = document.getElementById('total-biaya');

    // Date inputs
    const tanggalMulai = document.getElementById('tanggal_mulai');
    const tanggalSelesai = document.getElementById('tanggal_selesai');

    // Cart detection
    const fromCartFlag = document.getElementById('from-cart-flag');
    const isFromCart = fromCartFlag ? true : false;
    const isMobile = window.innerWidth <= 640;

    // Initialize
    updateStepDisplay();
    setupEventListeners();

    // Auto-populate summary jika dari cart
    if (isFromCart) {
        updateCartSummary();
    }

    // ==================== AUTO-FILL DURATION FROM CART ====================
    const urlParams = new URLSearchParams(window.location.search);
    const durationFromCart = urlParams.get('duration');
    
    if (durationFromCart && isFromCart) {
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        const tanggalMulaiValue = tomorrow.toISOString().split('T')[0];
        tanggalMulai.value = tanggalMulaiValue;
        
        // Pastikan durasi tidak lebih dari 3 hari
        const duration = Math.min(parseInt(durationFromCart), 3);
        const endDate = new Date(tomorrow);
        endDate.setDate(endDate.getDate() + duration - 1);
        const tanggalSelesaiValue = endDate.toISOString().split('T')[0];
        tanggalSelesai.value = tanggalSelesaiValue;
        
        // Set min dan max untuk tanggal selesai
        tanggalSelesai.setAttribute('min', tanggalMulaiValue);
        const maxEndDate = new Date(tomorrow);
        maxEndDate.setDate(maxEndDate.getDate() + 2); // Max 3 hari (0, 1, 2)
        tanggalSelesai.setAttribute('max', maxEndDate.toISOString().split('T')[0]);
        
        validateDates();
        showDurationNotification(duration);
    }

    // ==================== SETUP EVENT LISTENERS ====================
    function setupEventListeners() {
        // Step navigation
        nextBtn.addEventListener('click', nextStep);
        prevBtn.addEventListener('click', prevStep);

        // Kop surat upload
        kopSuratInput.addEventListener('change', handleKopSuratUpload);

        // Barang selection
        barangCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', handleBarangSelection);
        });

        // Category filter
        if (kategoriFilter) {
            kategoriFilter.addEventListener('change', filterBarangByCategory);
        }

        // Date validation
        tanggalMulai.addEventListener('change', handleTanggalMulaiChange);
        tanggalSelesai.addEventListener('change', validateDates);

        // Form submission
        form.addEventListener('submit', handleSubmit);

        // Mobile optimizations
        if (isMobile) {
            setupMobileOptimizations();
        }
    }

    // ==================== MOBILE OPTIMIZATIONS ====================
    function setupMobileOptimizations() {
        // Smooth scroll on step change
        nextBtn.addEventListener('click', function() {
            setTimeout(smoothScrollTop, 100);
        });
        
        prevBtn.addEventListener('click', function() {
            setTimeout(smoothScrollTop, 100);
        });
        
        // Optimize barang card interaction
        const barangCards = document.querySelectorAll('.barang-card');
        barangCards.forEach(card => {
            card.style.cursor = 'pointer';
            card.addEventListener('click', function(e) {
                if (e.target.tagName !== 'INPUT' && 
                    e.target.tagName !== 'LABEL' &&
                    !e.target.closest('.jumlah-container')) {
                    const checkbox = card.querySelector('.barang-checkbox');
                    if (checkbox && !checkbox.disabled) {
                        checkbox.click();
                    }
                }
            });
        });
        
        // Auto-show date picker on mobile
        const dateInputs = document.querySelectorAll('input[type="date"]');
        dateInputs.forEach(input => {
            input.addEventListener('focus', function() {
                if (this.showPicker) {
                    this.showPicker();
                }
            });
        });
        
        // Prevent double-tap zoom on buttons
        const buttons = document.querySelectorAll('button, a');
        let lastTouchEnd = 0;
        buttons.forEach(btn => {
            btn.addEventListener('touchend', function(e) {
                const now = Date.now();
                if (now - lastTouchEnd <= 300) {
                    e.preventDefault();
                }
                lastTouchEnd = now;
            }, false);
        });
    }

    // Handle orientation change
    window.addEventListener('orientationchange', function() {
        setTimeout(function() {
            window.scrollTo(0, 0);
        }, 100);
    });

    // ==================== STEP NAVIGATION ====================
    function nextStep() {
        if (validateCurrentStep()) {
            if (currentStep < totalSteps) {
                currentStep++;
                updateStepDisplay();
                updateSummary();
                smoothScrollTop();
            }
        }
    }

    function prevStep() {
        if (currentStep > 1) {
            currentStep--;
            updateStepDisplay();
            smoothScrollTop();
        }
    }

    function smoothScrollTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }

    function updateStepDisplay() {
        // Hide all steps
        document.querySelectorAll('.form-step').forEach(step => {
            step.classList.add('hidden');
        });

        // Show current step
        document.getElementById(`step${currentStep}`).classList.remove('hidden');

        // Update progress indicators
        for (let i = 1; i <= totalSteps; i++) {
            const stepItem = document.querySelector(`.step-item[data-step="${i}"]`);
            const circle = stepItem.querySelector('.step-circle');
            const title = stepItem.querySelector('.step-title');
            
            if (i < currentStep) {
                // Completed step
                circle.className = 'flex items-center justify-center w-10 h-10 bg-green-600 text-white rounded-full font-semibold step-circle';
                circle.innerHTML = '✓';
                title.className = 'text-sm font-medium text-green-600 step-title';
                stepItem.classList.remove('active');
            } else if (i === currentStep) {
                // Active step
                circle.className = 'flex items-center justify-center w-10 h-10 bg-blue-600 text-white rounded-full font-semibold step-circle';
                circle.innerHTML = i;
                title.className = 'text-sm font-medium text-blue-600 step-title';
                stepItem.classList.add('active');
            } else {
                // Future step
                circle.className = 'flex items-center justify-center w-10 h-10 bg-gray-300 text-gray-600 rounded-full font-semibold step-circle';
                circle.innerHTML = i;
                title.className = 'text-sm font-medium text-gray-600 step-title';
                stepItem.classList.remove('active');
            }
        }

        // Update progress connectors
        document.querySelectorAll('.connector-progress').forEach((connector, index) => {
            if (index < currentStep - 1) {
                connector.style.width = '100%';
                connector.className = 'h-full bg-green-600 transition-all duration-300 connector-progress';
            } else {
                connector.style.width = '0%';
                connector.className = 'h-full bg-gray-200 transition-all duration-300 connector-progress';
            }
        });

        // Update navigation buttons
        if (currentStep === 1) {
            prevBtn.classList.add('hidden');
        } else {
            prevBtn.classList.remove('hidden');
        }

        if (currentStep === totalSteps) {
            nextBtn.classList.add('hidden');
            submitBtn.classList.remove('hidden');
        } else {
            nextBtn.classList.remove('hidden');
            submitBtn.classList.add('hidden');
            
            const stepTexts = {
                1: isFromCart ? 'Lanjut ke Detail' : 'Pilih Barang',
                2: 'Detail Peminjaman'
            };
            nextBtnText.textContent = stepTexts[currentStep] || 'Selanjutnya';
        }
    }

// ==================== VALIDASI STEP BY STEP - DIPERBAIKI ====================

function validateCurrentStep() {
    // Clear previous errors
    document.querySelectorAll('.validation-error').forEach(error => error.remove());
    document.querySelectorAll('.error-border').forEach(el => el.classList.remove('error-border'));
    
    switch (currentStep) {
        case 1:
            return validateStep1();
        case 2:
            return validateStep2();
        case 3:
            return validateStep3();
        default:
            return true;
    }
}

// ==================== VALIDASI STEP 1 ====================
function validateStep1() {
    const kopSuratInput = document.getElementById('kop_surat');
    
    if (!kopSuratInput.files || kopSuratInput.files.length === 0) {
        showValidationError(
            kopSuratInput, 
            'Kop surat wajib diupload sebelum melanjutkan ke step berikutnya',
            'warning'
        );
        
        // Scroll to error
        kopSuratInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
        
        // Shake animation
        const uploadArea = kopSuratInput.closest('.border-2.border-dashed');
        if (uploadArea) {
            uploadArea.classList.add('shake-animation', 'error-border');
            setTimeout(() => uploadArea.classList.remove('shake-animation'), 500);
        }
        
        return false;
    }
    
    // Validate file type
    const file = kopSuratInput.files[0];
    const validTypes = ['image/png', 'image/jpeg', 'image/jpg'];
    
    if (!validTypes.includes(file.type)) {
        showValidationError(
            kopSuratInput,
            'Format file tidak valid. Hanya PNG, JPG, dan JPEG yang diperbolehkan',
            'error'
        );
        kopSuratInput.value = '';
        return false;
    }
    
    // Validate file size (max 2MB)
    const maxSize = 2 * 1024 * 1024; // 2MB in bytes
    if (file.size > maxSize) {
        showValidationError(
            kopSuratInput,
            `Ukuran file terlalu besar (${(file.size / 1024 / 1024).toFixed(2)} MB). Maksimal 2MB`,
            'error'
        );
        kopSuratInput.value = '';
        return false;
    }
    
    return true;
}

// ==================== VALIDASI STEP 2 ====================
function validateStep2() {
    let selectedBarang;
    
    if (isFromCart) {
        selectedBarang = document.querySelectorAll('.cart-barang-id');
    } else {
        selectedBarang = document.querySelectorAll('.barang-checkbox:checked');
    }
    
    if (selectedBarang.length === 0) {
        showValidationError(
            document.querySelector('#manual-selection-container') || document.querySelector('#step2'),
            'Anda harus memilih minimal 1 barang untuk melanjutkan',
            'warning'
        );
        
        // Scroll ke container barang
        const barangContainer = document.getElementById('barang-container');
        if (barangContainer) {
            barangContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
        
        // Highlight area pemilihan barang
        const selectionArea = document.querySelector('#manual-selection-container') || 
                             document.querySelector('.bg-green-50.border-green-200');
        if (selectionArea) {
            selectionArea.classList.add('pulse-animation', 'error-border');
            setTimeout(() => {
                selectionArea.classList.remove('pulse-animation', 'error-border');
            }, 1500);
        }
        
        return false;
    }
    
    // Validasi jumlah barang
    let hasInvalidQuantity = false;
    
    if (!isFromCart) {
        selectedBarang.forEach(checkbox => {
            const barangCard = checkbox.closest('.barang-card');
            const jumlahInput = barangCard.querySelector('.jumlah-input');
            const jumlah = parseInt(jumlahInput.value) || 0;
            const max = parseInt(jumlahInput.max) || 0;
            
            if (jumlah < 1) {
                showValidationError(
                    jumlahInput,
                    'Jumlah minimal 1 unit',
                    'error'
                );
                jumlahInput.classList.add('error-border');
                hasInvalidQuantity = true;
            } else if (jumlah > max) {
                showValidationError(
                    jumlahInput,
                    `Jumlah melebihi stok tersedia (maksimal ${max} unit)`,
                    'error'
                );
                jumlahInput.classList.add('error-border');
                hasInvalidQuantity = true;
            }
        });
    }
    
    if (hasInvalidQuantity) {
        return false;
    }
    
    return true;
}

// ==================== VALIDASI STEP 3 ====================
function validateStep3() {
    let isValid = true;
    
    // Validasi tanggal mulai
    const tanggalMulai = document.getElementById('tanggal_mulai');
    if (!tanggalMulai.value) {
        showValidationError(
            tanggalMulai,
            'Tanggal mulai peminjaman wajib diisi',
            'error'
        );
        tanggalMulai.classList.add('error-border');
        tanggalMulai.scrollIntoView({ behavior: 'smooth', block: 'center' });
        isValid = false;
    }
    
    // Validasi tanggal selesai
    const tanggalSelesai = document.getElementById('tanggal_selesai');
    if (!tanggalSelesai.value) {
        showValidationError(
            tanggalSelesai,
            'Tanggal selesai peminjaman wajib diisi',
            'error'
        );
        tanggalSelesai.classList.add('error-border');
        if (isValid) tanggalSelesai.scrollIntoView({ behavior: 'smooth', block: 'center' });
        isValid = false;
    }
    
    // Validasi durasi peminjaman
    if (tanggalMulai.value && tanggalSelesai.value) {
        const startDate = new Date(tanggalMulai.value);
        const endDate = new Date(tanggalSelesai.value);
        
        if (endDate < startDate) {
            showValidationError(
                tanggalSelesai,
                'Tanggal selesai tidak boleh lebih awal dari tanggal mulai',
                'error'
            );
            tanggalSelesai.classList.add('error-border');
            if (isValid) tanggalSelesai.scrollIntoView({ behavior: 'smooth', block: 'center' });
            isValid = false;
        } else {
            const diffTime = endDate.getTime() - startDate.getTime();
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
            
            if (diffDays > 3) {
                showValidationError(
                    tanggalSelesai,
                    'Durasi peminjaman maksimal 3 hari',
                    'error'
                );
                tanggalSelesai.classList.add('error-border');
                if (isValid) tanggalSelesai.scrollIntoView({ behavior: 'smooth', block: 'center' });
                isValid = false;
            }
        }
    }
    
    // Validasi keperluan
    const keperluan = document.getElementById('keperluan');
    if (!keperluan.value.trim()) {
        showValidationError(
            keperluan,
            'Keperluan peminjaman wajib diisi',
            'error'
        );
        keperluan.classList.add('error-border');
        if (isValid) keperluan.scrollIntoView({ behavior: 'smooth', block: 'center' });
        isValid = false;
    } else if (keperluan.value.trim().length < 10) {
        showValidationError(
            keperluan,
            'Keperluan minimal 10 karakter untuk menjelaskan tujuan peminjaman',
            'error'
        );
        keperluan.classList.add('error-border');
        if (isValid) keperluan.scrollIntoView({ behavior: 'smooth', block: 'center' });
        isValid = false;
    }
    
    // Validasi checkbox syarat dan ketentuan
    const agreeTerms = document.getElementById('agree_terms');
    if (!agreeTerms.checked) {
        showValidationError(
            agreeTerms,
            'Anda harus menyetujui syarat dan ketentuan peminjaman',
            'error'
        );
        agreeTerms.classList.add('error-border');
        if (isValid) agreeTerms.scrollIntoView({ behavior: 'smooth', block: 'center' });
        isValid = false;
    }
    
    return isValid;
}

// ==================== FUNGSI HELPER ====================
function showValidationError(element, message, type = 'error') {
    // Remove existing errors for this element
    const existingError = element.parentNode.querySelector('.validation-error');
    if (existingError) {
        existingError.remove();
    }
    
    // Only show toast notification - no inline error message
    showToastNotification(message, type);
}

function showToastNotification(message, type = 'error') {
    // Remove existing toasts
    const existingToasts = document.querySelectorAll('.toast-notification');
    existingToasts.forEach(toast => toast.remove());
    
    const toast = document.createElement('div');
    toast.className = 'toast-notification fixed top-6 right-6 z-50 animate-slide-in-right';
    
    toast.innerHTML = `
        <div class="relative bg-white rounded-2xl shadow-2xl max-w-md overflow-hidden border border-gray-100">
            <!-- Accent bar -->
            <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-red-500 via-red-600 to-rose-600"></div>
            
            <div class="p-4 flex items-start gap-3">
                <!-- Icon Container -->
                <div class="flex-shrink-0 w-10 h-10 rounded-xl bg-red-50 flex items-center justify-center">
                    <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </div>
                
                <!-- Content -->
                <div class="flex-1 pt-0.5">
                    <h4 class="font-semibold text-gray-900 text-sm mb-1">Validasi Error</h4>
                    <p class="text-sm text-gray-600 leading-relaxed">${message}</p>
                </div>
                
                <!-- Close Button -->
                <button onclick="this.closest('.toast-notification').remove()" 
                        class="flex-shrink-0 w-8 h-8 rounded-lg hover:bg-gray-100 flex items-center justify-center transition-colors group">
                    <svg class="w-4 h-4 text-gray-400 group-hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        </div>
    `;
    
    document.body.appendChild(toast);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        toast.style.animation = 'slide-out-right 0.3s ease-in';
        setTimeout(() => toast.remove(), 300);
    }, 5000);
}

// ==================== UPDATE NEXT STEP FUNCTION ====================
// Ganti fungsi nextStep() yang lama dengan yang ini:
function nextStep() {
    if (!validateCurrentStep()) {
        // Validation failed, don't proceed
        return;
    }
    
    if (currentStep < totalSteps) {
        currentStep++;
        updateStepDisplay();
        updateSummary();
        smoothScrollTop();
    }
}

// ==================== CLEAR VALIDATION ON INPUT ====================
// Tambahkan event listener untuk clear error saat user input
document.addEventListener('DOMContentLoaded', function() {
    // Clear error on file input change
    const kopSuratInput = document.getElementById('kop_surat');
    if (kopSuratInput) {
        kopSuratInput.addEventListener('change', function() {
            this.classList.remove('error-border');
            const error = this.closest('.space-y-4')?.querySelector('.validation-error');
            if (error) error.remove();
        });
    }
    
    // Clear error on checkbox change
    document.querySelectorAll('.barang-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const error = document.querySelector('#manual-selection-container .validation-error');
            if (error) error.remove();
            document.querySelector('#manual-selection-container')?.classList.remove('error-border');
        });
    });
    
    // Clear error on date input
    ['tanggal_mulai', 'tanggal_selesai'].forEach(id => {
        const input = document.getElementById(id);
        if (input) {
            input.addEventListener('change', function() {
                this.classList.remove('error-border');
                const error = this.parentNode.querySelector('.validation-error');
                if (error) error.remove();
            });
        }
    });
    
    // Clear error on textarea input
    const keperluan = document.getElementById('keperluan');
    if (keperluan) {
        keperluan.addEventListener('input', function() {
            this.classList.remove('error-border');
            const error = this.parentNode.querySelector('.validation-error');
            if (error) error.remove();
        });
    }
    
    // Clear error on checkbox change
    const agreeTerms = document.getElementById('agree_terms');
    if (agreeTerms) {
        agreeTerms.addEventListener('change', function() {
            this.classList.remove('error-border');
            const error = this.parentNode.querySelector('.validation-error');
            if (error) error.remove();
        });
    }
});

    // ==================== FILE UPLOAD ====================
    function handleKopSuratUpload() {
        const file = kopSuratInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                const previewContainer = document.getElementById('kop-preview-container');
                const previewImg = document.getElementById('kop-preview');
                const fileInfo = document.getElementById('kop-file-info');
                
                previewImg.src = e.target.result;
                fileInfo.textContent = `${file.name} (${(file.size/1024/1024).toFixed(2)} MB)`;
                previewContainer.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    }

    // ==================== BARANG SELECTION ====================
    function handleBarangSelection(event) {
        const checkbox = event.target;
        const jumlahContainer = checkbox.closest('.barang-card').querySelector('.jumlah-container');
        
        if (checkbox.checked) {
            jumlahContainer.classList.remove('hidden');
        } else {
            jumlahContainer.classList.add('hidden');
        }

        updateBarangSummary();
    }

    function updateBarangSummary() {
        const selectedCheckboxes = document.querySelectorAll('.barang-checkbox:checked');
        
        if (selectedCheckboxes.length === 0) {
            selectedSummary.classList.add('hidden');
            return;
        }

        selectedSummary.classList.remove('hidden');
        selectedItems.innerHTML = '';
        
        let total = 0;
        selectedCheckboxes.forEach(checkbox => {
            const barangCard = checkbox.closest('.barang-card');
            const jumlahInput = barangCard.querySelector('.jumlah-input');
            const nama = checkbox.dataset.nama;
            const harga = parseInt(checkbox.dataset.harga) || 0;
            const jumlah = parseInt(jumlahInput.value) || 1;
            const subtotal = harga * jumlah;
            
            total += subtotal;

            const itemDiv = document.createElement('div');
            itemDiv.className = 'flex justify-between items-center text-sm';
            itemDiv.innerHTML = `
                <span>${nama} x${jumlah}</span>
                <span class="font-medium">Rp ${subtotal.toLocaleString('id-ID')}</span>
            `;
            selectedItems.appendChild(itemDiv);
        });

        totalBiaya.textContent = total > 0 ? `Rp ${total.toLocaleString('id-ID')}` : 'GRATIS';
    }

    function updateCartSummary() {
        const cartItems = document.querySelectorAll('.cart-barang-id');
        if (cartItems.length === 0) return;
        updateSummary();
    }

    function filterBarangByCategory() {
        const selectedCategory = kategoriFilter.value;
        const barangCards = document.querySelectorAll('.barang-card');
        
        barangCards.forEach(card => {
            if (!selectedCategory || card.dataset.kategori === selectedCategory) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    // ==================== DATE HANDLING ====================
    function handleTanggalMulaiChange() {
        if (tanggalMulai.value) {
            const startDate = new Date(tanggalMulai.value);
            
            // Set min untuk tanggal selesai = tanggal mulai
            tanggalSelesai.setAttribute('min', tanggalMulai.value);
            
            // Set max untuk tanggal selesai = tanggal mulai + 2 hari (total 3 hari)
            const maxDate = new Date(startDate);
            maxDate.setDate(maxDate.getDate() + 2);
            const maxDateString = maxDate.toISOString().split('T')[0];
            tanggalSelesai.setAttribute('max', maxDateString);
            
            // Reset tanggal selesai jika melebihi max
            if (tanggalSelesai.value) {
                const selectedEndDate = new Date(tanggalSelesai.value);
                if (selectedEndDate > maxDate || selectedEndDate < startDate) {
                    tanggalSelesai.value = '';
                }
            }
        } else {
            // Reset min/max jika tanggal mulai dikosongkan
            tanggalSelesai.removeAttribute('min');
            tanggalSelesai.removeAttribute('max');
        }
        validateDates();
    }

    function validateDates() {
        // Clear previous errors
        const existingErrors = tanggalSelesai.parentNode.querySelectorAll('.text-red-600');
        existingErrors.forEach(error => error.remove());
        tanggalSelesai.setCustomValidity('');

        if (tanggalMulai.value && tanggalSelesai.value) {
            const startDate = new Date(tanggalMulai.value);
            const endDate = new Date(tanggalSelesai.value);
            
            // Cek apakah tanggal selesai lebih awal dari tanggal mulai
            if (endDate < startDate) {
                const errorMsg = 'Tanggal selesai tidak boleh lebih awal dari tanggal mulai';
                tanggalSelesai.setCustomValidity(errorMsg);
                
                const errorElement = document.createElement('p');
                errorElement.className = 'mt-1 text-sm text-red-600';
                errorElement.textContent = errorMsg;
                tanggalSelesai.parentNode.appendChild(errorElement);
                return false;
            }
            
            // Hitung durasi dalam hari (inklusif)
            const diffTime = endDate.getTime() - startDate.getTime();
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1;
            
            // Maksimal 3 hari
            if (diffDays > 3) {
                const errorMsg = 'Durasi peminjaman maksimal 3 hari';
                tanggalSelesai.setCustomValidity(errorMsg);
                
                const errorElement = document.createElement('p');
                errorElement.className = 'mt-1 text-sm text-red-600';
                errorElement.textContent = errorMsg;
                tanggalSelesai.parentNode.appendChild(errorElement);
                return false;
            }
            
            tanggalSelesai.setCustomValidity('');
        }
        
        updateSummary();
        return true;
    }

    // ==================== SUMMARY UPDATE ====================
    function updateSummary() {
        if (currentStep === 3) {
            const summaryTanggalMulai = document.querySelector('#summary-tanggal-mulai p:last-child');
            const summaryTanggalSelesai = document.querySelector('#summary-tanggal-selesai p:last-child');
            const summaryBarang = document.querySelector('#summary-barang div');
            const summaryBiaya = document.querySelector('#summary-biaya p:last-child');

            summaryTanggalMulai.textContent = tanggalMulai.value || '-';
            summaryTanggalSelesai.textContent = tanggalSelesai.value || '-';

            let barangList = '';
            if (isFromCart) {
                const cartItemElements = document.querySelectorAll('.cart-barang-id');
                const items = [];
                cartItemElements.forEach(input => {
                    const barangId = input.value;
                    const jumlahInput = document.querySelector(`input[name="jumlah[${barangId}]"]`);
                    const itemContainer = input.closest('.bg-white');
                    const namaBarang = itemContainer.querySelector('h4').textContent;
                    const jumlah = jumlahInput ? jumlahInput.value : 1;
                    items.push(`${namaBarang} (${jumlah} unit)`);
                });
                barangList = items.join(', ');
            } else {
                const selectedCheckboxes = document.querySelectorAll('.barang-checkbox:checked');
                if (selectedCheckboxes.length > 0) {
                    barangList = Array.from(selectedCheckboxes).map(checkbox => {
                        const jumlahInput = checkbox.closest('.barang-card').querySelector('.jumlah-input');
                        const jumlah = jumlahInput.value || 1;
                        return `${checkbox.dataset.nama} (${jumlah} unit)`;
                    }).join(', ');
                }
            }
            summaryBarang.textContent = barangList || '-';

            if (tanggalMulai.value && tanggalSelesai.value) {
                const start = new Date(tanggalMulai.value);
                const end = new Date(tanggalSelesai.value);
                const diffTime = end.getTime() - start.getTime();
                const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24)) + 1; // Inklusif
                
                let totalPerHari = 0;

                if (isFromCart) {
                    const cartItemElements = document.querySelectorAll('.cart-barang-id');
                    cartItemElements.forEach(input => {
                        const barangId = input.value;
                        const jumlahInput = document.querySelector(`input[name="jumlah[${barangId}]"]`);
                        const barangCheckbox = document.getElementById(`barang_${barangId}`);
                        if (barangCheckbox) {
                            const harga = parseInt(barangCheckbox.dataset.harga) || 0;
                            const jumlah = parseInt(jumlahInput.value) || 1;
                            totalPerHari += harga * jumlah;
                        }
                    });
                } else {
                    const selectedCheckboxes = document.querySelectorAll('.barang-checkbox:checked');
                    selectedCheckboxes.forEach(checkbox => {
                        const barangCard = checkbox.closest('.barang-card');
                        const jumlahInput = barangCard.querySelector('.jumlah-input');
                        const harga = parseInt(checkbox.dataset.harga) || 0;
                        const jumlah = parseInt(jumlahInput.value) || 1;
                        totalPerHari += harga * jumlah;
                    });
                }
                
                const totalBiayaFinal = totalPerHari * diffDays;
                if (totalBiayaFinal > 0) {
                    summaryBiaya.innerHTML = `Rp ${totalBiayaFinal.toLocaleString('id-ID')} <small class="text-sm font-normal">(${diffDays} hari)</small>`;
                } else {
                    summaryBiaya.innerHTML = `GRATIS <small class="text-sm font-normal">(${diffDays} hari)</small>`;
                }
            } else {
                summaryBiaya.textContent = totalBiaya.textContent || '-';
            }
        }
    }

    // ==================== FORM SUBMISSION ====================
    function handleSubmit(event) {
        if (!isFromCart) {
            const selectedCheckboxes = document.querySelectorAll('.barang-checkbox:checked');
            selectedCheckboxes.forEach((checkbox, index) => {
                const barangCard = checkbox.closest('.barang-card');
                const jumlahInput = barangCard.querySelector('.jumlah-input');
                const barangId = checkbox.value;
                const jumlah = jumlahInput.value || 1;
                
                const barangIdInput = document.createElement('input');
                barangIdInput.type = 'hidden';
                barangIdInput.name = `items[${index}][barang_id]`;
                barangIdInput.value = barangId;
                
                const jumlahInputHidden = document.createElement('input');
                jumlahInputHidden.type = 'hidden';
                jumlahInputHidden.name = `items[${index}][jumlah]`;
                jumlahInputHidden.value = jumlah;
                
                form.appendChild(barangIdInput);
                form.appendChild(jumlahInputHidden);
            });
        } else {
            const cartItemElements = document.querySelectorAll('.cart-barang-id');
            cartItemElements.forEach((input, index) => {
                const barangId = input.value;
                const jumlahInput = document.querySelector(`input[name="jumlah[${barangId}]"]`);
                const jumlah = jumlahInput ? jumlahInput.value : 1;
                
                const barangIdInput = document.createElement('input');
                barangIdInput.type = 'hidden';
                barangIdInput.name = `items[${index}][barang_id]`;
                barangIdInput.value = barangId;
                
                const jumlahInputHidden = document.createElement('input');
                jumlahInputHidden.type = 'hidden';
                jumlahInputHidden.name = `items[${index}][jumlah]`;
                jumlahInputHidden.value = jumlah;
                
                form.appendChild(barangIdInput);
                form.appendChild(jumlahInputHidden);
            });
        }

        if (!validateCurrentStep()) {
            event.preventDefault();
            return false;
        }

        submitBtn.disabled = true;
        submitBtn.innerHTML = `
            <svg class="w-5 h-5 mr-2 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            Memproses...
        `;

        return true;
    }

    // ==================== DURATION NOTIFICATION ====================
    function showDurationNotification(days) {
        const notification = document.createElement('div');
        notification.className = 'fixed top-6 right-6 z-50 animate-slide-in';
        notification.innerHTML = `
            <div class="flex items-center gap-3 px-6 py-4 bg-gradient-to-r from-blue-500 to-cyan-500 text-white rounded-2xl shadow-2xl backdrop-blur-lg border-2 border-white/20 min-w-[280px]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <div>
                    <p class="font-bold">Durasi dari Keranjang</p>
                    <p class="text-sm">Tanggal diisi otomatis untuk ${days} hari</p>
                </div>
            </div>
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.animation = 'slide-out 0.3s ease-out forwards';
            setTimeout(() => notification.remove(), 300);
        }, 5000);
    }

    // ==================== JUMLAH INPUT CHANGE LISTENER ====================
    document.addEventListener('input', function(event) {
        if (event.target.classList.contains('jumlah-input')) {
            const input = event.target;
            const max = parseInt(input.getAttribute('max'));
            const value = parseInt(input.value);
            
            if (value > max) {
                input.value = max;
            } else if (value < 1) {
                input.value = 1;
            }
            
            updateBarangSummary();
        }
    });
});

// ==================== GLOBAL FUNCTIONS ====================

function clearCartItems() {
    if (confirm('Yakin ingin membatalkan item dari keranjang dan memilih barang secara manual?')) {
        const cartPreview = document.querySelector('.bg-green-50.border-green-200');
        if (cartPreview) {
            cartPreview.remove();
        }
        
        const fromCartFlag = document.getElementById('from-cart-flag');
        if (fromCartFlag) {
            fromCartFlag.remove();
        }
        
        const manualContainer = document.getElementById('manual-selection-container');
        if (manualContainer) {
            manualContainer.classList.remove('hidden');
        }
        
        window.location.href = window.location.pathname;
    }
}

function clearKopSurat() {
    const kopSuratInput = document.getElementById('kop_surat');
    const previewContainer = document.getElementById('kop-preview-container');
    
    kopSuratInput.value = '';
    previewContainer.classList.add('hidden');
}

document.addEventListener('DOMContentLoaded', function() {
    const kategoriFilter = document.getElementById('kategori_filter');
    const searchInput = document.getElementById('search_barang');
    const barangContainer = document.getElementById('barang-container');
    const emptyState = document.getElementById('empty-state');
    const barangCount = document.getElementById('barang-count');
    const selectedSummary = document.getElementById('selected-summary');
    const selectedItems = document.getElementById('selected-items');
    const totalBiaya = document.getElementById('total-biaya');
    const selectedCountBadge = document.getElementById('selected-count-badge');
    // Filter functionality
    function filterBarang() {
        const selectedCategory = kategoriFilter.value;
        const searchTerm = searchInput.value.toLowerCase().trim();
        const barangCards = document.querySelectorAll('.barang-card');
        let visibleCount = 0;

        barangCards.forEach(card => {
            const kategoriId = card.dataset.kategori;
            const namaBarang = card.dataset.nama;
            
            const matchCategory = !selectedCategory || kategoriId === selectedCategory;
            const matchSearch = !searchTerm || namaBarang.includes(searchTerm);
            
            if (matchCategory && matchSearch) {
                card.style.display = 'block';
                visibleCount++;
            } else {
                card.style.display = 'none';
            }
        });

        // Update count and show/hide empty state
        barangCount.textContent = `Menampilkan ${visibleCount} barang`;
        if (visibleCount === 0) {
            barangContainer.classList.add('hidden');
            emptyState.classList.remove('hidden');
        } else {
            barangContainer.classList.remove('hidden');
            emptyState.classList.add('hidden');
        }
    }

    // Event listeners for filters
    kategoriFilter.addEventListener('change', filterBarang);
    searchInput.addEventListener('input', filterBarang);

    // Reset filters function
    window.resetFilters = function() {
        kategoriFilter.value = '';
        searchInput.value = '';
        filterBarang();
    };

    // Barang selection with improved UX
    const barangCheckboxes = document.querySelectorAll('.barang-checkbox');
    barangCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const card = this.closest('.barang-card');
            const jumlahContainer = card.querySelector('.jumlah-container');
            
            if (this.checked) {
                jumlahContainer.classList.remove('hidden');
                card.classList.add('ring-2', 'ring-blue-500', 'shadow-lg');
            } else {
                jumlahContainer.classList.add('hidden');
                card.classList.remove('ring-2', 'ring-blue-500', 'shadow-lg');
            }
            
            updateBarangSummary();
        });
    });

    // Increase/Decrease buttons
    document.querySelectorAll('.increase-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const targetId = this.dataset.target;
            const input = document.getElementById(targetId);
            const max = parseInt(this.dataset.max);
            const currentValue = parseInt(input.value) || 1;
            
            if (currentValue < max) {
                input.value = currentValue + 1;
                updateBarangSummary();
            }
        });
    });

    document.querySelectorAll('.decrease-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const targetId = this.dataset.target;
            const input = document.getElementById(targetId);
            const currentValue = parseInt(input.value) || 1;
            
            if (currentValue > 1) {
                input.value = currentValue - 1;
                updateBarangSummary();
            }
        });
    });

    // Update summary with improved styling
    function updateBarangSummary() {
        const selectedCheckboxes = document.querySelectorAll('.barang-checkbox:checked');
        
        if (selectedCheckboxes.length === 0) {
            selectedSummary.classList.add('hidden');
            return;
        }

        selectedSummary.classList.remove('hidden');
        selectedItems.innerHTML = '';
        selectedCountBadge.textContent = `${selectedCheckboxes.length} item`;
        
        let total = 0;
        selectedCheckboxes.forEach((checkbox, index) => {
            const barangCard = checkbox.closest('.barang-card');
            const jumlahInput = barangCard.querySelector('.jumlah-input');
            const nama = checkbox.dataset.nama;
            const harga = parseInt(checkbox.dataset.harga) || 0;
            const jumlah = parseInt(jumlahInput.value) || 1;
            const subtotal = harga * jumlah;
            
            total += subtotal;

            const itemDiv = document.createElement('div');
            itemDiv.className = 'flex justify-between items-center p-3 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow';
            itemDiv.innerHTML = `
                <div class="flex-1">
                    <p class="font-medium text-gray-900">${nama}</p>
                    <p class="text-sm text-gray-600">${jumlah} unit × Rp ${harga.toLocaleString('id-ID')}</p>
                </div>
                <div class="text-right">
                    <p class="font-semibold text-gray-900">Rp ${subtotal.toLocaleString('id-ID')}</p>
                    <p class="text-xs text-gray-500">per hari</p>
                </div>
            `;
            selectedItems.appendChild(itemDiv);
        });

        totalBiaya.textContent = total > 0 ? `Rp ${total.toLocaleString('id-ID')}` : 'GRATIS';
    }

    // Input validation for jumlah
    document.querySelectorAll('.jumlah-input').forEach(input => {
        input.addEventListener('input', function() {
            const max = parseInt(this.getAttribute('max'));
            let value = parseInt(this.value);
            
            if (isNaN(value) || value < 1) {
                this.value = 1;
            } else if (value > max) {
                this.value = max;
            }
            
            updateBarangSummary();
        });
    });
    });
    document.addEventListener('DOMContentLoaded', function() {
    const limitFilter = document.getElementById('limit_filter');
    const barangContainer = document.getElementById('barang-container');
    const paginationControls = document.getElementById('pagination-controls');
    const showingCount = document.getElementById('showing-count');
    const totalCountEl = document.getElementById('total-count');
    const currentPageEl = document.getElementById('current-page');
    const totalPagesEl = document.getElementById('total-pages');
    const prevBtn = document.getElementById('prev-page-btn');
    const nextBtn = document.getElementById('next-page-btn');
    let currentPage = 1;
    let itemsPerPage = 9;
    let filteredCards = [];

    // Event listener untuk limit filter
    limitFilter.addEventListener('change', function() {
        const value = this.value;
        if (value === 'all') {
            itemsPerPage = Infinity;
            paginationControls.classList.add('hidden');
        } else {
            itemsPerPage = parseInt(value);
            paginationControls.classList.remove('hidden');
        }
        currentPage = 1;
        applyFilters();
    });

    // Function untuk apply semua filter
    function applyFilters() {
        const selectedCategory = document.getElementById('kategori_filter').value;
        const searchTerm = document.getElementById('search_barang').value.toLowerCase().trim();
        const allCards = Array.from(document.querySelectorAll('.barang-card'));
        
        // Filter cards berdasarkan kategori dan search
        filteredCards = allCards.filter(card => {
            const kategoriId = card.dataset.kategori;
            const namaBarang = card.dataset.nama;
            
            const matchCategory = !selectedCategory || kategoriId === selectedCategory;
            const matchSearch = !searchTerm || namaBarang.includes(searchTerm);
            
            return matchCategory && matchSearch;
        });

        // Update counts
        const totalCount = filteredCards.length;
        totalCountEl.textContent = totalCount;

        // Calculate pagination
        const totalPages = Math.ceil(totalCount / itemsPerPage);
        totalPagesEl.textContent = totalPages;
        currentPageEl.textContent = currentPage;

        // Show/hide pagination controls
        if (itemsPerPage === Infinity || totalPages <= 1) {
            paginationControls.classList.add('hidden');
        } else {
            paginationControls.classList.remove('hidden');
        }

        // Calculate which items to show
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = Math.min(startIndex + itemsPerPage, totalCount);

        // Hide all cards first
        allCards.forEach(card => {
            card.style.display = 'none';
        });

        // Show only cards for current page
        filteredCards.slice(startIndex, endIndex).forEach(card => {
            card.style.display = 'block';
        });

        // Update showing count
        if (totalCount === 0) {
            showingCount.textContent = '0';
            barangContainer.classList.add('hidden');
            document.getElementById('empty-state').classList.remove('hidden');
        } else {
            const showing = Math.min(endIndex, totalCount);
            showingCount.textContent = showing;
            barangContainer.classList.remove('hidden');
            document.getElementById('empty-state').classList.add('hidden');
        }

        // Update button states
        prevBtn.disabled = currentPage === 1;
        nextBtn.disabled = currentPage === totalPages || totalPages === 0;

        // Scroll to top
        smoothScrollToBarang();
    }

    // Change page function
    window.changePage = function(direction) {
        const totalPages = Math.ceil(filteredCards.length / itemsPerPage);
        const newPage = currentPage + direction;
        
        if (newPage >= 1 && newPage <= totalPages) {
            currentPage = newPage;
            applyFilters();
        }
    };

    // Smooth scroll to barang container
    function smoothScrollToBarang() {
        const container = document.getElementById('manual-selection-container');
        if (container) {
            container.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }

    // Reset filters function
    window.resetFilters = function() {
        document.getElementById('kategori_filter').value = '';
        document.getElementById('search_barang').value = '';
        limitFilter.value = '9';
        itemsPerPage = 9;
        currentPage = 1;
        paginationControls.classList.remove('hidden');
        applyFilters();
    };

    // Event listeners for other filters
    document.getElementById('kategori_filter').addEventListener('change', function() {
        currentPage = 1;
        applyFilters();
    });

    document.getElementById('search_barang').addEventListener('input', function() {
        currentPage = 1;
        applyFilters();
    });

    // Initial load
    applyFilters();
    });
    
</script>
@endpush