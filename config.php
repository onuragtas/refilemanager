<?php
class config {
    public $config;
    function __construct(){
        $this->config = array(
            'path' => "uploads/",
            'return_path' => '/uploads/',
            'template' => "template",
    
            'image_ext' => array(".jpg",".jpeg",".png"),
            'video_ext' => array(".mp4",".3gp",".avi"),
            'music_ext' => array(".mp3"),
            'application_ext' => array(".apk"),
            'document_ext' => array(".doc",".pdf",".docx")
        );
    }
}
?>