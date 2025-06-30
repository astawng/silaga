@extends('dashboard.layouts.app')

@section('title')
SILAGA | Contacts
@endsection

@push('custom-css')
<style>
    :root {
        --primary-color: #2A62C9;
        /* Warna biru utama yang diambil dari logo Anda */
        --primary-light: #EAF1FB;
        /* Biru muda untuk latar belakang dan sorotan */
        --secondary-color: #1E293B;
        /* Abu-abu tua untuk teks agar mudah dibaca */
        --muted-color: #6B7280;
        /* Abu-abu muda untuk teks sekunder */
        --border-color: #E5E7EB;
        /* Warna border yang lembut */
        --background-color: #F9FAFB;
        /* Warna latar belakang halaman yang bersih */
    }

    /* Penyesuaian Latar Belakang Utama */
    .container-p-y {
        background-color: var(--background-color);
    }

    /* Penyesuaian Breadcrumb */
    .fw-bold .text-muted.fw-light {
        color: var(--muted-color) !important;
    }

    /* Input Pencarian dengan Gaya Baru */
    #html5-search-input {
        border: 1px solid var(--border-color);
        border-radius: 0.5rem;
        transition: border-color 0.2s ease, box-shadow 0.2s ease;
    }

    #html5-search-input:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(42, 98, 201, 0.15);
    }

    /* Kartu dengan Desain Modern */
    .card {
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        background-color: var(--primary-color);
        color: white;
        border-bottom: none;
        /* Menghilangkan border bawah standar */
        border-top-left-radius: 0.75rem;
        border-top-right-radius: 0.75rem;
        font-weight: 600;
    }

    /* Tabel dengan Tampilan yang Lebih Bersih */
    .table-responsive {
        border-radius: 0.75rem;
    }

    .table thead {
        background-color: var(--primary-light);
    }

    .table thead th {
        color: var(--secondary-color);
        font-weight: 600;
        border-bottom: 2px solid var(--border-color);
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    
    .table-border-bottom-0 > tfoot > tr > th {
        border-bottom: 0 !important;
    }

    .table tbody tr:hover {
        background-color: var(--primary-light);
    }

    .table td,
    .table th {
        vertical-align: middle;
    }

    .table tbody td {
        color: var(--secondary-color);
    }

    /* Ikon dan Tombol Aksi */
    .text-primary-custom {
        color: var(--primary-color) !important;
    }
    
    .dropdown-toggle::after {
        display: none; /* Menyembunyikan panah dropdown default */
    }

    .dropdown-menu {
        border-radius: 0.5rem;
        border: 1px solid var(--border-color);
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
    }

    .dropdown-item {
        color: var(--secondary-color);
        transition: background-color 0.2s ease, color 0.2s ease;
    }

    .dropdown-item:hover,
    .dropdown-item:focus {
        background-color: var(--primary-light);
        color: var(--primary-color);
    }
    
    .dropdown-item i {
        margin-right: 0.75rem;
        font-size: 1.1rem;
        vertical-align: middle;
    }

    /* Paginasi yang Disesuaikan */
    .pagination .page-item .page-link {
        color: var(--primary-color);
        border-radius: 0.375rem;
        margin: 0 0.25rem;
        border: 1px solid var(--border-color);
    }

    .pagination .page-item.active .page-link {
        background-color: var(--primary-color);
        border-color: var(--primary-color);
        color: white;
        box-shadow: 0 2px 4px rgba(42, 98, 201, 0.2);
    }

    .pagination .page-item.disabled .page-link {
        color: var(--muted-color);
    }

    .pagination .page-item .page-link:hover {
        background-color: var(--primary-light);
    }
</style>
@endpush


@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h6 class="fw-bold py-0 mb-4"><span class="text-muted fw-light">Dashboard /</span> Contacts</h6>
    <div class="row">
        <div class="col-lg-12 col-md-12 order-1">
            <div class="col-md-4 py-3" style="margin-top: -30px; margin-left:-12px">
                <form action="{{ route('dashboard.contact') }}" method="GET">
                    <input class="form-control" type="search" value="{{ request()->query('search') }}" name="search"
                        placeholder="Search..." id="html5-search-input">
                </form>
            </div>
            <div class="card">
                <div class="card-top d-lg-lex">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-header">Data Contact</h5>
                    </div>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($data->count())
                            @foreach ( $data as $key => $item)
                            <tr>
                                <td>{{ $key + $data->firstItem() }}</td>
                                <td>
                                    {{-- Mengganti ikon lama dengan ikon yang lebih sesuai dan berwarna primer --}}
                                    <i class='bx bxs-user-circle text-primary-custom me-2'></i>
                                    <strong>{{ $item->name }}</strong>
                                </td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->subject }}</td>
                                <td>
                                    {{ Str::limit($item->message, 50, '...') }}
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                            data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item" href="javascript:void(0);"
                                                onclick="confirmDelete('{{ $item->id }}')">
                                                <i class="bx bx-trash"></i> Delete
                                            </a>
                                            <form id="delete-form-{{ $item->id }}"
                                                action="{{ route('dashboard.contact.destroy', $item->id) }}" method="POST"
                                                style="display: none;">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td class="text-center align-middle" colspan="100%">
                                    No Data Found
                                </td>
                            </tr>
                            @endif
                        </tbody>
                        <tfoot class="table-border-bottom-0">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Message</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="d-flex justify-content-center p-3">
                        {{-- Memastikan paginasi menggunakan style yang sudah disediakan oleh framework --}}
                        {{ $data->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-js')
<script>
    // Fungsi ini tetap sama, hanya untuk konfirmasi hapus
    function confirmDelete(contactId) {
        // Untuk pengalaman pengguna yang lebih baik, gunakan modal konfirmasi
        // Tapi untuk menjaga fungsionalitas tetap sama, kita langsung submit
        if (confirm('Are you sure you want to delete this contact?')) {
            document.getElementById('delete-form-' + contactId).submit();
        }
    }
</script>
@endpush
