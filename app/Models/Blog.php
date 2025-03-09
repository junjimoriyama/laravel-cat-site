<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    // createメソッドによる一括代入を可能にする
    protected $fillable = [ 'title', 'image', 'body' ];
}
