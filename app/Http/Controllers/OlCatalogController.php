<?php

namespace App\Http\Controllers;

use App\OlBook;
use App\OlCatalog;
use App\OlContent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OlCatalogController extends Controller
{
    //
    //
    //
    public function index(){
        $ol_book_id = \request('olbook_id');

        $olcatalogs = OlCatalog::orderBy('created_at','desc')
            ->where('ol_book_id','=', $ol_book_id)
            ->paginate(6);

        $isShow = true;
        $olbook_id = \request('olbook_id');
        $olbook = OlBook::find($olbook_id);


        return view('olcatalog/index',compact('olcatalogs', 'olbook_id','olbook','isShow'));
    }

    public function show(OlCatalog $olcatalog){
        $isShow = true;

        $olcontents = OlContent::orderBy('created_at','desc')->where('ol_catalog_id', '=',$olcatalog->id)
            ->paginate(6);

        return view('olcatalog/show',compact('olcatalog','isShow','olcontents'));
    }

    public function create(){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');

        $olcatalog = [];

        $olbook_id= \request("olbook_id");



        return view('olcatalog/create',compact('olcatalog','olbook_id'));
    }

    public function store(){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');

        $this->validate(request(),[
            'entry' => 'required|string|max:125|min:1',
        ]);

        $user_id = \Auth::id();

        $params = array_merge(request(['entry','entry_mnc','entry_trans','ol_book_id']),compact('user_id'));

        $this->_unsetNull($params);

        OlCatalog::create($params);

        $olbook_id = \request('ol_book_id');

        return redirect('/olcatalogs?olbook_id='. $olbook_id);
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

    public function edit(OlCatalog $olcatalog){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');
        return view('olcatalog/edit',compact('olcatalog'));
    }

    public function update(OlCatalog $olcatalog){
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

        $this->authorize('update', $olcatalog);


        $pic = ImageTool::saveImgFromRequestByDateDir('pic','olcatalogpic',135,206);

        $olcatalogNew = array_merge(request(['title','title_mnc','author','translator','publisher','page_count','price',
            'binding','isbn','pic','brief_intro','about_the_author','catalogue']),compact('user_id'));

        $oldPic = null;

        if(isset($olcatalog['pic'])){
            $oldPic = $olcatalog->pic;
        }
        if(isset($pic)){
            $olcatalog->pic = $pic;
        }
        $id = $olcatalog->id;
        $olcatalog->update();

        if(isset($pic) && !empty($oldPic) && $oldPic != ''){
            ImageTool::delete($oldPic);

        }
        return redirect('/olcatalogs/'. $id);
    }

    public function delete(OlCatalog $olcatalog){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');
        $this->authorize('delete', $olcatalog);

        $oldFile = $olcatalog->pic;
        $olcatalog ->delete();

        if(isset($oldFile)){
            ImageTool::delete($oldFile);

        }
        return redirect("/olcatalogs/");
    }
}
