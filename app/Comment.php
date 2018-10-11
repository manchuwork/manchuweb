<?php

namespace App;
use App\Model;

class Comment extends Model
{
    // 评论所属文章
    public function post(){
        return $this->belongsTo('App\Post');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}

