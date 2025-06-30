<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers {
        register as registrationTrait;
    }

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    // protected $redirectTo = '/dashboard'; // Commented to ensure method override is used

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'password_confirmation' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role_id' => 3,
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * Override the redirect path after registration to go to login page instead of dashboard.
     */
    protected function redirectTo()
    {
        return '/login';
    }

    /**
     * Override the registered method to prevent auto-login after registration.
     */
    protected function registered($request, $user)
    {
        // Do not log in the user automatically, just redirect to login page with a message
        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login untuk melanjutkan.');
    }

    /**
     * Override register method to prevent auto-login after registration.
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        // Do NOT log the user in automatically
        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login untuk melanjutkan.');
    }
}
