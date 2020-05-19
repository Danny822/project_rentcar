<?php

$upload_dir = __DIR__. '/uploads/';

header('Content-Type: application/json');

$result = [
    'success' => false,
    'filename' => '',
    'info' => '',
    'mAccount' => '',
];

if(empty($_FILES['my_file'])){
    echo json_encode($result, JSON_UNESCAPED_UNICODE);
    exit;
}
//$filename = $_FILES['my_file']['name']; //原檔名

$filename = $_POST['shopName'].uniqid(); //重新命名檔名
$shopName = $_POST['shopName'];
$test = $_POST['test'];

switch($_FILES['my_file']['type']){ //判斷type是不是我要的格式
    case 'image/jpeg':
        $filename .= '.jpg'; //接上副檔名
        break;
    case 'image/png':
        $filename .= '.png'; //接上副檔名
        break;
    default:
        $result['info'] = '格式不符';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
}
$result['filename'] = $filename;
$upload_file = $upload_dir. $filename;

if(move_uploaded_file($_FILES['my_file']['tmp_name'], $upload_file)){ //把暫存檔搬移到要放的位置
    $result['success'] = true;
} else {
    $result['info'] = '暫存檔無法搬移';
}
$result['shopName'] = $shopName;
$result['test'] = $test;
$result['source'] = '__m_upload.php';

echo json_encode($result, JSON_UNESCAPED_UNICODE);