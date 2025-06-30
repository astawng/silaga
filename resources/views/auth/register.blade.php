@extends('dashboard.layouts.app')

@section('title')
SILAGA | Register
@endsection

@push('custom-css')
    {{-- Menghubungkan ke stylesheet otentikasi dasar --}}
    <link rel="stylesheet" href="{{ asset('backend/vendor/css/pages/page-auth.css') }}" />

    {{-- CSS Kustom untuk penyesuaian tema warna --}}
    <style>
        :root {
            --primary-color: #2563eb; /* Warna biru utama yang diambil dari logo */
            --primary-color-hover: #1d4ed8; /* Warna biru yang lebih gelap untuk hover */
            --body-bg-color: #f3f4f6; /* Warna latar belakang abu-abu muda yang nyaman */
            --card-bg-color: #ffffff; /* Warna putih untuk kartu */
            --text-color-dark: #111827; /* Warna teks gelap untuk kontras yang baik */
            --text-color-light: #6b7280; /* Warna teks abu-abu untuk teks sekunder */
            --border-radius: 0.75rem; /* Sudut yang lebih tumpul untuk tampilan modern */
        }

        /* Mengganti warna latar belakang utama untuk kenyamanan mata */
        body {
            background-color: var(--body-bg-color) !important;
        }

        /* Menyesuaikan kartu otentikasi */
        .authentication-wrapper .authentication-inner .card {
            border: none;
            border-radius: var(--border-radius);
            box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
        }

        /* Menyesuaikan logo agar lebih menonjol */
        .app-brand-logo img {
            height: 150px;
            width: auto;
        }

        /* Menyesuaikan gaya teks judul dan paragraf */
        .card-body h4 {
            color: var(--text-color-dark);
            font-weight: 600;
        }

        .card-body .mb-4 {
            color: var(--text-color-light);
        }

        /* Mengganti warna tombol utama agar sesuai dengan logo */
        .btn-primary {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
            box-shadow: none !important;
        }

        .btn-primary:hover,
        .btn-primary:focus,
        .btn-primary:active {
            background-color: var(--primary-color-hover) !important;
            border-color: var(--primary-color-hover) !important;
        }

        /* Menyesuaikan warna tautan */
        a {
            color: var(--primary-color) !important;
        }

        a:hover {
            color: var(--primary-color-hover) !important;
        }

        /* Memberikan warna fokus pada input form */
        .form-control:focus {
            border-color: var(--primary-color) !important;
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25) !important;
        }

        /* Memberikan warna pada checkbox yang dicentang */
        .form-check-input:checked {
            background-color: var(--primary-color) !important;
            border-color: var(--primary-color) !important;
        }

        .form-check-input:focus {
            box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25) !important;
        }
    </style>
@endpush

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register Card -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mb-4">
                        <a href="/" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                {{-- PASTIKAN path ke logo Anda sudah benar. Contoh: 'assets/img/Logo_Icon.jpeg' --}}
                                <img src="{{ asset('BizLand/Logo_Silaga.png') }}" alt="SILAGA Logo">
                            </span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-2 text-center">Good Citizens starts here 🚀</h4>
                    <p class="mb-4 text-center">Make your road better!</p>

                    <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="Name" class="form-label">Name</label>
                            <input
                                type="text"
                                class="form-control @error('name') is-invalid @enderror"
                                id="name"
                                name="name"
                                value="{{ old('name') }}"
                                placeholder="Enter your name"
                                autofocus
                                required
                            />
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" name="email" placeholder="Enter your email" required />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
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
                            <label class="form-label" for="password-confirm">Confirm Password</label>
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
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms" required />
                                <label class="form-check-label" for="terms-conditions">
                                    I agree to
                                    <a href="javascript:void(0);">privacy policy & terms</a>
                                </label>
                            </div>
                        </div>
                        <button class="btn btn-primary d-grid w-100">Sign up</button>
                    </form>

                    <p class="text-center">
                        <span>Already have an account?</span>
                        <a href="{{ route('login') }}">
                            <span>Sign in instead</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Register Card -->
        </div>
    </div>
</div>
@endsection
