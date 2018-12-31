<?php
/**
 * Created by PhpStorm.
 * User: heshen
 * Date: 2018/10/14
 * Time: 23:32
 */

namespace App\Http\Controllers;


use App\Lyric;
use App\Tool\FileTool;
use Illuminate\Support\Facades\Auth;

class LyricController extends Controller
{
    public function search(){

        $contentType= "text/plain";

        $title = \request('title');
        $author = \request('author');

        if(!isset($title)){
            return response("title is empty ". $title.' '. $author, 404);
        }

        $lyrics = [];
        if(isset($title) && isset($author)){
            $lyrics = Lyric::where('title', '=', "{$title}")
                //->where('author','=',"{$author}")
                ->orderBy('created_at','desc')->paginate(1);
            if(empty($lyrics)){
                $lyrics = Lyric::where('title', 'like', "%{$title}%")
                  //  ->where('author','like',"%{$author}%")
                    ->orderBy('created_at','desc')->paginate(1);
            }
        }

        if(empty($lyrics)){
            $lyrics = Lyric::where('title', '=', "$title")

                ->orderBy('created_at','desc')->paginate(1);
            if(empty($lyrics)){
                $lyrics = Lyric::where('title', 'like', "%{$title}%")

                    ->orderBy('created_at','desc')->paginate(1);
            }
        }

        if(isset($lyrics) && sizeof($lyrics) > 0){

            //获取当前的url
            $path = $lyrics[0]->file;

            $path_mnc = $lyrics[0]->file_mnc;
            $path = storage_path("app".DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR .$path)  ;

            $path_mnc = storage_path("app".DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR .$path_mnc)  ;

            // 转义：
            $path = str_replace('\\','/',$path);
            $path_mnc = str_replace('\\','/',$path_mnc);

            $lyric_zh_en = $this->loadFile($path);
            $lyric_mnc = $this->loadFile($path_mnc);

            return $this->res(['lyric'=>$lyric_zh_en, 'lyric_mnc'=> $lyric_mnc], $contentType, "*");

        }

        return response('');

    }

    private function loadFile($path){
        if(!file_exists($path)){
            //报404错误
            return '';

        }

        return file_get_contents($path);
    }




    private function res($content, $contentType, $AccessControlAllowOrigin = null)
    {

        $timestamp = time();
        $interval = 60 * 60 * 24 * 512; // 6 hours

        $r =
         response($content)
            ->header('Content-Type', $contentType)
            ->header("Last-Modified", gmdate('r', $timestamp))
            ->header("Expires", gmdate("r", ($timestamp + $interval)))
            ->header("Cache-Control", "max-age=$interval");

        if($AccessControlAllowOrigin != null){
            $r->header("Access-Control-Allow-Origin", $AccessControlAllowOrigin);

        }

        return $r;
    }

    public function index(){

        $lyrics = Lyric::orderBy('created_at','desc')
            ->paginate(6);


        return view('lyric/index',compact('lyrics'));
    }

    public function show(Lyric $lyric){
        $isShow = true;

        return view('lyric/show',compact('lyric','isShow'));
    }


    public function create(){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');

        $lyric = [];
        return view('lyric/create',compact('lyric'));
    }

    public function store(){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');

        $this->validate(request(),[
            'title' => 'required|string|max:125|min:1',
            'author'=> 'required|string|max:125|min:1',
        ]);

        $user_id = \Auth::id();


        $file = FileTool::saveFileFromRequestByDateDir('file','lyric');

        $file_mnc = FileTool::saveFileFromRequestByDateDir('file_mnc','lyric');
        if(empty($file_mnc)){
            $file_mnc = '';
        }
        $params = array_merge(request(['title','author']),compact('user_id','file','file_mnc'));

        Lyric::create($params);

        return redirect('/lyrics');
    }


    public function edit(Lyric $lyric){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');
        return view('lyric/edit',compact('lyric'));
    }

    public function update(Lyric $lyric){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');
        $this->validate(request(),[
            'title' => 'required|string|max:125|min:1',
            'author'=> 'required|string|max:125|min:1',
        ]);

        $this->authorize('update', $lyric);


        $file = FileTool::saveFileFromRequestByDateDir('file','lyric');

        $lyricNew = array_merge(request(['title','author']));

        $oldFile = null;

        if(isset($lyric['file'])){
            $oldFile = $lyric->file;
        }
        $oldFileMnc = null;
        $file_mnc = FileTool::saveFileFromRequestByDateDir('file_mnc','lyric');
        if(isset($lyric['file_mnc'])){
            $oldFileMnc = $lyric->file_mnc;
        }

        if(isset($file)){
            $lyric->file = $file;
        }

        if(isset($file_mnc)){
            $lyric->file_mnc = $file_mnc;
        }


        $id = $lyric->id;

        if(isset($lyricNew['title'])){
            $lyric->title = $lyricNew['title'];
        }

        if(isset($lyricNew['author'])){
            $lyric->author = $lyricNew['author'];
        }
        $lyric->update();

        if(isset($file) && !empty($oldFile) && $oldFile != ''){
            FileTool::delete($oldFile);

        }

        if(isset($file_mnc ) && !empty($oldFileMnc) && $oldFileMnc != '' ){
            FileTool::delete($oldFileMnc);
        }
        return redirect('/lyrics/'. $id);
    }

    public function delete(Lyric $lyric){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');
        $this->authorize('delete', $lyric);
        $oldFile = $lyric->file;

        $lyric ->delete();

        if(isset($oldFile)){
            FileTool::delete($oldFile);

        }
        return redirect("/lyrics/");
    }
}