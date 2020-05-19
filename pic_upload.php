<?php
$upload_dir=__DIR__."/upload/";

header('Content-Type: application/json');

// $result=[
//     "success"=>false,
//     "filename"=>"",
//     "info"=>"",
// ];

// if(empty($_FLIES["pImg"])){
//     $result["info"]="沒有檔案";
//     echo json_encode($result, JSON_UNESCAPED_UNICODE);
//     exit;
// }

// $filename =sha1($_FILES["pImg"]["name"].uniqid());

// switch($_FILES["pImg"]["type"]){
//     case "image/jpeg":
//         $filename .=".jpg";
//         break;
//     case "image/png":
//         $filename .= ".png";
//         break;
//     default:
//         $result["info"]="格式不符";
//         echo json_encode($result, JSON_UNESCAPED_UNICODE);
//     exit;
// }
// $result["filename"]=$filename;
// $upload_file=$upload_dir.$filename;


//     if(move_upload_file($_FILES["pImg"]["tmp_name"],$upload_file)){
        
//         $result["success"]=true;
//     }else{
//         $result["info"]="暫存檔無法搬移";
//     }
//     echo json_encode($result, JSON_UNESCAPED_UNICODE);

    
    ?>
