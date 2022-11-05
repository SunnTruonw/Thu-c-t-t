<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Models\Setting;
use App\Models\Code;
use App\Models\CategoryPost;
use App\Models\CategoryProduct;
use App\Helper\CartHelper;
use App\Helper\CompareHelper;
use App\Models\Supplier;
use App\Models\Attribute;
use App\Models\Product;
use App\Models\Post;
use  Illuminate\Support\Facades\App;

trait GetDataTrait
{
    public function getDataHeaderTrait($setting)
    {
        $cart = new CartHelper();
        $totalQuantity =  $cart->getTotalQuantity();
        $compare = new CompareHelper();
        $totalCompareQuantity =  $compare->getTotalQuantity();

        $header['hotline'] = $setting->find(2);
        $header['email'] = $setting->find(3);
        $header['address'] = $setting->find(6);
        $header['title'] = $setting->find(89);
        $header['logo'] = $setting->find(13);
        $header['socialParent'] = $setting->find(11);
        $header['seo_home'] = $setting->find(211);
        $header['muahang'] = $setting->find(234);
        $header['tai_sao1'] = $setting->find(355);
        $header['search_top'] = $setting->find(368);
        $header['header_top'] = $setting->find(410);

        $header['tai_sao'] = $setting->find(238);
        $header['thuong_hieu'] = $setting->find(235);
        $header['uu_dai'] = $setting->find(236);
        $header['banhang'] = $setting->find(237);
        $header['hotline_top'] = $setting->find(238);
        $header['totalQuantity'] = $totalQuantity;
        $header['totalCompareQuantity'] = $totalCompareQuantity;

        $code = new Code();
        $header['google-anlytic'] = $code->find(1);
        $header['code-top'] = $code->find(2);
        $header['code-home'] = $code->find(4);
        $header['code-bottom'] = $code->find(3);

        $lang =   App::getLocale();

        $menuP = [];
        $categoryProduct = new CategoryProduct();


        // lấy megamenu
        $menuProduct = [];
        // $listCategoryProduct = $categoryProduct->where([
        //     'active' => 1,
        // ])->whereIn(
        //     'id',
        //     [258, 259]
        // )->orderby('order')->pluck('id');
        // foreach ($listCategoryProduct as $id) {
        //     array_push($menuProduct, menuRecusiveLimit($categoryProduct, $id));
        // }

        $header['hangNoiDia'] = $categoryProduct->select('id', 'icon_path')->where('active', 1)->find(258);
        $header['hangNgoaiDia'] = $categoryProduct->select('id', 'icon_path')->where('active', 1)->find(259);
        $header['meVaBe'] = $categoryProduct->select('id', 'icon_path')->where('active', 1)->find(700);
        $header['hangNgoaiDia1'] = $categoryProduct->select('id', 'icon_path')->where('active', 1)->find(582);
        $header['hangNgoaiDia2'] = $categoryProduct->select('id', 'icon_path')->where('active', 1)->find(581);



        // $listCategoryProduct = $categoryProduct->whereIn(
        //     'parent_id',
        //     [2]
        // )->orderby('order')->pluck('id');
        // foreach ($listCategoryProduct as $id) {
        //     array_push($menuM, menuRecusive($categoryProduct, $id));
        // }

        $categoryPost = new CategoryPost();
        // menu 1 
        $menuNew = [];
        // $listCategoryPost = $categoryPost->whereIn(
        //     'id',
        //     [71, 52, 70]
        // )->orderby('order')->pluck('id');

        // foreach ($listCategoryPost as $id) {
        //     array_push($menuNew, menuRecusive($categoryPost, $id));
        // }

        $header['menuNew'] = $categoryPost->whereIn('id', [62, 70])->select('id')->where('active', 1)->orderBy('order')->get();
        $header['heThongNhaThuoc'] = $categoryPost->select('id')->where('active', 1)->find(135);

        // $header['menu-product'] = [...$menuProduct];

        // dd($header['menu-product']);

        //$header['menu-new'] = [
        //[
        //    'name'=> __('home.home'),
        //    'slug_full'=>makeLink('home'),
        //    'childs'=>[
        //    ]
        //],
        // [
        //     'name'=>__('home.gioi_thieu'),
        //     'slug_full'=>makeLinkToLanguage('about-us',null,null,$lang),
        //     'childs'=>[
        //     ]
        // ],
        //     ...$menuNew,
        //     [
        //         'name' => __('home.lien_he'),
        //         'slug_full' => makeLinkToLanguage('contact', null, null, $lang),
        //     ],
        // ];

        // $header['menu_mobile'] =  [

        //     // ...$menuM,
        //     [
        //         'name' => __('home.lien_he'),
        //         'slug_full' => makeLinkToLanguage('contact', null, null, $lang),
        //     ],
        // ];

        // $menuGt = [];
        // $listCategoryPostGT = $categoryPost->where([
        //     'active' => 1
        // ])->whereIn(
        //     'id',
        //     [13]
        // )->orderby('order')->pluck('id');
        // foreach ($listCategoryPostGT as $id) {
        //     array_push($menuGt, menuRecusive($categoryPost, $id));
        // }

        return  $header;
    }

    public function getDataFooterTrait($setting)
    {
        $footer = [];
        $footer['dataAddress'] = $setting->find(19);
        $footer['linklienket'] = $setting->find(271);
        $footer['linklienket1'] = $setting->find(358);
        $footer['linklienket2'] = $setting->find(366);
        //$footer['linkFooter'] = $setting->find([37]);
        $footer['linkFooterBottom'] = $setting->find(97);
        $footer['registerSale'] = $setting->find(45);
        $footer['coppy_right'] = $setting->find(46);
        $footer['socialParent'] = $setting->find(47);
        $footer['pay'] = $setting->find(52);
        $footer['gutters'] = $setting->find(379);
        $footer['banner_bottom'] = $setting->find(384);
        $footer['drugStore'] = $setting->find(389);

        $footer['map'] = $setting->find(53);
        $footer['banner_shipping'] = $setting->find(75);
        $footer['banner_giua'] = $setting->find(78);
        $footer['logo_banner_shipping'] = $setting->find(77);
        $footer['nhan_tu_van'] = $setting->find(76);
        $footer['bocongthuong'] = $setting->find(155);
        $footer['maqr'] = $setting->find(66);
        //  $footer['about'] = $setting->find(100);
        $footer['doitac'] = $setting->find(346);
        $footer['timeWork'] = $setting->find(154);
        $footer['hotline'] = $setting->find(163);

        $footer['bct'] = $setting->find(241);
        $footer['dmca'] = $setting->find(242);
        $footer['bao_hanh'] = $setting->find(243);
        $footer['bao_hanh_hotline'] = $setting->find(255);
        $footer['mapss'] = $setting->find(284);

        $footer['zalo'] = $setting->find(246);

        $footer['messenger'] = $setting->find(245);

        $footer['sign_now'] = $setting->find(248);

        $categoryProduct = new CategoryProduct();
        $footer['listCategory'] = $categoryProduct->where([
            'active' => 1
        ])->whereIn(
            'parent_id',
            [2]
        )->orderby('order')->get();

        $categoryPost = new CategoryPost();
        $footer['listChinhsach'] = $categoryPost->where([
            'active' => 1
        ])->where(
            'id',
            '54'
        )->first();


        $footer['categoryProduct']  = $categoryProduct->setAppends(['count_product'])->whereIn(
            'parent_id',
            [0]
        )->get();
        $post = new Post();

        $footer['dieuKhoan'] = $post->where([
            'active' => 1,
            'id' => 5
        ])->first();



        $footer['chinhSach'] = $post->where([
            'active' => 1
        ])->find(6);

        return  $footer;
    }

    public function getDataSidebarTrait($categoryPost, $categoryProduct)
    {
        $sidebar = [];
        // lấy nhà cung cấp
        $supplier = new Supplier();
        $suppliers = $supplier->where('active', 1)->orderby('order')->get();
        $sidebar['supplier'] = $suppliers;
        // lấy thuộc tính
        $attribute = new Attribute();
        $attributes = $attribute->where([
            ['active', 1],
            ['parent_id', 0],
        ])->orderby('order')->get();
        $sidebar['attribute'] = $attributes;

        $setting = new Setting();
        // lấy sidebar
        $sidebar['banner'] = $setting->find(110);
        $sidebar['uudiem'] = $setting->find(108);
        $sidebar['slider'] = $setting->find(105);
        $sidebar['dichvu'] = $setting->find(287);
        $sidebar['support_online'] = $setting->find(269);
        // lấy product
        $product = new Product();
        $post = new Post();

        $pro1 = $product->where([
            ['active', 1]
        ])->orderByDesc('view')->limit(6)->get();

        $pro = $product->where([
            ['hot', 1],
            ['active', 1]
        ])->orderByDesc('created_at')->limit(6)->get();


        $sidebar['product'] = $pro;
        $sidebar['productViewHot'] = $pro1;
        $sidebar['categoryPost'] = $categoryPost->whereIn(
            'parent_id',
            [0]
        )->whereNotIn(
            'id',
            [14]
        )->get();

        $sidebar['categoryProduct']  = $categoryProduct->setAppends(['count_product'])->whereIn(
            'parent_id',
            [0]
        )->get();

        $sidebar['postsHot'] = $post->where([
            ['active', 1],
            ['hot', 1],
            ['category_id', 56],
        ])->orderby('order')->orderByDesc('created_at')->limit(5)->get();



        return  $sidebar;
    }
}
