<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PDF;
use App\Models\Report;
use App\Models\ImageReport;

class PrintReportController extends Controller
{
    public function index(Request $request)
    {
        if ($request->user()->role_id != 1) {
            abort(403, 'Unauthorized');
        }
        return view('dashboard.print-reports.index');
    }

    public function print(Request $request)
    {
        if ($request->user()->role_id != 1) {
            abort(403, 'Unauthorized');
        }
        $query = Report::query();
        if ($request->tanggal_awal && $request->tanggal_akhir) {
            $query->whereBetween('created_at', [
                date('Y-m-d 00:00:00', strtotime($request->tanggal_awal)),
                date('Y-m-d 23:59:59', strtotime($request->tanggal_akhir))
            ]);
        }
        $reports = $query->with(['user', 'images'])->get();
        $data = [];
        foreach ($reports as $r) {
            $data[] = [
                'kode' => $r->id,
                'nama' => $r->user->name ?? '-',
                'judul' => $r->title,
                'status' => $r->status,
                'deskripsi' => $r->description,
                'alamat' => $r->address,
                'images' => $r->images->pluck('filename')->map(function($img) use ($r) {
                    $folder = $r->title;
                    return public_path('assets/images/reports/' . $folder . '/' . $img);
                })->toArray(),
            ];
        }
        $periode = $request->tanggal_awal . ' s/d ' . $request->tanggal_akhir;
        $jenis = 'Reports';
        $pdf = PDF::loadView('dashboard.print-reports.pdf', compact('data', 'periode', 'jenis'));
        return $pdf->stream('laporan.pdf');
    }
}
