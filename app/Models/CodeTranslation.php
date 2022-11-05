<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CodeTranslation extends Model
{
    //
    protected $table = "code_translations";
    // public $fillable =['name'];
    protected $guarded = [];
    public function code()
    {
        return $this->belongsTo(Code::class, 'code_id', 'id');
    }
}
