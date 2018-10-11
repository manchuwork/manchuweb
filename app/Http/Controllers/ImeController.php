<?php
/**
 * Created by PhpStorm.
 * User: heshen
 * Date: 2018/10/9
 * Time: 22:16
 */

namespace App\Http\Controllers;


class ImeController extends Controller
{

    public function index(){

        return view('ime/manchu');
    }
}