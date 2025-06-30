@extends('dashboard.layouts.app')

@section('title')
SILAGA | Reports
@endsection

@push('custom-css')
<style>
    /*
     * Skema Warna terinspirasi oleh logo SILAGA.
     * Warna utama: Biru cerah, untuk elemen interaktif.
     * Warna sekunder/netral: Abu-abu untuk teks dan latar belakang untuk tampilan yang bersih.
    */
    :root {
        --primary-color: #3F6AD8; /* Warna biru cerah yang diambil dari logo */
        --primary-color-darker: #3254ad; /* Warna lebih gelap untuk status hover */
        --card-bg: #ffffff;
        --card-header-bg: #f8f9fa;
        --text-color: #495057;
        --text-muted-color: #8897AD;
        --border-color: #ebeef4;
    }

    body {
        background-color: #f5f7fa; /* Warna abu-abu sangat terang untuk latar belakang keseluruhan */
    }

    .card {
        border: 1px solid var(--border-color);
        box-shadow: 0 0.25rem 0.75rem rgba(0, 0, 0, 0.04);
        transition: all 0.3s ease-in-out;
    }

    .card-header {
        background-color: var(--card-header-bg);
        border-bottom: 1px solid var(--border-color);
        font-weight: 600;
        color: var(--text-color);
    }

    .nav-pills .nav-link {
        color: var(--primary-color);
        font-weight: 500;
        transition: all 0.2s ease-in-out;
    }
    
    .nav-pills .nav-link:not(.active):hover {
        background-color: #e7f0fe; /* Biru muda saat hover untuk tab yang tidak aktif */
    }

    .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
        background-color: var(--primary-color) !important;
        color: #fff !important;
        box-shadow: 0 4px 6px -1px rgba(63, 106, 216, 0.2), 0 2px 4px -1px rgba(63, 106, 216, 0.12);
    }

    .btn-primary {
        background-color: var(--primary-color) !important;
        border-color: var(--primary-color) !important;
        color: #fff !important;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        transition: all 0.2s ease-in-out;
    }

    .btn-primary:hover, .btn-primary:focus {
        background-color: var(--primary-color-darker) !important;
        border-color: var(--primary-color-darker) !important;
        transform: translateY(-1px);
        box-shadow: 0 7px 10px -1px rgba(0, 0, 0, 0.1), 0 4px 6px -1px rgba(0, 0, 0, 0.06);
    }
    
    .btn-outline-secondary {
        border-color: #dce0e5;
        color: #495057;
    }

    .btn-outline-secondary:hover {
        background-color: #e9ecef;
        border-color: #dce0e5;
        color: #495057;
    }
    
    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.25rem rgba(63, 106, 216, 0.25);
    }
    
    .form-label {
        font-weight: 500;
        color: #343a40;
    }
    
    /* Penyesuaian Badge Status */
    .bg-label-secondary {
        background-color: #eef2f7 !important;
        color: #566a7f !important;
        border: 1px solid #d6e0ea;
    }

    .bg-label-warning {
        background-color: #fff7e6 !important;
        color: #b47900 !important;
        border: 1px solid #ffe5b3;
    }

    .bg-label-info {
        background-color: #e7f0fe !important;
        color: #3f6ad8 !important;
        border: 1px solid #c4d8fc;
    }

    .bg-label-success {
        background-color: #e8f5e9 !important;
        color: #388e3c !important;
        border: 1px solid #c8e6c9;
    }
    
    .text-muted.fw-light {
        color: #6c757d !important;
    }
</style>
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-0 mb-4"><span class="text-muted fw-light">Dashboard /</span> Reports</h4>
    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-file me-1"></i> Detail</a>
                </li>
                @if ($report)
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('dashboard.imageReport.index',['reportId' => $report->report_id]) }}"><i class="bx bx-file-blank me-1"></i> Supporting Document</a>
                </li>
                @endif
            </ul>
            <div class="card mb-4">
                <h5 class="card-header">Report Detail
                    @if($report?->status === 'pending')
                        <span class="text-sm bg-label-secondary">{{ $report?->status }}</span>
                    @elseif($report?->status === 'review')
                        <span class="text-sm bg-label-warning">{{ $report?->status }}</span>
                    @elseif($report?->status === 'progress')
                        <span class="text-sm bg-label-info">{{ $report?->status }}</span>
                    @else
                        <span class="text-sm bg-label-success">{{ $report?->status }}</span>
                    @endif
                </h5>
                <hr class="my-0" />
                <div class="card-body">
                    <form method="POST" action="{{ route('dashboard.reports.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label for="title" class="form-label">Title</label>
                                <input required
                                @if($report)
                                readonly
                                @endif
                                class="form-control" type="text" id="title" placeholder="Jalan Rusak" name="title" value="{{ $report->title ?? old('title') }}" autofocus />
                            </div>
                            <input required type="hidden" name="user_id" value="{{ Auth::user()->user_id }}">
                            <div class="mb-3 col-md-6">
                                <label for="address" class="form-label">Address</label>
                                <input required
                                @if($report)
                                readonly
                                @endif
                                class="form-control @error('address') is-invalid @enderror" type="text" id="address" placeholder="Jl. Soekarno Htta" name="address" value="{{ $report->address ?? old('address') }}" autofocus />
                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-6">
                                <label for="description" class="form-label">Description</label>
                                <textarea
                                @if($report)
                                readonly
                                @endif
                                class="form-control" type="text" id="description" name="description" autofocus />{{ $report->description ?? old('description') }}</textarea>
                            </div>
                            <div class="mb-3 col-md-6
                                @if($report)
                                d-none
                                @endif
                                ">
                                <label for="formFileMultiple" class="form-label">Supporting Document</label>
                                <input required
                                class="form-control" type="file" name="file[]" accept="image/*" id="formFileMultiple" multiple />
                            </div>
                            <div class="mb-3 col-md-6">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="lat" class="form-label">Latitude</label>
                                        <input required
                                        @if($report)
                                        readonly
                                        @endif
                                        class="form-control numeric-only @error('lat') is-invalid @enderror" type="text" id="lat" name="lat" placeholder="69342324" value="{{ $report->lat ?? old('lat') }}" autofocus />
                                        @error('lat')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-6">
                                        <label for="long" class="form-label">Longitude</label>
                                        <input required
                                        @if($report)
                                        readonly
                                        @endif
                                        class="form-control numeric-only @error('long') is-invalid @enderror" type="text" id="long" name="long" placeholder="129343" value="{{ $report->long ?? old('long') }}" autofocus />
                                        @error('long')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 col-md-6">
                                <!-- State field removed because it does not exist in the reports table -->
                            </div>
                        </div>
                        <div class="mt-2">
                            @if($report)
                            <button type="reset" class="btn  btn-secondary me-2" disabled
                            >Save</button>
                            <a href="{{ route('dashboard.reports.index') }}" class="btn btn-outline-secondary">Back</a>
                            @else
                            <button type="submit" class="btn  btn-primary me-2"
                            >Save</button>
                            <button type="reset" class="btn btn-outline-secondary">Cancel</button>
                            @endif
                        </div>
                    </form>
                </div>
                <!-- /Account -->
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-js')
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            function validateNumericInput(event) {
                const value = event.target.value;
                event.target.value = value.replace(/[^0-9.,-]/g, '');
            }

            document.querySelectorAll('input.numeric-only').forEach(input => {
                input.addEventListener('input', validateNumericInput);
            });
        });
    </script>
@endpush
