<!DOCTYPE html>
<html lang="tr">
<head>
    <title>ReFileManager</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/mm.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/toastr.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <?php if(isset($_SESSION['error'])): ?>
    <div class="modal-body">
        <div id="media-manager-2" class="media-manager">
            <div class="mm" style="height: 100px;">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php endif ?>

    <div class="modal-body">
        <div id="media-manager-2" class="media-manager">
            <div class="mm" >
                <!---->
                <!---->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="notification-widget"></div>
                        <ol class="breadcrumb">
                        <?php foreach(explode("/",$path) as $f): ?>
                        <li>
                                <a><?php echo $f ?></a>
                            </li>
                        <?php endforeach ?>
                            
                        </ol>
                        <form method="post" style="float:right;margin-top:-50px; width:330px;" enctype="multipart/form-data" class="animated fadeIn">
                                        
                                        <input id="" style="float:left" type="file" name="files" multiple="multiple">
                                        <input id="" style="float:left" type="submit" name="send" value="Gönder">
                                    </form>
                        <div class="mm-content">
                            <div class="upload-widget animated fadeIn">
                                <div class="upload-drop-zone">
                                    
                                </div>
                            </div>

                            <div class="medias-widget clearfix animated fadeIn">
                                <div class="medias clearfix">
                                    <div class="file file-no-title animated fadeIn">
                                        <div class="file-preview">
                                            <div class="icon">
                                                <a href="<?php echo $this->createURL($this->backURL($path)) ?>"><img src="images/back.png" /></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php foreach($this->getList($path) as $f): ?>
                                    <?php if(is_file($path.$f)){?>
                                    <div class="file animated fadeIn">
                                        <div class="files-title">
                                            <h3 style="margin: 0;font-size: 14px;"><a href="<?php echo $this->createURL($path.$f, true) ?>">Sil</a></h3>
                                        </div>
                                        <div class="select file-preview" id="<?php echo str_replace($this->config['path'],$this->config['return_path'], $path.$f) ?>">
                                            <?php if(in_array($this->extension($path.$f),$this->config['image_ext'])): ?>
                                            <img style="width:132px; height:110px;" src="<?php echo $path.$f ?>" class="thumb">
                                            <?php elseif(in_array($this->extension($path.$f),$this->config['video_ext'])): ?>
                                            <img style="width:132px; height:110px;" src="images/film.png" class="thumb">
                                            <?php elseif(in_array($this->extension($path.$f),$this->config['music_ext'])): ?>
                                            <img style="width:132px; height:110px;" src="images/muzik.png" class="thumb">
                                            <?php elseif(in_array($this->extension($path.$f),$this->config['application_ext'])): ?>
                                            <img style="width:132px; height:110px;" src="images/apk.png" class="thumb">
                                            <?php endif ?>
                                        </div>
                                        <div class="file-title select file-preview" id="<?php echo str_replace($this->config['path'],$this->config['return_path'], $path.$f) ?>">
                                            <h3><?php echo $f ?></h3>
                                        </div>
                                    </div>
                                    <?php }else{ ?>
                                    <div class="file animated fadeIn">
                                        <div class="file-preview">
                                            <a href="<?php echo $this->createURL($path.$f."/") ?>"><img src="images/folder.png" class="thumb"></a>
                                        </div>
                                        <div class="file-title">
                                            <h3><?php echo $f ?></h3>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    <?php endforeach ?>
                                </div>
                                <!---->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/toastr.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".select").click(function(){
                id = $(this).attr("id")
                <?php foreach($_GET['fields'] as $field): ?>
                <?php $exp = explode("||", $field); ?>
                $(window.opener.document).find("#<?php echo $exp[0] ?>").attr("<?php echo $exp[1] ?>",$.trim(id))
                <?php endforeach ?>
                window.close();
            })
        })

    </script>

</body>

</html>