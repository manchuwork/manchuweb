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

    public function text(){
        $this->headerCache();

        //获取当前的url
        $path = request()->path();
        $needle = "text";
        $realpath = substr_replace($path,"",strpos($path,$needle),strlen($needle));

        $path = storage_path("app".DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR .$realpath)  ;



        if(!file_exists($path)){
            echo 'not found ';
            //报404错误
            header("HTTP/1.1 404 Not Found");
            header("Status: 404 Not Found");
            exit;
        }
        //输出图片
        header('Content-type: text/plain');
        echo file_get_contents($path);
        exit;
    }


    public function pic(){
        $this->headerCache();

        //获取当前的url
        $path = request()->path();
        $needle = "pic";
        $realpath = substr_replace($path,"",strpos($path,$needle),strlen($needle));

        $path = storage_path("app".DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR .$realpath)  ;



        if(!file_exists($path)){
            echo 'not found ';
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

    public function file($file){

        //获取当前的url
        $path = request()->path();
        $needle = "file";

        $contentType = 'application/octet-stream';
        $extension = '';
        $pos = strrpos($path,"/");
        $fileName = $path;
        if($pos){
          $p = substr($path, $pos+1);

          $file_decode = base64_decode($p);

            $str_split = explode('|', $file_decode);

            $fileName = $file_decode;
            if(sizeof($str_split) == 3){
                $fileName = $str_split[0];
                $extension = $str_split[1];
                $mimeType = $str_split[2];

                switch ($mimeType){
                    case 'application/octet-stream':{
                        $contentType = 'application/octet-stream';
                        break;
                    }

                    case 'plain/text':{
                        $contentType = 'application/octet-stream';
                        break;
                    }
                    case 'application/pdf':{
                        $contentType = 'application/pdf';

                        break;
                    }
                    default:{
                        $contentType = 'application/octet-stream';

                        break;
                    }
                }
            }
        }

        $realpath = substr_replace($path,"",strpos($path,$needle),strlen($needle));
        $dir = storage_path("app".DIRECTORY_SEPARATOR."public" .$realpath)  ;

        if(!file_exists($dir)){
            return response("unkonw file", 404);
        }


        $this->download($dir,'file'.$fileName.'.'.$extension, $contentType);
        //http://www.manchu.work/file/20190302/bookfile/MHdtMExFSVRqbEhWTjB0SE12clh1ZGZ4TmhzakZ3cVE0bFM5NlF6d3xwZGZ8YXBwbGljYXRpb24vcGRm
        //return $this->res(file_get_contents($dir), $contentType);

    }

    /**
     * PHP-HTTP断点续传实现
     * @param string $path: 文件所在路径
     * @param string $file: 文件名
     * @param string $contentType type
     * @return void
     */
    function download($path,$file, $contentType) {
        $real = $path;//.'/'.$file;

        if(!file_exists($real)) {
            return false;
        }
        $size = filesize($real);
        $size2 = $size-1;
        $range = 0;

        if(isset($_SERVER['HTTP_RANGE'])) {   //http_range表示请求一个实体/文件的一个部分,用这个实现多线程下载和断点续传！
            header('HTTP /1.1 206 Partial Content');
            $range = str_replace('=','-',$_SERVER['HTTP_RANGE']);
            $range = explode('-',$range);
            $range = trim($range[1]);
            header('Content-Length:'.$size);
            header('Content-Range: bytes '.$range.'-'.$size2.'/'.$size);
        } else {
            header('Content-Length:'.$size);
            header('Content-Range: bytes 0-'.$size2.'/'.$size);
        }
        header('Accenpt-Ranges: bytes');


        if(isset($contentType)){
            header('Content-Type:'.$contentType);
        }else{
            header('Content-Type:application/octet-stream');
        }
        header("Cache-control: public");
        header("Pragma: public");
        //解决在IE中下载时中文乱码问题
        $ua = $_SERVER['HTTP_USER_AGENT'];
        if(preg_match('/MSIE/',$ua)) {    //表示正在使用 Internet Explorer。
            $ie_filename = str_replace('+','%20',urlencode($file));
            header('Content-Disposition:attachment; filename='.$ie_filename);
        } else {
            header('Content-Disposition:attachment; filename='.$file);
        }
        $fp = fopen($real,'rb+');
        fseek($fp,$range);                //fseek:在打开的文件中定位,该函数把文件指针从当前位置向前或向后移动到新的位置，新位置从文件头开始以字节数度量。成功则返回 0；否则返回 -1。注意，移动到 EOF 之后的位置不会产生错误。
        while(!feof($fp)) {               //feof:检测是否已到达文件末尾 (eof)
            set_time_limit(0);              //注释①
            print(fread($fp,1024));         //读取文件（可安全用于二进制文件,第二个参数:规定要读取的最大字节数）
            ob_flush();                     //刷新PHP自身的缓冲区
            flush();                       //刷新缓冲区的内容(严格来讲, 这个只有在PHP做为apache的Module(handler或者filter)安装的时候, 才有实际作用. 它是刷新WebServer(可以认为特指apache)的缓冲区.)
        }
        fclose($fp);
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


        return response("unkonw file", 404);
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
