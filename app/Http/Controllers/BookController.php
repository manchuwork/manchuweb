<?php

namespace App\Http\Controllers;

use App\Tool\FileTool;
use App\Tool\ImageTool;

use \App\Book;
use Illuminate\Support\Facades\Auth;
class BookController extends Controller
{
    //
    public function index(\Psr\Log\LoggerInterface $log){

        //$app = app();
        //$log = $app->make('log');
        //$posts = Post::orderBy('created_at','desc')->withCount('comments')->withCount('zans')->paginate(5);
        $books = Book::orderBy('created_at','desc')
            ->paginate(6);


        return view('book/index',compact('books'));
    }

    public function show(Book $book){
        $isShow = true;

        if(!isset($book['price']) || $book['price'] <= 0){
            unset($book['price']);
        }else{

            $book['price'] =bcdiv($book['price'], '100', 2);

        }
        return view('book/show',compact('book','isShow'));
    }

    public function create(){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');

        $book = [];
        return view('book/create',compact('book'));
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


        $pic = ImageTool::saveImgFromRequestByDateDir('pic','bookpic',135,206);

        if(empty($pic)){
            $pic = '';
        }

        $filePropertiesArray = FileTool::saveFileFromRequestByDateDir01('file','bookfile');

        if(empty($filePropertiesArray)){
            $filePropertiesArray = null;
        }
        $params = array_merge(request(['title','title_mnc','subtitle','author','translator','publisher','publish_year','page_count','price',
            'binding','isbn','pic','brief_intro','about_the_author','catalogue']),compact('user_id','pic'));


        if(isset($filePropertiesArray) && is_array($filePropertiesArray)){
            $params = array_merge($params, $filePropertiesArray);
        }

        if(!isset($params['page_count'])){
            $params['page_count']= 0;
        }

        if(!isset($params['price'])){
            $params['price']=0;
        }

        $params['price'] = bcmul($params['price'] , '100',0);
        $this->_unsetNull($params);
        //dd ($params);

        Book::create($params);

        return redirect('/books');
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

    public function edit(Book $book){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');
        return view('book/edit',compact('book'));
    }

    public function update(Book $book){
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

        $this->authorize('update', $book);


        $pic = ImageTool::saveImgFromRequestByDateDir('pic','bookpic',135,206);

        $filePropertiesArray = FileTool::saveFileFromRequestByDateDir01('file','bookfile');


        if(empty($pic)){
            $pic = null;
        }

        if(empty($filePropertiesArray)){
            $filePropertiesArray = null;
        }

        $oldPic = null;

        if(isset($book['pic'])){
            $oldPic = $book->pic;
        }
        /*
        if(isset($pic)){
            $book->pic = $pic;
        }
        */

        $oldFile = null;
        if(isset($book['file'])){
            $oldFile = $book->file;
        }

        $params = array_merge(request(['title','title_mnc','subtitle','author','translator','publisher','publish_year','page_count','price',
            'binding','isbn','pic','brief_intro','about_the_author','catalogue']),compact('user_id','pic'));


        if(isset($filePropertiesArray) && is_array($filePropertiesArray)){
            $params = array_merge($params, $filePropertiesArray);
        }

        if(!isset($params['price'])){
            $params['price']=0;
        }

        $params['price'] = bcmul($params['price'] , '100',0);


        $bookNewWithFiler = array_filter($params);



        foreach($bookNewWithFiler as $key => $value){
            $book->{$key} = $value;
        }

        //var_dump($book);
        //dd($bookNewWithFiler);
        $id = $book->id;
        $book->update();

        if(!empty($pic) && !empty($oldPic) && $oldPic != ''){
            ImageTool::delete($oldPic);

        }

        if(!empty($filePropertiesArray) && isset($filePropertiesArray['file']) && !empty($oldFile) && $oldFile != ''){
            FileTool::delete($oldFile);

        }
        return redirect('/books/'. $id);
    }

    public function delete(Book $book){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');
        $this->authorize('delete', $book);

        $oldFile = $book->pic;
        $book ->delete();

        if(isset($oldFile)){
            ImageTool::delete($oldFile);

        }
        return redirect("/books/");
    }
}
