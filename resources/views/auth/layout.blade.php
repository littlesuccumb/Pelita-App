<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Cimahi Techno Park')</title>
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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        'sans': ['Inter', 'system-ui', 'sans-serif']
                    },
                    colors: {
                        'techno-blue': '#0066CC',
                        'techno-dark': '#003366',
                        'techno-light': '#E6F3FF'
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        .glass-morphism {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .floating-animation {
            animation: floating 4s ease-in-out infinite;
        }
        
        @keyframes floating {
            0% { transform: translate(0, 0px); }
            50% { transform: translate(0, -8px); }
            100% { transform: translate(0, 0px); }
        }
        
        .input-focus {
            transition: all 0.2s ease;
        }
        
        .input-focus:focus {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 102, 204, 0.2);
        }
        
        .btn-hover {
            transition: all 0.2s ease;
        }
        
        .btn-hover:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(0, 102, 204, 0.4);
        }
        
        .bg-overlay::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 51, 102, 0.7);
            z-index: 1;
        }
        
        .particle {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            animation: particle-float 6s infinite linear;
        }
        
        @keyframes particle-float {
            0% {
                opacity: 0;
                transform: translateY(100vh) scale(0);
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                opacity: 0;
                transform: translateY(-10vh) scale(1);
            }
        }
        
        .fade-in {
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .shake-animation {
            animation: shake 0.5s ease-in-out;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        /* Custom scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
        }
        
        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }
        
        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        /* Compact responsive adjustments */
        @media (max-height: 800px) {
            .floating-animation {
                animation: none;
            }
            .main-container {
                padding: 0.5rem;
            }
            .glass-morphism {
                padding: 1.5rem;
            }
            .logo-container {
                margin-bottom: 1rem;
            }
            .logo-size {
                width: 3.5rem;
                height: 3.5rem;
            }
            .logo-inner {
                width: 2.5rem;
                height: 2.5rem;
            }
            .logo-img {
                width: 2rem;
                height: 2rem;
            }
            .title-size {
                font-size: 1.5rem;
            }
            .form-spacing {
                gap: 1rem;
            }
            .input-height {
                padding-top: 0.75rem;
                padding-bottom: 0.75rem;
            }
            .footer-compact {
                margin-top: 1rem;
                font-size: 0.75rem;
            }
        }

        @media (max-height: 700px) {
            .glass-morphism {
                padding: 1.25rem;
            }
            .logo-container {
                margin-bottom: 0.75rem;
            }
            .header-spacing {
                margin-bottom: 1.5rem;
            }
            .form-spacing {
                gap: 0.75rem;
            }
        }

        @media (max-height: 600px) {
            .glass-morphism {
                padding: 1rem;
            }
            .logo-container {
                margin-bottom: 0.5rem;
            }
            .header-spacing {
                margin-bottom: 1rem;
            }
            .form-spacing {
                gap: 0.5rem;
            }
            .footer-compact {
                display: none;
            }
        }

        /* Scrollable container for very small screens */
        @media (max-height: 500px) {
            .main-wrapper {
                align-items: flex-start;
                padding-top: 1rem;
                padding-bottom: 1rem;
                overflow-y: auto;
            }
        }
    </style>
    
    @stack('styles')
</head>
<body class="min-h-screen font-sans relative">
    <!-- Background with overlay -->
    <div class="fixed inset-0 bg-gradient-to-br from-blue-900 via-blue-800 to-indigo-900 bg-overlay">
        <div class="absolute inset-0 bg-cover bg-center opacity-70" 
             style="background-image: url('{{ asset('images/technopark.jpg') }}');">
        </div>
    </div>
    
    <!-- Animated particles -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0" id="particles-container">
        <div class="particle w-1 h-1" style="left: 10%; animation-delay: 0s;"></div>
        <div class="particle w-2 h-2" style="left: 30%; animation-delay: 1s;"></div>
        <div class="particle w-1 h-1" style="left: 50%; animation-delay: 2s;"></div>
        <div class="particle w-2 h-2" style="left: 70%; animation-delay: 3s;"></div>
        <div class="particle w-1 h-1" style="left: 90%; animation-delay: 4s;"></div>
    </div>

    <!-- Main content with scrollable wrapper -->
    <div class="relative z-10 min-h-screen flex items-center justify-center main-container main-wrapper" style="padding: 1rem;">
        <div class="w-full max-w-md">
            <!-- Compact main card -->
            <div class="glass-morphism rounded-2xl shadow-xl floating-animation fade-in" style="padding: 2rem;">
                <!-- Compact header -->
                <div class="text-center header-spacing" style="margin-bottom: 2rem;">
                    <!-- Compact logo -->
                    <div class="flex justify-center logo-container" style="margin-bottom: 1.25rem;">
                        <div class="logo-size rounded-xl bg-white shadow-lg flex items-center justify-center" style="width: 4rem; height: 4rem;">
                            <div class="logo-inner bg-gradient-to-br from-yellow-400 to-blue-500 rounded-lg flex items-center justify-center" style="width: 3rem; height: 3rem;">
                                <img src="{{ asset('images/logo ctp.png') }}" 
                                     alt="Cimahi Techno Park"
                                     class="logo-img object-contain" style="width: 2.5rem; height: 2.5rem;">
                            </div>
                        </div>
                    </div>
                    
                    <h1 class="title-size font-bold text-white mb-1" style="font-size: 1.75rem;">@yield('header-title', 'Welcome')</h1>
                    <p class="text-white/80 text-sm font-medium">Cimahi Techno Park</p>
                    <p class="text-white/60 text-xs">@yield('header-subtitle', 'Sistem Informasi')</p>
                </div>

                <!-- Content Area -->
                @yield('content')
            </div>

            <!-- Compact footer -->
            <div class="text-center footer-compact" style="margin-top: 1.5rem;">
                <p class="text-white/50 text-xs mb-2">
                    © 2025 Cimahi Techno Park
                </p>
                <div class="flex justify-center space-x-3">
                    <a href="https://www.facebook.com/cimahitechnopark.id/" target="_blank" class="text-white/40 hover:text-white/70 transition-colors">
                        <i class="fab fa-facebook-f text-sm"></i>
                    </a>
                    <a href="https://twitter.com/CimahiTPark" target="_blank" class="text-white/40 hover:text-white/70 transition-colors">
                        <i class="fab fa-twitter text-sm"></i>
                    </a>
                    <a href="https://www.instagram.com/cimahitechnopark.id/" target="_blank" class="text-white/40 hover:text-white/70 transition-colors">
                        <i class="fab fa-instagram text-sm"></i>
                    </a>
                    <a href="https://id.linkedin.com/company/cimahitechnopark" target="_blank" class="text-white/40 hover:text-white/70 transition-colors">
                        <i class="fab fa-linkedin-in text-sm"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Generate particles
        function createParticle() {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.width = particle.style.height = (Math.random() * 2 + 1) + 'px';
            particle.style.animationDelay = Math.random() * 6 + 's';
            
            const container = document.getElementById('particles-container');
            if (container) {
                container.appendChild(particle);
                setTimeout(() => particle.remove(), 6000);
            }
        }

        // Create particles periodically
        setInterval(createParticle, 3000);
    </script>

    @stack('scripts')
</body>
</html>