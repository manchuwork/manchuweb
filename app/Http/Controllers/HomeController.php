<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Dict;
use \App\Post;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $posts = Post::orderBy('created_at','desc')->paginate(5);

        $dicts = Dict::orderBy('created_at','desc')->paginate(5);
        return view('index',compact('posts','dicts'));
    }
}
