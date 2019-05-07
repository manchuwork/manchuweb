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


        $title_prefix = '';
        $description = '';
        if(!empty($books)){
            foreach ($books as $book) {
                $title_prefix .= $book->title .' '. $book->title_mnc . ',';

                $description .=  $book->title .' '. $book->title_mnc . ' '. $book->author . ',';
            }
        }

        return view('book/index',compact('books','title_prefix','description'));
    }

    public function show(Book $book){
        $isShow = true;

        if(!isset($book['price']) || $book['price'] <= 0){
            unset($book['price']);
        }else{
            $book['price'] = number_format($book['price'] /100, 2);
        }

        if(!isset($book['page_count']) || $book['page_count'] <= 0){
            unset($book['page_count']);
        }


        $title_prefix = '';
        $description = '';
        if(!empty($book)) {
            $title_prefix .= $book->title . ' ' . $book->title_mnc . ',';

            $description .= $book->title . ' ' . $book->title_mnc . ' ' . $book->author . ',';
        }

            return view('book/show',compact('book','isShow','title_prefix', 'description'));
    }

    public function create(){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');

        $book = [];
        return view('book/create',compact('book'));
    }



    private function _unsetNull(& $arr){
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


    public function store(){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');

        $this->validate(request(),[
            'title' => 'required|string|max:125|min:1',
        ]);

        $user_id = \Auth::id();

        //$book = [];
        $bookNewWithFiler = $this->_saveOrUpdateBookPre();

        $bookNewWithFiler = array_merge($bookNewWithFiler, compact('user_id'));


//        $this->_unsetNull($params);

        Book::create($bookNewWithFiler);

        return redirect('/books');
    }

    public function edit(Book $book){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');

        $book['price'] = number_format($book['price'] /100, 2);

        return view('book/edit',compact('book'));
    }


    public function update(Book $book){
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');
        $this->validate(request(),[
            'title' => 'required|string|max:125|min:1',
        ]);

        $this->authorize('update', $book);


        $oldPic = null;

        if(isset($book['pic'])){
            $oldPic = $book->pic;
        }

        $oldFile = null;
        if(isset($book['file'])){
            $oldFile = $book->file;
        }

        $id = $book->id;


        $bookNewWithFiler = $this->_saveOrUpdateBookPre();

        foreach ($bookNewWithFiler as $key => $value) {
            $book->{$key} = $value;
        }

        $book->update();

        if(isset($bookNewWithFiler['pic']) && !empty($oldPic) && $oldPic != ''){
            ImageTool::delete($oldPic);

        }

        if(isset($bookNewWithFiler['file']) && !empty($oldFile) && $oldFile != ''){
            FileTool::delete($oldFile);

        }
        return redirect('/books/'. $id);
    }

    public function delete(Book $book){
        //dd('hahha');
        if(!Auth::check()){
            return redirect("/login");
        }
        $this->middleware('auth');
        $this->authorize('delete', $book);

        $oldPic = $book->pic;

        $oldFile = $book->file;
        $book ->delete();

        if(isset($oldPic)){
            ImageTool::delete($oldPic);

        }

        if(isset($oldFile) && !empty($oldFile) && $oldFile != ''){
            FileTool::delete($oldFile);

        }


        return redirect("/books/");
    }

    /**
     * @param Book $book
     * @param $user_id
     * @return array
     */
    private function _saveOrUpdateBookPre()
    {
        $pic = ImageTool::saveImgFromRequestByDateDir('pic', 'bookpic', 135, 206);

        $filePropertiesArray = FileTool::saveFileFromRequestByDateDir01('file', 'bookfile');


        if (empty($pic)) {
            $pic = null;
        }

        if (empty($filePropertiesArray)) {
            $filePropertiesArray = null;
        }


        $params = array_merge(request([
            'title',
            'title_mnc',
            'subtitle',
            'author',
            'translator',
            'publisher',
            'publish_year',
            'page_count',
            'price',
            'binding',
            'isbn',
            'brief_intro',
            'about_the_author',
            'catalogue',
            'buy_url'
        ]));

        if (!empty($pic)) {
            $params = array_merge($params, compact('pic'));
        }

        if (isset($filePropertiesArray) && is_array($filePropertiesArray)) {
            $params = array_merge($params, $filePropertiesArray);
        }

        if (!isset($params['price'])) {
            $params['price'] = 0;
        }

        $params['price'] = str_replace(',', '', $params['price']);

        $params['price'] = $params['price'] * 100;


        $bookNewWithFiler = $this->_unsetNull($params);

        return $bookNewWithFiler;
    }
}
