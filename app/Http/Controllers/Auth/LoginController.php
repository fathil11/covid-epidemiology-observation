<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

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

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo;

    public function redirectTo()
    {
        $settings = [
            'isAdmin' => route('admin.pe.all'),
            'isLab' => route('lab.pe'),
            'isPe' => route('registration.person.create'),
            'isDoctor' => route('registration.person.create'),
            'isReviewer' => route('statistic'),
        ];

        /** @var App\User */
        $user = Auth::user();

        foreach ($settings as $role => $route) {
            if($user->{$role}()){
                return $route;
            }
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
