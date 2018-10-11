<?php
/**
 * Created by PhpStorm.
 * User: heshen
 * Date: 2018/2/21
 * Time: 10:19
 */

namespace App;

use Illuminate\Database\Eloquent\Model as BaseModel;
class Model extends BaseModel
{
    protected $guarded = [];// 不可以注入的字段
}