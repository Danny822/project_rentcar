<?php

    $upload_dir=__DIR__. "/uploads/";

    if(empty($_FILES["my_file"])){
        exit;
    }

    $upload_file=$upload_dir.$_FILES["my_file"]["name"];

    if(move_uploaded_file($_FILES["my_file"]["tmp_name"],$upload_file)){
        echo"{$_FILES["my_file"]["name"]}<br>";
        echo"{$_FILES["my_file"]["type"]}<br>";
        echo"{$_FILES["my_file"]["size"]}<br>";
    }else{
        echo "no";
    }




?>