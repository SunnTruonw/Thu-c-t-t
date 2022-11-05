<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\CategorySlider;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\StorageImageTrait;
use App\Traits\DeleteRecordTrait;
use App\Http\Requests\Admin\ValidateAddSlider;
use App\Http\Requests\Admin\ValidateEditSlider;
use Illuminate\Support\Facades\Storage;

class AdminSliderController extends Controller
{
    //
    use StorageImageTrait, DeleteRecordTrait;
    private $slider;
    private $langConfig;
    private $langDefault;
    public function __construct(Slider $slider, CategorySlider $categorySlider)
    {
        $this->slider = $slider;
        $this->categorySlider = $categorySlider;
        $this->langConfig = config('languages.supported');
        $this->langDefault = config('languages.default');
    }
    //
    public function index(Request $request)
    {
        $data = $this->slider->with('category');
        if ($request->input('category')) {
            $categorySliderId = $request->input('category');
            $idCategorySearch = $this->categorySlider->getALlCategoryChildren($categorySliderId);
            $idCategorySearch[] = (int)($categorySliderId);
            $data = $data->whereIn('category_id', $idCategorySearch);
            $htmlselect = $this->categorySlider->getHtmlOption($categorySliderId);
        } else {
            $htmlselect = $this->categorySlider->getHtmlOption();
        }
        $where = [];
        if ($request->input('keyword')) {
            $where[] = ['name', 'like', '%' . $request->input('keyword') . '%'];
        }
        if ($where) {
            $data = $data->where($where);
        }
        if ($request->input('order_with')) {
            $key = $request->input('order_with');
            switch ($key) {
                case 'dateASC':
                    $orderby = ['created_at'];
                    break;
                case 'dateDESC':
                    $orderby = [
                        'created_at',
                        'DESC'
                    ];
                    break;
                case 'viewASC':
                    $orderby = [
                        'view',
                        'ASC'
                    ];
                    break;
                case 'viewDESC':
                    $orderby = [
                        'view',
                        'DESC'
                    ];
                    break;
                default:
                    $orderby =  $orderby = [
                        'created_at',
                        'DESC'
                    ];
                    break;
            }
            $data = $data->orderBy(...$orderby);
        } else {
            $data = $data->orderBy("created_at", "DESC");
        }
        $data = $data->paginate(15);

        return view(
            "admin.pages.slider.list",
            [
                'data' => $data,
                'option' => $htmlselect,
                'keyword' => $request->input('keyword') ? $request->input('keyword') : "",
                'order_with' => $request->input('order_with') ? $request->input('order_with') : "",
                'fill_action' => $request->input('fill_action') ? $request->input('fill_action') : "",
            ]
        );
    }
    public function create(Request $request = null)
    {
        $htmlselect = $this->categorySlider->getHtmlOption();

        return view(
            "admin.pages.slider.add",
            [
                'request' => $request,
                'option' => $htmlselect,

            ]
        );
    }
    public function store(ValidateAddSlider $request)
    {
        try {
            DB::beginTransaction();
            $dataSliderCreate = [
                "active" => $request->active,
                'order' => $request->order,
                "category_id" => $request->input('category_id'),
                "admin_id" => auth()->guard('admin')->id()
            ];
            //   dd($dataSliderCreate);
            $dataUploadAvatar = $this->storageTraitUpload($request, "image_path", "slider");
            if (!empty($dataUploadAvatar)) {
                $dataSliderCreate["image_path"] = $dataUploadAvatar["file_path"];
            }

            $slider = $this->slider->create($dataSliderCreate);
            //  dd($slider);
            // insert data product lang
            $dataSliderTranslation = [];
            foreach ($this->langConfig as $key => $value) {
                $itemSliderTranslation = [];
                $itemSliderTranslation['name'] = $request->input('name_' . $key) ?? '';
                $itemSliderTranslation['slug'] = $request->input('slug_' . $key) ?? '';
                $itemSliderTranslation['description'] = $request->input('description_' . $key);
                $itemSliderTranslation['language'] = $key;
                $dataSliderTranslation[] = $itemSliderTranslation;
            }
            //  dd($dataSliderTranslation);
            $sliderTranslation =   $slider->translations()->createMany($dataSliderTranslation);
            // dd($sliderTranslation);
            DB::commit();
            return redirect()->route("admin.slider.index")->with("alert", "Thêm  thành công");
        } catch (\Exception $exception) {
            // dd($exception);
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.slider.index')->with("error", "Thêm  không thành công");
        }
    }
    public function edit($id)
    {
        $data = $this->slider->find($id);
        $category_id = $data->category_id;
        $htmlselect = $this->categorySlider->getHtmlOption($category_id);
        return view("admin.pages.slider.edit", [
            'data' => $data,
            'option' => $htmlselect,
        ]);
    }
    public function update(ValidateEditSlider $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataSliderUpdate = [
                "active" => $request->active,
                'order' => $request->order,
                "category_id" => $request->input('category_id'),
                "admin_id" => auth()->guard('admin')->id()
            ];
            //  dd($dataCategoryPostUpdate);

            $dataUpdateAvatar = $this->storageTraitUpload($request, "image_path", "slider");
            if (!empty($dataUpdateAvatar)) {
                $path = $this->slider->find($id)->image_path;
                if ($path) {
                    Storage::delete($this->makePathDelete($path));
                }
                $dataSliderUpdate["image_path"] = $dataUpdateAvatar["file_path"];
            }

            $this->slider->find($id)->update($dataSliderUpdate);
            $slider = $this->slider->find($id);
            $dataSliderTranslationUpdate = [];
            foreach ($this->langConfig as $key => $value) {
                $itemSliderTranslationUpdate = [];
                $itemSliderTranslationUpdate['name'] = $request->input('name_' . $key) ?? '';
                $itemSliderTranslationUpdate['slug'] = $request->input('slug_' . $key) ?? '';
                $itemSliderTranslationUpdate['description'] = $request->input('description_' . $key);
                $itemSliderTranslationUpdate['language'] = $key;
                if ($slider->translationsLanguage($key)->first()) {
                    $slider->translationsLanguage($key)->first()->update($itemSliderTranslationUpdate);
                } else {
                    $slider->translationsLanguage($key)->create($itemSliderTranslationUpdate);
                }
            }
            DB::commit();
            return redirect()->route("admin.slider.index")->with("alert", "Sửa  thành công");
        } catch (\Exception $exception) {
            //throw $th;
            dd($exception);
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.slider.index')->with("error", "Sửa  không thành công");
        }
    }
    public function destroy($id)
    {
        return $this->deleteTrait($this->slider, $id);
    }

    public function loadActive($id)
    {
        $slider   =  $this->slider->find($id);
        $active = $slider->active;
        if ($active) {
            $activeUpdate = 0;
        } else {
            $activeUpdate = 1;
        }
        $updateResult =  $slider->update([
            'active' => $activeUpdate,
        ]);
        $slider   =  $this->slider->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-active', ['data' => $slider, 'type' => 'slider'])->render(),
                "message" => "success"
            ], 200);
        } else {
            return response()->json([
                "code" => 500,
                "message" => "fail"
            ], 500);
        }
    }
}
