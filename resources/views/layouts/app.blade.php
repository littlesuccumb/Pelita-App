<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>@yield('title', 'Dashboard - Pelita App')</title>
    
    <!-- Favicon - Logo untuk tab browser -->
    <link rel="icon" type="image/x-icon" href="{{ asset('images/logo ctp.png') }}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('images/logo ctp.png') }}">
    
    <!-- Favicon untuk berbagai device dan resolusi -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/logo ctp.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/logo ctp.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('images/logo ctp.png') }}">
    
    <!-- Apple Touch Icon untuk iOS -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/logo ctp.png') }}">
    
    <!-- Android Chrome Icons -->
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('images/logo ctp.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('images/logo ctp.png') }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- ✅ Notification System CSS -->
    <link rel="stylesheet" href="{{ asset('css/notification-system.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    <!-- AOS Library -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    
    <!-- CountUp.js -->
    <script src="https://cdn.jsdelivr.net/npm/countup.js@2.0.7/dist/countUp.min.js"></script>
    
    <!-- ✅ INLINE NOTIFICATION SYSTEM - Load sebelum page scripts -->
    <script>
        const NotificationSystem = {
            templates: {
                success: {
                    'basic': { icon: '<i class="fas fa-check-circle"></i>', title: '✨ Berhasil!', message: 'Operasi berhasil diselesaikan.', color: '#10b981', duration: 5000 },
                    'data-added': { icon: '<i class="fas fa-plus-circle"></i>', title: '✨ Barang Ditambahkan!', message: null, color: '#10b981', duration: 5000 },
                    'data-updated': { icon: '<i class="fas fa-sync-alt"></i>', title: '✨ Data Diperbarui!', message: null, color: '#10b981', duration: 5000 },
                    'deleted': { icon: '<i class="fas fa-trash-alt"></i>', title: '✨ Barang Dihapus!', message: null, color: '#10b981', duration: 5000 },
                    'maintenance-scheduled': { icon: '<i class="fas fa-tools"></i>', title: '✨ Maintenance Dijadwalkan!', message: null, color: '#10b981', duration: 5000 },
                    'import-completed': { icon: '<i class="fas fa-file-import"></i>', title: '✨ Import Selesai!', message: null, color: '#10b981', duration: 5000 }
                },
                error: {
                    'basic': { icon: '<i class="fas fa-times-circle"></i>', title: '❌ Gagal!', message: 'Operasi gagal. Silakan coba lagi.', color: '#ef4444', duration: 6000 },
                    'validation': { icon: '<i class="fas fa-exclamation-circle"></i>', title: '❌ Validasi Error!', message: 'Terdapat kesalahan pada form:', color: '#ef4444', duration: 7000 },
                    'delete-failed': { icon: '<i class="fas fa-trash-alt"></i>', title: '❌ Hapus Gagal!', message: null, color: '#ef4444', duration: 6000 },
                    'import-failed': { icon: '<i class="fas fa-file-import"></i>', title: '❌ Import Gagal!', message: null, color: '#ef4444', duration: 8000 }
                },
                warning: {
                    'basic': { icon: '<i class="fas fa-exclamation-triangle"></i>', title: '⚠️ Peringatan!', message: 'Ada beberapa hal yang perlu diperhatikan.', color: '#f59e0b', duration: 6000 },
                    'partial-upload-fail': { icon: '<i class="fas fa-exclamation"></i>', title: '⚠️ Sebagian Foto Gagal!', message: null, color: '#f59e0b', duration: 8000 },
                    'partial-import-fail': { icon: '<i class="fas fa-exclamation"></i>', title: '⚠️ Sebagian Data Gagal!', message: null, color: '#f59e0b', duration: 8000 }
                },
                info: {
                    'basic': { icon: '<i class="fas fa-info-circle"></i>', title: 'ℹ️ Informasi', message: 'Informasi penting untuk Anda.', color: '#3b82f6', duration: 5000 }
                }
            },

            show(type, subType, data = {}) {
                const template = this.templates[type]?.[subType] || this.templates[type]?.basic;
                if (!template) {
                    console.warn('Template tidak ditemukan:', type, subType);
                    return;
                }

                const container = document.getElementById('notification-container');
                if (!container) {
                    console.error('Notification container tidak ditemukan!');
                    return;
                }

                const notification = document.createElement('div');
                notification.className = `notification ${type}`;
                notification.style.setProperty('--color', template.color);

                const message = data.message || template.message;
                let detailsHTML = '';
                if (data.details && data.details.length > 0) {
                    detailsHTML = `<div class="notification-list">${data.details.map(detail => 
                        `<div class="notification-list-item" style="border-left-color: var(--color);">${detail.icon}<span>${detail.text}</span></div>`
                    ).join('')}</div>`;
                }

                notification.innerHTML = `
                    <div class="notification-header">
                        <div class="notification-icon">${template.icon}</div>
                        <div class="notification-header-content">
                            <div class="notification-title">${template.title}</div>
                            <div class="notification-time"><i class="fas fa-clock"></i><span>Baru saja</span></div>
                        </div>
                        <button class="notification-close" onclick="this.closest('.notification').classList.add('exit'); setTimeout(() => this.closest('.notification').remove(), 400)">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="notification-body">
                        <p class="notification-message">${message}</p>
                        ${detailsHTML}
                    </div>
                    <div class="notification-progress" style="background: var(--color);"></div>
                `;

                container.appendChild(notification);

                const duration = data.duration || template.duration;
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.classList.add('exit');
                        setTimeout(() => notification.remove(), 400);
                    }
                }, duration);
            },

            success(subType, data = {}) { this.show('success', subType, data); },
            error(subType, data = {}) { this.show('error', subType, data); },
            warning(subType, data = {}) { this.show('warning', subType, data); },
            info(subType, data = {}) { this.show('info', subType, data); },

            dataAdded(barangName, barangCode, jumlah, fotoCount = 0, kategori = '') {
                this.success('data-added', {
                    message: `Barang "${barangName}" berhasil ditambahkan!`,
                    details: [
                        { icon: '<i class="fas fa-barcode"></i>', text: `Kode: ${barangCode}` },
                        { icon: '<i class="fas fa-cubes"></i>', text: `Jumlah: ${jumlah} unit` },
                        kategori ? { icon: '<i class="fas fa-tag"></i>', text: `Kategori: ${kategori}` } : null,
                        fotoCount > 0 ? { icon: '<i class="fas fa-images"></i>', text: `Foto: ${fotoCount} gambar` } : null
                    ].filter(Boolean)
                });
            },

            dataUpdated(barangName, changes = []) {
                this.success('data-updated', {
                    message: `Data barang "${barangName}" berhasil diperbarui!`,
                    details: changes.length > 0 ? changes : [{ icon: '<i class="fas fa-edit"></i>', text: 'Data telah diperbarui' }]
                });
            },

            deleted(barangName, barangCode) {
                this.success('deleted', {
                    message: `Barang "${barangName}" telah dihapus dari sistem.`,
                    details: [
                        { icon: '<i class="fas fa-warning"></i>', text: 'Tindakan tidak dapat dibatalkan' },
                        barangCode ? { icon: '<i class="fas fa-barcode"></i>', text: `Kode: ${barangCode}` } : null
                    ].filter(Boolean)
                });
            },

            maintenanceScheduled(barangName, jumlah, teknisi = '', tanggal = '') {
                this.success('maintenance-scheduled', {
                    message: `Maintenance untuk ${jumlah} unit "${barangName}" berhasil dijadwalkan!`,
                    details: [
                        { icon: '<i class="fas fa-cubes"></i>', text: `Jumlah: ${jumlah} unit` },
                        tanggal ? { icon: '<i class="fas fa-calendar"></i>', text: `Tanggal: ${tanggal}` } : null,
                        teknisi ? { icon: '<i class="fas fa-user"></i>', text: `Teknisi: ${teknisi}` } : null
                    ].filter(Boolean)
                });
            },

            importCompleted(successCount, failedCount = 0, errorDetails = []) {
                if (failedCount > 0) {
                    this.warning('partial-import-fail', {
                        message: `${successCount} data berhasil diimport, ${failedCount} gagal.`,
                        details: [
                            { icon: '<i class="fas fa-check"></i>', text: `${successCount} berhasil` },
                            { icon: '<i class="fas fa-times"></i>', text: `${failedCount} gagal` },
                            ...errorDetails.slice(0, 3)
                        ]
                    });
                } else {
                    this.success('import-completed', {
                        message: `${successCount} data barang berhasil diimport!`,
                        details: [{ icon: '<i class="fas fa-check"></i>', text: `Total: ${successCount} barang` }]
                    });
                }
            },

            validationError(errors = []) {
                this.error('validation', {
                    message: 'Terdapat kesalahan pada form:',
                    details: errors.map(err => ({ icon: '<i class="fas fa-times"></i>', text: err }))
                });
            },

            photosUploaded(barangName, uploadedCount, failedCount = 0) {
                if (failedCount > 0) {
                    this.warning('partial-upload-fail', {
                        message: `${uploadedCount} foto berhasil diupload, ${failedCount} foto gagal.`,
                        details: [
                            { icon: '<i class="fas fa-check"></i>', text: `${uploadedCount} foto berhasil` },
                            { icon: '<i class="fas fa-times"></i>', text: `${failedCount} foto gagal` }
                        ]
                    });
                } else {
                    this.success('photos-uploaded', {
                        message: `${uploadedCount} foto untuk "${barangName}" berhasil diupload!`,
                        details: [{ icon: '<i class="fas fa-check"></i>', text: `Total: ${uploadedCount} gambar` }]
                    });
                }
            },

            clearAll() {
                const container = document.getElementById('notification-container');
                if (container) {
                    document.querySelectorAll('.notification').forEach(n => n.classList.add('exit'));
                    setTimeout(() => {
                        document.querySelectorAll('.notification').forEach(n => n.remove());
                    }, 400);
                }
            }
        };

        // Log untuk debugging
        console.log('%c✅ Notification System Loaded (Inline)', 'color: #10b981; font-weight: bold; font-size: 14px;');
    </script>
    
    @stack('styles')

    <!-- Custom Styles -->
    @include('layouts.partials.styles')

    <style>
        /* ✅ SMOOTH DARK MODE TRANSITION - OPTIMIZED */
        html {
            transition: background-color 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        /* Disable all transitions during theme switch to prevent lag */
        html.theme-switching,
        html.theme-switching * {
            transition: none !important;
            animation: none !important;
        }
        
        /* Smooth transitions for specific elements only */
        .sidebar,
        .top-nav,
        .main-content,
        .card,
        .alert {
            transition: background-color 0.25s ease, 
                        border-color 0.25s ease, 
                        color 0.25s ease,
                        box-shadow 0.25s ease;
        }
        
        /* Hapus space di bawah navbar */
        .main-content {
            padding-top: 0 !important;
        }
        
        /* Pastikan content punya jarak dari navbar */
        main.flex-1 {
            padding-top: 2rem;
        }
        
        /* Override any existing margin/padding */
        .top-nav + * {
            margin-top: 0 !important;
        }
        
        .breadcrumb-modern {
            display: flex;
            align-items: center;
            gap: 12px;
            background: white;
            padding: 16px 24px;
            border-radius: 16px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.04);
            border: 1px solid rgba(14, 165, 233, 0.1);
        }

        .dark .breadcrumb-modern {
            background: #1F2937;
            border-color: #374151;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.2);
        }

        .breadcrumb-link {
            color: #64748B;
            font-weight: 600;
            font-size: 14px;
            transition: all 0.2s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dark .breadcrumb-link {
            color: #94A3B8;
        }

        .breadcrumb-link:hover {
            color: #0EA5E9;
        }

        .dark .breadcrumb-link:hover {
            color: #60A5FA;
        }

        .breadcrumb-current {
            color: #0F172A;
            font-weight: 700;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .dark .breadcrumb-current {
            color: #F1F5F9;
        }

        /* Separator Icon Styling */
        .breadcrumb-modern .fa-chevron-right {
            font-size: 10px;
            opacity: 0.5;
        }

        /* Animation untuk breadcrumb */
        .animate-fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from { 
                opacity: 0;
                transform: translateY(-10px);
            }
            to { 
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive breadcrumb */
        @media (max-width: 640px) {
            .breadcrumb-modern {
                padding: 12px 16px;
                gap: 8px;
            }
            
            .breadcrumb-link,
            .breadcrumb-current {
                font-size: 13px;
            }
            
            .breadcrumb-link span,
            .breadcrumb-current span {
                display: none;
            }
            
            .breadcrumb-link i,
            .breadcrumb-current i {
                font-size: 16px;
            }
        }

        /* Hover effect untuk breadcrumb container */
        .breadcrumb-modern:hover {
            border-color: rgba(14, 165, 233, 0.2);
        }

        .dark .breadcrumb-modern:hover {
            border-color: #4B5563;
        }
        
        /* Custom style untuk breadcrumb edit */
        .breadcrumb-edit .breadcrumb-current {
            color: #EA580C;
        }

        .dark .breadcrumb-edit .breadcrumb-current {
            color: #FB923C;
        }

        .breadcrumb-edit {
            border-color: rgba(234, 88, 12, 0.15);
        }

        .dark .breadcrumb-edit {
            border-color: rgba(251, 146, 60, 0.2);
        }
    </style>
</head>
<body class="antialiased bg-gray-50 dark:bg-gray-900">
    <!-- Mobile Overlay -->
    @include('layouts.partials.mobile-overlay')

    <!-- ✅ FIXED: Alpine.js State Management -->
    <div x-data="{ 
        sidebarCollapsed: localStorage.getItem('sidebarCollapsed') === 'true',
        mobileMenuOpen: false
    }" 
    x-init="
        // ✅ Auto-close mobile menu saat klik link sidebar (HANYA DI MOBILE)
        $el.addEventListener('click', (e) => {
            const link = e.target.closest('.sidebar a');
            if (link && window.innerWidth < 1024) {
                setTimeout(() => {
                    mobileMenuOpen = false;
                }, 100);
            }
        });
        
        // ✅ Save sidebar collapsed state to localStorage
        $watch('sidebarCollapsed', value => {
            localStorage.setItem('sidebarCollapsed', value.toString());
        });
        
        // ✅ Prevent body scroll when mobile menu is open
        $watch('mobileMenuOpen', value => {
            if (value) {
                document.body.style.overflow = 'hidden';
            } else {
                document.body.style.overflow = '';
            }
        });
        
        // ✅ Close mobile menu on window resize to desktop
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024 && mobileMenuOpen) {
                mobileMenuOpen = false;
            }
        });
    ">
        <!-- Sidebar -->
        @include('layouts.partials.sidebar')

        <!-- Main Content Area -->
        <div class="main-content bg-gray-50 dark:bg-gray-900" :class="{ 'expanded': sidebarCollapsed }">
            <!-- Top Navigation -->
            @include('layouts.partials.topnav')
            
            <!-- Main Content -->
            <main class="flex-1 py-0 -mt-4">
                <!-- Page Content -->
                @yield('content')
            </main>
        </div>

        <!-- Footer -->
        <div class="footer-wrapper" :class="{ 'expanded': sidebarCollapsed }">
            @include('layouts.partials.footer')
        </div>
    </div>

    <!-- ✅ Notification Container -->
    <div id="notification-container"></div>

    <!-- ✅ Page-specific Scripts (loaded after NotificationSystem) -->
    @stack('scripts')

    <!-- Custom Scripts -->
    @include('layouts.partials.scripts')

    <!-- ✅ GLOBAL BACK NAVIGATION SCRIPT -->
    <script>
        /**
         * Global function untuk navigasi kembali
         * Otomatis tersedia di semua halaman yang menggunakan layout ini
         */
        function goBack() {
            // Cek apakah ada history sebelumnya dan bukan dari external site
            if (window.history.length > 1 && document.referrer && 
                document.referrer.indexOf(window.location.host) !== -1) {
                window.history.back();
            } else {
                // Fallback ke halaman default berdasarkan role
                const userRole = '{{ auth()->user()->role ?? "user" }}';
                
                // Tentukan fallback URL berdasarkan role
                if (userRole === 'super_admin' || userRole === 'admin') {
                    window.location.href = '{{ route('dashboard') }}';
                } else if (userRole === 'mahasiswa') {
                    window.location.href = '{{ route('dashboard') }}';
                } else {
                    window.location.href = '{{ route('dashboard') }}';
                }
            }
        }

        /**
         * Helper function untuk navigasi dengan konfirmasi (jika ada perubahan form)
         */
        function goBackWithConfirm(message = 'Ada perubahan yang belum disimpan. Yakin ingin kembali?') {
            // Cek apakah form sudah dimodifikasi
            const forms = document.querySelectorAll('form');
            let isModified = false;

            forms.forEach(form => {
                const inputs = form.querySelectorAll('input:not([type="hidden"]), textarea, select');
                inputs.forEach(input => {
                    if (input.defaultValue !== input.value) {
                        isModified = true;
                    }
                });
            });

            // Jika ada perubahan, tampilkan konfirmasi
            if (isModified) {
                if (confirm(message)) {
                    goBack();
                }
            } else {
                goBack();
            }
        }

        /**
         * Auto-setup untuk semua link/button dengan class 'btn-back' atau 'back-button'
         */
        document.addEventListener('DOMContentLoaded', function() {
            // Setup untuk button/link dengan class khusus
            const backButtons = document.querySelectorAll('.btn-back, .back-button, [data-back]');
            
            backButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();
                    
                    // Cek apakah perlu konfirmasi
                    if (this.hasAttribute('data-confirm')) {
                        goBackWithConfirm(this.getAttribute('data-confirm'));
                    } else {
                        goBack();
                    }
                });
            });

            // Keyboard shortcut: Alt + Left Arrow untuk back
            document.addEventListener('keydown', function(e) {
                if (e.altKey && e.key === 'ArrowLeft') {
                    e.preventDefault();
                    goBack();
                }
            });

            // ✅ Log Notification System status
            console.log('%c📢 Notification System Status', 'color: #3b82f6; font-weight: bold; font-size: 12px;');
            console.log('NotificationSystem:', typeof NotificationSystem !== 'undefined' ? '✅ Loaded' : '❌ Not loaded');
            console.log('Container:', document.getElementById('notification-container') ? '✅ Found' : '❌ Missing');
        });

        // Log untuk debugging
        console.log('%c🔙 Global Back Navigation Loaded', 'color: #10B981; font-size: 12px; font-weight: bold;');
        console.log('%cUse goBack() or add class="btn-back" to any button/link', 'color: #6B7280; font-size: 11px;');
    </script>
</body>
</html>