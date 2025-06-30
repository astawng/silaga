@extends('dashboard.layouts.app')

@section('title')
Detail Report
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h6 class="fw-bold py-0 mb-4"><span class="text-muted fw-light">Dashboard /</span> Report Detail</h6>
    <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5>Detail Report</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama Pelapor</th>
                            <td>{{ optional($report->user)->name ?? '-' }}</td>
                        </tr>
                        <tr>
                            <th>Title</th>
                            <td>{{ $report->title }}</td>
                        </tr>
                        <tr>
                            <th>Description</th>
                            <td>{{ $report->description }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $report->status }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <td>{{ $report->address }}</td>
                        </tr>
                        <tr>
                            <th>Latitude</th>
                            <td>{{ $report->lat }}</td>
                        </tr>
                        <tr>
                            <th>Longitude</th>
                            <td>{{ $report->long }}</td>
                        </tr>
                        <tr>
                            <th>Images</th>
                            <td>
                                @php
                                    $images = \App\Models\ImageReport::where('report_id', $report->report_id)->get();
                                @endphp
                                @if($images->count())
                                    @foreach($images as $img)
                                        <a href="{{ asset('assets/images/reports/'.$report->title.'/'.$img->filename) }}" target="_blank">
                                            <img src="{{ asset('assets/images/reports/'.$report->title.'/'.$img->filename) }}" alt="{{ $img->filename }}" class="img-thumbnail m-1" style="max-width:120px;">
                                        </a>
                                    @endforeach
                                @else
                                    <span>No Images</span>
                                @endif
                            </td>
                        </tr>
                    </table>
                    <a href="{{ route('dashboard.reports.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
