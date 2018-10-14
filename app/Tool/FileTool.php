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
    public static function saveFileFromRequestByDateDir($imgFieldName, $subDir)
    {

        $dictpic = request()->file($imgFieldName);

        if(empty($dictpic)){

            return null;
        }
        $picDirPath = date('Ymd') . DIRECTORY_SEPARATOR . $subDir;
        $storageDirPath = storage_path('app' . DIRECTORY_SEPARATOR . 'public' . DIRECTORY_SEPARATOR . $picDirPath);

        File::isDirectory($storageDirPath) or File::makeDirectory($storageDirPath, 0777, true, true);

        $picPath = $storageDirPath . DIRECTORY_SEPARATOR . FileTool::extend_1($dictpic->hashName());

        copy($dictpic->getPathname(), $picPath);

        return $picDirPath  . DIRECTORY_SEPARATOR . FileTool::extend_1($dictpic->hashName());
    }

    private static function extend_1($file_name){
        $retval="";
        $pt=strrpos($file_name, ".");

        if ($pt) $retval=substr($file_name, 0, $pt);

        return ($retval);
    }

    public static function delete($file){

        Storage::delete($file);
    }
}