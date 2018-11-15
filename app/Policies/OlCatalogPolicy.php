<?php
/**
 * Created by PhpStorm.
 * User: heshen
 * Date: 2018/11/7
 * Time: 00:08
 */

namespace App\Policies;

use App\OlCatalog;
use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class OlCatalogPolicy
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
    public function update(User $user, OlCatalog $olCatalog){
        return $user->id == $olCatalog->user_id;
    }

    public function delete(User $user, OlCatalog $olCatalog){
        return $user->id == $olCatalog->user_id;

    }
}