<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Traits\StorageImageTrait;
use App\Traits\DeleteRecordTrait;
use App\Http\Requests\Admin\ValidateAddQuestion;
use App\Http\Requests\Admin\ValidateEditQuestion;
use Illuminate\Support\Facades\Storage;

class AdminQuestionController extends Controller
{
    //
    use DeleteRecordTrait, StorageImageTrait;
    private $question;
    private $langConfig;
    private $langDefault;

    public function __construct(Question $question)
    {
        $this->question = $question;
        $this->langConfig = config('languages.supported');
        $this->langDefault = config('languages.default');
    }
    public function index(Request $request)
    {
        $parentBr = null;
        if ($request->has('parent_id')) {
            $data = $this->question->where('parent_id', $request->input('parent_id'))->orderBy("id", "desc")->paginate(15);
            if ($request->input('parent_id')) {
                $parentBr = $this->question->find($request->input('parent_id'));
            }
        } else {
            $data = $this->question->where('parent_id', 0)->orderBy("id", "desc")->paginate(15);
        }
        return view(
            "admin.pages.question.list",
            [
                'data' => $data,
                'parentBr' => $parentBr,
            ]
        );
    }
    public function create(Request $request)
    {
        if ($request->has("parent_id")) {
            $htmlselect = $this->question->getHtmlOptionAddWithParent($request->parent_id);
        } else {
            $htmlselect = $this->question->getHtmlOption();
        }
        return view(
            "admin.pages.question.add",
            [
                'option' => $htmlselect,
                'request' => $request
            ]
        );
    }
    public function store(ValidateAddQuestion $request)
    {
        try {
            DB::beginTransaction();
            $dataQuestionCreate = [
                "active" => $request->active,
                'order' => $request->order,
                "parent_id" => $request->parent_id ? $request->parent_id : 0,
            ];

            $question = $this->question->create($dataQuestionCreate);
            // dd($question);

            // insert data product lang
            $dataQuestionTranslation = [];
            foreach ($this->langConfig as $key => $value) {
                $itemQuestionTranslation = [];
                $itemQuestionTranslation['name'] = $request->input('name_' . $key);
                $itemQuestionTranslation['value'] = $request->input('value_' . $key);
                $itemQuestionTranslation['language'] = $key;
                $dataQuestionTranslation[] = $itemQuestionTranslation;
            }
            //  dd($question->translations());
            $questionTranslation =   $question->translations()->createMany($dataQuestionTranslation);
            //  dd($questionTranslation);
            DB::commit();
            return redirect()->route("admin.question.index", ['parent_id' => $request->parent_id])->with("alert", "Thêm câu hỏi thành công");
        } catch (\Exception $exception) {
            DB::rollBack();
            dd($exception);
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.question.index', ['parent_id' => $request->parent_id])->with("error", "Thêm câu hỏi không thành công");
        }
    }
    public function edit($id)
    {
        $data = $this->question->find($id);
        $parentId = $data->parent_id;
        $htmlselect = Question::getHtmlOptionEdit($parentId, $id);
        return view("admin.pages.question.edit", [
            'option' => $htmlselect,
            'data' => $data
        ]);
    }
    public function update(ValidateEditQuestion $request, $id)
    {
        try {
            DB::beginTransaction();
            $dataQuestionUpdate = [
                "active" => $request->active,
                'order' => $request->order,
                "parent_id" => $request->parent_id ? $request->parent_id : 0,
            ];
            $this->question->find($id)->update($dataQuestionUpdate);
            $question = $this->question->find($id);
            $dataQuestionTranslationUpdate = [];
            foreach ($this->langConfig as $key => $value) {
                $itemQuestionTranslationUpdate = [];
                $itemQuestionTranslationUpdate['name'] = $request->input('name_' . $key);
                $itemQuestionTranslationUpdate['value'] = $request->input('value_' . $key);
                $itemQuestionTranslationUpdate['language'] = $key;
                if ($question->translationsLanguage($key)->first()) {
                    $question->translationsLanguage($key)->first()->update($itemQuestionTranslationUpdate);
                } else {
                    $question->translationsLanguage($key)->create($itemQuestionTranslationUpdate);
                }
            }
            DB::commit();
            return redirect()->route("admin.question.index", ['parent_id' => $request->parent_id])->with("alert", "Sửa câu hỏi thành công");
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error('message' . $exception->getMessage() . 'line :' . $exception->getLine());
            return redirect()->route('admin.question.index', ['parent_id' => $request->parent_id])->with("error", "Sửa câu hỏi không thành công");
        }
    }
    public function destroy($id)
    {
        return $this->deleteCategoryRecusiveTrait($this->question, $id);
    }
}
