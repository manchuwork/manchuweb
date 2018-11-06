<?php
/**
 * Created by PhpStorm.
 * User: heshen
 * Date: 2018/11/7
 * Time: 00:08
 */

namespace App\Policies;

use App\OlBook;
use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class OlBookPolicy
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
    public function update(User $user, OlBook $olBook){
        return $user->id == $olBook->user_id;
    }

    public function delete(User $user, OlBook $olBook){
        return $user->id == $olBook->user_id;

    }
}