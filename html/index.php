<?php 
ob_start();
session_start();
?>

<?php
include ('functions.php');
class Page extends Functions{
    function __construct(){
        parent::__construct();
        $path = @$_GET['path'];

        if(@$_GET['i'] == "delete"){
            unlink($_GET['path']);
            header("location:".$this->createURL($this->backURLdelete($path)));
        }


        if(empty($path) || $path == "../"){
            $path = $this->config['path'];
            // createURL($path);
            header("location:".$this->createURL($path));
        }

        if($_POST){
            $file = $_FILES['files'];
            $up = $this->upload($file, $path);
            if($up[1]){
                header("location:".$this->createURL());
            }else{
                $_SESSION['error'] = "Error";
                header("location:".$this->createURL());
            }
        }

        include "templates/".$this->config['template']."/index.php";
    }
}
new Page();
?>