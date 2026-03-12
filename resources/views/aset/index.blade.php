@extends('layouts.guest')

@section('title', 'Pelita App - Sistem Peminjaman Aset Terpadu')

{{-- Custom Styles --}}
@push('styles')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/landing-page.css') }}">
    <link rel="stylesheet" href="{{ asset('css/mobile-compact.css') }}">
@endpush

@section('content')
    {{-- Hero Section with Stats --}}
    @include('aset.partials.hero', ['stats' => $stats])

    {{-- How It Works Section --}}
    @include('aset.partials.cara-kerja')

    {{-- Features Section --}}
    @include('aset.partials.features')

    {{-- Recent Items Section --}}
    @include('aset.partials.recent-items', ['recentBarang' => $recentBarang])

    {{-- CTA Section --}}
    @include('aset.partials.cta')
@endsection

{{-- Scripts --}}
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/countup.js@2.8.0/dist/countUp.umd.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="{{ asset('js/landing-page.js') }}"></script>
@endpush