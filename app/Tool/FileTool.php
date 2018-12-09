<?php
/**
 * Created by PhpStorm.
 * User: heshen
 * Date: 2018/10/14
 * Time: 23:49
 */

namespace App\Tool;


use Illuminate\Support\Facades\File;

use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
use Psy\Util\Json;

//use Intervention\Image\ImageManager;
class FileTool
{

    /**
     * Initiate a mock expectation on the facade.
     *
     * @return \Mockery\Expectation
     */
    public static function saveFileFromRequestByDateDir01($imgFieldName, $subDir)
    {

        $file = request()->file($imgFieldName);

        $extension = $file->getClientOriginalExtension();
        $mimeType = $file->getMimeType();

       // echo ($extension.",mimeType:".$mimeType);

        if(empty($file)){

            return null;
        }
        $picDirPath = date('Ymd') . DIRECTORY_SEPARATOR . $subDir;
        $storageDirPath = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $picDirPath);

        File::isDirectory($storageDirPath) or File::makeDirectory($storageDirPath, 0777, true, true);

        $picPath = $storageDirPath . DIRECTORY_SEPARATOR . FileTool::extend_1($file->hashName(), $extension, $mimeType);

        copy($file->getPathname(), $picPath);

        return ['file'=>$picDirPath  . DIRECTORY_SEPARATOR . FileTool::extend_1($file->hashName(), $extension, $mimeType)
            ,
            'file_ext'=>$extension,
            'file_mimetype' => $mimeType];
    }

    /**
     * Initiate a mock expectation on the facade.
     *
     * @return \Mockery\Expectation
     */
    public static function saveFileFromRequestByDateDir($imgFieldName, $subDir)
    {

        $file = request()->file($imgFieldName);

//        $extension = $file->getClientOriginalExtension();
//        $mimeType = $file->getMimeType();

        //echo ($extension.",mimeType:".$mimeType);
        if(empty($file)){

            return null;
        }
        $picDirPath = date('Ymd') . DIRECTORY_SEPARATOR . $subDir;
        $storageDirPath = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $picDirPath);

        File::isDirectory($storageDirPath) or File::makeDirectory($storageDirPath, 0777, true, true);

        $picPath = $storageDirPath . DIRECTORY_SEPARATOR . FileTool::extend_1($file->hashName());

        copy($file->getPathname(), $picPath);

        return $picDirPath  . DIRECTORY_SEPARATOR . FileTool::extend_1($file->hashName());
    }

    private static function extend_1($file_name,  $extension = '', $mimeType = ''){
        $retval="";
        $pt=strrpos($file_name, ".");



        if ($pt) $retval=substr($file_name, 0, $pt);



        return str_replace('=','',base64_encode($retval.'|'. $extension.'|' .$mimeType));
    }

    public static function delete($file){

        Storage::delete($file);
    }
}