<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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

    public function showLoginForm()
    {
        return view('page.auth.login');
    }

    public function Login(Request $request){
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ];
        $user = DB::table('users')->where('email', $request->input('email'))->first();
        Auth::attempt($data);
        if (Auth::check()) {
            Session::put('id', $user->id);
            if ($response = $this->authenticated($request, $this->guard()->user())) {
                return $response;
            }

            return $request->wantsJson()
                        ? new JsonResponse([], 204)
                        : redirect()->intended($this->redirectPath());
        } else {
            echo "Anda gagal login";
        }
    }
}
