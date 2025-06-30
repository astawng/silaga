@extends('dashboard.layouts.app')

@section('title')
SILAGA | Login
@endsection

@push('custom-css')
{{-- Menghubungkan file CSS asli untuk layout dasar --}}
<link rel="stylesheet" href="{{ asset('backend/vendor/css/pages/page-auth.css') }}" />

{{-- Blok CSS kustom untuk mengubah skema warna agar sesuai dengan logo --}}
<style>
    /*
    |--------------------------------------------------------------------------
    | Gaya Kustom untuk Halaman Login
    |--------------------------------------------------------------------------
    |
    | Blok style ini ditambahkan untuk menimpa warna tema default
    | dan mencocokkannya dengan branding dari logo "SILAGA".
    | Warna diambil langsung dari palet warna logo Anda.
    |
    */
    :root {
        --silaga-primary: #294F89;   /* Biru tua dari teks "SILAGA" */
        --silaga-accent: #3D79D7;    /* Biru terang dari ikon megafon */
        --silaga-background: #f4f7fa; /* Abu-abu kebiruan yang sangat terang dan bersih */
        --text-color: #4A5568;      /* Warna teks yang lembut */
    }

    /* Mengubah warna latar belakang utama halaman */
    body, .authentication-wrapper {
        background-color: var(--silaga-background) !important;
    }

    /* Memberi gaya pada kartu login utama */
    .authentication-inner .card {
        border: none;
        border-radius: 0.75rem; /* Membuat sudut lebih tumpul */
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.07), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
    }

    /* Memperbarui warna tombol utama */
    .btn-primary {
        background-color: var(--silaga-primary) !important;
        border-color: var(--silaga-primary) !important;
        font-weight: 600;
        transition: opacity 0.3s ease;
    }

    .btn-primary:hover, .btn-primary:focus {
        opacity: 0.9;
    }

    /* Memperbarui warna tautan (link) */
    a, .btn-link {
        color: var(--silaga-accent) !important;
        font-weight: 500;
        transition: color 0.3s ease;
    }

    a:hover, .btn-link:hover {
        color: var(--silaga-primary) !important;
        text-decoration: underline !important;
    }

    /* Memperbarui warna fokus pada input form */
    .form-control:focus {
        border-color: var(--silaga-accent) !important;
        box-shadow: 0 0 0 0.2rem rgba(61, 121, 215, 0.25) !important;
    }

    /* Memberi gaya pada checkbox "Remember Me" */
    .form-check-input:checked {
        background-color: var(--silaga-primary) !important;
        border-color: var(--silaga-primary) !important;
    }

    /* Mengubah warna teks default untuk keterbacaan yang lebih baik */
    .card-body, .form-label, p {
        color: var(--text-color);
    }

    h4.mb-2 {
        font-weight: 700;
        color: #1A202C;
    }

</style>
@endpush

@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
            <!-- Card Login -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center mb-4">
                        <a href="/" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo">
                                {{-- Pastikan path ke logo ini benar --}}
                                <img src="{{ asset('BizLand/Logo_Silaga.png') }}" alt="Silaga Logo" style="width: 200px;">
                            </span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-2 text-center">Selamat Datang! 👋</h4>
                    <p class="mb-4 text-center">Silakan masuk ke akun Anda untuk melanjutkan.</p>

                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form id="formAuthentication" class="mb-3" action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input
                                type="text"
                                class="form-control @error('email') is-invalid @enderror"
                                id="email"
                                name="email"
                                placeholder="Masukkan alamat email Anda"
                                autofocus
                                required
                                value="{{ old('email') }}"
                            />
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                                @if (Route::has('password.request'))
                                    <a href="{{ route('password.request') }}">
                                        <small>Lupa Password?</small>
                                    </a>
                                @endif
                            </div>
                            <div class="input-group input-group-merge">
                                <input
                                    type="password"
                                    id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    name="password"
                                    required
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password"
                                />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                             @error('password')
                                <span class="invalid-feedback d-block" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} />
                                <label class="form-check-label" for="remember"> Ingat Saya </label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary d-grid w-100" type="submit">Masuk</button>
                        </div>
                    </form>

                    <p class="text-center">
                        <span>Pengguna baru?</span>
                        <a href="{{ route('register') }}">
                            <span>Buat sebuah akun</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Card Login -->
        </div>
    </div>
</div>
@endsection
