<?php

namespace App;

use App\Model;

class Dict extends Model
{
    //
    public function user(){
        // 1个用户有多个 字典信息
        return $this->belongsTo(\App\User::class);// 遵循下面原则，可简写
        //return $this->belongsTo('App\User');// 遵循下面原则，可简写

    }
}
