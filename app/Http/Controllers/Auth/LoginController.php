<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LastLogin;
use App\Providers\RouteServiceProvider;
use App\Trait\SystemInfoHelper;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use SystemInfoHelper;
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

    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $attach = ['email' => $request->input('email'), 'password' => $request->input('password'), 'status' => 'active'];
            if (Auth::guard('web')->attempt($attach)) {
                $logined =  LastLogin::query()->create([
                    'user_id' => auth()->user()->id,
                    'ip_address' => self::get_ip(),
                    'browser' => self::get_browsers(),
                    'operating_system' => self::get_os(),
                    'device' => self::get_device(),
                ]);
                if ($logined) return redirect(RouteServiceProvider::DASHBOARD);
            }
            session()->flash('error', 'The Account Not Found!');
            return  redirect()->back();
        }
        return view('frontend.auth.login');
    }

    public function logout(Request $request) {
         Auth::logout();
        return redirect()->back();
    }
}
