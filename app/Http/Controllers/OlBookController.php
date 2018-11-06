<?php

namespace App\Http\Controllers;

use App\OlBook;
use App\Tool\ImageTool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OlBookController extends Controller
{
    //
    //
    public function index(){

        $olbooks = OlBook::orderBy('created_at','desc')
            ->paginate(6);


        return view('olbook/index',compact('olbooks'));
    }

    public function show(OlBook $olbook){
        $isShow = true;

        return view('olbook/show',compact('olbook','isShow'));
    }

    public function create(){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');

        $olbook = [];
        return view('olbook/create',compact('olbook'));
    }

    public function store(){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');

        $this->validate(request(),[
            'title' => 'required|string|max:125|min:1',

        ]);

        $user_id = \Auth::id();


        $pic = ImageTool::saveImgFromRequestByDateDir('pic','olbookpic',135,206);

        if(empty($pic)){
            $pic = '';
        }


        $params = array_merge(request(['title','title_mnc','title_trans',
            'author','pic','brief_intro','subtitle']),compact('user_id','pic'));



        $this->_unsetNull($params);

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

    public function update(OlBook $olbook){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');
        $this->validate(request(),[
            'title' => 'required|string|max:125|min:1',

        ]);

        $this->authorize('update', $olbook);


        $pic = ImageTool::saveImgFromRequestByDateDir('pic','olbookpic',135,206);

//        $olbookNew = array_merge(request(['title','title_mnc','title_trans',
//            'author','pic','brief_intro','subtitle']),compact('user_id'));

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

    public function delete(OlBook $olbook){
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
