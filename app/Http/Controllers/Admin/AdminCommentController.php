<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\StorageImageTrait;
use App\Traits\DeleteRecordTrait;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;

class AdminCommentController extends Controller
{
    //
    use DeleteRecordTrait, StorageImageTrait;
    private $comment;
    private $langConfig;
    private $langDefault;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
        $this->langConfig = config('languages.supported');
        $this->langDefault = config('languages.default');
    }
    public function index(Request $request)
    {
        $parentBr = null;
        if ($request->has('parent_id')) {
            $data = $this->comment->where('parent_id', $request->input('parent_id'))->orderBy("created_at", "desc")->paginate(15);
            if ($request->input('parent_id')) {
                $parentBr = $this->comment->find($request->input('parent_id'));
            }
        } else {
            $data = $this->comment->where('parent_id', 0)->orderBy("created_at", "desc")->paginate(15);
        }
        return view(
            "admin.pages.comment.list",
            [
                'data' => $data,
                'parentBr' => $parentBr,
            ]
        );
    }

    public function edit($id)
    {
        dd('đang xử lý');

        $data = $this->comment->find($id);
        $parentId = $data->parent_id;
        $htmlselect = comment::getHtmlOptionEdit($parentId, $id);
        return view("admin.pages.comment.edit", [
            'option' => $htmlselect,
            'data' => $data
        ]);
    }

    public function update(ValidateEditcomment $request, $id)
    {
        dd('đang xử lý');
        try {
            DB::beginTransaction();
            $datacommentUpdate = [
                "active" => $request->active,
                'order' => $request->order,
                "parent_id" => $request->parent_id ? $request->parent_id : 0,
                "admin_id" => auth()->guard('admin')->id()
            ];
            //  dd($datacommentUpdate);
            $this->comment->find($id)->update($datacommentUpdate);
            $comment = $this->comment->find($id);
            //  dd($comment);
            $datacommentTranslationUpdate = [];
            foreach ($this->langConfig as $key => $value) {
                $itemcommentTranslationUpdate = [];
                $itemcommentTranslationUpdate['name'] = $request->input('name_' . $key);
                //  $itemcommentTranslationUpdate['value'] = $request->input('value_' . $key);
                $itemcommentTranslationUpdate['language'] = $key;
                if ($comment->translationsLanguage($key)->first()) {
                    $comment->translationsLanguage($key)->first()->update($itemcommentTranslationUpdate);
                } else {
                    $comment->translationsLanguage($key)->create($itemcommentTranslationUpdate);
                }
            }
            DB::commit();
            return redirect()->route("admin.comment.index", ['parent_id' => $request->parent_id])->with("alert", "Sửa comment thành công");
        } catch (\Exception $exception) {
            //throw $th;
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.comment.index', ['parent_id' => $request->parent_id])->with("error", "Sửa comment không thành công");
        }
    }

    public function destroy($id)
    {
        return $this->deleteCategoryRecusiveTrait($this->comment, $id);
    }
}
