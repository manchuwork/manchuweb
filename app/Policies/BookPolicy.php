<?php
/**
 * Created by PhpStorm.
 * User: heshen
 * Date: 2018/10/6
 * Time: 10:50
 */

namespace App\Policies;
use App\Book;
use App\User;

use Illuminate\Auth\Access\HandlesAuthorization;

class BookPolicy
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
    public function update(User $user, Book $book){
        return $user->id == $book->user_id;
    }

    public function delete(User $user, Book $book){
        return $user->id == $book->user_id;

    }

}