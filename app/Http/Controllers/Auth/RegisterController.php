<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\User;
use App\Trait\FunctionsTrait;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    use FunctionsTrait;
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
    public function index(Request $request)
    {
        if ($request->isMethod("post")) {
            try {
                $data = $this->data($request);
                if ($request->hasFile('photo')) {
                    $image_name = time() . '.' . $request->file('photo')->extension();
                    $data['photo'] = "uploads/customer/$image_name";
                }
                $status = User::query()->create($data);

                if ($status) {
                    if ($request->hasFile('photo')) {
                        $request->file('photo')->move(public_path("uploads/customer/"), $image_name);
                    }
                    session()->flash('success', "Successfully Created Customer");
                    return  redirect()->back();
                }
                session()->flash('error', "Not Successfully Created Customer");
                return  redirect()->back();
            } catch (\Exception $ex) {
                return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
            }
        } else {
            $customers = User::query()->orderBy('created_at', 'DESC')->paginate(self::count_data());
            $countries = Cache::rememberForever('countries', function () {
                return Country::query()->orderBy('created_at', 'DESC')->get();
            });
            return view("frontend.auth.register", compact("customers", "countries"));
        }
    }

    public function data($request = null): array
    {
        $data = $request->except('_token', 'type_account', 'photo', 'password_confirmation');
        $data['role_name'] = $request->input('type_account');
        // $data['admin_id'] = auth()->user()->id;
        $data['password'] = Hash::make($request->input('password'));
        return $data;
    }
}
