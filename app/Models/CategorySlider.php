<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Components\Recusive;

class CategorySlider extends Model
{
    //
    protected $table = "category_sliders";
    public $parentId = "parent_id";
    protected $guarded = [];
    protected $appends = ['slug_full'];
    public function getBreadcrumbAttribute()
    {
        $listIdParent = $this->getALlCategoryParent($this->attributes['id']);
        $allData = $this->select('id', 'name', 'slug')->find($listIdParent)->toArray();
        return $allData;
    }
    public function getSlugFullAttribute()
    {
        return $this->attributes['slug'];
    }
    public static function getHtmlOption($parentId = "")
    {
        $data = self::select('id', 'name', 'parent_id')->get();
        $rec = new Recusive();
        // $prId=$this->parentId;
        return  $rec->categoryRecusive($data, 0, "parent_id", $parentId, "", "");
    }
    public static function getHtmlOptionEdit($parentId = "", $id)
    {
        $data = self::select('id', 'name', 'parent_id')->where('id', '<>', $id)->get();
        $rec = new Recusive();
        // $prId=$this->parentId;
        return  $rec->categoryRecusive($data, 0, "parent_id", $parentId, "", "");
    }

    // lấy html option có danh mục cha là $Id
    public static function getHtmlOptionAddWithParent($id)
    {
        $data = self::select('id', 'name', 'parent_id')->get();
        $parentId = $id;
        $rec = new Recusive();
        // $prId=$this->parentId;
        return  $rec->categoryRecusive($data, 0, "parent_id", $parentId, "", "");
    }


    // chỉ lấy html option có cha là id trở đi
    public static function getHtmlOptionOriginById($id, $parentId = "")
    {
        $data = self::select('id', 'name', 'parent_id')->get();
        $rec = new Recusive();
        // $prId=$this->parentId;
        return  $rec->categoryRecusive($data, $id, "parent_id", $parentId, "", "");
    }


    // get user was created category_posts
    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id', 'id');
    }
    public function sliders()
    {
        return $this->hasMany(Slider::class, 'category_id', 'id');
    }
    public function childs()
    {
        return $this->hasMany(CategorySlider::class, 'parent_id', 'id');
    }
    public function parent()
    {
        return $this->belongsTo(CategorySlider::class, 'parent_id', 'id');
    }

    public function getALlCategoryChildren($id)
    {
        $data = self::select('id', 'parent_id')->get();
        $rec = new Recusive();
        return  $rec->categoryRecusiveAllChild($data, $id);
    }
    public function getALlCategoryChildrenAndSelf($id)
    {
        $data = self::select('id', 'parent_id')->get();
        $rec = new Recusive();
        $arrID = $rec->categoryRecusiveAllChild($data, $id);
        array_unshift($arrID, $id);
        return  $arrID;
    }
    public function getALlCategoryParent($id)
    {
        $data = self::select('id', 'parent_id')->get();
        $rec = new Recusive();
        return  $rec->categoryRecusiveAllParent($data, $id);
    }
    public function getALlCategoryParentAndSelf($id)
    {
        $data = self::select('id', 'parent_id')->get();
        $rec = new Recusive();
        $arrID = $rec->categoryRecusiveAllParent($data, $id);

        array_push($arrID, $id);

        return  $arrID;
    }



    public function getALlModelCategoryChildrenAndSelf($parent, $limit = null, $data = null)
    {
        if (!$data) {
            $data = self::select('id', 'name', 'slug', 'parent_id')->where('active', 1)->orderby('order')->latest()->get();
        }
        $id = optional($parent)->id ?? 0;
        $rec = new Recusive();

        $slug_full = optional($parent)->slug_full;
        $parent = optional($parent)->toArray();
        $parent['slug_full'] = $slug_full;
        $data->map(function ($item, $key) {
            $item['slug_full'] = makeLinkProduct('category', $item['id'], $item['slug']);
            return $item;
        });


        $parent['childs'] = $rec->categoryModelRecusiveAllChild($data, $id, $limit);
        // $arrID = $rec->categoryModelRecusiveAllChild($data, $id,$limit);
        // array_unshift($arrID, $id);
        return  $parent;
    }
    public function getALlModelCategoryChildren($id, $limit = null, $data = null)
    {
        if (!$data) {
            $data = self::select('id', 'name', 'slug', 'parent_id')->where('active', 1)->orderby('order')->latest()->get();
        }

        $data->map(function ($item, $key) {
            $item['slug_full'] = makeLinkProduct('category', $item['id'], $item['slug']);
            return $item;
        });

        $rec = new Recusive();
        return  $rec->categoryModelRecusiveAllChild($data, $id, $limit);
    }
}
