<?php
/**
 * Created by PhpStorm.
 * User: heshen
 * Date: 2018/9/19
 * Time: 23:39
 */

namespace App\Tool;

use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Psy\Util\Json;

//use Intervention\Image\ImageManager;

class ImageTool
{

    /**
     * Initiate a mock expectation on the facade.
     *
     * @return \Mockery\Expectation
     */
    public static function saveImgTmpFromRequestByDateDir($imgFieldName, $subDir, $resizeWidth = 320, $resizeHeight= 240)
    {

        $dictpic = request()->file($imgFieldName);



        if(empty($dictpic)){

            return null;
        }


        $picDirPath = 'tmp'. DIRECTORY_SEPARATOR .date('Ymd') . DIRECTORY_SEPARATOR . $subDir;

        //dd("public_path:". public_path("a"));
        $storageDirPath = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $picDirPath);

        File::isDirectory($storageDirPath) or File::makeDirectory($storageDirPath, 0777, true, true);

        $picPath = $storageDirPath . DIRECTORY_SEPARATOR . ImageTool::extend_1($dictpic->hashName());

        $img = Image::make($dictpic->getPathname());

        //$img = Image::make($picPath);

        $img->resize($resizeWidth, null)->resize(null, $resizeHeight)->save($picPath);

        return $picDirPath  . DIRECTORY_SEPARATOR . ImageTool::extend_1($dictpic->hashName());
    }

    /**
     * Initiate a mock expectation on the facade.
     *
     * @return \Mockery\Expectation
     */
    public static function saveImgFromRequestByDateDir($imgFieldName, $subDir, $resizeWidth = 320, $resizeHeight= 240)
    {

        $dictpic = request()->file($imgFieldName);



        if(empty($dictpic)){

            return null;
        }


        $picDirPath = date('Ymd') . DIRECTORY_SEPARATOR . $subDir;

        //dd("public_path:". public_path("a"));
        $storageDirPath = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $picDirPath);

        File::isDirectory($storageDirPath) or File::makeDirectory($storageDirPath, 0777, true, true);

        $picPath = $storageDirPath . DIRECTORY_SEPARATOR . ImageTool::extend_1($dictpic->hashName());


//        var_dump($dictpic);
//        $ret = move_uploaded_file($dictpic->getPathname(), $picPath);
//
//        var_dump($picPath);
//        //dd("$storageDirPath DIRECTORY_SEPARATOR, ImageTool::extend_1(dictpic->hashName())". $dictpic->getRealPath());
//        dd("$picDirPath".$picDirPath. ", realPath:". $dictpic->getRealPath(). ", dictpic:". Json::encode($dictpic). ", ret". $ret);
//        $dir = $dictpic->storeAs($picDirPath ,ImageTool::extend_1($dictpic->hashName()));
//        //dd("dir:$dir, picDirPath:$picDirPath, picPath:$picPath");

        $img = Image::make($dictpic->getPathname());

        //$img = Image::make($picPath);

        $img->resize($resizeWidth, null)->resize(null, $resizeHeight)->save($picPath);
        //$img->resize(100,100)->save($storageDirPath . DIRECTORY_SEPARATOR ."100x100". $dictpic->hashName());
        //->insert('public/watermark.png');

       //dd("dir:$dir, picPath:$picPath, img:$img, dictpic:$dictpic");
        return $picDirPath  . DIRECTORY_SEPARATOR . ImageTool::extend_1($dictpic->hashName());
    }

    private static function extend_1($file_name){
        $retval="";
        $pt=strrpos($file_name, ".");

        if ($pt) $retval=substr($file_name, 0, $pt);

        //dd("pt:".$pt .", file_name:". $file_name. ", retval:". $retval);

        return ($retval);
    }

    public static function delete($file){

        Storage::delete($file);
    }
}