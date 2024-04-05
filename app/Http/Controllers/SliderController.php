<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Services\SystemServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SliderController extends Controller
{
    private $systemServices;
    
    function __construct(SystemServices $systemServices)
    {
        $this->systemServices = $systemServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sliders = Slider::query()->orderBy('created_at', 'DESC')->get();
        return view('backend.pages.slider.index', compact('sliders'));
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
    public function store(Request $request)
    {
        try {
            $data = $this->data($request);
            if ($request->hasFile('photo')) {
                $image_name = time() . '.' . $request->file('photo')->extension();
                $data['photo'] = "uploads/slider/$image_name";
            }

            $status = Slider::query()->create($data);

            if ($status) {
                $request->file('photo')->move(public_path("uploads/slider/"), $image_name);
                session()->flash('success', "Successfully Created Slider!");
                return redirect()->back();
            }
            session()->flash('error', "Not Successfully Created Slider!");
            return redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Slider $slider)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Slider $slider)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $slider = Slider::query()->findOrFail($id);
            $data = $this->data($request);
            if ($request->hasFile('photo')) {
                if (!is_null($slider->photo)) {
                    unlink($slider->photo);
                }
                $image_name = time() . '.' . $request->file('photo')->extension();
                $data['photo'] = "uploads/slider/$image_name";
            }

            $status = $slider->fill($data)->save();

            if ($status) {
                if ($request->hasFile('photo')) {
                    $request->file('photo')->move(public_path("uploads/slider/"), $image_name);
                }
                session()->flash('success', "Successfully Updated Slider!");
                return redirect()->back();
            }
            session()->flash('error', "Not Successfully Updated Slider!");
            return redirect()->back();
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = Slider::query()->findOrFail($id);
        if ($slider) {
            if (!is_null($slider->photo)) {
                unlink($slider->photo);
            }
            $status = $slider->delete();
            if ($status) {
                session()->flash('success', "Successfully Deleted Slider!");
                return redirect()->back();
            }
            session()->flash('error', "Successfully Deleted Slider!");
            return redirect()->back();
        }
    }

    public function data($request): array
    {
        $data['title'] = ['ar' => $request->input('title'), 'en' => $request->input('title_en')];
        $data['description'] = ['ar' => $request->input('description'), 'en' => $request->input('description_en')];
        $data['title'] = ['ar' => $request->input('title'), 'en' => $request->input('title_en')];
        $data['status'] = $request->input('status');
        $data['admin_id'] = Auth::user()->id;
        return $data;
    }
}
