<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use Illuminate\Validation\Rule;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function login(Request $request)
    {
        $errors = new MessageBag(); // initiate MessageBag

        $credentials = $request->only('email', 'password');

        $credentials =  $this->validate($request, [
            'email' => [
                'required',
                Rule::exists('users', 'email')->where('type', '1')
            ],
            'password' => [
                'required'
            ],

//            'g-recaptcha-response' => 'required|captcha'
        ]);


        if (Auth::attempt($credentials))
        {
            session()->flash('message.success', 'تم تسجيل الدخول بنجاح');
            if(Auth::user()->role_id === "4") {
                return redirect('/mark-voter');
            }
            else {
                return redirect()->intended('/');
            }
        }
        else
        {
            $errors = new MessageBag(['password' => ['الرجاء التأكد من البيانات المدخلة']]);
            return redirect()->back()->withErrors($errors);
        }
    }
}
