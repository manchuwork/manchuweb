<?php

namespace App\Http\Controllers;

use App\OlBook;
use Illuminate\Http\Request;

class OlBookController extends Controller
{
    //
    //
    public function index(){

        $olBooks = OLBook::orderBy('created_at','desc')
            ->paginate(6);


        return view('olbook/index',compact('olBooks'));
    }

    public function show(OLBook $book){
        $isShow = true;

        return view('olbook/show',compact('book','isShow'));
    }

    public function create(){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');

        $olbook = [];
        return view('ololbook/create',compact('olbook'));
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


        $pic = ImageTool::saveImgFromRequestByDateDir('pic','olbookpic',135,206);

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

        OlBook::create($params);

        return redirect('/olbooks');
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

    public function edit(OlBook $olbook){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');
        return view('olbook/edit',compact('olbook'));
    }

    public function update(OLBook $olbook){
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

        $this->authorize('update', $olbook);


        $pic = ImageTool::saveImgFromRequestByDateDir('pic','olbookpic',135,206);

        $olbookNew = array_merge(request(['title','title_mnc','author','translator','publisher','page_count','price',
            'binding','isbn','pic','brief_intro','about_the_author','catalogue']),compact('user_id'));

        $oldPic = null;

        if(isset($olbook['pic'])){
            $oldPic = $olbook->pic;
        }
        if(isset($pic)){
            $olbook->pic = $pic;
        }
        $id = $olbook->id;
        $olbook->update();

        if(isset($pic) && !empty($oldPic) && $oldPic != ''){
            ImageTool::delete($oldPic);

        }
        return redirect('/olbooks/'. $id);
    }

    public function delete(OLBook $olbook){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');
        $this->authorize('delete', $olbook);

        $oldFile = $olbook->pic;
        $olbook ->delete();

        if(isset($oldFile)){
            ImageTool::delete($oldFile);

        }
        return redirect("/olbooks/");
    }
}
