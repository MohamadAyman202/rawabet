<?php

namespace App\Http\Controllers;

use App\Http\Requests\MeasuringUnitRequest;
use App\Models\MeasuringUnit;
use App\Services\SystemServices;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class MeasuringUnitController extends Controller
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
        $measuring_units = MeasuringUnit::query()->orderBy('created_at', 'DESC')->get();
        return view('backend.pages.measuring_unit.index', compact('measuring_units'));
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
     * @throws ValidationException
     */
    public function store(MeasuringUnitRequest $request)
    {
        $data = $this->data($request);
        $data['slug'] = str()->slug($request->input('title_en'));
        return $this->systemServices->createSystem(MeasuringUnit::query(), $data, 'MeasuringUnits');
    }

    /**
     * Display the specified resource.
     */
    public function show(MeasuringUnit $measuringUnit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MeasuringUnit $measuringUnit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * @throws ValidationException
     */
    public function update(MeasuringUnitRequest $request, $slug)
    {

        $data = $this->data($request);
        return $this->systemServices->editSystem(MeasuringUnit::query(), $slug, $data, 'MeasuringUnits');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        return $this->systemServices->deleteSystem(MeasuringUnit::query(), $slug, 'MeasuringUnits');
    }

    public function data($request): array
    {
        $data['title'] = ['ar' => $request->input('title'), 'en' => $request->input('title_en')];
        return $data;
    }
}
