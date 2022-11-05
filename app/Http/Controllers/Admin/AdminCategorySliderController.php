<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategorySlider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

use App\Exports\ExcelExportsDatabase;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ExcelImportsDatabase;



use App\Http\Requests\Admin\CategorySlider\ValidateEditCategory;
use App\Http\Requests\Admin\CategorySlider\ValidateAddCategory;
use App\Traits\StorageImageTrait;
use App\Traits\DeleteRecordTrait;
use App\Traits\CategoryTrait;

//use PDF;
class AdminCategorySliderController extends Controller
{
    use StorageImageTrait, DeleteRecordTrait,CategoryTrait;
    private $categoryModel;
    private $categoryConfig;
    public function __construct(CategorySlider $categorySlider)
    {
        $this->categoryModel = $categorySlider;
        $this->categoryConfig = config('category.category_sliders');
    }
    //

    public function store(ValidateAddCategory $request){
        return $this->storeCategory($request);
    }
    public function update(ValidateEditCategory $request, $id){
        return $this->updateCategory($request, $id);
    }



    public function excelExportDatabase()
    {
        return Excel::download(new ExcelExportsDatabase(config('excel_database.categoryProduct')), config('excel_database.categoryProduct.excelfile'));
    }
    public function excelImportDatabase()
    {
        $path = request()->file('fileExcel')->getRealPath();
        Excel::import(new ExcelImportsDatabase(config('excel_database.categoryProduct')), $path);
    }
}
