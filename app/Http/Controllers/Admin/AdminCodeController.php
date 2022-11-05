<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Code;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\StorageImageTrait;
use App\Traits\DeleteRecordTrait;
use Illuminate\Support\Facades\Storage;

class AdminCodeController extends Controller
{
    //
    use StorageImageTrait, DeleteRecordTrait;
    private $code;
    private $langConfig;
    private $langDefault;
    public function __construct(Code $code)
    {
        $this->code = $code;
        $this->langConfig = config('languages.supported');
        $this->langDefault = config('languages.default');
    }
    //
    public function index()
    {
        $data = $this->code->orderBy("created_at", "desc")->paginate(15);

        return view(
            "admin.pages.code.list",
            [
                'data' => $data
            ]
        );
    }
    public function create(Request $request = null)
    {
        return view(
            "admin.pages.code.add",
            [
                'request' => $request
            ]
        );
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $dataCodeCreate = [
                "active" => $request->active,
                'order' => $request->order,
                "admin_id" => auth()->guard('admin')->id()
            ];
            //   dd($dataCodeCreate);
            $dataUploadAvatar = $this->storageTraitUpload($request, "image_path", "code");
            if (!empty($dataUploadAvatar)) {
                $dataCodeCreate["image_path"] = $dataUploadAvatar["file_path"];
            }

            $code = $this->code->create($dataCodeCreate);
            //  dd($code);
            // insert data product lang
            $dataCodeTranslation = [];
            foreach ($this->langConfig as $key => $value) {
                $itemCodeTranslation = [];
                $itemCodeTranslation['name'] = $request->input('name_' . $key);
                $itemCodeTranslation['slug'] = $request->input('slug_' . $key);
                $itemCodeTranslation['description'] = $request->input('description_' . $key);
                $itemCodeTranslation['language'] = $key;
                $dataCodeTranslation[] = $itemCodeTranslation;
            }
            //  dd($dataCodeTranslation);
            $codeTranslation =   $code->translations()->createMany($dataCodeTranslation);
            // dd($codeTranslation);
            DB::commit();
            return redirect()->route("admin.code.index")->with("alert", "Thêm  thành công");
        } catch (\Exception $exception) {
            dd($exception);
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.code.index')->with("error", "Thêm  không thành công");
        }
    }
    public function edit($id)
    {
        $data = $this->code->find($id);
        return view("admin.pages.code.edit", [
            'data' => $data
        ]);
    }
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataCodeUpdate = [
                "active" => $request->active,
                'order' => $request->order,
                "admin_id" => auth()->guard('admin')->id()
            ];
            //  dd($dataCategoryPostUpdate);

            $dataUpdateAvatar = $this->storageTraitUpload($request, "image_path", "code");
            if (!empty($dataUpdateAvatar)) {
                $path = $this->code->find($id)->image_path;
                if ($path) {
                    Storage::delete($this->makePathDelete($path));
                }
                $dataCodeUpdate["image_path"] = $dataUpdateAvatar["file_path"];
            }

            $this->code->find($id)->update($dataCodeUpdate);
            $code = $this->code->find($id);
            $dataCodeTranslationUpdate = [];
            foreach ($this->langConfig as $key => $value) {
                $itemCodeTranslationUpdate = [];
                $itemCodeTranslationUpdate['name'] = $request->input('name_' . $key);
                $itemCodeTranslationUpdate['slug'] = $request->input('slug_' . $key);
                $itemCodeTranslationUpdate['description'] = $request->input('description_' . $key);
                $itemCodeTranslationUpdate['language'] = $key;
                if ($code->translationsLanguage($key)->first()) {
                    $code->translationsLanguage($key)->first()->update($itemCodeTranslationUpdate);
                } else {
                    $code->translationsLanguage($key)->create($itemCodeTranslationUpdate);
                }
            }
            DB::commit();
            return redirect()->route("admin.code.index")->with("alert", "Sửa  thành công");
        } catch (\Exception $exception) {
            //throw $th;
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.code.index')->with("error", "Sửa  không thành công");
        }
    }
    public function destroy($id)
    {
        return $this->deleteTrait($this->code, $id);
    }

    public function loadActive($id)
    {
        $code   =  $this->code->find($id);
        $active = $code->active;
        if ($active) {
            $activeUpdate = 0;
        } else {
            $activeUpdate = 1;
        }
        $updateResult =  $code->update([
            'active' => $activeUpdate,
        ]);
        $code   =  $this->code->find($id);
        if ($updateResult) {
            return response()->json([
                "code" => 200,
                "html" => view('admin.components.load-change-active', ['data' => $code, 'type' => 'code'])->render(),
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
