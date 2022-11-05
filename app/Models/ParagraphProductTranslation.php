<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParagraphProductTranslation extends Model
{
    protected $table = "paragraph_product_translations";
    // public $fillable =['name'];
    protected $guarded = [];
    public function paragraph()
    {
        return $this->belongsTo(ParagraphProduct::class, 'paragraph_id', 'id');
    }
}
