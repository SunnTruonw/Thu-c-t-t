<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Post;
use App\Models\Slider;
use App\Models\Attribute;
use App\Models\CategoryPost;
use App\Models\CategoryProduct;
use App\Models\PostTranslation;
use App\Models\ProductTranslation;
use App\Models\CategoryPostTranslation;
use App\Models\ProductAttribute;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $product;
    private $setting;
    private $slider;
    private $attribute;
    private $productAttribute;
    private $post;
    private $categoryPost;
    private $categoryProduct;
    private $postTranslation;
    private $categoryPostTranslation;
    private $productTranslation;
    private $productSearchLimit  = 4;
    private $postSearchLimit     = 6;
    private $idCategoryProductRoot = 185;
    private $limitProduct = 12;

    private $productHotLimit     = 10;
    private $productNgocLimit     = 8;
    private $productSaleLimit     = 8;
    private $productNewLimit     = 8;
    private $phukienLimit     = 4;
    private $productViewLimit    = 8;
    private $productPayLimit     = 8;
    private $sliderLimit         = 8;
    private $postsHotLimit       = 8;
    private $unit                = 'đ';
    public function __construct(
        Product $product,
        Setting $setting,
        Slider $slider,
        Post $post,
        Attribute $attribute,
        ProductAttribute $productAttribute,
        CategoryPost $categoryPost,
        CategoryProduct $categoryProduct,
        PostTranslation $postTranslation,
        CategoryPostTranslation $categoryPostTranslation,
        ProductTranslation $productTranslation
    ) {
        /*$this->middleware('auth');*/
        $this->product = $product;
        $this->setting = $setting;
        $this->slider = $slider;
        $this->post = $post;
        $this->attribute = $attribute;
        $this->productAttribute = $productAttribute;
        $this->categoryPost = $categoryPost;
        $this->categoryProduct = $categoryProduct;
        $this->postTranslation = $postTranslation;
        $this->categoryPostTranslation = $categoryPostTranslation;
        $this->productTranslation = $productTranslation;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    // public function index()
    // {
    //     return view('home');
    // }
    public function index(Request $request)
    {
        $listId = $this->categoryPost->getALlCategoryChildrenAndSelf(70);
        $post_home = $this->post->whereIn('category_id', $listId)->where('active', 1)->where('hot', 1)->get();
        $postTitle = $this->categoryPost->where('active', 1)->find(62);
        $listId = $this->categoryPost->getALlCategoryChildrenAndSelf(70);
        $post_home_video = $this->post->whereIn('category_id', $listId)->where('active', 1)->where('hot', 1)->get();

        $listIdProduct = $this->categoryProduct->getALlCategoryChildrenAndSelf(185);
        $categories = $this->categoryProduct->where([
            ['active', 1],
            ['hot', 1],
        ])->orderBy('order')->limit(12)->get();

        $listIdPro = $this->productAttribute->where('attribute_id', 2)->pluck('product_id');

        $products = $this->product->whereIn('id', $listIdPro)->limit(10)->get();

        if ($request->ajax()) {
            $productAttr = $this->productAttribute;
            $data = $this->product;

            $listIdPro = $productAttr->where('attribute_id', $request->idAttribute)->pluck('product_id');

            $data = $data->whereIn('id', $listIdPro);

            $data = $data->latest()->limit(10)->get();

            return response()->json([
                "code" => 200,
                "html" => view('frontend.components.load-product-filter', [
                    'data' => $data,
                    'unit' => $this->unit,
                ])->render(),
                "message" => "success"
            ], 200);
        }


        // sản phẩm nổi bật
        $productsHot = $this->product->where([
            ['active', 1],
            ['hot', 1],
        ])->latest()->limit($this->productHotLimit)->get();
        // sản phẩm sale
        $listIdCategory = $this->categoryProduct->getALlCategoryChildrenAndSelf(185);
        // $categoryProductHome = $this->categoryProduct->find(239);
        $categoryProductHome = $this->categoryProduct->where([
            ['active', 1],
            ['hot', 1],
        ])->whereIn('id', $listIdCategory)->latest()->limit($this->phukienLimit)->get();

        // sản phẩm mới
        $productsNew = $this->product->where([
            ['active', 1]
        ])->latest()->limit($this->productNewLimit)->get();

        $productsBest = $this->product->where([
            ['active', 1],
            ['sp_km', 1],
        ])->latest()->limit($this->productHotLimit)->get();

        $productsHeart = $this->product->where([
            ['active', 1],
            ['sp_ngoc', 1],
        ])->latest()->limit($this->productHotLimit)->get();
        $slidesub = $this->setting->find(342);
        $hotro = $this->setting->find(337);
        $slide_in = $this->setting->find(290);
        $camnhan = $this->setting->find(302);
        $camnhan2 = $this->setting->find(304);
        $thongtin_danhmucsp = $this->setting->find(239);
        $dichvu = $this->setting->find(287);
        $banner = $this->setting->where('parent_id', 287)->where('active', 1)->orderBy('order')->orderByDesc('created_at')->get();
        $titleSMMoi = $this->setting->find(174);
        $titleSPBanchay = $this->setting->find(175);
        $titlePostNew = $this->setting->find(265);
        // // sản phẩm xem nhiều
        // $productsView = $this->product->where([
        //     ['active', 1],
        // ])->orderByDesc('view')->limit($this->productViewLimit)->get();
        // // sản phẩm mua nhiều
        // $productsPay = $this->product->where([
        //     ['active', 1],
        // ])->orderByDesc('pay')->limit($this->productPayLimit)->get();
        // // lấy slider
        $sliders = $this->slider->where([
            ['active', 1],
        ])->orderBy('order')->orderByDesc('created_at')->limit($this->sliderLimit)->get();
        // slidersMob
        $slidersM = $this->setting->where([
            ['active', 1],
            ['parent_id', 290],
        ])->orderBy('order')->orderByDesc('created_at')->limit($this->sliderLimit)->get();

        $bosuutapM = $this->setting->find(228);
        $khuyenMaiM = $this->setting->find(229);
        $dichvuM = $this->setting->find(222);
        $popM = $this->setting->find(230);
        // // bài viết nổi bật
        $postsHot = $this->post->where([
            ['active', 1],
            ['hot', 1],
            ['category_id', 56],
        ])->orderby('order')->orderByDesc('created_at')->limit(5)->get();

        // $bannerHome = $this->setting->find(18);

        $cate = $this->categoryProduct->getALlCategoryChildrenAndSelf(1);

        $cateProduct = $this->categoryProduct->find(185);

        $listCateHot = $this->categoryProduct->where('active', 1)->where('hot', 1)->orderBy('order')->orderByDesc('created_at')->get();
        $postNew = $this->post->whereIn('category_id', $cate)->where('active', '1')->orderByDesc('created_at')->limit(6)->get();

        $collection = $this->setting->find(167);

        $modalHome = $this->setting->where('active', 1)->find(177);

        // $video = $this->post->where('category_id', '33')->orderByDesc('created_at')->get();

        // $video_one = $this->post->where('category_id', '33')->orderByDesc('created_at')->first();

        // $supportHome = $this->setting->find(90);
        // $banner2Home = $this->setting->find(93);
        // $menuHome=$this->categoryProduct->where([
        //     'active'=>1,
        //     'parent_id'=>2
        // ])->orderby('order')->get();

        $attributes = $this->attribute->where('active', 1)->find(1);

        $supports = $this->setting->where('active', 1)->find(396);

        return view('frontend.pages.home', [
            'categories' => $categories,
            'postTitle' => $postTitle,
            'supports' => $supports,
            'post_home' => $post_home,
            'attributes' => $attributes,
            'products' => $products,
            'post_home_video' => $post_home_video,
            'categoryProductHome' => $categoryProductHome,
            // 'categoryProductHome2' => $categoryProductHome2,
            'productHot' => $productsHot,
            'cateProduct' => $cateProduct,
            'thongtin_danhmucsp' => $thongtin_danhmucsp,
            'modalHome' => $modalHome,
            'productsBest' => $productsBest,
            'productsHeart' => $productsHeart,
            'productNew' => $productsNew,
            // 'phukien' => $phukien,
            'hotro' => $hotro,
            'slidesub' => $slidesub,
            'camnhan' => $camnhan,
            'slide_in' => $slide_in,
            'camnhan2' => $camnhan2,
            'collection' => $collection,
            'dichvu' => $dichvu,
            'listCateHot' => $listCateHot,
            // 'productView' => $productsView,
            // 'productPay' => $productsPay,
            'postsHot'  => $postsHot,
            // // 'dataSettings' => $dataSettings,
            // 'video' => $video,
            // 'video_one' => $video_one,
            'postNew' => $postNew,
            "slider" => $sliders,
            "unit" => $this->unit,
            "banner" => $banner,
            "titleSMMoi" => $titleSMMoi,
            "titleSPBanchay" => $titleSPBanchay,
            "titlePostNew" => $titlePostNew,
            "slidersM" => $slidersM,
            "bosuutapM" => $bosuutapM,
            "khuyenMaiM" => $khuyenMaiM,
            "dichvuM" => $dichvuM,
            "popM" => $popM,
        ]);
    }

    public function renderProductView(Request $request)
    {
        if ($request->ajax()) {
            $listId = $request->id;
            $products = $this->product->whereIn('id', $listId)->where('active', 1)->limit(8)->get();
            //  dd($products);

            $html = view('frontend.components.load-view-product', compact('products'))->render();
            return response()->json(['data' => $html]);
        }
    }

    public function aboutUs(Request $request)
    {
        $resultCheckLang = checkRouteLanguage2();
        if ($resultCheckLang) {
            return $resultCheckLang;
        }
        $data = $this->categoryPost->find(71);

        // $postCateLeft = $this->post->whereIn('id', [24, 25, 26, 27, 28])->orderBy('id', 'ASC')->get();

        $breadcrumbs = [[
            'id' => $data->id,
            'name' => $data->name,
            'slug' => makeLinkToLanguage('about-us', null, null, \App::getLocale()),
        ]];

        //Về chúng tôi
        $about_us = $this->categoryPost->where('active', '1')->findOrFail(71);

        $partner = $this->setting->where('parent_id', '70')->orderBy('created_at', 'ASC')->limit(10)->get();

        return view("frontend.pages.about-us", [
            "data" => $data,
            // 'postCateLeft' => $postCateLeft,
            'breadcrumbs' => $breadcrumbs,
            'about_us' => $about_us,
            'partner' => $partner,
            'typeBreadcrumb' => 'about-us',
            'title' => $data ? $data->name : "",
            'category' => $data->category ?? null,
            'seo' => [
                'title' =>  $data->title_seo ?? "",
                'keywords' =>  $data->keywords_seo ?? "",
                'description' =>  $data->description_seo ?? "",
                'image' => $data->avatar_path ?? "",
                'abstract' =>  $data->description_seo ?? "",
            ]
        ]);
    }

    public function drugStore(Request $request)
    {
        $resultCheckLang = checkRouteLanguage2();
        if ($resultCheckLang) {
            return $resultCheckLang;
        }

        $listSystem = $this->setting->where('active', 1)->where('parent_id', 389)->orderBy('order')->latest()->get();

        $dataAddress = $this->setting->find(28);
        $map = $this->setting->find(33);
        $breadcrumbs = [
            [
                'name' => __('Hệ thống nhà thuốc'),
                'slug' => makeLinkToLanguage('drug-store', null, null, \App::getLocale()),
            ],
        ];

        if ($request->ajax()) {

            if ($request->id_address) {
                $id_address = $request->id_address;
                $map_selected = $this->setting->find($id_address);

                $output = $map_selected->description;

                echo $output;
            }
            if ($request->id_address_city) {
                $id_address_city = $request->id_address_city;

                $data = $this->setting->getALlCategoryProductChildren($id_address_city);
                $map_selected = $this->setting->find($data[0]);

                $output = $map_selected->description;
                echo $output;
            }
        } else {
            return view("frontend.pages.he-thong-nha-thuoc", [

                'breadcrumbs' => $breadcrumbs,
                'listSystem' => $listSystem,
                'typeBreadcrumb' => 'drug-store',
                'title' =>  "Hệ thống nhà thuốc",

                'seo' => [
                    'title' => "Hệ thống nhà thuốc",
                    'keywords' =>  "Hệ thống nhà thuốc",
                    'description' =>   "Hệ thống nhà thuốc",
                    'image' =>  "",
                    'abstract' =>  "Hệ thống nhà thuốc",
                ],

                "dataAddress" => $dataAddress,
                "map" => $map,
            ]);
        }
    }

    public function tuyen_dung(Request $request)
    {
        $resultCheckLang = checkRouteLanguage2();
        if ($resultCheckLang) {
            return $resultCheckLang;
        }
        $data = $this->categoryPost->find(39);

        $breadcrumbs = [[
            'id' => $data->id,
            'name' => $data->name,
            'slug' => makeLinkToLanguage('tuyen-dung', null, null, \App::getLocale()),
        ]];

        $categoryAll =  $this->post->where('category_id', $data->id)->paginate(9);

        $post_hot =  $this->post->where('category_id', $data->id)->where('hot', 1)->limit(4)->get();

        return view("frontend.pages.tuyendung", [
            "data" => $data,
            "categoryAll" => $categoryAll,
            "post_hot" => $post_hot,
            'breadcrumbs' => $breadcrumbs,
            'typeBreadcrumb' => 'tuyen-dung',
            'title' => $data ? $data->name : "",
            'category' => $data->category ?? null,
            'seo' => [
                'title' =>  $data->title_seo ?? "",
                'keywords' =>  $data->keywords_seo ?? "",
                'description' =>  $data->description_seo ?? "",
                'image' => $data->avatar_path ?? "",
                'abstract' =>  $data->description_seo ?? "",
            ]
        ]);
    }

    public function tuyendungDetail($slug)
    {
        $resultCheckLang = checkRouteLanguage2($slug);
        if ($resultCheckLang) {
            return $resultCheckLang;
        }

        $breadcrumbs = [];
        $data = [];

        $translation = $this->postTranslation->where([
            ["slug", $slug],
        ])->first();

        if ($translation) {
            $data = $translation->post;
            if (checkRouteLanguage($slug, $data)) {
                return checkRouteLanguage($slug, $data);
            }

            $categoryId = $data->category_id;
            $listIdChildren = $this->categoryPost->getALlCategoryChildrenAndSelf($categoryId);
            $dataRelate =  $this->post->whereIn('category_id', $listIdChildren)->where([
                ["id", "<>", $data->id],
            ])->limit(5)->get();
            $listIdParent = $this->categoryPost->getALlCategoryParentAndSelf($categoryId);
            foreach ($listIdParent as $parent) {
                $breadcrumbs[] = $this->categoryPost->select('id', 'name', 'slug')->find($parent)->toArray();
            }
            //Tin noi bat
            $post_hot =  $this->post->where('hot', 1)->orderByDesc('created_at')->limit(4)->get();

            return view('frontend.pages.tuyendung-detail', [
                'data' => $data,
                'post_hot' => $post_hot,
                "dataRelate" => $dataRelate,
                'breadcrumbs' => $breadcrumbs,
                'typeBreadcrumb' => 'tuyen-dung',
                'title' => $data ? $data->name : "",
                'category' => $data->category ?? null,
                'seo' => [
                    'title' =>  $data->title_seo ?? "",
                    'keywords' =>  $data->keywords_seo ?? "",
                    'description' =>  $data->description_seo ?? "",
                    'image' => $data->avatar_path ?? "",
                    'abstract' =>  $data->description_seo ?? "",
                ]
            ]);
        }
    }

    public function camnhan(Request $request)
    {
        $resultCheckLang = checkRouteLanguage2();
        if ($resultCheckLang) {
            return $resultCheckLang;
        }
        $camnhan = $this->setting->find(93);
        $breadcrumbs = [[
            'name' => 'Cảm nhận của khách hàng',
            'slug' => makeLinkToLanguage('camnhan', null, null, \App::getLocale()),
        ]];

        $listCategoryHome = $this->categoryProduct->where('parent_id', '76')->where('active', 1)->orderBy('created_at', 'ASC')->limit(4)->get();

        return view("frontend.pages.camnhan", [
            "data" => $camnhan,
            'breadcrumbs' => $breadcrumbs,
            'typeBreadcrumb' => 'camnhan',
            'seo' => [
                'title' =>  "Cảm nhận của khách hàng",
                'keywords' =>   "Cảm nhận của khách hàng",
                'description' =>    "Cảm nhận của khách hàng",
                'image' =>   "Cảm nhận của khách hàng",
                'abstract' =>   "Cảm nhận của khách hàng",
            ]
        ]);
    }

    public function storeAjax(Request $request)
    {
        //   dd($request->name);
        // dd($request->ajax());
        try {
            DB::beginTransaction();

            $dataContactCreate = [
                'name' => $request->input('name'),
                'phone' => $request->input('phone') ?? "",
                'email' => $request->input('email') ?? "",
                'sex' => $request->input('sex') ?? 1,
                'from' => $request->input('from') ?? "",
                'to' => $request->input('to') ?? "",
                'service' => $request->input('service') ?? "",
                'content' => $request->input('content') ?? null,
            ];
            //  dd($dataContactCreate);
            $contact = $this->contact->create($dataContactCreate);
            //  dd($contact);
            DB::commit();
            return response()->json([
                "code" => 200,
                "html" => 'ສົ່ງຂໍ້ຄວາມສຳເລັດ',
                "message" => "success"
            ], 200);
        } catch (\Exception $exception) {
            //throw $th;
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return response()->json([
                "code" => 500,
                'html' => 'ສົ່ງຂໍ້ຄວາມສຳເລັດ',
                "message" => "fail"
            ], 500);
        }
    }

    public function search(Request $request)
    {
        $dataProduct = $this->product;
        $dataPost = $this->post;
        $where = [];
        $req = [];
        if ($request->has('category_id')) {
            $categoryId = $request->category_id;
            $listIdChildren = $this->categoryProduct->getALlCategoryChildrenAndSelf($categoryId);
            $dataProduct =  $this->product->whereIn('category_id', $listIdChildren);
        }
        //  dd($dataProduct->get());
        if ($request->input('keyword')) {

            $dataProduct = $dataProduct->where(function ($query) {
                $idProTran = $this->productTranslation->where([
                    ['name', 'like', '%' . request()->input('keyword') . '%']
                ])->pluck('product_id');
                // dd($idProTran);
                $query->whereIn('id', $idProTran)->orWhere([
                    ['masp', 'like', '%' . request()->input('keyword') . '%']
                ]);
            });
        }
        // if ($where) {
        //     $dataProduct = $dataProduct->where($where)->orderBy("created_at", "DESC");
        //     $dataPost = $dataPost->where($where)->orderBy("created_at", "DESC");
        // }
        $dataProduct = $dataProduct->orderBy("order", "ASC")->orderBy("created_at", "DESC")->paginate($this->productSearchLimit);
        //   $dataPost = $dataPost->paginate($this->postSearchLimit);
        $breadcrumbs = [[
            'id' => null,
            'name' => __('search.ket_qua_tim_kiem'),
            //'slug' => makeLink('search', null, null, $req),
            'slug' => "",
        ]];
        // dd($dataProduct);
        return view("frontend.pages.search", [
            'breadcrumbs' => $breadcrumbs,
            'typeBreadcrumb' => 'search',
            'dataProduct' => $dataProduct,
            // 'dataPost' => $dataPost,
            'unit' => $this->unit,
            'seo' => [
                'title' =>  __('search.ket_qua_tim_kiem'),
                'keywords' => __('search.ket_qua_tim_kiem'),
                'description' => __('search.ket_qua_tim_kiem'),
                'image' => __('search.ket_qua_tim_kiem'),
                'abstract' => __('search.ket_qua_tim_kiem'),
            ]
        ]);
    }

    public function search_daily(Request $request)
    {

        $dataAddress = $this->setting->find(28);
        $map = $this->setting->find(33);
        $breadcrumbs = [
            [
                'name' => "ຕິດຕໍ່",
                'slug' => makeLink('contact'),
            ],
        ];

        // Thông tin mục hệ thống
        $system = $this->setting->where('id', '57')->where('active', 1)->orderByDesc('created_at')->first();

        // Thông tin item mục hệ thống
        $systemChilds = $this->setting->where('parent_id', '57')->where('active', 1)->orderByDesc('created_at')->limit(2)->get();

        $data = $request->all();
        $key = $request->input('keyword');
        if ($key) {
            $listAddress = $this->setting->where('parent_id', '28')->where('name', 'LIKE', '%' . $key . '%')->get();
        }

        return view("frontend.pages.contact", [

            'breadcrumbs' => $breadcrumbs,
            'systemChilds' => $systemChilds,
            'system' => $system,
            'listAddress' => $listAddress,
            'typeBreadcrumb' => 'contact',
            'title' =>  "Thông tin liên hệ",

            'seo' => [
                'title' => "Thông tin liên hệ",
                'keywords' =>  "Thông tin liên hệ",
                'description' =>   "Thông tin liên hệ",
                'image' =>  "",
                'abstract' =>  "Thông tin liên hệ",
            ],

            "dataAddress" => $dataAddress,
            "map" => $map,
        ]);
    }
}
