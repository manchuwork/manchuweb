<?php

namespace App\Http\Controllers;

use App\OlContent;
use Illuminate\Http\Request;
use App\OlCatalog;
use Illuminate\Support\Facades\Auth;

class OlContentController extends Controller
{
    //
    public function index(){

        $olcontents = OlContent::orderBy('created_at','desc')
            ->paginate(6);


        return view('olcontent/index',compact('olcontents'));
    }

    public function show(OlContent $olcontent){
        $isShow = true;

        return view('olcontent/show',compact('olcontent','isShow'));
    }

    public function create(){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');

        $olcatalog_id = request('olcatalog_id');
        $olcatalog = OlCatalog::find($olcatalog_id);
        $olcontent = [];
        return view('olcontent/create',compact('olcontent','olcatalog','olcatalog_id'));
    }

    public function store(){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');

        $this->validate(request(),[
            'content' => 'required|string|max:125|min:1',
        ]);

        $user_id = \Auth::id();


        $params = array_merge(request(['ol_book_id','ol_catalog_id','content']),compact('user_id'));

        $this->_unsetNull($params);
        //dd ($params);

        OlContent::create($params);

        return redirect('/olcontents/');
    }

    public function _unsetNull(& $arr){
        if($arr !== null){
            if(is_array($arr)){
                if(!empty($arr)){
                    foreach($arr as $key => $value){
                        if($value === null){
                            $arr[$key] = '';
                        }else{
                            $arr[$key] = $this->_unsetNull($value);      //递归再去执行
                        }
                    }
                }else{ $arr = ''; }
            }else{
                if($arr === null){ $arr = ''; }         //注意三个等号
            }
        }else{ $arr = ''; }
        return $arr;
    }

    public function edit(OlContent $olcontent){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');
        return view('olcontent/edit',compact('olcontent'));
    }

    public function update(OlContent $olcontent){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');
        $this->validate(request(),[
            'content' => 'required|string|max:125|min:1',
        ]);

        $this->authorize('update', $olcontent);

        $id = $olcontent->id;
        $olcontent->update();

        return redirect('/olcontents/'. $id);
    }

    public function delete(OlContent $olcontent){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');
        $this->authorize('delete', $olcontent);

        $oldFile = $olcontent->pic;
        $olcontent ->delete();

        if(isset($oldFile)){
            ImageTool::delete($oldFile);

        }
        return redirect("/olcontents/");
    }
}
