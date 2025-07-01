<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\StoreRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Mail\DeclineAccountEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        $query = User::query();
        $role = [3];

        if(Auth::user()->role_id == 1)
        {
            $role = [2,3];
        }

        if ($request->filled('search')) {

            $searchTerm = $request->input('search');
            $query->where('name', 'LIKE', '%'. $searchTerm . '%')
                  ->where('role_id','!=',1);

            if(Auth::user()->role_id == 1)
            {
                $query->where('name', 'LIKE', '%'. $searchTerm . '%')
                    ->orWhereHas('roles', function($queryRoles) use ($searchTerm){
                    $queryRoles->where('role', 'LIKE', '%'. $searchTerm . '%');
                });
            }
        }

        $users = $query->orderBy('role_id', 'ASC')->whereIn('role_id', $role)->paginate(10);

        return view('dashboard.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $user = $request->validated();
        $user['password'] = \Hash::make($request->password);
        if($request->role_id == 2)
        {
            $user['email_verified_at'] = Carbon::now();
        }
        User::create($user);
        return back()->with(['success' => 'Successfully Add User']);
    }

    /**
     * Display the specified resource.
     */
    public function verifyUser(string $id = null)
    {
        $user = User::where('user_id', $id)->firstOrFail();
        return view('dashboard.users.verify', compact('user'))->render();
    }

    /**
     * Verify users.
     */
    public function verifyUserAction(string $id = null)
    {
        $user = User::where('user_id', $id)->firstOrFail();
        $userDetails = $user->details;
        $userDetails->status = 1;
        $userDetails->save();
        return back()->with(['success' => 'Successfully Verify User']);
    }

    /**
     * Decline users.
     */
    public function declineUserAction(string $id = null)
    {
        $user = User::where('user_id', $id)->firstOrFail();
        $actionUrl = route('dashboard.profile');
        Mail::to($user->email)->send(new DeclineAccountEmail($user, $actionUrl));
        return back()->with(['success' => 'Successfully Send Email']);
    }

    /**
     * Display the form users.
     */
    public function show(string $id = null)
    {
        $user = $id ? User::where('user_id', $id)->firstOrFail() : null;
        $title = $id ? "Update User" : "Add User";
        $method = $id ? 'PUT' : 'POST';
        return view('dashboard.users.modal', compact('user', 'title', 'method'))->render();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $user = User::where('user_id', $id)->firstOrFail();
        $user->update($request->only(['name', 'email', 'role_id']));

        // Update user details
        $userDetails = $user->details;
        if (!$userDetails) {
            $userDetails = new UserDetail();
            $userDetails->user_id = $user->user_id;
        }
        $userDetails->identity = $request->input('identity');
        $userDetails->address = $request->input('address');
        $userDetails->zip_code = $request->input('zip_code');
        $userDetails->state = $request->input('state');
        $userDetails->phone = $request->input('phone');
        $gender = $request->input('gender');
        if ($gender === 'male') {
            $userDetails->gender = 'L';
        } elseif ($gender === 'female') {
            $userDetails->gender = 'P';
        } else {
            $userDetails->gender = null;
        }
        $userDetails->status = $request->input('status');

        // Handle identity image upload
        if ($request->hasFile('identity_image')) {
            $file = $request->file('identity_image');
            $filename = time().'_'.$file->getClientOriginalName();
            $file->move(public_path('assets/images/identity'), $filename);
            $userDetails->identity_image = $filename;
        }

        $userDetails->save();

        return back()->with(['success' => 'Successfully Update User']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::where('user_id', $id)->firstOrFail();
        $user->delete();
        return back()->with('success', 'Successfully Delete User');
    }

    /**
     * Display the detail of the specified resource.
     */
    public function detail(string $id)
    {
        $user = User::with('details', 'roles')->where('user_id', $id)->firstOrFail();
        return view('dashboard.users.detail', compact('user'))->render();
    }

    /**
     * Set user as Not Verified.
     */
    public function setNotVerified($id)
    {
        $user = User::where('user_id', $id)->firstOrFail();
        $userDetails = $user->details;
        if ($userDetails) {
            $userDetails->status = 0;
            $userDetails->save();
        }
        // Jika role_id 2 (admin), bisa juga diubah ke 3 jika ingin downgrade role
        // $user->role_id = 3;
        // $user->save();
        return response()->json(['success' => true, 'message' => 'User set as Not Verified']);
    }
}
