<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Dict;
use \App\Post;
class HomeController extends Controller
{

    public function load()
    {
        $url = request('url');

        if(!$this->isDomain($url)){
            $url = '';
        }

        $url = $this->url_to_absolute($url);

        return view('load',compact('url'));
    }

    function url_to_absolute($relative)
    {
        $absolute = '';
        // 去除所有的 './'
        $absolute = preg_replace('/(?<!\.)\.\//','',$relative);
        $count = preg_match_all('/(?<!\/)\/([^\/]{1,}?)\/\.\.\//',$absolute,$res);
        // 迭代去除所有的 '/abc/../'
        do
        {
            $absolute = preg_replace('/(?<!\/)\/([^\/]{1,}?)\/\.\.\//','/',$absolute);
            $count = preg_match_all('/(?<!\/)\/([^\/]{1,}?)\/\.\.\//',$absolute,$res);
        }while($count >= 1);
        // 除去最后的 '/..'
        $absolute = preg_replace('/(?<!\/)\/([^\/]{1,}?)\/\.\.$/','/',$absolute);
        $absolute = preg_replace('/\/\.\.$/','',$absolute);
        // 除去存在的 '../'
        $absolute = preg_replace('/(?<!\.)\.\.\//','',$absolute);
        return $absolute;
    }
    public function isDomain($domain)
    {
        return !empty($domain) && strpos($domain, '--') === false &&
        preg_match('/^((http)s?:\/\/)?(www\.)?manchu.work(\/.+)*$/i',
            $domain) ? true : false;
    }
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
