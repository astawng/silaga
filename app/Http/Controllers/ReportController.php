<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    // ...existing methods...

    public function showChangeStatus($id)
    {
        $report = Report::where('report_id', $id)->firstOrFail();
        return view('dashboard.reports._change_status', compact('report'))->render();
    }

    public function changeStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,review,progress,done',
        ]);
        $report = Report::where('report_id', $id)->firstOrFail();
        $report->status = $request->status;
        $report->save();
        return response()->json(['success' => true]);
    }

    // ...existing methods...
}