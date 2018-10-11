<?php

namespace App;

class Post extends Model
{
    //
    //protected $guarded =[];


//    protected $fillable = ['title','content'];
    // 关联用户
    public function user(){
        // 1个用户有多个 文章
        return $this->belongsTo('App\User');// 遵循下面原则，可简写
        //         return $this->belongsTo('App\User','user_id'/** 外键 */,'id'/* User表主键*/);

    }

    public function comments(){
        return $this->hasMany('\App\Comment')->orderBy('created_at');
    }

    public function zan($user_id){
        return $this->hasOne(\App\Zan::class)->where('user_id',$user_id);
    }
    // 文章的所有赞
    public function zans(){
        return $this->hasMany(\App\Zan::class);
    }
}
