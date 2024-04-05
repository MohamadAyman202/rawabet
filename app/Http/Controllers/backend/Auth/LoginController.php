<?php

namespace App\Http\Controllers\backend\Auth;

use App\Http\Controllers\Controller;
use App\Models\LastLogin;
use App\Providers\RouteServiceProvider;
use App\Trait\SystemInfoHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use SystemInfoHelper;
    public function login(Request $request)
    {
        if ($request->isMethod('post')) {
            $attach = ['email' => $request->input('email'), 'password' => $request->input('password'), 'status' => 'active'];
            if (Auth::guard('admin')->attempt($attach)) {
                $logined = LastLogin::query()->create([
                    'admin_id' => Auth::guard('admin')->user()->id,
                    'ip_address' => self::get_ip(),
                    'browser' => self::get_browsers(),
                    'operating_system' => self::get_os(),
                    'device' => self::get_device(),
                ]);
                if ($logined) return redirect(RouteServiceProvider::DASHBOARD);
            }
            session()->flash('error', 'The Account Not Found!');
            return redirect()->back();
        }
        return view('backend.Auth.login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->back();
    }
}
