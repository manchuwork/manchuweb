<?php
/**
 * Created by PhpStorm.
 * User: heshen
 * Date: 2018/11/7
 * Time: 00:08
 */

namespace App\Policies;

use App\OlCatalog;
use App\OlContent;
use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class OlContentPolicy
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
    public function update(User $user, OlContent $olContent){
        return $user->id == $olContent->user_id;
    }

    public function delete(User $user, OlContent $olContent){
        return $user->id == $olContent->user_id;

    }
}