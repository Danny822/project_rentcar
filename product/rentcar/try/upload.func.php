<?php

function getFiles() {
    $i=0;

    foreach($_FILES as $file){
        if(is_string($file["name"])){
            $files[$i]=$file;
            $i++;
        }
        elseif(is_array($file["name"])){
            foreach($file["name"] as $key=>$value){
                $files[$i]["name"]= $file["name"][$key];
                $files[$i]["type"]= $file["type"][$key];
                $files[$i]["tmp_name"]= $file["tmp_name"][$key];
                $files[$i]["error"]= $file["error"][$key];
                $files[$i]["size"]= $file["size"][$key];
                $i++;

            }
        }
    }
    return $files;
}