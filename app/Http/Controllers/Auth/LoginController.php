<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class LoginController extends Controller
{
    use AuthenticatesUsers;
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated( $request)
    {

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials) ) {
            // Authentication passed...
            if (Auth::user()->isAdmin())
               return redirect()->intended('AdminHome');
            else
                return redirect()->intended('CompanyHome');

        }
    }
}
