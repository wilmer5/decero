<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';

    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function validateLogin()
    {
        //Esto valida que se envie el captcha
        // $this->validate(request(), [
        //     'g-recaptcha-response' => 'required|recaptcha',
        // ]);

        //Esto valida que la cuenta este activada
        $messages = [
            'email.exists' => 'Su cuenta no se encuentra activa.',
        ];

        $this->validate(request(), [
            $this->username() => 'required|exists:users,email,activada,0', 'password' => 'required'
        ], $messages);
    }

}
