<?php
/**
 * Created by PhpStorm.
 * User: heshen
 * Date: 2018/10/14
 * Time: 23:40
 */

namespace App\Policies;


use App\Lyric;
use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class LyricPolicy
{

    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    // 修改权限
    public function update(User $user, Lyric $lyric){
        return $user->id == $lyric->user_id;
    }

    public function delete(User $user, Lyric $lyric){
        return $user->id == $lyric->user_id;

    }
}