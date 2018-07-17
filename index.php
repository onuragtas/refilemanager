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
            $res = false;
            $total = count($_FILES['upload']['name']);
            for( $i=0 ; $i < $total ; $i++ ) {
                $name = $_FILES['upload']['name'][$i];
                $tmp_name = $_FILES['upload']['tmp_name'][$i];
                if ($name != ""){;
                  if($this->upload($name, $tmp_name, $path)) {
                      $res = true;
                  }
                }
              }
              if(!$res){
                $_SESSION['error'] = "Error";
              }
            //   header("location:".$this->createURL());
        }

        include "templates/".$this->config['template']."/index.php";
    }
}
new Page();
?>