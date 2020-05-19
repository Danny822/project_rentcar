<?php
require __DIR__. '/__cred.php';
require __DIR__. '/__connect_db.php';

header('Content-Type: application/json');

$result = [
    'success' => false,
    'errorCode' => 0,
    'errorMsg' => '資料輸入不完整',
    'post' => [], // 做 echo 檢查

];
$mNo = isset($_POST['mNo']) ? intval($_POST['mNo']) : 0;

if(isset($_POST['mName']) and !empty($mNo)){ //name本身勢必填欄位 在此看它有沒有被設定過
                                            //轉換以後，mNo不能是0
    $mName = $_POST['mName'];
    $mAccount = $_POST['mAccount'];
    $mPwd = $_POST['mPwd'];
    $mPhone = $_POST['mPhone'];
    $mPhoto = $_POST['mPhoto'];
    $mEmail = $_POST['mEmail'];
    $mAddress = $_POST['mAddress'];
    $mBirthday = $_POST['mBirthday'];
    $mId = $_POST['mId'];
    $mGender = $_POST['mGender'];

    $result['post'] = $_POST;  // 做 echo 檢查

    if(empty($mName) or empty($mAccount) or empty($mPwd)){
        $result['errorCode'] = 400;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // TODO: 檢查 name 長度

    // 檢查 email 格式
    if(! filter_var($mEmail, FILTER_VALIDATE_EMAIL)){
        $result['errorCode'] = 405;
        $result['errorMsg'] = 'Email 格式不正確';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }


    // TODO: 檢查 mobile 格式

    // 1. 修改資料之前可以先確認該筆資料是否存在
    // 2. Email 有沒有跟別筆的資料相同

    $s_sql = "SELECT * FROM `lessee` WHERE `mNo`=? OR `mAccount`=?"; //在此用欲修改的email去做檢查
                                                                        //如果出現兩筆，表示有重複的email
    $s_stmt = $pdo->prepare($s_sql);
    $s_stmt->execute([$mNo, $_POST['mAccount']]); //放兩個值 一個是mNo 一個是傳進來的mEmail

    switch($s_stmt->rowCount()){
        case 0:
            $result['errorCode'] = 410;
            $result['errorMsg'] = '該筆資料不存在';
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            exit;
        //break;
        case 2:
            $result['errorCode'] = 420;
            $result['errorMsg'] = '帳號已存在';
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            exit;
        case 1:
            $row = $s_stmt->fetch(PDO::FETCH_ASSOC);
            if($row['mNo']!=$mNo){ //檢查現在拿到的mNo跟資料庫的mNo是不是一樣
                $result['errorCode'] = 430;
                $result['errorMsg'] = '該筆資料不存在';
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                exit;
            }
    }

    $sql = "UPDATE `lessee` SET 
                `mName`=?,
                `mAccount`=?,
                `mPwd`=?,
                `mPhone`=?,
                `mPhoto`=?, 
                `mEmail`=?, 
                `mAddress`=?, 
                `mBirthday`=?, 
                `mId`=?, 
                `mGender`=? 
                WHERE `mNo`=?";

    try {
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['mName'],
            $_POST['mAccount'],
            $_POST['mPwd'],
            $_POST['mPhone'],
            $_POST['mPhoto'],
            $_POST['mEmail'],
            $_POST['mAddress'],
            $_POST['mBirthday'],
            $_POST['mId'],
            $_POST['mGender'],
            $mNo
        ]);

        if($stmt->rowCount()==1) { //rowCount() 是有修改的資料筆數 有可能是1或0
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
