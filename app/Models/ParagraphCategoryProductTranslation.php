<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ParagraphCategoryProductTranslation extends Model
{
    //
    protected $table = "paragraph_category_product_translations";
    // public $fillable =['name'];
    protected $guarded = [];
    public function paragraph()
    {
        return $this->belongsTo(ParagraphCategoryProduct::class, 'paragraph_id', 'id');
    }
}
