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
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
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
        // dd($request->input('type_comment'));
        $parentBr = null;
        if ($request->has('parent_id')) {
            $data = $this->comment->with('products')->where([
                'status' => 0,
                'parent_id' => $request->input('parent_id'),
                'type_comment' => $request->input('type_comment'),
            ])->orderBy("id", "desc")->paginate(15);
            if ($request->input('parent_id')) {
                $parentBr = $this->comment->find($request->input('parent_id'));
            }
        } else {
            $data = $this->comment->with('products')->where([
                'status' => 0,
                // 'parent_id' => 0,
                'type_comment' => $request->input('type_comment'),
            ])->orderBy("id", "desc")->paginate(15);
        }

        $title = $request->input('type_comment') == 1 ? 'bình luận' : 'đánh giá sao';

        return view(
            "admin.pages.comment.list",
            [
                'data' => $data,
                'parentBr' => $parentBr,
                'title' => $title,
                'type_comment' => $request->input('type_comment'),
            ]
        );
    }

    public function create(Request $request)
    {
        try {
            DB::beginTransaction();
            $dataContactCreate = [
                'name' => "Quản trị viên",
                'phone' => "",
                'email' => "",
                'danh_xung' => 1,
                'user_id' => Auth::check() ? Auth::user()->id : 0,
                "parent_id" => $request->parent_id ? $request->parent_id : 0,
                'content' => $request->input('content') ?? null,
                'like' => 0,
                'share' => 0,
                'type_comment' => $request->type_comment ?? 0,
                'stars' => $request->star ?? 0,
                'status' => 1, // Đã trả lời
            ];


            $comment = Comment::create($dataContactCreate);

            $product = Product::find($request->product_id);
            $product->comments()->attach($comment->id);

            // Đã được quản trị trả lời
            Comment::find($request->parent_id)->update(['status' => 1]);

            DB::commit();
            return response()->json([
                "code" => 200,
                "message" => "success"
            ], 200);
        } catch (\Exception $exception) {
            //throw $th;
            DB::rollBack();
            // dd($exception);
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return response()->json([
                "code" => 500,
                "message" => "fail"
            ], 500);
        }
    }

    public function edit($id)
    {
        $data = $this->comment->find($id);
        $parentId = $data->parent_id;
        return view("admin.pages.comment.edit", [
            'data' => $data
        ]);
    }

    public function update(ValidateEditcomment $request, $id)
    {
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
