<?php
$upload_dir = __DIR__. '/uploads/';

header('Content-Type: application/json');

$result = [
    'success' => false,
    'filename' => '',
    'info' => '',
    'result' => '',
];

if(empty($_FILES['my_file3'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$filename = uniqid().$_FILES['my_file3']['name'];

// switch($_FILES['pImg']['type']){
//     case 'image/jpeg':
//         $filename .= '.jpg';
//         break;
//     case 'image/png':
//         $filename .= '.png';
//         break;
//     default:
//         $result['info'] = '格式不符';
//         echo json_encode($result, JSON_UNESCAPED_UNICODE);
//         exit;
// }

$result['filename'] = $filename;

$upload_file = $upload_dir. $filename;

if(move_uploaded_file($_FILES["my_file3"]["tmp_name"],$upload_file)){$result['success'] = true;}else {$result['info'] = '暫存檔無法搬移';}




//     if(move_uploaded_file($_FILES['my_file2']['tmp_name'], $upload_file2)){
        
        
//             $result['success'] = true;
        
    
    
 
// }

echo json_encode($result, JSON_UNESCAPED_UNICODE);








