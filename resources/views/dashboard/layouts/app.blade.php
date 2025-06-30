<!DOCTYPE html>

<html
  lang="en"
  class="@auth light-style layout-menu-fixed @else light-style customizer-hide @endauth"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('backend') }}"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>@yield('title')</title>

    <meta name="description" content="Sistem Lapor Warga" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link href="{{ asset('BizLand/Logo_Icon.jpeg') }}" rel="icon">
    <link href="{{ asset('BizLand/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap" rel="stylesheet">

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('backend/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('backend/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('backend/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('backend/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('backend/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('backend/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('backend/js/config.js') }}"></script>

    <!-- [CUSTOM STYLES] Here are the new styles to match the logo -->
    <style>
      /* Mengubah variabel warna utama agar sesuai dengan warna biru pada logo */
      :root {
        --bs-primary: #4A89DC; /* Warna biru utama dari ikon megafon */
        --bs-primary-rgb: 74, 137, 220;
        --bs-link-color: #357ABD; /* Warna biru lebih gelap dari teks logo untuk tautan */
        --bs-link-hover-color: #2563EB; /* Warna biru lebih cerah saat hover */
      }

      /* Memberi warna latar belakang yang sedikit keabu-abuan agar mata lebih nyaman */
      .content-wrapper {
        background-color: #f8f9fa;
      }

      /* Mengubah tampilan sidebar menjadi gelap untuk kontras yang lebih baik */
      .layout-menu-fixed .layout-menu {
        background: #2c353d !important;
      }

      /* Mengubah warna teks dan ikon di sidebar */
      .menu-inner .menu-item .menu-link,
      .menu-inner .menu-item .menu-toggle {
        color: #b4c2cd;
      }
      .menu-inner .menu-item.active > .menu-link i,
      .menu-inner .menu-item.active > .menu-link,
      .menu-inner .menu-item.active > .menu-toggle {
          color: #ffffff !important;
      }
      .menu-inner .menu-item .menu-link i {
        color: #b4c2cd;
      }
      .menu-inner .menu-item:hover .menu-link i,
      .menu-inner .menu-item:hover .menu-link,
      .menu-inner .menu-item:hover .menu-toggle {
        color: #4A89DC !important;
      }

      /* Mengubah warna latar belakang item menu yang aktif */
      .menu-inner .menu-item.active > .menu-link {
        background-color: #4A89DC !important;
      }

      /* Mengubah warna garis indikator item menu aktif */
      .menu-inner > .menu-item.active::before {
        background: #ffffff !important;
      }

      /* Menyesuaikan warna tombol utama */
      .btn-primary {
        background-color: #4A89DC;
        border-color: #4A89DC;
        color: #fff;
      }
      .btn-primary:hover {
        background-color: #357ABD;
        border-color: #357ABD;
      }
      
      /* Memberi sedikit bayangan pada navbar agar terlihat 'mengambang' */
      .layout-navbar {
        background-color: #ffffff !important;
        box-shadow: 0 2px 4px rgba(0,0,0,0.05);
      }
    </style>
    <!-- [END CUSTOM STYLES] -->

    @stack('custom-css')
  </head>

  <body>
    @auth
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
         <!-- sidebar disini -->
         <x-dashboard.sidebar-component/>
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          <x-dashboard.navbar-component />
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            @if (session('error'))
                <x-toast-component :bg="'bg-danger'" :type="'Failed'" :message="session('error')" />
            @endif
            @if ($errors)
                @foreach ($errors->all() as $key => $error)
                <x-toast-component :bg="'bg-danger'" :type="'Failed'" :message="$error" />
                @endforeach
            @endif
            @if ($message = Session::get('success'))
                <x-toast-component :type="'Success'" :message="$message" />
            @endif
            <!-- Content -->
             @yield('content')
            <!-- / Content -->

            <x-dashboard.footer-component />

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    @else
        @yield('content')
    @endauth
    <!-- build:js backend/vendor/js/core.js -->
    <script src="{{ asset('backend/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('backend/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('backend/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('backend/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('backend/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('backend/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('backend/js/backends-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Core JS -->
    <script src="{{ asset('backend/js/ui-toasts.js') }}"></script>
     @stack('custom-js')
  </body>
</html>
