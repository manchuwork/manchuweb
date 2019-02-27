<?php

namespace App\Http\Controllers;

use App\WordType;
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

        return $this->query($log);
        //return view('dict/search');
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

        $search_type = \request('search_type');

        $searchWord = $word;
        if(!isset($search_type)){
            $searchWord = "%{$word}%";
        }elseif($search_type == 'pre'){
            $searchWord = "{$word}%";
        }elseif($search_type == 'full'){
            $searchWord = "{$word}";
        }

        if(preg_match('/[\x{4e00}-\x{9fa5}]/u', $word)>0){
            // 含有中文
            $dicts = Dict::where('chinese', 'like', $searchWord)
                ->orderBy('created_at','desc')->paginate(10);
        }else if(preg_match('/[\x{1800}-\x{18AF}]/u', $word)>0){
            // 含有满文
            $dicts = Dict::where('manchu', 'like', $searchWord)->orderBy('created_at','desc')->paginate(10);
        }else if(!empty($word)){
            // 英文处理
            $dicts = Dict::where('trans', 'like', $searchWord)->orderBy('created_at','desc')->paginate(10);

        }


        $title_prefix = '';
        $description = '';
        if(!empty($dicts)){
            foreach ($dicts as $dict) {
                $title_prefix .= $dict->manchu .' '. $dict->trans . ',';

                $description .=  $dict->manchu .' '. $dict->trans . ' '. $dict->trans_zh . ',';
            }
        }

        return compact('dicts','word','search_type','title_prefix','description');
    }

    public function query(\Psr\Log\LoggerInterface $log){



        $r = $this->queryInner();

        return view('dict/search',$r);
    }

    public function index(\Psr\Log\LoggerInterface $log){

        $dicts = Dict::orderBy('created_at','desc')->paginate(10);

        $title_prefix = '';
        $description = '';
        if(!empty($dicts)){
            foreach ($dicts as $dict) {
                $title_prefix .= $dict->manchu .' '. $dict->trans . ',';

                $description .=  $dict->manchu .' '. $dict->trans . ' '. $dict->trans_zh . ',';
            }
        }


        return view('dict/index',compact('dicts','title_prefix','description'));
    }

    public function show(Dict $dict){
        $isShow = true;

        $title_prefix = '';
        $description = '';
        $title_prefix .= $dict->manchu .' '. $dict->trans . ',';
        $description .=  $dict->manchu .' '. $dict->trans . ' '. $dict->trans_zh . ',';
        return view('dict/show',compact('dict','isShow','title_prefix','description'));
    }

    public function create(){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');

        $wordTypes = WordType::orderBy('id','asc')->paginate(50);
        return view('dict/create',compact('wordTypes'));
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


        $wordType = request('word_type',[]);
        $word_types = implode(",", $wordType);


        $pic = ImageTool::saveImgFromRequestByDateDir('pic','dictpic',200,200);

        if(empty($pic)){
            $pic = '';
        }
        $params = array_merge(request(['manchu','trans','trans_zh','chinese']),compact('user_id','pic','word_types'));

        $dict = Dict::create($params);

        return redirect('/dicts');
    }

    public function edit(Dict $dict){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');

        $wordTypes = WordType::orderBy('id','asc')->paginate(50);
        //dd($dict);

        $dictWordTypes = explode(",", $dict->word_types);
        //dd($dictWordTypes);

        if(!isset($dictWordTypes)){
            $dictWordTypes = [];
        }
        return view('dict/edit',compact('dict','wordTypes','dictWordTypes'));
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
        $dict->trans_zh = \request('trans_zh');
        $oldPic = $dict->pic;

        $wordType = request('word_type',[]);
        $word_types = implode(",", $wordType);

        if(isset($pic)){
            $dict->pic = $pic;
        }

        if(isset($word_types)){
            $dict->word_types = $word_types;
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
