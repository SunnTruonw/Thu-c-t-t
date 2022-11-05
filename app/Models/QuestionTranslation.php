<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionTranslation extends Model
{
    //
    protected $table = "question_translations";
    // public $fillable =['name'];
    protected $guarded = [];
    public function attribute()
    {
        return $this->belongsTo(Attribute::class, 'question_id', 'id');
    }
}
