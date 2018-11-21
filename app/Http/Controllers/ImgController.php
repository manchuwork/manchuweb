<?php
/**
 * Created by PhpStorm.
 * User: heshen
 * Date: 2018/11/21
 * Time: 12:56
 */

namespace App\Http\Controllers;


use App\Tool\ImageTool;
use Auth;

class ImgController extends Controller
{

    public function storeTmp(){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');

        $this->validate(request(),[
            'path' => 'required|string|max:125|min:1',

        ]);
        $path = request('path');
        $user_id = Auth::id();

        $pic = ImageTool::saveImgTmpFromRequestByDateDir('pic',$path,135,206);

        if(empty($pic)){
            $pic = '';
        }
        $params = array_merge(request(['path']),compact('user_id','pic'));

        OlBook::create($params);

        $data = ['pic'=> $pic];
        return response(json_encode($data));
    }
}