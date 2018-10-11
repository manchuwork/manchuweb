<?php

namespace App\Http\Controllers;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use \App\Dict;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use \App\Tool\ImageTool;


class DictController extends Controller
{
    //
    public function search(\Psr\Log\LoggerInterface $log){


        return view('dict/search');
    }

    public function queryWord(){
        @header("Content-type: text/javascript;charset=UTF-8");
        $r = $this->queryInner();
        return view('dict/word',$r);
    }

    private function queryInner(){
        $word  = \request('word');
        $word = trim($word);

        $word = mb_ereg_replace('^[ ]+', '', $word);
        $word = mb_ereg_replace('[ ]+$', '', $word);
        $word = mb_ereg_replace('&nbsp;', '', $word);

        if(preg_match('/[\x{4e00}-\x{9fa5}]/u', $word)>0){
            // 含有中文
            $dicts = Dict::where('chinese', 'like', "%{$word}%")->orderBy('created_at','desc')->paginate(5);
        }else if(preg_match('/[\x{1800}-\x{18AF}]/u', $word)>0){
            // 含有满文
            $dicts = Dict::where('manchu', 'like', "%{$word}%")->orderBy('created_at','desc')->paginate(5);
        }else if(!empty($word)){
            // 英文处理
            $dicts = Dict::where('trans', 'like', "%{$word}%")->orderBy('created_at','desc')->paginate(5);

        }

        return compact('dicts','word');
    }

    public function query(\Psr\Log\LoggerInterface $log){



        $r = $this->queryInner();

        return view('dict/index',$r);
    }

    public function index(\Psr\Log\LoggerInterface $log){

        $dicts = Dict::orderBy('created_at','desc')->paginate(10);
        return view('dict/index',compact('dicts'));
    }

    public function show(Dict $dict){
        $isShow = true;

        return view('dict/show',compact('dict','isShow'));
    }

    public function create(){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');

        return view('dict/create');
    }

    public function store(){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');

        $this->validate(request(),[
            'manchu' => 'required|string|max:500|min:1',
            'trans' => 'required|string|max:500|min:1',
            'chinese' => 'required|string|min:1',
        ]);

        $user_id = \Auth::id();


        $pic = ImageTool::saveImgFromRequestByDateDir('pic','dictpic',200,200);

        if(empty($pic)){
            $pic = '';
        }
        $params = array_merge(request(['manchu','trans','chinese']),compact('user_id','pic'));

        $dict = Dict::create($params);

        return redirect('/dicts');
    }

    public function edit(Dict $dict){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');
        return view('dict/edit',compact('dict'));
    }

    public function update(Dict $dict){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');
        $this->validate(request(),[
            'manchu' => 'required|string|max:500|min:1',
            'trans' => 'required|string|max:500|min:1',
            'chinese' => 'required|string|min:1',
        ]);
        $this->authorize('update', $dict);


        $pic = ImageTool::saveImgFromRequestByDateDir('pic','dictpic',200,200);

        $dict->manchu = \request('manchu');
        $dict->trans = \request('trans');
        $dict->chinese = \request('chinese');

        $oldPic = $dict->pic;
        if(isset($pic)){
            $dict->pic = $pic;
        }
        $id = $dict->id;
        $dict->update();

        if(isset($pic) && !empty($oldPic)){
            ImageTool::delete($oldPic);

        }
        return redirect('/dicts/'. $id);
    }

    public function delete(Dict $dict){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');
        $this->authorize('delete', $dict);

        $dict ->delete();
        return redirect("/dicts/");
    }
}
