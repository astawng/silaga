@extends('dashboard.layouts.app')

@section('title')
SILAGA | Atur Ulang Kata Sandi
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
    
    /* Gaya teks merek/logo */
    .app-brand-text {
        font-size: 1.75rem;
        color: var(--text-color) !important; /* Warna teks sesuai logo */
    }

    /* Gaya tautan */
    a {
        color: var(--primary-color);
        transition: color 0.3s ease;
    }

    a:hover {
        color: var(--primary-color-hover);
    }

    /* Efek fokus pada input form */
    .form-control:focus {
        border-color: var(--primary-color) !important;
        box-shadow: 0 0 0 0.25rem rgba(54, 119, 195, 0.25) !important;
    }

    .app-brand-logo img {
        width: 150px !important; /* Ukuran logo disesuaikan */
    }
</style>
@endpush

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <div class="card">
                <div class="card-body p-4 p-md-5">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mb-4">
                        <a href="/" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                {{-- Ganti dengan path logo Anda yang sesuai --}}
                                <img src="{{ asset('BizLand/Logo_Silaga.png') }}" alt="SILAGA logo">
                            </span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-2 text-center">Atur Ulang Kata Sandi 🔒</h4>
                    <p class="mb-4 text-center">Buat kata sandi baru yang kuat dan mudah Anda ingat.</p>

                    <form id="formAuthentication" class="mb-3" action="{{ route('password.update') }}" method="POST">
                        @csrf
                        <input type="hidden" value="{{ $token }}" name="token">
                        
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" readonly id="email" value="{{ $email ?? old('email') }}" name="email" placeholder="Masukkan email Anda" required />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password">Kata Sandi Baru</label>
                            <div class="input-group input-group-merge">
                                <input
                                type="password"
                                id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                name="password"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password"
                                required
                                />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password-confirm">Konfirmasi Kata Sandi</label>
                            <div class="input-group input-group-merge">
                                <input
                                type="password"
                                id="password-confirm"
                                class="form-control"
                                name="password_confirmation"
                                placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                aria-describedby="password"
                                autocomplete="new-password"
                                required
                                />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-primary d-grid w-100">Atur Ulang Kata Sandi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
