<?php
/**
 * Created by PhpStorm.
 * User: heshen
 * Date: 2018/10/14
 * Time: 23:24
 */

namespace App\Http\Controllers;

use App\Tool\ImageTool;

use Illuminate\Support\Facades\Auth;

class PlayerController extends Controller
{

    public function index(){

        $searchWord = "阿克善";
        return view('player/index',compact('searchWord'));
    }
}