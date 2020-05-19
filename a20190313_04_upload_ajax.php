<?php
$upload_dir = __DIR__. '/uploads/';

header('Content-Type: application/json');

$result = [
    'success' => false,
    'filename' => '',
    'info' => '',
];

if(empty($_FILES['my_file'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}

$filename = uniqid().$_FILES['my_file']['name'];
// $filename2 = uniqid().$_FILES['my_file2']['name'];
// $filename3 = uniqid().$_FILES['my_file3']['name'];

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
// $result['filename2'] = $filename2;
// $result['filename3'] = $filename3;
$upload_file = $upload_dir. $filename;
// $upload_file2 = $upload_dir. $filename2;
// $upload_file3 = $upload_dir. $filename3;

if(move_uploaded_file($_FILES["my_file"]["tmp_name"],$upload_file)){}
// if(move_uploaded_file($_FILES["my_file2"]["tmp_name"],$upload_file2)){}
// if(move_uploaded_file($_FILES["my_file3"]["tmp_name"],$upload_file3)){}




//     if(move_uploaded_file($_FILES['my_file2']['tmp_name'], $upload_file2)){
        
        
//             $result['success'] = true;
        
    
    
// } else {
//     $result['info'] = '暫存檔無法搬移';
// }

echo json_encode($result, JSON_UNESCAPED_UNICODE);








