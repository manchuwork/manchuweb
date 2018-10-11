<?php
/**
 * Created by PhpStorm.
 * User: heshen
 * Date: 2018/8/10
 * Time: 01:28
 */

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class ResourceController extends Controller
{

    private function resourceHassets(){
        $d = dirname(dirname(dirname(dirname(__FILE__)))). DIRECTORY_SEPARATOR.'resources'.DIRECTORY_SEPARATOR. 'hassets'.DIRECTORY_SEPARATOR;
        return $d;
    }

    private function headerCache(){
        $timestamp = time();
        $interval = 60 * 60 * 12; // 6 hours
        header ("Last-Modified: " . gmdate ('r', $timestamp));
        header ("Expires: " . gmdate ("r", ($timestamp + $interval)));
        header ("Cache-Control: max-age=$interval");
    }



    public function pic(){
        $this->headerCache();

        //获取当前的url
        $path = request()->path();
        $needle = "pic";
        $realpath = substr_replace($path,"",strpos($path,$needle),strlen($needle));

        $path = storage_path("app".DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR .$realpath)  ;



        if(!file_exists($path)){
            echo 'not found '.$path;
            //报404错误
            header("HTTP/1.1 404 Not Found");
            header("Status: 404 Not Found");
            exit;
        }
        //输出图片
        header('Content-type: image/jpg');
        echo file_get_contents($path);
        exit;
    }

    public function fonts_font_manchu_css(){
        $file = 'font-manchu';
        $ext = ".css";
        $contentType = 'text/css; charset=UTF-8';

        $dir =  $this->resourceHassets().'fonts'.DIRECTORY_SEPARATOR;

        return $this-> resCurrentDirFile($dir, $file, $ext, $contentType);

    }

    public function fonts_manchu_woff($file){


        $ext = ".woff";
        $contentType = 'application/x-font-woff';

        $dir =  $this->resourceHassets().'fonts'.DIRECTORY_SEPARATOR.'manchu'.DIRECTORY_SEPARATOR;

        return $this-> resCurrentDirFile($dir, $file, $ext, $contentType);
    }

    public function fonts_manchu_ttf($file){


        $ext = ".ttf";
        $contentType = 'application/x-font-ttf';

        $dir =  $this->resourceHassets().'fonts'.DIRECTORY_SEPARATOR.'manchu'.DIRECTORY_SEPARATOR;

        return $this-> resCurrentDirFile($dir, $file, $ext, $contentType);
    }

    public function css($file){
        $type="css";
        $ext = ".". $type;
        $contentType = 'text/css; charset=UTF-8';

        $dir =  $this->resourceHassets().$type.DIRECTORY_SEPARATOR;

        return $this-> resCurrentDirFile($dir, $file, $ext, $contentType);

    }



    public function js($file){
        $type="js";
        $ext = ".". $type;
        $contentType = 'text/javascript; charset=UTF-8';

        $dir =  $this->resourceHassets().$type.DIRECTORY_SEPARATOR;

        return $this-> resCurrentDirFile($dir, $file, $ext, $contentType);
    }

    public function img($file){
        $type="png";
        $ext = ".". $type;
        $contentType = 'image/jpg';

        $dir =  $this->resourceHassets().'img'.DIRECTORY_SEPARATOR;

        return $this-> resCurrentDirFile($dir, $file, $ext, $contentType);
    }

    private function resCurrentDirFile($dir, $file, $ext, $contentType){

        $HTTP_IF_MODIFIED_SINCE = request()->get('HTTP_IF_MODIFIED_SINCE');
        if(isset($HTTP_IF_MODIFIED_SINCE)) {
            $browserCachedCopyTimestamp = strtotime(preg_replace('/;.*$/', '', $HTTP_IF_MODIFIED_SINCE));
            if($browserCachedCopyTimestamp + 604800 > time()){
                header("http/1.1 304 Not Modified");
                header ("Expires: " . gmdate ("r", (time() + 604800)));
                header ("Cache-Control: max-age=604800");
                exit;
            }
        }
        //扫描文件夹
        $files = scandir($dir);

        if(in_array($file. $ext, $files)){
            $d= $dir. $file. $ext;
            return $this->res(file_get_contents($d), $contentType);
        }


        return response("unkonw ". $file, 404);
    }

    private function res($content, $contentType){

        $timestamp = time();
        $interval = 60 * 60 * 24 * 512 ; // 6 hours
        return response($content)
            ->header('Content-Type', $contentType)
            ->header ("Last-Modified", gmdate ('r', $timestamp))
            ->header ("Expires" , gmdate ("r", ($timestamp + $interval)))
            ->header ("Cache-Control", "max-age=$interval");
    }
}
