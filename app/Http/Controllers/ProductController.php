<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Country;
use App\Models\MeasuringUnit;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\User;
use App\Services\ProdcutServices;
use App\Trait\FunctionsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    use FunctionsTrait;
    private $ProdcutServices;
    function __construct(ProdcutServices $ProdcutServices)
    {
        $this->ProdcutServices = $ProdcutServices;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::find(954)->unreadNotifications;
        $products = Product::query()->paginate(self::count_data());
        return view('backend.pages.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = self::get_data_product();
        $data['categories'] = Cache::remember('categories', 180, function () {
            return Category::query()->orderBy('created_at', 'DESC')->get();
        });
        return view('backend.pages.products.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateProductRequest $request)
    {
        $data = $this->data($request);
        $data['slug'] = $request->input('title');
        return $this->ProdcutServices->create($data, $request);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($slug)
    {
        $data = self::get_data_product();
        $data['product'] = Product::query()->where('slug', $slug)->first();

        return view('backend.pages.products.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, $slug)
    {
        $data = $this->data($request);
        return $this->ProdcutServices->edit($slug, $data, $request);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($slug)
    {
        return $this->ProdcutServices->delete($slug, 'Product');
    }

    public function data($request): array
    {
        $data = $request->except('_token', 'photo', 'title', 'title_en', 'description', 'description_en', 'meta_description', 'meta_description_en');
        $data['title'] = ['ar' => $request->input('title'), 'en' => $request->input('title_en')];
        $data['meta_description'] = ['ar' => $request->input('meta_description'), 'en' => $request->input('meta_description_en')];
        $data['description'] = ['ar' => $request->input('description'), 'en' => $request->input('description_en')];
        $data['admin_id'] = auth()->user()->id;

        return $data;
    }

    public function get_sub_category($id)
    {
        $data = Category::query()->where('id', $id)->first()->sub_categories;
        return response()->json(['data' => $data, 'msg' => 'Successfully Get Data', 'status' => 200]);
    }
}
