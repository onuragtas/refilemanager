<?php
include "config.php";
class Functions extends config {
    function __construct(){
        parent::__construct();
        $this->checkPermission();
    }
    function checkPermission(){
        if(!isset($_SESSION['user'])){
            header("location:http://google.com");
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

    function upload($file, $dir){
        if(in_array($this->extension($file['name']), $this->config['music_ext']) || in_array($this->extension($file['name']), $this->config['video_ext']) || in_array($this->extension($file['name']), $this->config['image_ext']) || in_array($this->extension($file['name']),$this->config['application_ext']) || in_array($this->extension($file['name']),$this->config['document_ext'])){
            $time = time();
            if(move_uploaded_file ($file['tmp_name'],$dir.$time.$this->extension($file['name']))){
                return [$dir.$time.$this->extension($file['name']), true];
            }
        }else{
            return [null, false];
        }
    }

    function extension($name){
        $ext = ".".pathinfo($name, PATHINFO_EXTENSION);
        return $ext;
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