<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    //
    protected $fillable = [
        'name','email','password'
    ];

    // 用户的文章列表
    public function posts(){
        return $this->hasMany(\App\Post::class,'user_id','id');
    }

    // 用户的字典列表
    public function dicts(){
        return $this->hasMany(\App\Dict::class,'user_id','id');
    }

    // 关注我的Fan模型
    public function fans(){
        return $this->hasMany(\App\Fan::class,'star_id','id');
    }

    // 我关注的Fan模型,（我是粉丝）
    public function stars(){
        return $this->hasMany(\App\Fan::class,'fan_id','id');
    }

    // 关注某人，我要关注某人
    public function doFun($uid){
        $fan = new \App\Fan();
        $fan->star_id = $uid;
        $this->stars()->save($fan);
    }

    // 取消关注某人
    public function doUnFun($uid){
        $fan = new \App\Fan();
        $fan->star_id = $uid;
        $this->stars()->delete($fan);
    }


    // 当前用户是否被uid 关注了
    public function hasFun($uid){
        $this->fans()->where('fan_id',$uid)->count();
    }

    // 当前用户是否被uid 关注了
    public function hasStar($uid){
        $this->fans()->where('star_id',$uid)->count();
    }
}
