<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
/**
 *
 */
trait CategoryTrait
{
    public function index(Request $request)
    {
        $parentBr = null;
        if ($request->has('parent_id')) {
            $data = $this->categoryModel->where('parent_id', $request->input('parent_id'))->orderby('order')->orderBy("created_at", "desc")->paginate(15);
            if ($request->input('parent_id')) {
                $parentBr = $this->categoryModel->find($request->input('parent_id'));
            }
        } else {
            $data = $this->categoryModel->where('parent_id', 0)->orderby('order')->orderBy("created_at", "desc")->paginate(15);
        }

        //  dd(config('excel_database.category_product.title'));
        //  dd( view(
        //      "admin.pages.categoryproduct.list",
        //      [
        //          'data' => $data
        //      ]
        //  )->renderSections()['content']);
        return view("admin.pages.category.list",
            [
                'data' => $data,
                'parentBr' => $parentBr,
                'categoryConfig' => $this->categoryConfig,
            ]
        );
    }

    public function create(Request $request)
    {
        //    dd($request->query());
        if ($request->has("parent_id")) {
            $htmlselect = $this->categoryModel->getHtmlOptionAddWithParent($request->parent_id);
        } else {
            $htmlselect = $this->categoryModel->getHtmlOption();
        }

        return view("admin.pages.category.add",
            [
                'option' => $htmlselect,
                'request' => $request,
                'modelInstance'=>$this->categoryModel,
                'categoryConfig' => $this->categoryConfig,
            ]
        );
    }

    public function storeCategory($request)
    {
        try {
            DB::beginTransaction();
            $dataCategoryCreate =$request->only($this->categoryConfig['field']);
            $dataCategoryCreate["admin_id"] = auth()->guard('admin')->id();
            foreach ($this->categoryConfig['fieldFileSingle'] as $key => $value) {
                $dataUpdate = $this->storageTraitUpload($request, $value, $this->categoryConfig['table']);
                if (!empty($dataUpdate)) {
                    $dataCategoryCreate[$value] = $dataUpdate["file_path"];
                }
            }
          //  dd($dataCategoryCreate);
            $this->categoryModel->create($dataCategoryCreate);

            DB::commit();
            return redirect()->route($this->categoryConfig['routeNameIndex'], ['parent_id' => $request->parent_id])->with("alert", "Thêm danh mục ".$this->categoryConfig['type']." thành công");
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route($this->categoryConfig['routeNameIndex'], ['parent_id' => $request->parent_id])->with("error", "Thêm danh mục ".$this->categoryConfig['type']." không thành công");
        }
    }
    public function edit($id)
    {
        $data = $this->categoryModel->find($id);
        $parentId = $data->parent_id;
        $htmlselect = $this->categoryModel->getHtmlOptionEdit($parentId, $id);
        return view("admin.pages.category.edit", [
            'option' => $htmlselect,
            'data' => $data,
            'modelInstance'=>$this->categoryModel,
            'categoryConfig' => $this->categoryConfig,
        ]);
    }
    public function updateCategory($request, $id)
    {
        try {
            DB::beginTransaction();
            $dataCategoryUpdate =$request->only($this->categoryConfig['field']);
            $dataCategoryUpdate["admin_id"] = auth()->guard('admin')->id();
            foreach ($this->categoryConfig['fieldFileSingle'] as $key => $value) {
                $dataUpdate = $this->storageTraitUpload($request, $value, $this->categoryConfig['table']);
                if (!empty($dataUpdate)) {
                    $dataCategoryUpdate[$value] = $dataUpdate["file_path"];
                }
            }
            $this->categoryModel->find($id)->update($dataCategoryUpdate);
            DB::commit();
            return redirect()->route($this->categoryConfig['routeNameIndex'], ['parent_id' => $request->parent_id])->with("alert", "Sửa danh mục ".$this->categoryConfig['type']." thành công");
        } catch (\Exception $exception) {
            //throw $th;
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route($this->categoryConfig['routeNameIndex'], ['parent_id' => $request->parent_id])->with("error", "Sửa danh mục ".$this->categoryConfig['type']." không thành công");
        }
    }
    public function destroy($id)
    {
        return $this->deleteCategoryRecusiveTrait($this->categoryModel, $id);
    }
}
