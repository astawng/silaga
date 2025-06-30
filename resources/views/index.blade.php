<!DOCTYPE html>
<html lang="en">

@include('layouts.header')

{{-- Menambahkan Style Kustom untuk skema warna baru --}}
<style>
    :root {
        --accent-color: #3A5BA0; /* Biru dari logo */
        --primary-bg: #FFFFFF;
        --secondary-bg: #F9FAFB; /* Sedikit abu-abu untuk latar belakang bagian */
        --dark-bg: #1F3A68; /* Biru tua untuk bagian gelap */
        --text-color: #374151;
        --heading-color: #111827;
        --light-text-color: #FFFFFF;
    }

    /* Latar Belakang & Warna Teks Umum */
    body {
        color: var(--text-color);
        background-color: var(--primary-bg);
    }

    h1, h2, h3, h4, h5, h6 {
        color: var(--heading-color);
    }

    a {
        color: var(--accent-color);
    }

    a:hover {
        color: #6A89C8; /* Biru lebih terang saat hover */
    }

    /* Header & Navigasi */
    .header {
        background-color: var(--primary-bg);
    }

    /* Style untuk memperbesar logo */
    .header .logo img {
        max-height: 100px; /* Ubah nilai ini untuk menyesuaikan ukuran logo */
        width: auto;
    }

    .navmenu .active {
        color: var(--accent-color);
    }

    /* Hero Section */
    #hero {
        background-color: var(--secondary-bg);
    }

    #hero h1 span {
        color: var(--accent-color);
    }

    .btn-get-started {
        background-color: var(--accent-color);
        color: var(--light-text-color);
    }

    .btn-get-started:hover {
        background-color: #6A89C8;
    }

    /* Judul Bagian */
    .section-title span, .description-title {
        color: var(--accent-color) !important;
    }

    /* Bagian Layanan */
    .featured-services .service-item {
        background-color: var(--secondary-bg);
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
    }
    .services .service-item .icon i,
    .about-content ul i {
        color: var(--secondary-bg);
    }
    .services .service-item:hover h3, .services .service-item:hover p, .services .service-item:hover i {
        color: var(--light-text-color);
    }
    
    .services .service-item{
         background-color: var(--secondary-bg);
    }

    .services .service-item:hover{
         background-color: var(--accent-color);
    }

    /* Tombol & Link */
    .scroll-top {
        background-color: var(--accent-color);
    }

    .scroll-top:hover {
        background-color: #6A89C8;
    }

    /* Bagian Testimonial */
    .testimonials.dark-background {
        background-color: var(--dark-bg);
    }

    /* Bagian Kontak */
    .contact .info-wrap {
        background-color: var(--dark-bg);
        color: var(--light-text-color);
    }

    .contact .info-wrap h3, .contact .info-wrap p, .contact .info-wrap i {
        color: var(--light-text-color);
    }

    .contact .php-email-form button[type=submit] {
        background: var(--accent-color);
    }

    .contact .php-email-form button[type=submit]:hover {
        background: #6A89C8;
    }

    /* Footer */
    #footer {
        background-color: var(--secondary-bg);
    }
     #footer .footer-top .footer-about .sitename{
        color: var(--accent-color);
     }

</style>

<body class="index-page">

    <header id="header" class="header sticky-top">
        <div class="branding d-flex align-items-cente">

            <div class="container position-relative d-flex align-items-center justify-content-between">
                <a href="" class="logo d-flex align-items-center">
                    {{-- Mengubah logo dan formatnya sesuai permintaan --}}
                    <img src="{{asset('BizLand/Logo_Silaga.png')}}" alt="Logo Silaga">
                </a>

                <nav id="navmenu" class="navmenu">
                    <ul>
                        <li><a href="#hero" class="active">Home</a></li>
                        <li><a href="#about">Tentang Kami</a></li>
                        <li><a href="#services">Pelayanan</a></li>
                        <li><a href="#testimonials">Umpan Balik</a></li>
                        <li><a href="#faq">FAQ</a></li>
                        <li><a href="#contact">Kontak</a></li>
                        @auth
                        <li class="dropdown"><a href="{{ route('dashboard.home') }}"><span>{{ Auth::user()->name }}</span> <i class="bi bi-chevron-down toggle-dropdown"></i></a>
                            <ul>
                                <li>
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                                        <span>Log Out</span>
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        @else
                        <li><a href="{{ route('login') }}">Login</a></li>
                        @endauth
                    </ul>
                    <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
                </nav>

            </div>

        </div>

    </header>

    <main class="main">

        <!-- Hero Section -->
        <section id="hero" class="hero section">

            <div class="container">
                <div class="row gy-4">
                    <div class="col-lg-6 order-2 order-lg-1 d-flex flex-column justify-content-center" data-aos="zoom-out">
                        {{-- Mengubah nama brand --}}
                        <h1>Selamat Datang Di <span>SILAGA</span></h1>
                        <p>SILAGA (Sistem Lapor Warga) adalah platform digital yang dirancang untuk memudahkan masyarakat dalam mengirimkan pengaduan terkait fasilitas publik.</p>
                        <div class="d-flex">
                            <a href="{{ route('login') }}" class="btn-get-started">Login Untuk Memulai</a>
                        </div>
                    </div>
                </div>
            </div>

        </section><!-- /Hero Section -->



        <!-- About Section -->
        <section id="about" class="about section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Tentang Kami</h2>
                <p><span>Lebih Banyak </span> <span class="description-title">Tentang Kami.</span></p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-3">

                    <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
                        <img src="{{asset('BizLand/assets/img/about.jpeg')}}" alt="" class="img-fluid">
                    </div>

                    <div class="col-lg-6 d-flex flex-column justify-content-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="about-content ps-0 ps-lg-3">
                            <h3>Tentang SILAGA</h3>
                            <p class="fst-italic">
                                SILAGA (Sistem Lapor Warga) adalah platform digital yang dirancang untuk memudahkan masyarakat dalam mengirimkan pengaduan terkait kerusakan infrastruktur dan fasilitas publik. Melalui SILAGA, warga dapat melaporkan berbagai masalah yang membutuhkan perbaikan, yang kemudian akan ditindaklanjuti oleh pemerintah setempat. Kami berkomitmen untuk meningkatkan kualitas layanan publik demi kenyamanan dan keselamatan masyarakat.
                            </p>
                            <ul>
                                <li>
                                    <i class="bi bi-diagram-3"></i>
                                    <div>
                                        <h4>Pelaporan Mudah.</h4>
                                        <p>Kirim laporan kerusakan dengan cepat dan mudah melalui platform kami.</p>
                                    </div>
                                </li>
                                <li>
                                    <i class="bi bi-fullscreen-exit"></i>
                                    <div>
                                        <h4>Tindak Lanjut Transparan</h4>
                                        <p>Lacak status pengaduan Anda dan lihat perkembangan perbaikannya.</p>
                                    </div>
                                </li>
                            </ul>
                            <p>
                                Mari bergabung dengan SILAGA dan jadilah bagian dari solusi untuk lingkungan yang lebih baik!
                            </p>
                        </div>

                    </div>
                </div>

            </div>

        </section><!-- /About Section -->

        <!-- Featured Services Section -->
        <section id="featured-services" class="featured-services section">

            <div class="container">

                <div class="row gy-4">

                    <div class="col-xl-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-activity icon"></i></div>
                            <h4><a href="" class="stretched-link">Terhubung</a></h4>
                            <p>Mari hubungi kami dan bantu kami dalam membangun fasilitas yang baik!</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-bounding-box-circles icon"></i></div>
                            <h4><a href="" class="stretched-link">Terorganisir</a></h4>
                            <p>Sistem kami terorganisir mulai dari warga, petugas, dan administrator.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-xl-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item position-relative">
                            <div class="icon"><i class="bi bi-calendar4-week icon"></i></div>
                            <h4><a href="" class="stretched-link">Up To Date</a></h4>
                            <p>Kami selalu memperbarui laporan yang anda kirimkan, mari melapor karena semuanya gratis!</p>
                        </div>
                    </div><!-- End Service Item -->
                </div>

            </div>

        </section><!-- /Featured Services Section -->
        <!-- Services Section -->
        <section id="services" class="services section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Pelayanan</h2>
                <p><span>Apa Saja</span> <span class="description-title">Pelayanan kami?</span></p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row gy-4">

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-activity"></i>
                            </div>
                            <a href="javascript:void(0);" class="stretched-link">
                                <h3>Pelaporan Kerusakan</h3>
                            </a>
                            <p>Pengguna dapat melaporkan berbagai jenis kerusakan fasilitas publik dengan foto, deskripsi, dan lokasi.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-broadcast"></i>
                            </div>
                            <a href="javascript:void(0);" class="stretched-link">
                                <h3>Pemantauan Status Pengaduan</h3>
                            </a>
                            <p>Lacak status setiap pengaduan yang Anda kirimkan secara real-time.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-easel"></i>
                            </div>
                            <a href="javascript:void(0);" class="stretched-link">
                                <h3>Informasi Proses Perbaikan</h3>
                            </a>
                            <p>Dapatkan informasi terkini tentang progres perbaikan dari petugas di lapangan.</p>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-bounding-box-circles"></i>
                            </div>
                            <a href="javascript:void(0);" class="stretched-link">
                                <h3>Feedback & Penilaian</h3>
                            </a>
                            <p>Berikan feedback dan penilaian terhadap kualitas penanganan pengaduan.</p>
                            <a href="javascript:void(0);" class="stretched-link"></a>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-calendar4-week"></i>
                            </div>
                            <a href="javascript:void(0);" class="stretched-link">
                                <h3>Laporan & Statistik</h3>
                            </a>
                            <p>Akses laporan dan statistik mengenai kerusakan fasilitas dan progres perbaikannya.</p>
                            <a href="javascript:void(0);" class="stretched-link"></a>
                        </div>
                    </div><!-- End Service Item -->

                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                        <div class="service-item position-relative">
                            <div class="icon">
                                <i class="bi bi-chat-square-text"></i>
                            </div>
                            <a href="javascript:void(0);" class="stretched-link">
                                <h3>Notifikasi Pengguna</h3>
                            </a>
                            <p>Sistem notifikasi otomatis untuk memberitahu pengguna tentang status pengaduan mereka melalui email.</p>
                            <a href="javascript:void(0);" class="stretched-link"></a>
                        </div>
                    </div><!-- End Service Item -->

                </div>

            </div>

        </section><!-- /Services Section -->

        <section id="testimonials" class="testimonials section dark-background">

            <img src="https://i.pinimg.com/736x/6b/74/66/6b7466b98fe87c43ca9cd063aa4c8c2c.jpg" class="testimonials-bg" alt="">

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="swiper init-swiper">
                    <script type="application/json" class="swiper-config">
                        {
                            "loop": true,
                            "speed": 600,
                            "autoplay": {
                                "delay": 5000
                            },
                            "slidesPerView": "auto",
                            "pagination": {
                                "el": ".swiper-pagination",
                                "type": "bullets",
                                "clickable": true
                            }
                        }
                    </script>
                    <div class="swiper-wrapper">
                        @foreach ($feedbacks as $feedback)
                        <div class="swiper-slide">
                            <div class="testimonial-item">
                                <img src="{{ $feedback->user->details->image_url }}" class="testimonial-img" alt="{{ $feedback->user->name }}">
                                <h3>{{ $feedback->user->name }}</h3>
                                <h4>{{ $feedback->report->title.', '.$feedback->report->address }}</h4>
                                <div class="stars">
                                    @for ($i = 0; $i < $feedback->rating; $i++)
                                        <i class="bi bi-star-fill"></i>
                                    @endfor
                                </div>
                                <p>
                                    <i class="bi bi-quote quote-icon-left"></i>
                                    <span>{{ $feedback->description }}</span>
                                    <i class="bi bi-quote quote-icon-right"></i>
                                </p>
                            </div>
                        </div><!-- End testimonial item -->
                        @endforeach
                    </div>
                    <div class="swiper-pagination"></div>
                </div>

            </div>

        </section><!-- /Testimonials Section -->

        <!-- Faq Section -->
        <section id="faq" class="faq section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>F.A.Q</h2>
                <p><span>Frequently Asked Questions</span> <span class="description-title">(FAQ)</span></p>
            </div><!-- End Section Title -->

            <div class="container">

                <div class="row justify-content-center">

                    <div class="col-lg-10" data-aos="fade-up" data-aos-delay="100">

                        <div class="faq-container">

                            <div class="faq-item faq">
                                <h3>Bagaimana cara melaporkan kerusakan?</h3>
                                <div class="faq-content">
                                    <p>Untuk melaporkan kerusakan, Anda perlu membuat akun terlebih dahulu. Setelah mendaftar, Anda harus mengunggah foto KTP untuk verifikasi. Setelah akun terverifikasi (maks. 1x24 jam), Anda dapat mengirimkan pengaduan melalui halaman pengguna dengan melengkapi detail, foto, dan deskripsi kerusakan.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Berapa lama waktu yang dibutuhkan untuk menindaklanjuti pengaduan?</h3>
                                <div class="faq-content">
                                    <p>Kami berusaha menindaklanjuti setiap pengaduan secepat mungkin. Waktu penanganan bervariasi tergantung tingkat kerusakan dan jumlah pengaduan. Anda dapat memantau progres pengaduan di halaman pengguna.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Bagaimana saya bisa melacak status pengaduan saya?</h3>
                                <div class="faq-content">
                                    <p>Anda dapat melacak status pengaduan Anda melalui fitur pemantauan di akun SILAGA Anda. Status akan diupdate oleh petugas dan Anda akan menerima notifikasi untuk setiap perubahan.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Apa yang harus dilakukan jika perbaikan belum dilakukan setelah pengaduan?</h3>
                                <div class="faq-content">
                                    <p>Jika perbaikan belum dilakukan dalam waktu lama, Anda dapat menghubungi tim dukungan kami. Anda juga bisa memberikan tanggapan atau kritik melalui fitur feedback di halaman pengguna.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Apakah ada biaya untuk melaporkan kerusakan?</h3>
                                <div class="faq-content">
                                    <p>Tidak ada biaya yang dikenakan untuk melaporkan kerusakan melalui platform SILAGA. Layanan ini gratis untuk seluruh masyarakat.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Bagaimana cara memberikan feedback mengenai layanan SILAGA?</h3>
                                <div class="faq-content">
                                    <p>Anda dapat memberikan feedback melalui fitur di halaman pengguna. Anda bisa memberikan tingkat kepuasan, kritik, dan saran untuk membantu kami meningkatkan kualitas layanan.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                            <div class="faq-item">
                                <h3>Mengapa saya harus mengunggah foto KTP?</h3>
                                <div class="faq-content">
                                    <p>Foto KTP diperlukan untuk memverifikasi identitas pengguna demi memastikan keamanan dan keabsahan pengaduan yang masuk. Proses verifikasi ini biasanya memakan waktu paling lama 1x24 jam.</p>
                                </div>
                                <i class="faq-toggle bi bi-chevron-right"></i>
                            </div><!-- End Faq item-->

                        </div>

                    </div><!-- End Faq Column-->

                </div>

            </div>

        </section><!-- /Faq Section -->

        <!-- Contact Section -->
        <section id="contact" class="contact section">

            <!-- Section Title -->
            <div class="container section-title" data-aos="fade-up">
                <h2>Kontak Kami</h2>
                <p><span>Butuh Bantuan? </span> <span class="description-title">Hubungi Kami</span></p>
            </div><!-- End Section Title -->

            <div class="container" data-aos="fade-up" data-aos-delay="100">

                <div class="row gy-4">

                    <div class="col-lg-5">

                        <div class="info-wrap">
                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                                <i class="bi bi-geo-alt flex-shrink-0"></i>
                                <div>
                                    <h3>Alamat</h3>
                                    <p>Jl. Pluto Dalam Jl. Pondok Cabe No.01, Pisangan, Kec. Ciputat Timur, Kota Tangerang Selatan, Banten 15419
                                    </p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                                <i class="bi bi-telephone flex-shrink-0"></i>
                                <div>
                                    <h3>No Kami</h3>
                                    <p>08123467886</p>
                                </div>
                            </div><!-- End Info Item -->

                            <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                                <i class="bi bi-envelope flex-shrink-0"></i>
                                <div>
                                    <h3>Email Kami</h3>
                                    <p>SilagaHelp@gmail.com</p>
                                </div>
                            </div><!-- End Info Item -->

                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d247.85271071090398!2d106.79351981137695!3d-6.310494397126356!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69ee3d4baf6cad%3A0x7b377c1ebacae55e!2sUniversitas%20Bina%20Sarana%20Informatika%20Kampus%20Fatmawati%20(UBSI%20Fatmawati)!5e0!3m2!1sid!2sid!4v1750695746410!5m2!1sid!2sid" width="400" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>

                    <div class="col-lg-7">
                        @if ($message = Session::get('success') || session('success'))
                        <span class="text-primary">{{ $message }}</span>
                        @endif
                        <form action="{{ route('contact.user') }}" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
                            @csrf
                            <div class="row gy-4">

                                <div class="col-md-6">
                                    <label for="name-field" class="pb-2">Nama</label>
                                    <input type="text" name="name" value="{{ Auth::user()->name ?? old('name') }}" id="name-field" class="form-control  @error('name') is-invalid @enderror" required="">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label for="email-field" class="pb-2">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" value="{{ Auth::user()->email ?? old('email') }}" name="email" id="email-field" required="">
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="subject-field" class="pb-2">Perihal</label>
                                    <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}" id="subject-field" required="">
                                    @error('subject')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <label for="message-field" class="pb-2">Pesan</label>
                                    <textarea class="form-control @error('message') is-invalid @enderror" name="message" rows="10" id="message-field" required="">{{ old('message') }}</textarea>
                                    @error('message')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-12 text-center">
                                    <div class="loading">Loading</div>
                                    <div class="error-message"></div>
                                    <div class="sent-message">Pesanmu sudah dikirim, Terimakasih</div>

                                    <button type="submit">Kirim Pesan</button>
                                </div>

                            </div>
                        </form>
                    </div><!-- End Contact Form -->

                </div>

            </div>

        </section><!-- /Contact Section -->

    </main>

    <footer id="footer" class="footer">


        <div class="container footer-top">
            <div class="row gy-4">

                <div class="col-lg-4 col-md-6 footer-about">
                    <a href="index.html" class="d-flex align-items-center">
                        <span class="sitename">SILAGA</span>
                    </a>
                    <div class="footer-contact pt-3">
                        <p>Jl. Pluto Dalam Jl. Pondok Cabe No.01,</p>
                        <p>Pisangan, Kec. Ciputat Timur, Kota Tangerang Selatan, Banten 15419</p>
                        <p class="mt-3"><strong>No:</strong> <span>08123467886</span></p>
                        <p><strong>Email:</strong> <span>SilagaHelp@gmail.com</span></p>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 footer-links">
                    <h4>Useful Links</h4>
                    <ul class="row justify-stretch">
                        <li><i class="bi bi-chevron-right"></i><a class="text-muted" href="#hero">Home</a></li>
                        <li><i class="bi bi-chevron-right"></i><a class="text-muted" href="#about">Tentang Kami</a></li>
                        <li><i class="bi bi-chevron-right"></i><a class="text-muted" href="#services">Pelayanan</a></li>
                        <li><i class="bi bi-chevron-right"></i><a class="text-muted" href="#team">Team</a></li>
                        <li><i class="bi bi-chevron-right"></i><a class="text-muted" href="#faq">FAQ</a></li>
                        <li><i class="bi bi-chevron-right"></i><a class="text-muted" href="#contact">Kontak</a></li>
                    </ul>
                </div>

                <div class="col-lg-4 col-md-12">
                    <h4>Sosial Media </h4>
                    <p>Jangan lupa ikuti kami disosial media untuk mendapatkan informasi yang menarik</p>
                    <div class="social-links d-flex">
                        <a href="https://discord.gg/CvEgZbUa9k"><i class="bi bi-discord"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="container copyright text-center">
            {{-- Mengubah nama brand --}}
            <p>© <span>Copyright</span> <strong class="sitename">SILAGA</strong> <span>All Rights Reserved</span></p>
            <div class="credits">
                Made By Love <a href="https://discord.gg/CvEgZbUa9k">SILAGA Team</a>
            </div>
        </div>

    </footer>

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>


    @include('layouts.script')

</body>

</html>
