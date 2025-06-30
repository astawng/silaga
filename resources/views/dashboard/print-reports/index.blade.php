@extends('dashboard.layouts.app')

@section('title')

@endsection

@section('content')
<div class="container">
    <div class="d-flex align-items-center mb-1 mt-4" style="font-size: 1.1rem; color: #7b809a;">
         <h6 class="fw-bold py-0 mb-4"><span class="text-muted fw-light">Dashboard /</span> Users</h6>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-header">Filter Laporan</h5>
            <form action="{{ route('dashboard.print-reports.print') }}" method="GET" target="_blank">
                <div class="row align-items-end">
                    
                    <div class="col-md-3 mb-3">
                        <label for="tanggal_awal" class="form-label" style="color:#2c3162; font-weight:500;">Tanggal Awal</label>
                        <input type="text" class="form-control" id="tanggal_awal" name="tanggal_awal" placeholder="dd/mm/yyyy" onfocus="(this.type='date')" onblur="(this.type='text')" style="background:#f8fafc;">
                    </div>
                    <div class="col-md-3 mb-3">
                        <label for="tanggal_akhir" class="form-label" style="color:#2c3162; font-weight:500;">Tanggal Akhir</label>
                        <input type="text" class="form-control" id="tanggal_akhir" name="tanggal_akhir" placeholder="dd/mm/yyyy" onfocus="(this.type='date')" onblur="(this.type='text')" style="background:#f8fafc;">
                    </div>
                    <div class="col-md-2 mb-3 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100" style="font-weight:500;">Tampilkan</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
