{{--
    Step Card Component
    
    Required Props:
    - $number: Step number (1-6)
    - $color: Color theme (indigo, green, blue, yellow, purple, teal)
    - $title: Step title
    - $description: Step description
    - $icon: SVG path for icon
    
    Optional Props:
    - $delay: AOS animation delay (default: 0)
    - $isFinal: Boolean to show checkmark (default: false)
--}}

@php
    $colorClasses = [
        'indigo' => [
            'badge' => 'from-blue-500 to-blue-700',
            'shadow' => 'shadow-blue-500/50',
            'bg' => 'from-blue-100 to-blue-50',
            'text' => 'text-blue-600',
            'hover' => 'hover:text-blue-600',
            'border' => 'hover:border-blue-200',
            'arrow' => 'text-blue-500'
        ],
        'green' => [
            'badge' => 'from-emerald-500 to-emerald-700',
            'shadow' => 'shadow-emerald-500/50',
            'bg' => 'from-emerald-100 to-emerald-50',
            'text' => 'text-emerald-600',
            'hover' => 'hover:text-emerald-600',
            'border' => 'hover:border-emerald-200',
            'arrow' => 'text-emerald-500'
        ],
        'blue' => [
            'badge' => 'from-indigo-500 to-indigo-700',
            'shadow' => 'shadow-indigo-500/50',
            'bg' => 'from-indigo-100 to-indigo-50',
            'text' => 'text-indigo-600',
            'hover' => 'hover:text-indigo-600',
            'border' => 'hover:border-indigo-200',
            'arrow' => 'text-indigo-500'
        ],
        'yellow' => [
            'badge' => 'from-purple-500 to-purple-700',
            'shadow' => 'shadow-purple-500/50',
            'bg' => 'from-purple-100 to-purple-50',
            'text' => 'text-purple-600',
            'hover' => 'hover:text-purple-600',
            'border' => 'hover:border-purple-200',
            'arrow' => 'text-purple-500'
        ],
        'purple' => [
            'badge' => 'from-orange-500 to-orange-700',
            'shadow' => 'shadow-orange-500/50',
            'bg' => 'from-orange-100 to-orange-50',
            'text' => 'text-orange-600',
            'hover' => 'hover:text-orange-600',
            'border' => 'hover:border-orange-200',
            'arrow' => 'text-orange-500'
        ],
        'teal' => [
            'badge' => 'from-cyan-500 to-cyan-700',
            'shadow' => 'shadow-cyan-500/50',
            'bg' => 'from-cyan-100 to-cyan-50',
            'text' => 'text-cyan-600',
            'hover' => 'hover:text-cyan-600',
            'border' => 'hover:border-cyan-200',
            'arrow' => 'text-cyan-500'
        ]
    ];
    
    $colors = $colorClasses[$color] ?? $colorClasses['indigo'];
    $delay = $delay ?? 0;
    $isFinal = $isFinal ?? false;
@endphp

<div class="group relative" data-aos="fade-up" data-aos-delay="{{ $delay }}">
    <div class="relative bg-white rounded-3xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border-2 border-transparent {{ $colors['border'] }}">
        {{-- Step Number Badge --}}
        <div class="absolute -top-4 left-8 w-12 h-12 bg-gradient-to-br {{ $colors['badge'] }} rounded-2xl flex items-center justify-center shadow-lg {{ $colors['shadow'] }} transform group-hover:rotate-12 group-hover:scale-110 transition-all duration-500">
            <span class="text-white font-bold text-xl">{{ $number }}</span>
        </div>
        
        {{-- Icon --}}
        <div class="mt-6 mb-6 flex justify-center">
            <div class="w-20 h-20 bg-gradient-to-br {{ $colors['bg'] }} rounded-2xl flex items-center justify-center transform group-hover:scale-110 group-hover:rotate-6 transition-all duration-500">
                <svg class="w-10 h-10 {{ $colors['text'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"></path>
                </svg>
            </div>
        </div>
        
        {{-- Title --}}
        <h3 class="text-xl font-bold text-gray-900 mb-3 text-center {{ $colors['hover'] }} transition-colors duration-300">
            {{ $title }}
        </h3>
        
        {{-- Description --}}
        <p class="text-gray-600 text-center leading-relaxed">
            {{ $description }}
        </p>
        
        {{-- Progress Arrow (tidak tampil di step terakhir) --}}
        @if (!$isFinal)
        <div class="hidden lg:flex absolute -right-6 top-1/2 transform -translate-y-1/2 z-10">
            <div class="w-12 h-12 bg-white rounded-full shadow-lg flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                <svg class="w-6 h-6 {{ $colors['arrow'] }} animate-pulse-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </div>
        </div>
        @endif
        
        {{-- Checkmark untuk step terakhir --}}
        @if ($isFinal)
        <div class="mt-6 flex justify-center">
            <div class="w-12 h-12 bg-gradient-to-br {{ $colors['badge'] }} rounded-full flex items-center justify-center animate-bounce-slow shadow-lg {{ $colors['shadow'] }}">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>
        </div>
        @endif
    </div>
</div>