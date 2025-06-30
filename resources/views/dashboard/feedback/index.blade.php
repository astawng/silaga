@extends('dashboard.layouts.app')

@section('title')
SILAGA | Feedbacks
@endsection

@push('custom-css')
<style>
    /* -- Variabel Warna Berdasarkan Logo -- */
    :root {
        --primary-color: #2563EB; /* Biru utama dari logo */
        --primary-hover: #1D4ED8; /* Biru lebih gelap untuk hover */
        --background-color: #F8F9FA; /* Latar belakang abu-abu muda */
        --card-bg: #FFFFFF; /* Warna putih untuk kartu */
        --card-border: #E5E7EB; /* Warna border yang lembut */
        --text-primary: #1F2937; /* Warna teks utama */
        --text-secondary: #6B7281; /* Warna teks sekunder/muted */
        --star-color: #FFC107; /* Warna bintang kuning cerah */
    }

    /* -- Gaya Dasar -- */
    body {
        background-color: var(--background-color);
        color: var(--text-primary);
    }

    /* -- Gaya Kartu/Panel -- */
    .card {
        border: 1px solid var(--card-border);
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        background-color: var(--card-bg);
        border-radius: 0.75rem; /* Sudut lebih bulat */
    }

    .card-header {
        background-color: transparent;
        border-bottom: 1px solid var(--card-border);
        color: var(--text-primary);
        font-weight: 600;
    }

    /* -- Gaya Tombol Utama -- */
    .btn-primary {
        background-color: var(--primary-color) !important;
        border-color: var(--primary-color) !important;
        box-shadow: none;
        transition: background-color 0.2s ease-in-out;
    }

    .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
        background-color: var(--primary-hover) !important;
        border-color: var(--primary-hover) !important;
    }

    /* -- Gaya Tabel -- */
    .table thead th {
        color: var(--text-primary);
        font-weight: 600;
        border-bottom-width: 2px;
        border-color: var(--card-border);
    }

    .table td, .table th {
        border-top: 1px solid var(--card-border);
    }

    .table-responsive {
        border-radius: 0.75rem;
    }

    /* -- Gaya Elemen Lain -- */
    .text-muted {
        color: var(--text-secondary) !important;
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(37, 99, 235, 0.25);
    }

    /* -- Gaya Rating Bintang (disesuaikan) -- */
    .rating {
        display: flex;
        flex-direction: row-reverse;
        justify-content: center;
    }

    .rating>input {
        display: none;
    }

    .rating>label {
        position: relative;
        width: 1em;
        font-size: 30px;
        color: var(--star-color);
        cursor: pointer;
    }

    .rating>label::before {
        content: "\2605";
        position: absolute;
        opacity: 0;
    }

    .rating>label:hover:before,
    .rating>label:hover~label:before {
        opacity: 1 !important;
    }

    .rating>input:checked~label:before {
        opacity: 1;
    }

    .rating:hover>input:checked~label:before {
        opacity: 0.4;
    }
</style>
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    {{-- Breadcrumb --}}
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Dashboard /</span> Feedbacks
    </h4>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Data Feedbacks</h5>
                    {{-- Tombol Tambah Feedback --}}
                    @if (Auth::user()->role_id == 3)
                    <a href="javascript:void(0);" data-bs-target="#modalFeedbacks"
                       data-bs-toggle="modal" onclick="loadModal(`{{ $user_id }}`)"
                       class="btn btn-primary d-flex align-items-center">
                        <i class='bx bx-plus me-1'></i> Add Feedback
                    </a>
                    @endif
                </div>

                {{-- Kolom Pencarian --}}
                <div class="col-md-4 p-3">
                    <form action="{{ route('dashboard.feedbacks.index') }}" method="GET">
                        <input class="form-control" type="search" value="{{ request()->query('search') }}" name="search" placeholder="Search..." id="html5-search-input">
                    </form>
                </div>

                {{-- Tabel Data --}}
                <div class="table-responsive text-nowrap">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                @if (Auth::user()->role_id == 1)
                                <th>Report</th>
                                <th>User</th>
                                <th>Status</th>
                                @endif
                                <th class="text-center">Rating</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($feedbacks->count())
                                @foreach ($feedbacks as $key => $feedback)
                                <tr>
                                    <td>{{ $key + 1 + ($feedbacks->currentPage() - 1) * $feedbacks->perPage() }}</td>
                                    @if (Auth::user()->role_id == 1)
                                        <td>{{ $feedback->report ? \Str::limit($feedback->report->title, 30) : '-' }}</td>
                                        <td>{{ $feedback->user ? $feedback->user->name : '-' }}</td>
                                        <td>
                                            <form action="{{ route('dashboard.feedbacks.statusChange', ['id' => $feedback->feedback_id ?? 0]) }}" method="POST" id="status-form-{{$feedback->feedback_id}}">
                                                @csrf
                                                @method('PUT')
                                                <div class="form-check form-switch mb-2">
                                                    <input class="form-check-input cursor-pointer" name="status"
                                                    onclick="document.getElementById('status-form-{{$feedback->feedback_id}}').submit();"
                                                    type="checkbox" {{ $feedback->status ? 'checked' : '' }} {{ empty($feedback->feedback_id) ? 'disabled' : '' }}>
                                                </div>
                                            </form>
                                        </td>
                                    @endif
                                    <td>
                                        <div class="rating">
                                            @for ($i = 0; $i < $feedback->rating; $i++)
                                                <input type="radio" disabled checked><label for="star-{{$i}}">☆</label>
                                            @endfor
                                        </div>
                                    </td>
                                    <td>
                                        {{ \Str::limit($feedback->description, 50) }}
                                    </td>
                                </tr>
                                @endforeach
                            @else
                            <tr>
                                <td class="text-center" colspan="6">
                                    No Data Available
                                </td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                @if ($feedbacks->hasPages())
                    <div class="card-footer d-flex justify-content-end">
                        {{ $feedbacks->appends(request()->query())->links('vendor.pagination.bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalFeedbacks" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCenterTitle">Add New Feedback</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="loadModal" class="modal-body">
                {{-- Konten modal akan dimuat di sini oleh AJAX --}}
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-js')
<script>
    // Fungsi untuk memuat konten modal
    function loadModal(userId) {
        // Tampilkan loading spinner jika ada
        const modalBody = document.getElementById('loadModal');
        modalBody.innerHTML = '<div class="text-center"><div class="spinner-border" role="status"><span class="visually-hidden">Loading...</span></div></div>';

        $.ajax({
            type: 'GET',
            url: '/dashboard/feedbacks/modals/' + userId,
            success: function(response) {
                $("#loadModal").html(response);
            },
            error: function(response) {
                $("#loadModal").html('<p class="text-danger">Failed to load content. Please try again.</p>');
                console.error(response);
            }
        });
    }
</script>
@endpush
