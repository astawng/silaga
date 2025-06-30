@extends('dashboard.layouts.app')

@section('title')
SILAGA | Reports
@endsection

{{-- Menambahkan style kustom untuk menyesuaikan tema warna --}}
@push('page-styles')
<style>
    /*
    =========================================
    CUSTOM STYLES FOR SILAGA THEME
    =========================================
    */

    /* --- Palet Warna Utama --- */
    :root {
        --primary-blue: #0A58CA;       /* Warna biru utama dari logo */
        --primary-blue-hover: #0B5ED7; /* Warna saat hover */
        --text-muted-custom: #6c757d;
        --card-bg: #ffffff;
        --body-bg: #f8f9fa;

        /* Warna untuk Lencana Status */
        --status-pending-bg: #e9ecef;
        --status-pending-text: #495057;
        --status-review-bg: #fff3cd;
        --status-review-text: #664d03;
        --status-progress-bg: #cfe2ff;
        --status-progress-text: #084298;
        --status-success-bg: #d1e7dd;
        --status-success-text: #0f5132;
    }

    /* --- Gaya Umum --- */
    .fw-light.text-muted {
        color: var(--text-muted-custom) !important;
    }

    h5.card-header {
        color: var(--primary-blue);
        font-weight: 600; /* Membuat judul lebih tegas */
    }

    /* --- Tombol --- */
    .btn-primary {
        background-color: var(--primary-blue) !important;
        border-color: var(--primary-blue) !important;
        color: #fff !important;
        transition: background-color 0.2s ease-in-out;
    }

    .btn-primary:hover, .btn-primary:focus {
        background-color: var(--primary-blue-hover) !important;
        border-color: var(--primary-blue-hover) !important;
    }

    /* --- Elemen Formulir (Search Box) --- */
    .form-control:focus {
        border-color: var(--primary-blue-hover) !important;
        box-shadow: 0 0 0 0.25rem rgba(10, 88, 202, 0.25) !important;
    }

    /* --- Lencana Status --- */
    .badge {
        padding: 0.5em 0.75em;
        font-size: 0.8rem;
        font-weight: 600;
        border-radius: 0.375rem; /* Sedikit lebih rounded */
    }
    .bg-label-secondary {
        background-color: var(--status-pending-bg) !important;
        color: var(--status-pending-text) !important;
    }

    .bg-label-warning {
        background-color: var(--status-review-bg) !important;
        color: var(--status-review-text) !important;
    }

    .bg-label-info {
        background-color: var(--status-progress-bg) !important;
        color: var(--status-progress-text) !important;
    }

    .bg-label-success {
        background-color: var(--status-success-bg) !important;
        color: var(--status-success-text) !important;
    }

    /* --- Kartu & Tabel --- */
    .card {
        border: none;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border-radius: 0.75rem; /* Sudut lebih membulat */
    }

    .table>:not(caption)>*>* {
        padding: 1rem 1rem; /* Padding yang lebih konsisten */
    }

    .table thead th {
        color: var(--primary-blue);
        font-weight: 600;
        border-bottom-width: 2px;
    }

    /* --- Menu Dropdown Aksi --- */
    .dropdown-menu {
        border-radius: 0.5rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    .dropdown-item {
        transition: background-color 0.2s ease;
    }
    .dropdown-item:active, .dropdown-item:focus, .dropdown-item:hover {
         background-color: #e9ecef;
         color: #000;
    }
    .dropdown-item i {
        color: var(--primary-blue);
        margin-right: 8px;
    }

</style>
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h6 class="fw-bold py-0 mb-4"><span class="text-muted fw-light">Dashboard /</span> Reports</h6>
    <div class="row">
        <div class="col-lg-12 col-md-12 order-1">
            <div class="col-md-3 py-3" style="margin-top: -30px;">
                <form action="{{ route('dashboard.reports.index') }}" method="GET">
                    <input class="form-control" type="search" value="{{ request()->query('search') }}" name="search" placeholder="Search" id="html5-search-input">
                </form>
            </div>
            <div class="card">
                <div class="card-top d-lg-lex">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-header">Data Reports</h5>
                        @if (Auth::user()->role_id == 3)
                        <div class="button-add p-3" style="margin-right: 15px;">
                            <a href="{{ route('dashboard.reports.create') }}" class="btn btn-primary d-grid text-white font-serif" target="_blank">Add Reports</a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($reports->count())
                            @foreach ($reports as $key => $report)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td><i class="fab fa-lg text-danger "></i> <strong>{{ $report->title }}</strong></td>
                                <td>{{ \Illuminate\Support\Str::limit($report->description, 30) }}</td>
                                <td>
                                    <span class="badge
                                    @if($report->status == 'pending')
                                        bg-label-secondary
                                    @elseif($report->status == 'review')
                                        bg-label-warning
                                    @elseif($report->status == 'progress')
                                        bg-label-info
                                    @else
                                        bg-label-success
                                    @endif">
                                        {{ $report->status }}
                                    </span>
                                </td>
                                <td>{{ \Illuminate\Support\Str::limit($report->address, 30) }}</td>
                                <td>
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        @if(Auth::user()->role_id == 2)
                                        <a class="dropdown-item" href="#" onclick="changeStatus('{{ $report->report_id }}')" data-bs-toggle="modal" data-bs-target="#modalChangeStatus"><i class="bx bx-edit-alt"></i>Change Status</a>
                                        @endif
                                        <a class="dropdown-item" href="{{ route('dashboard.reports.show', $report->report_id) }}"><i class="bx bx-show"></i>Show</a>
                                        <a class="dropdown-item" href="{{ route('dashboard.reports.edit', $report->report_id) }}"><i class="bx bx-edit"></i>Edit</a>
                                        @if($report->status == 'pending')
                                        <a class="dropdown-item" href="#" onclick="confirmDelete('{{ $report->report_id }}')"><i class="bx bx-trash"></i>Delete</a>
                                        <form id="delete-form-{{ $report->report_id }}" action="{{ route('dashboard.reports.destroy', $report->report_id) }}" method="POST" style="display: none;">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td class="text-center align-middle" colspan="100%">
                                    No Data
                                </td>
                            </tr>
                            @endif
                        </tbody>
                        <tfoot class="table-border-bottom-0">
                            <tr>
                                <th>No</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th>Status</th>
                                <th>Address</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="d-flex justify-content-end p-3">
                        {{ $reports->appends(request()->query())->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="modalChangeStatus" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div id="loadModal"></div>
        </div>
    </div>
</div>
@endsection

@push('custom-js')
<script>
    // load users modal
    function changeStatus(reportId) {
        $.ajax({
            type: 'GET',
            url: '/dashboard/reports/change-status/' + reportId,
            success: function(response) {
                $("#loadModal").html(response);
            },
            error: function(response) {
                console.log(response);
            }
        });
    }
    // delete user
    function confirmDelete(userId) {
        // Ganti dengan modal konfirmasi kustom jika diperlukan
        // untuk menghindari pemblokiran oleh browser
        if (confirm('Are you sure you want to delete this report?')) {
            document.getElementById('delete-form-' + userId).submit();
        }
    }
</script>
@endpush
