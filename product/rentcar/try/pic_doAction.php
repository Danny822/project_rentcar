<?php

header('content-type:text/html;charset=utf-8');

include_once "upload.func.php";

$files=getFiles();

foreach ($files as $fileInfo){
    $res = uploadFile($fileInfo);
    
    echo $res["mes"] ."<br>";

    if(!empty($res["dest"])){
        $uploadFiles[]=$res["dest"];
    }
    
}

print_r($uploadFiles);

