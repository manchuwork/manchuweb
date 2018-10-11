<?php
/**
 * Created by PhpStorm.
 * User: heshen
 * Date: 2018/8/13
 * Time: 16:55
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class TopicController extends Controller
{

    public function index(){
        return view('admin/topic/index');
    }

    public function create(){

    }

    public function store(){

    }

    public function destory(){

    }
}