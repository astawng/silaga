@extends('dashboard.layouts.app')

@section('title')
Edit Report
@endsection

{{-- Menambahkan blok style khusus untuk penyesuaian warna --}}
@push('styles')
<style>
    /* Warna utama diekstrak dari logo Anda */
    :root {
        --primary-color: #357ABD; /* Warna biru yang solid dan profesional dari logo */
        --primary-hover-color: #2A609A; /* Warna biru yang sedikit lebih gelap untuk efek hover */
        --info-color: #A0C4FF; /* Warna biru muda untuk status 'progress' */
        --warning-color: #FFC107; /* Warna kuning standar untuk peringatan */
    }

    /* Menyesuaikan warna header kartu agar serasi */
    .card-header {
        background-color: #F8F9FA; /* Warna latar belakang abu-abu muda agar bersih */
        border-bottom: 1px solid #DEE2E6;
    }
    
    .card-header h5 {
        color: var(--primary-color); /* Menggunakan warna utama untuk judul */
        font-weight: 600;
    }

    /* Menyesuaikan Tombol Utama (Update) */
    .btn-primary {
        background-color: var(--primary-color) !important;
        border-color: var(--primary-color) !important;
        color: #fff !important;
    }

    .btn-primary:hover, .btn-primary:focus {
        background-color: var(--primary-hover-color) !important;
        border-color: var(--primary-hover-color) !important;
    }
    
    /* Tombol Peringatan (Edit Images) diubah menjadi outline agar tidak terlalu mencolok */
    .btn-warning {
        color: var(--primary-color) !important;
        background-color: transparent !important;
        border-color: var(--primary-color) !important;
    }

    .btn-warning:hover, .btn-warning:focus {
        color: #fff !important;
        background-color: var(--primary-color) !important;
        border-color: var(--primary-color) !important;
    }

    /* Penyesuaian warna untuk badge status */
    .badge.bg-info {
        background-color: var(--info-color) !important;
        color: #000 !important;
    }
    
    .badge.bg-warning {
        background-color: var(--warning-color) !important;
        color: #000 !important;
    }

    /* Gaya untuk input yang dinonaktifkan agar lebih jelas */
    .form-control:disabled, .form-control[readonly] {
        background-color: #E9ECEF;
        opacity: 0.8;
    }
</style>
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h6 class="fw-bold py-0 mb-4"><span class="text-muted fw-light">Dashboard /</span> Edit Report</h6>
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>Edit Report</h5>
                    <span class="badge
                        @if($report->status == 'pending') bg-secondary
                        @elseif($report->status == 'review') bg-warning
                        @elseif($report->status == 'progress') bg-info
                        @else bg-success
                        @endif
                    " style="font-size:0.9rem; padding: 0.5em 0.7em;">
                        {{ ucfirst($report->status) }}
                    </span>
                </div>
                <div class="card-body">
                    @php
                        $isEditable = $report->status === 'pending';
                    @endphp
                    <form action="{{ route('dashboard.reports.update', $report->report_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $report->title) }}" required @if(!$isEditable) disabled @endif>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3" required @if(!$isEditable) disabled @endif>{{ old('description', $report->description) }}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" value="{{ old('address', $report->address) }}" required @if(!$isEditable) disabled @endif>
                        </div>
                        <div class="mb-3">
                            <label for="lat" class="form-label">Latitude</label>
                            <input type="text" class="form-control" id="lat" name="lat" value="{{ old('lat', $report->lat) }}" required @if(!$isEditable) disabled @endif>
                        </div>
                        <div class="mb-3">
                            <label for="long" class="form-label">Longitude</label>
                            <input type="text" class="form-control" id="long" name="long" value="{{ old('long', $report->long) }}" required @if(!$isEditable) disabled @endif>
                        </div>
                        <hr class="my-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <button type="submit" class="btn btn-primary" @if(!$isEditable) disabled @endif>Update Report</button>
                                <a href="{{ route('dashboard.reports.index') }}" class="btn btn-secondary">Cancel</a>
                            </div>
                            <a href="{{ route('dashboard.imageReport.index', ['reportId' => $report->report_id]) }}" class="btn @if(!$isEditable) btn-secondary disabled pointer-events-none @else btn-warning @endif">
                                <i class="bx bx-image-add me-1"></i> Edit Images
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
