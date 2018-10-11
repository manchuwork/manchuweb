<?php

namespace App\Policies;

use App\Dict;
use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class DictPolicy
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
    public function update(User $user, Dict $dict){
        return $user->id == $dict->user_id;
    }

    public function delete(User $user, Dict $dict){
        return $user->id == $dict->user_id;

    }
}
