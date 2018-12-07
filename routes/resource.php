<?php
/**
 * Created by PhpStorm.
 * User: heshen
 * Date: 2018/8/13
 * Time: 23:37
 */

Route::get('/fonts/font-manchu','\App\Http\Controllers\ResourceController@fonts_font_manchu_css');
Route::get('/fonts/manchu/{file}/woff','\App\Http\Controllers\ResourceController@fonts_manchu_woff');
Route::get('/fonts/manchu/{file}/ttf','\App\Http\Controllers\ResourceController@fonts_manchu_ttf');

Route::get('/fonts/manchu/Ab_Trans_V_B','\App\Http\Controllers\ResourceController@fonts_manchu_Ab_Trans_V_B_ttf');

Route::get('/css/{file}','\App\Http\Controllers\ResourceController@css');
Route::get('/js/{file}','\App\Http\Controllers\ResourceController@js');
Route::get('/img/{file}','\App\Http\Controllers\ResourceController@img');

Route::get('/pic/{one?}/{two?}/{three?}/{four?}/{five?}/{six?}/{seven?}/{eight?}/{nine?}','\App\Http\Controllers\ResourceController@pic');

Route::get('/file/{one?}/{two?}/{three?}/{four?}/{five?}/{six?}/{seven?}/{eight?}/{nine?}','\App\Http\Controllers\ResourceController@file');


Route::get('/text/{one?}/{two?}/{three?}/{four?}/{five?}/{six?}/{seven?}/{eight?}/{nine?}','\App\Http\Controllers\ResourceController@text');

Route::get('/storage/{one?}/{two?}/{three?}/{four?}/{five?}/{six?}/{seven?}/{eight?}/{nine?}','\App\Http\Controllers\ResourceController@pic');



Route::get('/ime_manchu', '\App\Http\Controllers\ImeController@index');


