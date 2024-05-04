<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Country;
use App\Models\User;
use App\Trait\FunctionsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    use FunctionsTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = User::query()->orderBy('created_at', 'DESC')->paginate(self::count_data());
        $countries = Cache::rememberForever('countries', function () {
            return Country::query()->orderBy('created_at', 'DESC')->get();
        });
        return view("backend.pages.customer.index", compact('customers', 'countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCustomerRequest $request)
    {
        try {
            $data = $this->data($request);

            if ($request->hasFile('photo')) {
                $image_name = time() . '.' . $request->file('photo')->extension();
                $data['photo'] = "uploads/customer/$image_name";
                $request->file('photo')->move(public_path("uploads/customer/"), $image_name);
            }

            $status = User::query()->create($data);

            if ($status) {
                session()->flash('success', "Successfully Created Customer");
                return  redirect()->back();
            }
            session()->flash('error', "Not Successfully Created Customer");
            return  redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, string $id)
    {
        try {
            $customer = User::query()->findOrFail($id);
            if ($customer) {
                $data = $this->data($request);

                if ($request->hasFile('photo')) {
                    $image_name = time() . '.' . $request->file('photo')->extension();
                    $data['photo'] = "uploads/customer/$image_name";
                    $request->file('photo')->move(public_path("uploads/customer/"), $image_name);
                }

                $status = $customer->fill($data)->save();

                if ($status) {
                    session()->flash('success', "Successfully Updated Customer");
                    return  redirect()->back();
                }
                session()->flash('error', "Not Successfully Updated Customer");
                return  redirect()->back();
            }
            session()->flash('error', "Not Notfound Data Customer");
            return  redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $customer = User::query()->findOrFail($id);
            if ($customer) {
                if (!is_null($customer->photo)) {
                    unlink($customer->photo);
                }
                $status = $customer->delete();
                if ($status) {
                    session()->flash('success', "Successfully Deleted Customer");
                    return redirect()->back();
                }
                session()->flash('error', "Not Successfully Deleted Customer");
                return redirect()->back();
            }
            session()->flash('error', "Not Notfound Data Customer");
            return  redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    public function data($request = null): array
    {
        $data = $request->except('_token', 'type_account', 'photo', 'confirm_password', 'password');
        $data['role_name'] = $request->input('type_account');
        $data['admin_id'] = auth()->user()->id;
        if (!is_null($request->input('password'))) {
            $data['password'] = Hash::make($request->input('password'));
        }
        return $data;
    }

}
