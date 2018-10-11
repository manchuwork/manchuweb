<?php


Route::group(['middleware' => 'can:topic'],function(){
    Route::resource('topics','\App\Admin\Controllers\TopicController',['only' => ['index','create','store','destory']]);
});
