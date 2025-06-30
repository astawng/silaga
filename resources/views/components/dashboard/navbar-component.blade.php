<style>
  /*
   * Custom CSS for the new navbar color scheme.
   * We use a specific class `navbar-custom-theme` to apply these styles.
   */

  /* Main navbar background color, derived from your logo */
  .navbar-custom-theme {
    background-color: #2a5d9a !important; /* Warna biru tua dari logo */
  }

  /* Color for text and links inside the navbar */
  .navbar-custom-theme .nav-item .nav-link,
  .navbar-custom-theme .nav-item > span {
    color: #ffffff !important; /* Warna teks putih agar kontras */
  }

  /* Color for icons inside the navbar, like the menu toggle */
  .navbar-custom-theme .layout-menu-toggle i,
  .navbar-custom-theme .navbar-nav-right .nav-link i {
    color: #ffffff !important;
  }

  /* Lighter text color on hover/focus for better user experience */
  .navbar-custom-theme .nav-item .nav-link:hover,
  .navbar-custom-theme .nav-item .nav-link:focus {
    color: #e0e0e0 !important;
  }

  /* Ensure the dropdown menu itself remains a light color for readability */
  .dropdown-menu {
    border: 1px solid #e0e0e0;
  }

  /* Style for the user's name and role in the dropdown */
  .dropdown-menu .flex-grow-1 .fw-semibold {
    color: #333;
  }

  .dropdown-menu .dropdown-item:active,
  .dropdown-menu .dropdown-item.active {
    background-color:rgb(74, 143, 228) !important; /* Warna biru saat item aktif */
    color: #ffffff !important;
  }
</style>

<!-- Navbar -->
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center navbar-custom-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- User Email -->
            <li class="nav-item lh-1 me-3">
                <span>{{ Auth::user()->email }}</span>
            </li>

            <!-- User Dropdown -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <!-- Updated the UI Avatars URL to match the new color scheme -->
                        <img src="
                        @if(Auth::user()->details?->image_url)
                        {{ Auth::user()->details?->image_url }}
                        @else
                        https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=1E88E5&color=FFFFFF
                        @endif" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="{{ route('dashboard.profile') }}">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <!-- Updated the UI Avatars URL here as well -->
                                        <img src="
                                        @if(Auth::user()->details?->image_url)
                                        {{ Auth::user()->details?->image_url }}
                                        @else
                                        https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=1E88E5&color=FFFFFF
                                        @endif" alt class="w-px-40 h-auto rounded-circle" />
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <span class="align-middle d-block">{{ Auth::user()->name }}</span>
                                    <small class="fw-semibold">{{ Auth::user()->roles->role }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('dashboard.profile') }}">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
<!-- / Navbar -->
