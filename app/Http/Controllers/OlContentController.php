<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OlContentController extends Controller
{
    //
    public function index(){

        $olContent = OlContent::orderBy('created_at','desc')
            ->paginate(6);


        return view('olcontent/index',compact('olContent'));
    }

    public function show(OlContent $book){
        $isShow = true;

        return view('olcontent/show',compact('book','isShow'));
    }

    public function create(){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');

        $olcontent = [];
        return view('olcontent/create',compact('olcontent'));
    }

    public function store(){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');

        $this->validate(request(),[
            'title' => 'required|string|max:125|min:1',
//            'title_mnc' => 'string|max:512',
//            'author' => 'required|string|max:125',
//            'translator' => 'string|max:512',
//            'publisher' => 'string|max:125',
//            'page_count' => 'integer',
//            'price' => 'integer',
//            'binding' => 'string',
//            'isbn' => 'string',
//            'user_id' => 'integer',
//            'brief_intro' => 'string',
//            'about_the_author' => 'string',
//            'catalogue' => 'string',
        ]);

        $user_id = \Auth::id();


        $pic = ImageTool::saveImgFromRequestByDateDir('pic','olcontentpic',135,206);

        if(empty($pic)){
            $pic = '';
        }
        $params = array_merge(request(['title','title_mnc','author','translator','publisher','page_count','price',
            'binding','isbn','pic','brief_intro','about_the_author','catalogue']),compact('user_id','pic'));

        if(!isset($params['page_count'])){
            $params['page_count']= 0;
        }

        if(!isset($params['price'])){
            $params['price']=0;
        }

        $this->_unsetNull($params);
        //dd ($params);

        OlContent::create($params);

        return redirect('/olcontents');
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
            'title' => 'required|string|max:125|min:1',
//            'title_mnc' => 'string|max:512',
//            'author' => 'required|string|max:125',
//            'translator' => 'string|max:512',
//            'publisher' => 'string|max:125',
//            'page_count' => 'integer',
//            'price' => 'integer',
//            'binding' => 'string',
//            'isbn' => 'string',
//            'pic' => 'string|max:512',
//            'user_id' => 'integer',
//            'brief_intro' => 'string',
//            'about_the_author' => 'string',
//            'catalogue' => 'string',
        ]);

        $this->authorize('update', $olcontent);


        $pic = ImageTool::saveImgFromRequestByDateDir('pic','olcontentpic',135,206);

        $olcontentNew = array_merge(request(['title','title_mnc','author','translator','publisher','page_count','price',
            'binding','isbn','pic','brief_intro','about_the_author','catalogue']),compact('user_id'));

        $oldPic = null;

        if(isset($olcontent['pic'])){
            $oldPic = $olcontent->pic;
        }
        if(isset($pic)){
            $olcontent->pic = $pic;
        }
        $id = $olcontent->id;
        $olcontent->update();

        if(isset($pic) && !empty($oldPic) && $oldPic != ''){
            ImageTool::delete($oldPic);

        }
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