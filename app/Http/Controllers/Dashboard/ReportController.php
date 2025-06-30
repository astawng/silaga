<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Report;
use App\Models\ImageReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Reports\CitizensRequest;
use App\Http\Requests\Reports\EmployeRequest;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    /**
     * Middleware
     */
    public function __construct(){
        $this->middleware('checkUserProfile');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Report::query();
        $user_id = Auth::user()->user_id;
        $reports = [];

        if ($request->filled('search')) {

            $searchTerm = $request->input('search');
            $query->where('title', 'LIKE', '%'. $searchTerm . '%')
                  ->orWhere('address','LIKE',  '%'. $searchTerm . '%')
                  ->orWhere('lat','LIKE',  '%'. $searchTerm . '%')
                  ->orWhere('long','LIKE',  '%'. $searchTerm . '%')
                  ->orWhere('status','LIKE',  '%'. $searchTerm . '%');
        }

        $reports = $query->orderBy('created_at', 'ASC')->paginate(10);

        if(Auth::user()->role_id == 3)
        {
            $reports = $query->orderBy('created_at', 'ASC')->where('user_id', $user_id)->paginate(10);
        }

        return view('dashboard.reports.index',compact('reports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($reportId = null)
    {
        $report = null;

        if($reportId)
        {
            $report = Report::where('report_id', $reportId)->firstOrFail();
        }
        return view('dashboard.reports.create', compact('report'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CitizensRequest $request)
    {
        $report = Report::create($request->all());
        $files = $request->file;
        if($files)
        {
            foreach($files as $file){
                $fileName = $this->imageHandler($file, $report->title);
                if ($fileName) {
                    ImageReport::create([
                        'report_id' => $report->report_id,
                        'filename' => $fileName
                    ]);
                } else {
                    \Log::error('Gagal upload gambar untuk report_id: ' . $report->report_id);
                }
            }
        }
        return redirect()->route('dashboard.reports.index')->with('success', 'Report has been send');
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report, $id = null)
    {
        $report = Report::where('report_id', $id)->firstOrFail();

        if(!$report)
        {
            return back()->with('error', 'Report not found');
        }

        return view('dashboard.reports.show', compact('report'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        return view('dashboard.reports.edit', compact('report'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeRequest $request, $id)
    {
        $data = Report::where('report_id', $id)->firstOrFail();
        $oldTitle = $data->title;
        $newTitle = $request->title;
        // status tetap sama seperti sebelum update jika tidak dikirim dari form
        $data->status = $data->status;
        $data->title = $newTitle;
        $data->description = $request->description;
        $data->address = $request->address;
        $data->lat = $request->lat;
        $data->long = $request->long;

        // Rename folder if title changed
        if ($oldTitle !== $newTitle) {
            $oldFolder = public_path('assets/images/reports/' . $oldTitle);
            $newFolder = public_path('assets/images/reports/' . $newTitle);
            if (\File::exists($oldFolder)) {
                \File::move($oldFolder, $newFolder);
            }
        }

        $data->update();

        // Redirect langsung ke halaman index reports setelah update
        return redirect()->route('dashboard.reports.index')->with('success', 'Success updating report');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Report::where('report_id', $id)->firstOrFail();
        $data->delete();

        return back()->with('success', 'Success deleting report');
    }
    /**
     * Image handler resource from storage.
     */
    public function imageHandler($file, $filename)
    {
        try {
            $basePath = public_path('assets/images/reports/');
            $name = time() . uniqid() . '.' . $file->extension();
            $destinationPath = $basePath . $filename;
            $file->move($destinationPath, $name);
            return $name;
        } catch (\Throwable $th) {
            return null;
        }
    }

    /**
     * Show the form for changing the status of the specified resource.
     */
    public function showChangeStatus($id)
    {
        $report = Report::where('report_id', $id)->firstOrFail();
        return view('dashboard.reports._change_status', compact('report'))->render();
    }

    /**
     * Change the status of the specified resource.
     */
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
}
