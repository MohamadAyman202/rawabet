<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $setting = Setting::query()->first();
        return view('backend.pages.setting.index', compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(SettingRequest $request, string $id)
    {
        try {
            $setting = Setting::query()->findOrFail($id);

            $data = $this->data($request);

            if ($request->file('logo')) {
                if ($setting->logo) {
                    unlink($setting->logo);
                }
                $logo = time() . '.' . $request->file('logo')->extension();
                $data['logo'] = "uploads/setting/$logo";
                $request->file('logo')->move(public_path("uploads/setting/"), $logo);
            }

            if ($request->file('favicon')) {
                if ($setting->favicon) {
                    unlink($setting->favicon);
                }
                $favicon = time() . '.' . $request->file('favicon')->extension();
                $data['favicon'] = "uploads/setting/$favicon";
                $request->file('favicon')->move(public_path("uploads/setting/"), $favicon);
            }

            $status = $setting->fill($data)->save();

            if ($status) {
                session()->flash('success', "Successfully Updated Settin!");
                return redirect()->back();
            }
            session()->flash('error', "Not Successfully Updated Setting!");
            return redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }


    public function data($request): array
    {
        $data = $request->except('_token', 'title', 'title_en', 'logo', 'favicon');
        $data['title'] = ['ar' => $request->input('title'), 'en' => $request->input('title_en')];

        return $data;
    }
}
