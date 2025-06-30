@extends('dashboard.layouts.app')

@section('title')
SILAGA | Lupa Kata Sandi
@endsection

@push('custom-css')
<link rel="stylesheet" href="{{ asset('backend/vendor/css/pages/page-auth.css') }}" />
<style>
    :root {
        --primary-color: #3677C3; /* Warna biru utama dari logo */
        --primary-color-hover: #2C5DA5; /* Warna biru lebih gelap untuk efek hover */
        --text-color: #2C4E8A; /* Warna biru tua untuk teks dari logo */
    }

    /* Penyesuaian tampilan agar lebih modern dan nyaman */
    body {
        background-color: #f8f9fa; /* Warna latar belakang netral */
    }

    .authentication-wrapper.authentication-basic .authentication-inner {
        max-width: 450px;
        border-radius: 1rem; /* Sudut lebih tumpul */
        box-shadow: 0 8px 25px rgba(0,0,0,0.08); /* Bayangan lebih halus */
        overflow: hidden;
        border: 1px solid #dee2e6;
    }

    .card {
        border: none;
    }

    /* Gaya tombol utama */
    .btn-primary {
        background-color: var(--primary-color) !important;
        border-color: var(--primary-color) !important;
        color: #ffffff !important;
        padding: 0.75rem 1rem;
        font-weight: 600;
        transition: background-color 0.3s ease, border-color 0.3s ease;
    }

    .btn-primary:hover,
    .btn-primary:focus,
    .btn-primary:active {
        background-color: var(--primary-color-hover) !important;
        border-color: var(--primary-color-hover) !important;
    }

    /* Gaya tombol outline */
    .btn-outline-primary {
        border: 2px solid var(--primary-color) !important;
        color: var(--primary-color) !important;
        background-color: transparent !important;
        transition: background-color 0.3s, color 0.3s, border-color 0.3s;
    }

    .btn-outline-primary:hover, .btn-outline-primary:focus {
        border-color: var(--primary-color-hover) !important;
        color: #fff !important;
        background-color: var(--primary-color-hover) !important;
    }
    
    /* Gaya teks merek/logo */
    .app-brand-text {
        font-size: 1.75rem;
        color: var(--text-color) !important; /* Warna teks sesuai logo */
    }

    /* Gaya tautan */
    .text-center a {
        color: var(--primary-color);
        transition: color 0.3s ease;
    }

    .text-center a:hover {
        color: var(--primary-color-hover);
    }

    /* Efek fokus pada input form */
    .form-control:focus {
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 0 0.25rem rgba(54, 119, 195, 0.25) !important;
    }

    .app-brand-logo img {
        width:150px !important; /* Ukuran logo disesuaikan */
    }
</style>
@endpush

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card">
                <div class="card-body p-4 p-md-5 text-center">
                    <div class="app-brand justify-content-center mb-4">
                        <a href="/" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                <img src="{{ asset('BizLand/Logo_Silaga.png') }}" alt="SILAGA logo">
                            </span>
                        </a>
                    </div>
                    <h4 class="mb-2">Lupa Password?</h4>
                    <p class="mb-4">Jika anda lupa password hubungi admin kami dengan nomor <b>08912342234</b></p>
                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="btn btn-outline-primary">Kembali ke halaman login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
