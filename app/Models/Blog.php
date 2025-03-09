<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    // createメソッドによる一括代入を可能にする
    protected $fillable = [ 'title', 'image', 'body' ];
}
// <img class="w-12 h-12 mr-4 object-cover rounded-md" src="http://localhost/storage/blogs/CsbRiLPU8u5h6tI2zdJoYD4ccvW3qABZ1OOC3vyj.png" alt="">
