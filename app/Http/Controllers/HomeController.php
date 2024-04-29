<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ContactUs;
use App\Models\Country;
use App\Models\Order;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\Subscription;
use App\Models\User;
use App\Services\SystemServices;
use App\Trait\FunctionsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    use FunctionsTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $systemServices;
    public function __construct(SystemServices $systemServices)
    {
        $this->systemServices = $systemServices;
        $this->middleware('redirectPayment', ['only' => 'subscriptions']);
        $this->middleware('checkProducts', ['only' => ['product_details', 'my_products']]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function home(Request $request)
    {
        $data['products'] = Product::query()->where('status', 'active')->orderBy("created_at", 'DESC')
            ->paginate(self::count_data());
        return view('frontend.home', compact('data'));
    }
    public function index()
    {
        $data = $this->data();
        return view('frontend.index', compact('data'));
    }

    public function contact(Request $request)
    {
        $data = $request->except('_token');
        try {
            $status = ContactUs::query()->create($data);
            if ($status) {
                session()->flash('success', 'Successfully Send Data!');
                return to_route('index');
            }
            session()->flash('error', 'Not Successfully Send Data Please Try Again!');
            return to_route('index');
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors(['error' => $ex->getMessage()]);
        }
    }

    public function subscriptions()
    {
        $data = $this->data();

        return view("frontend.pages.subscriptions.index", compact("data"));
    }

    public function data(): array
    {
        $data['slider'] = Slider::query()->where('status', 'active')->orderBy('created_at', 'DESC')->get();

        $data['subscription'] = Subscription::query()->where('status', 'active')->get();

        return $data;
    }

    public function product_details($slug)
    {
        $product = Product::query()->where('slug', $slug)->first();

        $more_products =  Product::query()->with('user')->where('slug', '!=', $slug)
            ->where(function ($query) use ($product) {
                $query->where('title', 'like', "%{$product->title}%")
                    ->orderBy('created_at', 'DESC')
                    ->where('status', 'active');
            })->limit(10)->get();

        return view("frontend.pages.product.details", compact("product", 'more_products'));
    }

    public function categories()
    {
        $categories = Category::where('status', 'active')->orderBy('created_at', 'DESC')->paginate(self::count_data());
        return view('frontend.pages.category.index', compact('categories'));
    }

    public function sub_categories($slug)
    {
        $category =  Category::where('slug', $slug)->where(function ($query) {
            $query->where('status', 'active')->orderBy('created_at', 'DESC');
        })->with(['sub_categories' => function ($query) {
            $query->where('status', 'active')->orderBy('created_at', 'DESC')->get();
        }])->first();
        return view('frontend.pages.subcategory.index', compact('category'));
    }

    public function products($slug)
    {
        $sub_category = SubCategory::where('slug', $slug)->where(function ($query) {
            $query->where('status', 'active')->orderBy('created_at', 'DESC');
        })->with(['products' => function ($query) {
            $query->where('status', 'active')->orderBy('created_at', 'DESC')->get();
        }])->first();
        return view('frontend.pages.product.index', compact('sub_category'));
    }

    public function contactus()
    {
        return view('frontend.pages.contact.index');
    }

    public function profile()
    {
        return view('frontend.pages.profile.index');
    }
    public function all_products()
    {
        $data['products'] = Product::query()->where('status', 'active')->orderBy("created_at", 'DESC')
            ->paginate(self::count_data());
        return view('frontend.pages.product.all_products', compact('data'));
    }

    public function my_products()
    {
        $products = Auth::user()->products()->orderBy('created_at', 'DESC')->paginate(self::count_data());
        return view('frontend.pages.product.my_products', compact('products'));
    }

    public function product_create()
    {
        $data = self::get_data_product();
        return view('frontend.pages.product.create', compact('data'));
    }

    public function product_store(Request $request)
    {
        $data = $this->data_products($request);
        $data['slug'] = $request->input('title');
        return $this->systemServices->createSystem(Product::query(), $data, 'Product', null, $request);
    }

    public function product_edit(string $slug)
    {
        $data = self::get_data_product();
        $data['product'] = Product::query()->where('slug', $slug)->first();

        return view('frontend.pages.product.edit', compact('data'));
    }

    public function product_update(Request $request, string $slug)
    {
        $data = $this->data_products($request);
        return $this->systemServices->editSystem(Product::query(), $slug, $data, 'Product', null, $request);
    }

    public function product_destroy(string $slug)
    {
        return $this->systemServices->deleteSystem(Product::query(), $slug, "product");
    }

    public function invoice()
    {
        $orders = Auth::user()->load('orders');
        return view('frontend.pages.invoice.index', compact('orders'));
    }

    public function setting()
    {
        $countries = Cache::rememberForever('countries', function () {
            return Country::query()->orderBy('created_at', 'DESC')->get();
        });
        $lastLogin = Auth::user()->load(['last_logins' => function ($query) {
            $query->orderBy('created_at', 'desc')->limit(5);
        }]);
        return view('frontend.pages.setting.index', compact('countries', 'lastLogin'));
    }

    public function delete_account($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->delete();
        }
        return redirect()->back()->with('error', 'Not Found Account Please Try Again!');
    }

    public function checkout($subscription)
    {
        $subscription = Subscription::findOrFail($subscription);
        return view('frontend.pages.payment.checkout', compact('subscription'));
    }

    public function data_products($request): array
    {
        $data = $request->except('_token', 'photo', 'title', 'title_en', 'description', 'description_en', 'meta_description', 'meta_description_en');
        $data['title'] = ['ar' => $request->input('title'), 'en' => $request->input('title_en')];
        $data['meta_description'] = ['ar' => $request->input('meta_description'), 'en' => $request->input('meta_description_en')];
        $data['description'] = ['ar' => $request->input('description'), 'en' => $request->input('description_en')];
        $data['user_id'] = auth()->user()->id;

        return $data;
    }
}
