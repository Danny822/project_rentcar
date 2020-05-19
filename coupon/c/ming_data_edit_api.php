<?php
// require __DIR__. '/__cred.php';
require __DIR__. '/__connect_db.php';

header('Content-Type: application/json');

$result = [
    'success' => false,
    'errorCode' => 0,
    'errorMsg' => '資料輸入不完整',
    'post' => [], // 做 echo 檢查      
];

$couponSid = isset($_POST['couponSid']) ? intval($_POST['couponSid']) : 0;

if(isset($_POST['couponNo'])){

    $couponNo = $_POST['couponNo'];
    $couponInfo = $_POST['couponInfo'];
    $couponFunc = $_POST['couponFunc'];
    $couponState = $_POST['couponState'];
    

    $result['post'] = $_POST; // 做 echo 檢查

    if(empty($couponNo) or empty($couponInfo) or empty($couponFunc) or empty($couponState)){
        $result['errorCode'] = 400;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // TODO: 檢查 mobile 格式

    // 1. 修改資料之前可以先確認該筆資料是否存在
    // 2. Email 有沒有跟別筆的資料相同

    // $s_sql = "SELECT * FROM `coupon` WHERE `sid`=? OR `email`=?";
    // $s_stmt = $pdo->prepare($s_sql);
    // $s_stmt->execute([$sid, $_POST['email']]);

    // switch($s_stmt->rowCount()){
    //     case 0:
    //         $result['errorCode'] = 410;
    //         $result['errorMsg'] = '該筆資料不存在';
    //         echo json_encode($result, JSON_UNESCAPED_UNICODE);
    //         exit;
    //         //break;
    //     case 2:
    //         $result['errorCode'] = 420;
    //         $result['errorMsg'] = 'Email 已存在';
    //         echo json_encode($result, JSON_UNESCAPED_UNICODE);
    //         exit;
    //     case 1:
    //         $row = $s_stmt->fetch(PDO::FETCH_ASSOC);
    //         if($row['sid']!=$sid){
    //             $result['errorCode'] = 430;
    //             $result['errorMsg'] = '該筆資料不存在';
    //             echo json_encode($result, JSON_UNESCAPED_UNICODE);
    //             exit;
    //         }
    // }

    $sql = "UPDATE `coupon` SET 
                `couponNo`=?,
                `couponInfo`=?,
                `couponFunc`=?,
                `couponState`=?
               
                WHERE `couponSid`=?";

    try {
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['couponNo'],
            $_POST['couponInfo'],
            $_POST['couponFunc'],
            $_POST['couponState'],
            $couponSid
        ]);

        if($stmt->rowCount()==1) {
            $result['success'] = true;
            $result['errorCode'] = 200;
            $result['errorMsg'] = '';
        } else {
            $result['errorCode'] = 402;
            $result['errorMsg'] = '資料沒有修改';
        }
    } catch(PDOException $ex){
        $result['errorCode'] = 403;
        $result['errorMsg'] = '資料更新發生錯誤';
    }
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);

