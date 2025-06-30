@php
// File: index.blade.php
// Deskripsi: Kode ini telah disesuaikan dengan skema warna baru yang terinspirasi dari logo SILAGA.
// Perubahan utama adalah penambahan blok @push('custom-css') untuk menimpa gaya default.
@endphp

@extends('dashboard.layouts.app')

@section('title')
SILAGA | Users
@endsection

{{-- Menambahkan custom CSS untuk skema warna baru --}}
{{-- Pastikan layout utama Anda (app.blade.php) memiliki @stack('custom-css') di dalam tag <head> --}}
@push('custom-css')
<style>
    :root {
        --primary-blue: #2A5DDE;
        --primary-blue-dark: #1E40AF;
        --primary-blue-light: #E9EFFE;
        --text-dark: #333;
        --text-light: #6c757d;
        --border-color: #dee2e6;
        --background-light: #f8f9fa;
        --success-green: #28a745;
        --success-green-light: #eaf7ec;
        --danger-red: #dc3545;
        --danger-red-light: #fbebed;
        --neutral-gray: #6c757d;
        --neutral-gray-light: #f1f1f1;
    }

    /* Penyesuaian Tombol Utama */
    .btn-primary {
        background-color: var(--primary-blue) !important;
        border-color: var(--primary-blue) !important;
        color: #fff !important;
        transition: all 0.3s ease;
    }

    .btn-primary:hover, .btn-primary:focus {
        background-color: var(--primary-blue-dark) !important;
        border-color: var(--primary-blue-dark) !important;
        box-shadow: 0 4px 12px rgba(42, 93, 222, 0.2);
    }

    /* Penyesuaian Tampilan Card */
    .card {
        border: none;
        border-radius: 0.75rem;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.05);
    }

    .card-header {
        background-color: #fff;
        border-bottom: 1px solid var(--border-color);
        color: var(--primary-blue-dark);
        font-weight: 600;
    }

    /* Penyesuaian Breadcrumb */
    .fw-bold.py-0.mb-4 {
        color: var(--primary-blue-dark);
        font-size: 1.1rem;
    }
    .text-muted.fw-light {
        color: var(--text-light) !important;
    }

    /* Penyesuaian Kolom Pencarian */
    #html5-search-input {
        border-radius: 0.5rem;
    }
     #html5-search-input:focus {
        border-color: var(--primary-blue);
        box-shadow: 0 0 0 0.2rem rgba(42, 93, 222, 0.25);
     }


    /* Penyesuaian Tabel */
    .table thead th {
        color: var(--text-dark);
        font-weight: 600;
    }

    .table tbody tr:hover {
        background-color: var(--background-light);
    }

    /* Penyesuaian Badge/Label Status & Role */
    .badge {
        padding: 0.5em 0.75em;
        font-size: 0.8rem;
        border-radius: 0.5rem;
    }

    /* Role: Admin */
    .bg-label-primary {
        background-color: var(--primary-blue-light) !important;
        color: var(--primary-blue-dark) !important;
    }

    /* Role: User & Akun Terverifikasi */
    .bg-label-secondary {
        background-color: var(--neutral-gray-light) !important;
        color: var(--neutral-gray) !important;
    }

    /* Akun yang sudah terverifikasi (jika ingin dibedakan) */
    .bg-label-success {
        background-color: var(--success-green-light) !important;
        color: var(--success-green) !important;
    }

    /* Akun Belum Terverifikasi */
    .bg-label-danger {
        background-color: var(--danger-red-light) !important;
        color: var(--danger-red) !important;
    }

    /* Penyesuaian Aksi Dropdown */
    .dropdown-menu {
        border: none;
        box-shadow: 0 4px 25px rgba(0, 0, 0, 0.1);
        border-radius: 0.5rem;
    }

    .dropdown-item {
        transition: all 0.2s ease;
    }

    .dropdown-item:hover, .dropdown-item:focus {
        background-color: var(--primary-blue-light);
        color: var(--primary-blue-dark);
    }

</style>
@endpush

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h6 class="fw-bold py-0 mb-4"><span class="text-muted fw-light">Dashboard /</span> Users</h6>
    <div class="row">
        <div class="col-lg-12 col-md-12 order-1">
            <div class="col-md-3 py-3" style="margin-top: -30px;">
                <form action="{{ route('dashboard.users.index') }}" method="GET">
                    <input class="form-control" type="search" value="{{ request()->query('search') }}" name="search" placeholder="Search" id="html5-search-input">
                </form>
            </div>
            <div class="card">
                <div class="card-top d-lg-lex">
                    <div class="d-flex justify-content-between">
                        <h5 class="card-header">Data Users</h5>
                        <div class="button-add p-3" style="margin-right: 15px;">
                            <a href="javascript::void(0);" class="btn btn-primary d-grid text-white"
                            data-bs-toggle="modal" data-bs-target="#modalUsers" onclick="userMethod(0,'crud')">Add User</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive text-nowrap">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Account</th>
                                <th>Address</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($users->count())
                            @foreach ( $users as $key => $user)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td><i class="fab fa-lg text-danger "></i> <strong>{{ $user->name }}</strong></td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <span class="badge
                                                    @if($user->role_id == 2) bg-label-success
                                                    @elseif($user->role_id == 3 && $user->details?->status == 1) bg-label-success
                                                    @else bg-label-danger
                                                    @endif">
                                        @if($user->role_id == 2)
                                        VERIFIED
                                        @elseif($user->role_id == 3 && $user->details?->status == 1)
                                        VERIFIED
                                        @else
                                        NOT VERIFIED
                                        @endif
                                    </span>
                                </td>
                                <td>
                                    {{ Str::limit($user->details?->complete_address ?? '-', 30) }}
                                </td>
                                <td>
                                    <span class="badge
                                                    @if($user->role_id == 2) bg-label-primary
                                                    @else bg-label-secondary
                                                    @endif">
                                        {{ $user->roles->role }}
                                    </span>
                                </td>
                                <td>
                                    <div class="dropdown">
                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                            <i class="bx bx-dots-vertical-rounded"></i>
                                        </button>
                                        <div class="dropdown-menu">
                                            @if($user->details?->status == 0 && $user->role_id == 3)
                                            <a href="javascript:void(0);" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalVerify" onclick="userMethod(`{{ $user->user_id }}`, 'verify')"><i class="bx bx-check"></i>Verify</a>
                                            @endif
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalUsers" onclick="userMethod(`{{ $user->user_id }}`, 'crud')"><i class="bx bx-edit-alt"></i>Edit</a>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="confirmDelete(`{{ $user->user_id }}`)"><i class="bx bx-trash"></i> Delete</a>
                                            <a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#modalDetailUser" onclick="userDetailMethod(`{{ $user->user_id }}`)"><i class="bx bx-user"></i> Detail</a>
                                            @if(($user->role_id == 2) || ($user->role_id == 3 && $user->details?->status == 1))
                                            <a href="javascript:void(0);" class="dropdown-item" onclick="setNotVerified(`{{ $user->user_id }}`)"><i class="bx bx-x"></i> Set Not Verified</a>
                                            @endif
                                            <form id="delete-form-{{ $user->user_id }}" action="{{ route('dashboard.users.destroy', $user->user_id) }}" method="POST" style="display: none;">
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
                                    No User Data
                                </td>
                            </tr>
                            @endif
                        </tbody>
                        <tfoot class="table-border-bottom-0">
                            <tr>
                                <th>No</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Account</th>
                                <th>Address</th>
                                <th>Role</th>
                                <th>Actions</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="d-flex justify-content-end">
                        {{ $users->appends(request()->query())->links('vendor.pagination.tailwind') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@component('components.modal-component', [
    'id' => 'modalUsers'])
@endcomponent

@component('components.modal-component', [
    'id' => 'modalVerify'])
@endcomponent

@component('components.modal-component', [
    'id' => 'modalDetailUser'])
@endcomponent

@endsection

@push('custom-js')
<script>
    // load users modal
    function userMethod(userId, status) {

        if(status == 'crud')
        {
            $.ajax({
                type: 'GET',
                url: '/dashboard/users/' + userId,
                success: function(response) {
                    $("#loadModal").html(response);
                    console.log(response);
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }

        else{
            $.ajax({
                type: 'GET',
                url: '/dashboard/users/verify/' + userId,
                success: function(response) {
                    $("#loadModalVerify").html(response);
                    console.log(response);
                },
                error: function(response) {
                    console.log(response);
                }
            });
        }
    }
    // delete user
    function confirmDelete(userId) {
        // Untuk pengalaman pengguna yang lebih baik, gunakan modal konfirmasi custom
        // daripada confirm() bawaan browser.
        // Contoh:
        // if (confirm('Are you sure you want to delete this user?')) {
        //     document.getElementById('delete-form-' + userId).submit();
        // }
        document.getElementById('delete-form-' + userId).submit();
    }

    function userDetailMethod(userId) {
        $.ajax({
            type: 'GET',
            url: '/dashboard/users/detail/' + userId,
            success: function(response) {
                $("#modalDetailUser .modal-content").html(response);
            },
            error: function(response) {
                console.log(response);
            }
        });
    }

    function setNotVerified(userId) {
        // Modal custom konfirmasi
        const modalHtml = `
        <div class="modal fade" id="modalSetNotVerified" tabindex="-1" aria-labelledby="modalSetNotVerifiedLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header" style="background-color: #3367a3; ">
                        <h5 class="modal-title" id="modalSetNotVerifiedLabel" style="color: #fff;"><i class="bx bx-x"></i> Konfirmasi Ubah Status</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body text-center">
                        <p class="mb-3">Apakah Anda yakin ingin mengubah status user ini menjadi <span class="fw-bold text-danger">Not Verified</span>?</p>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancle</button>
                        <button type="button" class="btn btn-danger" id="btnConfirmSetNotVerified">Accept</button>
                    </div>
                </div>
            </div>
        </div>`;
        // Hapus modal jika sudah ada
        $("#modalSetNotVerified").remove();
        // Tambahkan ke body
        $("body").append(modalHtml);
        // Tampilkan modal
        const modal = new bootstrap.Modal(document.getElementById('modalSetNotVerified'));
        modal.show();
        // Handle klik konfirmasi
        $("#btnConfirmSetNotVerified").off('click').on('click', function() {
            $.ajax({
                type: 'POST',
                url: '/dashboard/users/set-not-verified/' + userId,
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    modal.hide();
                    location.reload();
                },
                error: function(response) {
                    modal.hide();
                    alert('Gagal mengubah status user.');
                }
            });
        });
    }
</script>
@endpush
