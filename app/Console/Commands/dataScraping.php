<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\User;
use Goutte\Client;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class dataScraping extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'data-scraping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $dataCategory = [];
        $dataProducts = [];
        $customer_count = User::count();

        $client = new Client();

        $crawler = $client->request('GET', 'https://www.egyptianindustry.com/');

        // Filter Parent Element
        $crawler->filter('.panel-body')->each(function ($child) use ($client, &$dataCategory, &$dataProducts, $customer_count) {

            $child->filter('#demo #examples p a')->each(function ($anchor) use ($client, &$dataCategory, &$dataProducts, $customer_count) {
                if ($anchor) {
                    $url = $anchor->attr("href");
                    // Find the position of "SearchR/" and "/Page"
                    $start = strpos($url, "Industry/") + strlen("Industry/");
                    $end = strpos($url, "/", $start);

                    // Extract the substring containing the ID
                    $category_id = substr($url, $start, $end - $start);
                    $titleCateory = $anchor->text();
                    $category = [];
                    $category['id'] = $category_id;
                    $category['title'] = $titleCateory;
                    $category['slug'] = str()->slug($titleCateory);
                    $category['description'] = [
                        "ar" => 'مرحبًا، إنه لأمر مؤلم حقًا متابعة السمنة. شيء عن تلك الرغبة في بعض الأحيان',
                        "en" => 'Lorem, ipsumin dolor sit amet consecteturs adipisicing elit. Aliquid cupiditate illo tempora'
                    ];
                    $category['photo'] = "mohamad";
                    $category['status'] = 'inactive';
                    $category['admin_id'] = 1;

                    $dataCategory[] = $category;
                    $link = $anchor->link();
                    $categoryPage = $client->click($link);
                    $categoryPage->filter('.categories-box .f-listings-item')->each(function ($product) use (&$dataProducts, $category_id, $customer_count) {
                        $products = [];
                        $product->filter('.f-listings-item__media .row .col-md-8 h1 a')->each(function ($productDetails) use (&$products) {
                            $productTitle = $productDetails->text();
                            $products['title'] = $productTitle;
                            $products['slug'] = str()->slug($productTitle);
                        });
                        $products['meta_description'] = [
                            "ar" => 'مرحبًا، إنه لأمر مؤلم حقًا متابعة السمنة. شيء عن تلك الرغبة في بعض الأحيان',
                            "en" => 'Lorem, ipsumin dolor sit amet consecteturs adipisicing elit. Aliquid cupiditate illo tempora'
                        ];
                        $products['description'] = [
                            "ar" => "مرحبًا، إنه لأمر مؤلم حقًا متابعة السمنة. دع الزمن يهرب من الشيء بتلك الرغبة، فاللين أبدًا، ولا بهذا الألم والألم والاختيار، ولكن العقل سيفسر كل هروبنا.",
                            "en" => "Lorem, ipsumin dolor sit amet consecteturs adipisicing elit. Aliquid cupiditate illo tempora fugiat rem, mollitia numquam vel enim eaque dolor dolorem atque delectus at ratione omnis consectetur explicabo nostrum fugit.",
                        ];

                        $products['price'] = 0;
                        $products['category_id'] = $category_id;
                        $products['photo'] = "mohamad";
                        $products['sub_category_id'] = null;
                        $products['measuring_unit_id'] = 1;
                        $products['user_id'] = rand(0, $customer_count);
                        $products['offers'] = 0.00;
                        $products['quantity'] = "100";
                        $products['country_id'] = 65;
                        $products['status'] = "inactive";
                        $dataProducts[] = $products;
                    });
                }
            });
        });
        $saveCategory = json_encode($dataCategory, JSON_UNESCAPED_UNICODE);
        // Generate a unique filename
        $filename =  'data.json';
        // Store the JSON data in the specified directory
        Storage::disk('public')->put('category/' . $filename, $saveCategory);

        $saveProducts = json_encode($dataProducts, JSON_UNESCAPED_UNICODE);
        // Store the JSON data in the specified directory
        Storage::disk('public')->put('products/' . $filename, $saveProducts);
        Log::info("Successfully Scraping Data");
    }
}
