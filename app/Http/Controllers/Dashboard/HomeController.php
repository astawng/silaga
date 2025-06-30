<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\UpdateProfileRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = \App\Models\User::where('role_id', '!=', 1)->count();
        $feedbacks = \App\Models\Feedback::count();
        $citizens = \App\Models\User::where('role_id', 3)->count();
        // Ubah: hanya hitung report yang statusnya bukan pending
        $reports = \App\Models\Report::where('status', '!=', 'pending')->count();
        $reportDone = \App\Models\Report::where('status','done')->count();
        $reportReview = \App\Models\Report::whereIn('status',['review','checking'])->count();
        $reportProgress = \App\Models\Report::where('status','progress')->count();
        $maps = \App\Models\Report::all();
        $allReports = [
            'all' => $reports,
            'done' => $reportDone,
            'review' => $reportReview,
            'progress' => $reportProgress
        ];
        return view('dashboard.index', compact('users', 'citizens','feedbacks','allReports', 'maps'));
    }

    public function profile()
    {
        $user = \App\Models\User::with('details')->where('user_id', Auth::user()->user_id)->firstOrFail();
        return view('dashboard.profile', compact('user'));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        $user = \App\Models\User::where('user_id', Auth::user()->user_id)->firstOrFail();
        try {
            $user->name = $request->name;
            $user->save();

            $userDetails = $user->details()->firstOrNew(['user_id' => $user->user_id]);
            $userDetails->user_id = Auth::user()->user_id;
            $userDetails->identity = $request->identity;
            $userDetails->address = $request->address;
            $userDetails->zip_code = $request->zip_code;
            $userDetails->state = $request->state;
            $userDetails->phone = $request->phone;
            $userDetails->gender = $request->gender;

            if($request->image)
            {
                if ($user->details?->image && File::exists(public_path('assets/images/profile/' . $user->details->image))) {
                    File::delete(public_path('assets/images/profile/' . $user->details->image));
                }
                $userDetails->image = $this->imageHandler($request->image, 'profile');
            }

            if($request->identity_image)
            {
                if ($user->details?->identity_image && File::exists(public_path('assets/images/identity/' . $user->details->identity_image))) {
                    File::delete(public_path('assets/images/identity/' . $user->details->identity_image));
                }
                $userDetails->identity_image = $this->imageHandler($request->identity_image, 'identity');
            }

            $userDetails->save();

            return back()->with('success', 'Succefully update profile');
        } catch (\Throwable $th) {
            return response()->json(['errors' => $th->getMessage()]);
        }
    }

    protected function imageHandler($image, $type)
    {
        try {
            $basePath = public_path('assets/images/');

            $typeDirectory = [
                'profile' => 'profile/',
                'identity' => 'identity/'
            ];

            $imageName = time() . uniqid() . '.' . $image->extension();
            $destinationPath = $basePath . ($typeDirectory[$type] ?? 'other/');
            $image->move($destinationPath, $imageName);

            return $imageName;
        } catch (\Throwable $th) {
            return null;
        }
    }
}
