@extends('dashboard.layouts.app')

@section('title')
SILAGA | Dashboard
@endsection

@push('custom-css')
<script src="https://api.tiles.mapbox.com/mapbox-gl-js/v3.3.0/mapbox-gl.js"></script>
<link href="https://api.tiles.mapbox.com/mapbox-gl-js/v3.3.0/mapbox-gl.css" rel="stylesheet" />
<style>
    /* Style untuk peta */
    #map {
        width: 100%;
        height: 400px;
    }

    /* Kustomisasi warna agar sesuai dengan logo */
    :root {
        --brand-blue: #1c52a3; /* Warna biru dari logo */
        --brand-success: #28a745; /* Warna hijau untuk status selesai */
        --brand-warning: #ffc107; /* Warna kuning untuk status review */
        --brand-info: #17a2b8;    /* Warna biru muda untuk status progres */
    }

    /* Mengganti warna primer default */
    .text-primary {
        color: var(--brand-blue) !important;
    }

    .bg-label-primary {
        background-color: #e8f0fe !important;
        color: var(--brand-blue) !important;
    }

    /* Kustomisasi warna label status */
    .bg-label-success {
        background-color: #eaf6ec !important;
        color: var(--brand-success) !important;
    }
    
    .bg-label-warning {
        background-color: #fff8e1 !important;
        color: var(--brand-warning) !important;
    }

    .bg-label-info {
         background-color: #e8f7f9 !important;
        color: var(--brand-info) !important;
    }


    /* Style untuk marker di peta */
    .marker-progress {
        background-image: url('marker.png'); /* Sebaiknya gunakan path yang benar atau SVG */
        background-size: cover;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        border: 3px solid var(--brand-info);
    }

    .marker-done {
        background-image: url('marker-done.png'); /* Sebaiknya gunakan path yang benar atau SVG */
        background-size: cover;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        cursor: pointer;
        border: 3px solid var(--brand-success);
    }
</style>
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-lg-12 col-md-12 order-1">
            <div class="row">
                {{-- Tampilan untuk Admin --}}
                @if (Auth::user()->role_id == 1)
                <div class="col-lg-2 col-md-2 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class="menu-icon tf-icons bx bx-user-pin fs-1 text-primary"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                        <a class="dropdown-item" href="{{ route('dashboard.users.index') }}">View More</a>
                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Users</span>
                            <h3 class="card-title mb-2">{{ $users }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class="menu-icon tf-icons bx bx-message-dots fs-1 text-primary"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                        <a class="dropdown-item" href="{{ route('dashboard.feedbacks.index') }}">View More</a>
                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Feedback</span>
                            <h3 class="card-title mb-2">{{ $feedbacks }}</h3>
                        </div>
                    </div>
                </div>
                {{-- Tampilan untuk Petugas --}}
                @elseif(Auth::user()->role_id == 2)
                <div class="col-lg-2 col-md-2 col-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-start justify-content-between">
                                <div class="avatar flex-shrink-0">
                                    <i class="menu-icon tf-icons bx bx-user fs-1 text-primary"></i>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                        <a class="dropdown-item" href="{{ route('dashboard.users.index') }}">View More</a>
                                    </div>
                                </div>
                            </div>
                            <span class="fw-semibold d-block mb-1">Warga</span>
                            <h3 class="card-title mb-2">{{ $citizens }}</h3>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-lg-3 order-0 mb-4">
                    <div class="card h-100">
                        <div class="card-header d-flex align-items-center justify-content-between pb-0">
                            <div class="card-title mb-0">
                                <h5 class="m-0 me-2">Report Statistics</h5>
                            </div>
                            <div class="dropdown">
                                <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="bx bx-dots-vertical-rounded"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                    <a class="dropdown-item" href="{{ route('dashboard.feedbacks.index') }}">View All</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <div class="d-flex flex-column align-items-center gap-1">
                                    <h2 class="mb-2">{{ $allReports['all'] }}</h2>
                                    <span>Total Reports</span>
                                </div>
                                <div id="orderStatisticsChart"></div>
                            </div>
                            <ul class="p-0 m-0">
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        {{-- Diubah menjadi bg-label-success untuk indikator selesai --}}
                                        <span class="avatar-initial rounded bg-label-success"><i class="bx bx-check"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Done</h6>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">{{ $allReports['done'] }}</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        {{-- Warna warning dipertahankan untuk konsistensi --}}
                                        <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-file-find"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Review</h6>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">{{ $allReports['review'] }}</small>
                                        </div>
                                    </div>
                                </li>
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        {{-- Diubah menjadi bg-label-info agar lebih sesuai --}}
                                        <span class="avatar-initial rounded bg-label-info"><i class="bx bx-timer"></i></span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">Progress</h6>
                                        </div>
                                        <div class="user-progress">
                                            <small class="fw-semibold">{{ $allReports['progress'] }}</small>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-lg-7 col-xl-7 order-0 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                <div class="card-title mb-0">
                                    <h5 class="m-0 me-2 mb-2">Map Report</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                {{-- Tampilan untuk Warga --}}
                @else
                    <div class="col-md-3 col-lg-3 col-xl-3 order-0 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                <div class="card-title mb-0">
                                    <h5 class="m-0 me-2">Report Statistics</h5>
                                </div>
                                <div class="dropdown">
                                    <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                                        <a class="dropdown-item" href="{{ route('dashboard.feedbacks.index') }}">View All</a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <div class="d-flex flex-column align-items-center gap-1">
                                        <h2 class="mb-2">{{ $allReports['all'] }}</h2>
                                        <span>Total Reports</span>
                                    </div>
                                    <div id="orderStatisticsChart"></div>
                                </div>
                                <ul class="p-0 m-0">
                                    <li class="d-flex mb-4 pb-1">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded bg-label-success"><i class="bx bx-check"></i></span>
                                        </div>
                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="mb-0">Done</h6>
                                            </div>
                                            <div class="user-progress">
                                                <small class="fw-semibold">{{ $allReports['done'] }}</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex mb-4 pb-1">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded bg-label-warning"><i class="bx bx-file-find"></i></span>
                                        </div>
                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="mb-0">Review</h6>
                                            </div>
                                            <div class="user-progress">
                                                <small class="fw-semibold">{{ $allReports['review'] }}</small>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex mb-4 pb-1">
                                        <div class="avatar flex-shrink-0 me-3">
                                            <span class="avatar-initial rounded bg-label-info"><i class="bx bx-timer"></i></span>
                                        </div>
                                        <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="mb-0">Progress</h6>
                                            </div>
                                            <div class="user-progress">
                                                <small class="fw-semibold">{{ $allReports['progress'] }}</small>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9 col-lg-9 col-xl-9 order-0 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                <div class="card-title mb-0">
                                    <h5 class="m-0 me-2 mb-2">Map Report</h5>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="map"></div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endsection
    @push('custom-js')
    <script>
        // Fungsi ini mengembalikan kelas warna berdasarkan status laporan
        function statusColor(type) {
            switch(type) {
                case "done":
                    // Menggunakan kelas 'success' untuk status selesai
                    return "bg-label-success";
                    break;
                case "review":
                    // Mempertahankan kelas 'warning' untuk status review
                    return "bg-label-warning";
                    break;
                case "progress":
                    // Menggunakan kelas 'info' untuk status progres
                    return "bg-label-info";
                    break;
                default:
                    // Fallback ke kelas sekunder
                    return "bg-label-secondary";
                    break;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            mapboxgl.accessToken = 'pk.eyJ1IjoieG51eHV6ZGV2IiwiYSI6ImNseXFkdXAxNDA5Y2syanEwZmg3a3liYjgifQ.NptD4HYsiUQGTyKdQscaeg';

            var map = new mapboxgl.Map({
                container: 'map',
                style: 'mapbox://styles/mapbox/streets-v12',
                center: [106.769973, -6.253456], 
                zoom: 14
            });

            let mapsData = @json($maps);

            mapsData.forEach(function(feature) {
                if(feature.status === 'pending') return; // Lewati marker jika statusnya 'pending'
                
                var el = document.createElement('div');
                el.className = feature.status == 'done' ? 'marker-done' : 'marker-progress';

                new mapboxgl.Marker(el)
                    .setLngLat([feature.long, feature.lat]) // Koordinat: longitude, latitude
                    .setPopup(
                        new mapboxgl.Popup({ offset: 25 })
                        .setHTML(
                            // Popup pada peta sekarang juga akan menggunakan skema warna yang baru
                            `<h3 class="fs-4">${feature.title}</h3>
                            <span class="p-1 rounded ${statusColor(feature.status)}">${feature.status.charAt(0).toUpperCase() + feature.status.slice(1)}</span>
                            <p class="mt-2">${feature.description}</p>`
                        )
                    )
                    .addTo(map);
            });
        });
    </script>
    @endpush
