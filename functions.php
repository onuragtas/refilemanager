<?php
include "config.php";
class Functions extends config {
    function __construct(){
        parent::__construct();
        $this->checkPermission();
    }
    function checkPermission(){
        if(!isset($_SESSION['user'])){
            // header("location:http://google.com");
        }
    }
    function getList($path){
        $files = array_diff(scandir($path), array('.', '..','.htaccess',".ckfinder",'.thumbs'));
        return $files;
    }

    function getUrl(){
        $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        return $actual_link;
    }


    function backURL($path){
        $exp = explode("/", substr($path, 0, -1));
        $path = str_replace(end($exp)."/", "", $path);
        return $path;
    }
    function backURLdelete($path){
        $exp = explode("/", $path);
        $path = str_replace(end($exp), "", $path);
        return $path;
    }

    function upload($name, $tmp_name, $dir){
        if(in_array($this->extension($name), $this->config['music_ext']) || in_array($this->extension($name), $this->config['video_ext']) || in_array($this->extension($name), $this->config['image_ext']) || in_array($this->extension($name),$this->config['application_ext']) || in_array($this->extension($name),$this->config['document_ext'])){
            $time = time();
            if(move_uploaded_file ($tmp_name,$dir.$name)){
                return [$dir.$time.$this->extension($name), true];
            }
        }else{
            return [null, false];
        }
    }

    function extension($name){
        $ext = ".".pathinfo($name, PATHINFO_EXTENSION);
        return $ext;
    }

    function getUploadURL(){
        $exp = explode('/', $_SERVER['REQUEST_URI']);
        $p = str_replace(end($exp),"",$_SERVER['REQUEST_URI']);
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/";
        return $url;
    }

    function createURL($path = null, $delete = null){
        $uri_parts = explode('?', $_SERVER['REQUEST_URI'], 2);
        $url = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$uri_parts[0]?";
        // $url = "index.php?";
        $res = false;
        foreach($_GET as $key=>$value){
            
            if($key == "path" && !empty($path)){
                $url .= $key."=".$path."&";
                $res = true;
            }else if($key == "fields"){
                foreach($value as $v){
                    $url .= "fields[]=".$v."&";
                }
            }else{
                if(empty($delete) && $value == "delete"){
                
                }else{
                    $url .= $key."=".$value."&";
                }
            }
        }
        if(!$res && !empty($path)){
            $url .= "path=".$path."&";
        }
        $url = substr($url, 0, -1);
        if(!empty($delete)){
            $url .= "&i=delete";
        }
        return $url;
    }
}
?>