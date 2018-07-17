<?php 
$name = $_POST['name'];
$path = $_POST['path'];
if(mkdir($path.$name, 0777, true)){
    echo "true";
}
?>