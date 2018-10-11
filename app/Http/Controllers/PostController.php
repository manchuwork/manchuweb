<?php

namespace App\Http\Controllers;
use App\Comment;
use App\Post;
use App\Tool\ImageTool;
use App\Zan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }
    //
    public function index(\Psr\Log\LoggerInterface $log){

        //$app = app();
        //$log = $app->make('log');
        $log->info("post_index",['data'=>"this is post index"]);
        //$posts = Post::orderBy('created_at','desc')->withCount('comments')->withCount('zans')->paginate(5);
        $posts = Post::orderBy('created_at','desc')->withCount(['comments','zans'])->paginate(5);

        return view('post/index',compact('posts'));
    }

    public function show(Post $post){
        $isShow = true;

        $post->load('comments');
        return view('post/show',compact('post','isShow'));
    }
    //
    public function create(){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');

        return view('post/create');
    }

    public function store(){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');
       // dump && die();
//        $post = new Post();
//        $post->title = request('title');
//        $post->content = request('content');
//        $post->save();
//        $params = ['title'=> request('title'),'content' => request('conent')];

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
        $post = Post::create($params);
        //dd($post);

        return redirect('/posts');
    }

    public function edit(Post $post){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');
        return view('post/edit',compact('post'));
    }

    public function update(Post $post){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');
        $this->validate(request(),[
            'manchu' => 'required|string|max:500|min:1',
            'trans' => 'required|string|max:500|min:1',
            'chinese' => 'required|string|min:1',
        ]);
        $this->authorize('update', $post);


        $post->manchu = \request('manchu');
        $post->trans = \request('trans');
        $post->chinese = \request('chinese');
        $id = $post->id;

        $oldPic = $post->pic;
        if(isset($pic)){
            $post->pic = $pic;
        }
        $post->update();

        if(isset($pic) && !empty($oldPic)){
            ImageTool::delete($oldPic);

        }
        return redirect('/posts/'. $id);
    }

    public function delete(Post $post){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');
        $this->authorize('delete', $post);

        $post ->delete();
        return redirect("/posts/");
    }
    // 上传图片
    public function imageUpload(Request $request){
        $this->middleware('auth');

        $file = $request->file('imgUpload');
        $path = $file->storePublicly(md5(time()));

//        {
//            // errno 即错误代码，0 表示没有错误。
//            //       如果有错误，errno != 0，可通过下文中的监听函数 fail 拿到该错误码进行自定义处理
//            "errno": 0,
//
//    // data 是一个数组，返回若干图片的线上地址
//    "data": [
//            "图片1地址",
//            "图片2地址",
//            "……"
//        ]
//
//
//}

        $fullPath = asset('storage/'. $path);

        return response()->json(['errno' => 0, 'data' => [$fullPath]]);
    }

    public function comment(Post $post){
        $this->middleware('auth');

        $this->middleware('auth');
        //dd(request());
        $this->validate(request(),[
            'content'=>'required|min:3',
        ]);
        // 逻辑
        $comment = new Comment();
        $comment->user_id = \Auth::id();
        $comment->content= \request('content');
        $post->comments()->save($comment);
        // 渲染

        return back();
    }

    public function zan(Post $post){
        $this->middleware('auth');
        $param = [
            'user_id' => \Auth::id(),
            'post_id' => $post ->id
        ];

        Zan::firstOrCreate($param);

        return back();
    }
    // 取消赞
    public function unzan(Post $post){
        $this->middleware('auth');

        $post->zan(\Auth::id())->delete();
        return back();
    }
}
