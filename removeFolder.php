<?php 
function del($dir) { 
    $files = array_diff(scandir($dir), array('.','..')); 
     foreach ($files as $file) { 
       (is_dir("$dir/$file")) ? delTree("$dir/$file") : unlink("$dir/$file"); 
     } 
     return rmdir($dir); 
} 

$path = $_GET['path'];
if(del($path)){
    header("location:".$_SERVER['HTTP_REFERER']);
}
?>