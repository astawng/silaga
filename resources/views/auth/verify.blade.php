@extends('dashboard.layouts.app')

@section('title')
SILAGA | Verifikasi Email
@endsection

@push('custom-css')
    {{-- CSS bawaan untuk halaman otentikasi --}}
    <link rel="stylesheet" href="{{ asset('backend/vendor/css/pages/page-auth.css') }}" />

    {{-- CSS Kustom untuk penyesuaian warna --}}
    <style>
        :root {
            --primary-color: #3B82F6; /* Biru yang terinspirasi dari megafon di logo */
            --dark-blue-text: #1E3A8A; /* Biru tua yang terinspirasi dari teks "SILAGA" */
            --light-gray-bg: #F9FAFB; /* Warna latar belakang yang lembut */
            --card-shadow: 0 4px 25px rgba(0, 0, 0, 0.05); /* Bayangan kartu yang lebih halus */
            --text-color: #374151; /* Warna teks standar untuk keterbacaan */
        }

        /* Mengatur latar belakang utama halaman */
        .authentication-wrapper {
            background-color: var(--light-gray-bg);
        }

        /* Menyesuaikan kartu utama */
        .authentication-inner .card {
            border: none;
            box-shadow: var(--card-shadow);
            border-radius: 12px; /* Membuat sudut lebih bulat */
        }
        
        /* Mengubah tampilan logo */
        .app-brand-logo img {
            width: 150px !important; /* Menyesuaikan ukuran logo agar lebih terlihat */
            height: auto;
        }

        .app-brand-text {
            color: var(--dark-blue-text) !important; /* Menyamakan warna teks logo */
            font-size: 2rem !important; /* Membuat teks logo lebih besar */
        }

        /* Menyesuaikan warna judul dan paragraf */
        .card-body h4 {
            color: var(--dark-blue-text);
            font-weight: 600;
        }

        .card-body p, .card-body span, .card-body form {
            color: var(--text-color);
        }

        /* Menyesuaikan tombol utama */
        .btn-primary {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            box-shadow: 0 2px 4px rgba(59, 130, 246, 0.4);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(59, 130, 246, 0.4);
        }

        /* Menyesuaikan tautan/link */
        .card-body a {
            color: var(--primary-color) !important;
            font-weight: 500;
        }

        .card-body a:hover {
            text-decoration: underline;
        }

    </style>
@endpush

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            {{-- Kartu Verifikasi --}}
            <div class="card">
                <div class="card-body">
                    {{-- Logo --}}
                    <div class="app-brand justify-content-center mb-4">
                        <a href="/" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                {{-- Ganti 'path/to/your/logo' dengan path sebenarnya ke file Logo_Icon.jpeg Anda --}}
                                <img src="{{ asset('BizLand/Logo_Silaga.png') }}" alt="Silaga Logo">
                            </span>
                        </a>
                    </div>
                    {{-- /Logo --}}

                    <h4 class="mb-2 text-center">Verifikasi Alamat Email Anda 📧</h4>
                    <p class="mb-4 text-center">
                        Terima kasih telah mendaftar! Sebelum melanjutkan, mohon periksa email Anda untuk tautan verifikasi.
                    </p>

                    @if (session('resent'))
                    <div class="alert alert-success" role="alert">
                        Tautan verifikasi baru telah dikirimkan ke alamat email Anda.
                    </div>
                    @endif

                    <p class="text-center">Jika Anda tidak menerima email,</p>
                    
                    <form class="mb-3 mt-2" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary d-grid w-100">Kirim Ulang Tautan Verifikasi</button>
                    </form>

                    <p class="text-center mt-4">
                        <span>Ingin menggunakan akun lain?</span>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <span>Keluar</span>
                        </a>
                    </p>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
            {{-- /Kartu Verifikasi --}}
        </div>
    </div>
</div>
@endsection
