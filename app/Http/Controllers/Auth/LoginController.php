<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
         $role = $request['user'];
        // Retrive Input
        // $user = User::role($role)->where('email', $request['email'])->first();
         $user = User::where('email', $request['email'])->first();
        if(empty($user)){
            return redirect()->back()->with('error', 'Incorrect Credential');
        }
        if (Hash::check($request['password'], $user->password)) {
             Auth::login($user);
            return redirect()->intended('/home');
        }else{
                return redirect()->back()->with('error','Incorrect Credential');
            }
    }

    public function logout(Request $request) {
        Auth::logout();
        session()->flush();
        return redirect('/login');
    }
}
