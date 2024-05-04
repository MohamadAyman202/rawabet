<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use App\Models\Country;
use App\Trait\FunctionsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller
{
    use FunctionsTrait;
    public function index()
    {
        $admins = Admin::query()->orderBy('created_at', 'DESC')->paginate(self::count_data());
        $countries = Cache::rememberForever('countries', function () {
            return Country::query()->orderBy('created_at', 'DESC')->get();
        });
        $roles = Role::pluck('name', 'name')->all();
        return view('backend.pages.admin.index', compact('admins', 'countries', 'roles'));
    }

    public function store(CreateAdminRequest $request)
    {
        try {
            $data = $this->data($request);
            $data['password'] = bcrypt($request->input('password'));

            if ($request->hasFile('photo')) {
                $image_name = time() . '.' . $request->file('photo')->extension();
                $data['photo'] = "uploads/admin/$image_name";
            }

            $status = Admin::query()->create($data);

            $status->assignRole($request->input('roles'));
            if ($status) {
                if ($request->hasFile('photo')) {
                    $request->file('photo')->move(public_path("uploads/admin/"), $image_name);
                }
                session()->flash('success', "Successfully Created Admin");
                return  redirect()->back();
            }
            session()->flash('error', "Not Successfully Created Admin");
            return  redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    public function update(UpdateAdminRequest $request, string $id)
    {
        try {
            $admin = Admin::query()->findOrFail($id);
            if ($admin) {

                $data = $this->data($request);

                if (!is_null($request->password)) $data['password'] = bcrypt($request->input('password'));

                if ($request->hasFile('photo')) {
                    $image_name = time() . '.' . $request->file('photo')->extension();
                    $data['photo'] = "uploads/admin/$image_name";
                }

                $status = $admin->update($data);

                if ($status) {
                    DB::table('model_has_roles')->where('model_id', $id)->delete();
                    $admin->assignRole($request->input('roles'));
                    if ($request->hasFile('photo')) {
                        $request->file('photo')->move(public_path("uploads/admin/"), $image_name);
                    }
                    session()->flash('success', "Successfully Updated Admin");
                    return  redirect()->back();
                }
                session()->flash('error', "Not Successfully Updated Admin");
                return  redirect()->back();
            }
            session()->flash('error', "Not Notfound Data Customer");
            return  redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    public function destroy(string $id)
    {
        try {
            $admin = Admin::query()->findOrFail($id);

            if ($admin) {
                if (!is_null($admin->photo)) {
                    unlink($admin->photo);
                }

                $status = $admin->delete();

                if ($status) {
                    session()->flash('success', 'Successfully Deleted Admin');
                    return redirect()->back();
                }
                session()->flash('error', 'Not Successfully Deleted Admin');
                return redirect()->back();
            }
            session()->flash('error', 'Not Found Data Admin');
            return redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    public function data($request = null): array
    {
        $data = $request->except('_token', 'photo', 'confirm_password', 'roles', 'password');
        $data['role_name'] = $request->input('roles')[0];
        return $data;
    }
}
