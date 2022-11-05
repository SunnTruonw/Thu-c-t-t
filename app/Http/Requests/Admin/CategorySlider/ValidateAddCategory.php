<?php

namespace App\Http\Requests\Admin\CategorySlider;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class ValidateAddCategory extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(auth()->guard('admin')->check()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                "name" => "required|min:1|max:191",
                "slug" => [
                    "nullable",
                    "min:1",
                    "max:191",
                   // 'unique:App\Models\CategoryProduct,slug',
                     Rule::unique("App\Models\CategorySlider",'slug')->where(function ($query) {

                    })
                ],
                "icon" => "mimes:jpeg,jpg,png,svg|nullable|max:3000",
                "avatar" => "mimes:jpeg,jpg,png,svg|nullable|max:3000",
                "active" => "required",
                "title_seo"=>"nullable|min:1|max:191",
                "description_seo"=>"nullable|min:1|max:191",
                "keyword_seo"=>"nullable|min:1|max:191",
        ];
    }
    public function messages()
    {
        return     [
            "name.required" => "Tên danh mục đã tồn tại",
            "name.min" => "Tên danh mục > 1 ký tự",
            "name.max" => "Tên danh mục < 191 ký tự",
            "slug.required" => "Đường dẫn is trường bắt buộc",
            "slug.unique" => "Đường dẫn  đã tồn tại",
            "icon.mimes" => "icon phải là định dạng jpeg,jpg,png,svg",
            "icon_path.max" => "icon  size < 3mb",
            "avatar.mimes" => "Ảnh đại diện phải là định dạng jpeg,jpg,png,svg",
            "avatar_path.max" => "Ảnh đại diện size < 3mb",
            "active.required" => "active  is required",
            "checkrobot.accepted" => "checkrobot category is accepted",
        ];
    }
}
