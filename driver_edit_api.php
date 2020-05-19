<?php

//require __DIR__. '/__cred.php';
require __DIR__. '/__connect_db.php';

header('Content-Type: application/json');

$result = [
    'success' => false,
    'errorCode' => 0,
    'errorMsg' => '資料錯誤或不完整',
    'post' => [], // 做 echo 檢查    
];

$driverNo = isset($_POST['driverNo']) ? ($_POST['driverNo']) : 0;

if(isset($_POST['driverName'])){

    $driverName = $_POST['driverName'];
    $driverGender = $_POST['driverGender'];
    $driverAccount = $_POST['driverAccount'];
    $driverPwd = $_POST['driverPwd'];
    $driverPhone = $_POST['driverPhone'];
    $driverEmail = $_POST['driverEmail'];
    $driverAddress = $_POST['driverAddress'];
    $driverBirthday = $_POST['driverBirthday'];
    $driverId = $_POST['driverId'];
    $driverPhotoName = $_POST['driverPhotoName'];

    $result['post'] = $_POST; // 做 echo 檢查 
    
    

    if(empty($driverName) 
        or empty($driverGender) 
        or empty($driverAccount) 
        or empty($driverPwd) 
        or empty($driverPhone)
        or empty($driverEmail) 
        or empty($driverAddress) 
        or empty($driverBirthday) 
        or empty($driverId) ){
        $result['errorCode'] = 400;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // 檢查name
    // if (strlen($driverName) < 2) {
    //     $result['errorCode'] = 401;
    //     $result['errorMsg'] = '駕駛姓名格式錯誤';
    //     echo json_encode($result, JSON_UNESCAPED_UNICODE);
    //     exit;
    // }
    
    //檢查密碼
    // if (strlen($driverPwd) < 6) {
    //     $result['errorCode'] = 402;
    //     $result['errorMsg'] = '密碼格式錯誤';
    //     echo json_encode($result, JSON_UNESCAPED_UNICODE);
    //     exit;
    // }
    
    //檢查 email 格式 ，true的話表示是email
    if(! filter_var($driverEmail, FILTER_VALIDATE_EMAIL)){
        $result['errorCode'] = 405;
        $result['errorMsg'] = 'Email格式不正確';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    };

    // 1.修改資料前可以先確認該筆資料是否存在
    // 2. Email 有沒有跟別筆的資料相同


    $s_sql = "SELECT * FROM `driver` WHERE `driverNo`=? OR `driverEmail`=?";//在此用欲修改的email去做檢查
                                                                            //如果出現兩筆，表示有重複的email
    $s_stmt = $pdo->prepare($s_sql);
    $s_stmt->execute([$driverNo, $_POST['driverEmail']]);//放兩個值 一個是mNo 一個是傳進來的mEmail

    switch($s_stmt->rowCount()){
        case 0:
            $result['errorCode'] = 410;
            $result['errorMsg'] = '該筆資料不存在';
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            exit;
        case 2:
            $result['errorCode'] = 420;
            $result['errorMsg'] = 'Email 已存在';
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            exit;
        case 1:
            $row = $s_stmt->fetch(PDO::FETCH_ASSOC);
            if($row['driverNo']!=$driverNo){
                $result['errorCode'] = 430;
                $result['errorMsg'] = '該筆資料不存在';
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                exit;
            }
    }




    $sql = "UPDATE `driver` SET 
                `driverName`=?,
                `driverGender`=?,
                `driverAccount`=?,
                `driverPwd`=?,
                `driverPhone`=?,
                `driverEmail`=?,
                `driverAddress`=?,
                `driverBirthday`=?,
                `driverId`=?,
                `driverPhotoName`=?
                WHERE `driverNo`=?";

    try{
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['driverName'],
            $_POST['driverGender'],
            $_POST['driverAccount'],
            $_POST['driverPwd'],
            $_POST['driverPhone'],
            $_POST['driverEmail'],
            $_POST['driverAddress'],
            $_POST['driverBirthday'],
            $_POST['driverId'],
            $_POST['driverPhotoName'],
            $driverNo,
        ]);

        if($stmt->rowCount()==1){
            $result['success'] = true;
            $result['errorCode'] = 200;
            $result['errorMsg'] = '';
        } else {
            $result['errorCode'] = 402;
            $result['errorMsg'] = '資料修改錯誤';
        }

    } catch(PDOException $ex) {
        $result['errorCode'] = 403;
        $result['errorMsg'] = '資料更新發生錯誤';


        //driverAccount
        // $accountSql = "SELECT * FROM `driver` WHERE `driverAccount`=?";
        // $accountstmt = $pdo->prepare($accountSql);
        // $accountstmt->execute([
        //     $_POST['driverAccount']
        // ]);

        // if ($accountstmt->rowCount()>0){
        //     $result['errorCode'] = 405;
        //     $result['errorMsg'] = '已有相同帳號';
        // }

        //driverEmail
        // $emailSql = "SELECT * FROM `driver` WHERE `driverEmail`=?";
        // $emailstmt = $pdo->prepare($emailSql);
        // $emailstmt->execute([
        //     $_POST['driverEmail'],
        // ]);

        // if ($emailstmt->rowCount()>0){
        //     $result['errorCode'] = 406;
        //     $result['errorMsg'] = '信箱重複申請';
        // }

        //driverId
        // $idSql = "SELECT * FROM `driver` WHERE `driverId`=?";
        // $idstmt = $pdo->prepare($idSql);
        // $idstmt->execute([
        //     $_POST['driverId'],
        // ]);

        // if ($idstmt->rowCount()>0){
        //     $result['errorCode'] = 407;
        //     $result['errorMsg'] = '已有相同身分證字號';
        // }
    };

}

echo json_encode($result, JSON_UNESCAPED_UNICODE);

