{{-- Hero Section - Professional with Animated Elements --}}
<section class="relative min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 overflow-hidden">
    {{-- Animated Background Elements --}}
    <div class="absolute inset-0">
        <div class="absolute inset-0 bg-black/30"></div>
        <div class="absolute inset-0 bg-cover bg-center opacity-20" 
             style="background-image: url('{{ asset('images/technopark.jpg') }}');"></div>
        
        {{-- Animated Gradient Mesh Background --}}
        <div class="absolute inset-0 opacity-25">
            <div class="absolute top-0 -left-4 w-[500px] h-[500px] bg-blue-500 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
            <div class="absolute top-0 -right-4 w-[500px] h-[500px] bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
            <div class="absolute -bottom-8 left-20 w-[500px] h-[500px] bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
        </div>
        
        {{-- Particle Background --}}
        <div class="absolute inset-0 overflow-hidden">
            <div class="stars"></div>
        </div>
        
        {{-- Grid Pattern --}}
        <div class="absolute inset-0 bg-[linear-gradient(rgba(255,255,255,0.03)_1px,transparent_1px),linear-gradient(90deg,rgba(255,255,255,0.03)_1px,transparent_1px)] bg-[size:4rem_4rem] [mask-image:radial-gradient(ellipse_80%_50%_at_50%_50%,#000,transparent)]"></div>
    </div>
    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="text-center space-y-8">
            {{-- Premium Badge --}}
            <div class="inline-flex items-center bg-white/10 backdrop-blur-xl border border-white/20 rounded-full px-6 py-3 mb-8 shadow-2xl" data-aos="fade-down">
                <span class="relative flex h-3 w-3 mr-3">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-3 w-3 bg-emerald-500"></span>
                </span>
                <span class="text-blue-100 text-sm font-semibold tracking-wide">Sistem Terpercaya dan Modern</span>
            </div>
            
            {{-- Main Heading --}}
            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-white leading-tight animate-fade-in-up" data-aos="fade-up" data-aos-delay="200">
                Kelola Aset dengan
                <br/>
                <span class="relative inline-block mt-2">
                    <span class="relative z-10 bg-gradient-to-r from-yellow-400 via-orange-500 to-yellow-400 bg-clip-text text-transparent animate-gradient-hero">
                        Mudah & Efisien
                    </span>
                </span>
            </h1>
            
            {{-- Subtitle --}}
            <p class="text-xl sm:text-2xl text-blue-100 max-w-3xl mx-auto leading-relaxed animate-fade-in" data-aos="fade-up" data-aos-delay="300" style="animation-delay: 0.2s">
                Platform terintegrasi untuk peminjaman aset dengan teknologi terkini. 
                Kelola, pantau, dan optimalkan aset Anda secara real-time.
            </p>
            
            {{-- CTA Buttons --}}
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center pt-4 animate-fade-in" data-aos="fade-up" data-aos-delay="400" style="animation-delay: 0.4s">
                <a href="{{ route('aset.barang') }}" class="group relative px-8 py-4 bg-white text-blue-900 rounded-xl font-semibold text-lg overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-2xl hover:shadow-blue-500/50">
                    <span class="relative z-10 flex items-center">
                        Lihat Barang
                        <svg class="ml-2 w-5 h-5 transform group-hover:translate-x-2 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-600 to-purple-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-500 origin-left"></div>
                    <span class="absolute inset-0 z-10 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-white font-semibold">
                        Lihat Barang
                        <svg class="ml-2 w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                        </svg>
                    </span>
                </a>
                
                <a href="#features" class="group px-8 py-4 bg-white/10 backdrop-blur-xl text-white rounded-xl font-semibold text-lg border-2 border-white/30 hover:bg-white/20 hover:border-white/50 transition-all duration-300 transform hover:scale-105">
                    <span class="flex items-center">
                        Pelajari Lebih Lanjut
                        <svg class="ml-2 w-5 h-5 transform group-hover:translate-y-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </span>
                </a>
            </div>

            {{-- Stats Section - DENGAN CLASS stats-variant-medium --}}
            @include('aset.partials.stats', ['stats' => $stats])
        </div>
    </div>
    
    {{-- Scroll Indicator - Animated --}}
    <div class="absolute bottom-1 left-1/6 transform -translate-x-1/2 animate-bounce-slow">
        <div class="flex flex-col items-center space-y-2">
            <span class="text-white text-sm font-medium animate-pulse">Scroll untuk lebih lanjut</span>
            <svg class="w-6 h-6 text-white animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
            </svg>
        </div>
    </div>
</section>

<style>
/* Fade In Animations */
@keyframes fade-in-down {
    from {
        opacity: 0;
        transform: translateY(-20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fade-in-up {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes fade-in {
    from {
        opacity: 0;
    }
    to {
        opacity: 1;
    }
}

.animate-fade-in-down {
    animation: fade-in-down 0.8s ease-out forwards;
}

.animate-fade-in-up {
    animation: fade-in-up 0.8s ease-out forwards;
    opacity: 0;
}

.animate-fade-in {
    animation: fade-in 0.8s ease-out forwards;
    opacity: 0;
}

/* Blob Animation */
@keyframes blob {
    0%, 100% { transform: translate(0px, 0px) scale(1); }
    33% { transform: translate(50px, -80px) scale(1.2); }
    66% { transform: translate(-30px, 40px) scale(0.8); }
}

.animate-blob { animation: blob 10s ease-in-out infinite; }
.animation-delay-2000 { animation-delay: 2s; }
.animation-delay-4000 { animation-delay: 4s; }

/* Particle Stars Background */
.stars { position: absolute; top: 0; left: 0; width: 100%; height: 100%; overflow: hidden; }
.stars::after {
    content: "";
    position: absolute;
    width: 2px;
    height: 2px;
    background: white;
    box-shadow: 100px 200px white, 300px 100px white, 500px 300px white, 700px 150px white, 900px 250px white, 200px 400px white, 400px 500px white, 600px 450px white, 800px 350px white, 150px 600px white, 350px 650px white, 550px 550px white;
    animation: sparkle 3s ease-in-out infinite;
    border-radius: 50%;
}

@keyframes sparkle {
    0%, 100% { opacity: 0.3; }
    50% { opacity: 1; }
}

/* Bounce Slow */
@keyframes bounce-slow {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-20px); }
}

.animate-bounce-slow {
    animation: bounce-slow 2s ease-in-out infinite;
}

    /* Gradient Animation untuk Hero */
    @keyframes gradient-hero {
        0%, 100% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
    }

    .animate-gradient-hero {
        background-size: 200% 200%;
        animation: gradient-hero 3s ease infinite;
    }
</style>