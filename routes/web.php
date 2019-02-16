<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/','\App\Http\Controllers\HomeController@load');


// 首页

Route::get('/home','\App\Http\Controllers\HomeController@index');

// 用户模块
// 注册页面
Route::get('/register','\App\Http\Controllers\RegisterController@index');
// 注册页面
Route::post('/register','\App\Http\Controllers\RegisterController@register');

// 登录页面
Route::get('/login','\App\Http\Controllers\LoginController@index')->name('login');

// 登录行为
Route::post('/login','\App\Http\Controllers\LoginController@login');
// 登出行为
Route::get('/logout','\App\Http\Controllers\LoginController@logout');
// 个人设置页面
Route::get('/user/me/setting','\App\Http\Controllers\UserController@setting');
// 个人设置操作

Route::post('/user/me/setting','\App\Http\Controllers\UserController@store');


// 文章列表页
Route::get('/posts', '\App\Http\Controllers\PostController@index');

// 创建文章
Route::get('/posts/create', '\App\Http\Controllers\PostController@create');
Route::post('/posts/create', '\App\Http\Controllers\PostController@store');

// 文章详情页
Route::get('/posts/{post}', '\App\Http\Controllers\PostController@show');

// 编辑文章
Route::get('/posts/{post}/edit', '\App\Http\Controllers\PostController@edit');
Route::put('/posts/{post}', '\App\Http\Controllers\PostController@update');
// 删除文章
Route::get('/posts/{post}/delete', '\App\Http\Controllers\PostController@delete');

// 图片上传
Route::post('/posts/image/upload','\App\Http\Controllers\PostController@imageUpload');

// 评论
Route::post('/posts/{post}/comment','\App\Http\Controllers\PostController@comment');

// 赞
Route::get('/posts/{post}/zan','\App\Http\Controllers\PostController@zan');
Route::get('/posts/{post}/unzan','\App\Http\Controllers\PostController@unzan');

// 字典查询页面
Route::get('/dicts/search', '\App\Http\Controllers\DictController@search');
//Route::post('/dicts', '\App\Http\Controllers\DictController@query');

Route::get('/dicts', '\App\Http\Controllers\DictController@index');
// 创建文章
Route::get('/dicts/create', '\App\Http\Controllers\DictController@create');
Route::post('/dicts/create', '\App\Http\Controllers\DictController@store');

// 文章详情页
Route::get('/dicts/{dict}', '\App\Http\Controllers\DictController@show');

// 编辑文章
Route::get('/dicts/{dict}/edit', '\App\Http\Controllers\DictController@edit');
Route::put('/dicts/{dict}', '\App\Http\Controllers\DictController@update');
// 删除文章
Route::get('/dicts/{dict}/delete', '\App\Http\Controllers\DictController@delete');


Route::get('/dict', '\App\Http\Controllers\DictController@queryWord');

Route::resource("books",'\App\Http\Controllers\BookController');

Route::get("books/{book}/delete",'\App\Http\Controllers\BookController@delete');

Route::resource("olbooks",'\App\Http\Controllers\OlBookController');

Route::resource("olcatalogs",'\App\Http\Controllers\OlCatalogController');

Route::resource("olcontents",'\App\Http\Controllers\OlContentController');


// 音乐
Route::get('/play', '\App\Http\Controllers\PlayerController@index');

Route::resource("lyrics",'\App\Http\Controllers\LyricController');
Route::get("lyric/search",'\App\Http\Controllers\LyricController@search');


// 关于我们
Route::get("about",function (){
    return view('about.index');
});
Route::get("radio",function (){
    return view('radio.index');
});

Route::get("video",function (){
    return view('video.index');
});

Route::get("software",function (){
    return view('software.index');
});

Route::get("other",function (){
    return view('other.index');
});

require_once('resource.php');