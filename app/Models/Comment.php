<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Components\Recusive;

class Comment extends Model
{
    //
    // use SoftDeletes;
    protected $table = "comments";
    // public $fillable =['name'];
    protected $guarded = [];

    public function childs()
    {
        return $this->hasMany(Comment::class, 'parent_id', 'id');
    }

    public static function getALlCommentChildrenAndSelf($id)
    {
        $data = self::select('id', 'parent_id')->get();
        $rec = new Recusive();
        $arrID = $rec->categoryRecusiveAllChild($data, $id);
        array_unshift($arrID, $id);
        return  $arrID;
    }
}
