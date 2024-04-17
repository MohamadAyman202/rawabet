<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSubCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Models\SubCategory;
use App\Services\SystemServices;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SubCategoryController extends Controller
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
        $data['sub_categories'] = SubCategory::query()->orderBy('created_at', 'DESC')->get();
        $data['categories'] = Category::query()->orderBy('created_at', 'DESC')->get();
        return view('backend.pages.sub_category.index', compact('data'));
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
    public function store(CreateSubCategoryRequest $request)
    {
        $data = $this->data($request);
        $data['slug'] = str()->slug($request->title_en);
        return $this->systemServices->createSystem(SubCategory::query(), $data, 'SubCategory', null, $request);
    }

    /**
     * Display the specified resource.
     */
    public function show(SubCategory $subCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SubCategory $subCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, $slug)
    {
        $data = $this->data($request);
        return $this->systemServices->editSystem(SubCategory::query(), $slug, $data, 'SubCategory', null, $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        return $this->systemServices->deleteSystem(SubCategory::query(), $slug, 'SubCategory');
    }

    public function data($request): array
    {
        $data = $request->except('_token', 'photo', 'title', 'title_en', 'description', 'description_en');
        $data['title'] = ['ar' => $request->title, 'en' => $request->title_en];
        $data['description'] = ['ar' => $request->description, 'en' => $request->description_en];
        $data['admin_id'] = auth()->user()->id;
        return $data;
    }
}
