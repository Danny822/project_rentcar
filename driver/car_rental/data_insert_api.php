<?php

require __DIR__. '/__connect_db.php';

header('Content-Type: application/json');

$result = [
    'success' => false,
    'errorCode' => 0,
    'errorMsg' => '資料輸入不完整',
    'post' => [], // 做 echo 檢查，給資料，然後回資料      
        
];

if(isset($_POST['checkme'])){

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
    

    //若是空字串或0，empty會是true，所以是true的話，表示有的欄位沒填好
    if(empty($driverName) or empty($driverPhone) or empty($driverEmail) or empty($driverId)){
        $result['errorCode'] = 400;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }

    //empty($driverName) or empty($driverGender) or empty($driverAccount) or empty($driverPwd) or empty($driverPhone)
    //or empty($driverEmail) or empty($driverAddress) or empty($driverBirthday) or empty($driverId)
    

     // TODO: 檢查 name 長度
    //檢查 email 格式 ，true的話表示是email
    if(! filter_var($driverEmail, FILTER_VALIDATE_EMAIL)){
        $result['errorCode'] = 405;
        $result['errorMsg'] = 'Email格式不正確';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    };

    $sql = "INSERT INTO `driver`(`driverName`, `driverGender`, `driverAccount`, `driverPwd`, `driverPhone`, 
                        `driverEmail`, `driverAddress`, `driverBirthday`, `driverId`, `driverPhotoName`
                        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            

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
        ]);

        if($stmt->rowCount()==1){
            $result['success'] = true;
            $result['errorCode'] = 200;
            $result['errorMsg'] = '';
        } else {
            $result['errorCode'] = 402;
            $result['errorMsg'] = '資料新增錯誤';
        }

    } catch(PDOException $ex) {
        

        //driverAccount & driverId
        // $accountIdSql = "SELECT * FROM `driver` WHERE `driverAccount`=? OR `driverId`=?";
        // $accountIdstmt = $pdo->prepare($accountIdSql);
        // $accountIdstmt->execute([
        //     $_POST['driverAccount'],
        //     $_POST['driverId']
        // ]);

        // if ($accountIdstmt->rowCount()>0){
        //     $result['errorCode'] = 409;
        //     $result['errorMsg'] = '已有相同帳號及身分證字號';
        // }


        //driverAccount
        $accountSql = "SELECT * FROM `driver` WHERE `driverAccount`=?";
        $accountstmt = $pdo->prepare($accountSql);
        $accountstmt->execute([
            $_POST['driverAccount']
        ]);

        if ($accountstmt->rowCount()>0){
            $result['errorCode'] = 406;
            $result['errorMsg'] = '已有相同帳號';
        }

        //driverEmail
        $emailSql = "SELECT * FROM `driver` WHERE `driverEmail`=?";
        $emailstmt = $pdo->prepare($emailSql);
        $emailstmt->execute([
            $_POST['driverEmail'],
        ]);

        if ($emailstmt->rowCount()>0){
            $result['errorCode'] = 407;
            $result['errorMsg'] = '信箱重複申請';
        }

        //driverId
        $idSql = "SELECT * FROM `driver` WHERE `driverId`=?";
        $idstmt = $pdo->prepare($idSql);
        $idstmt->execute([
            $_POST['driverId'],
        ]);

        if ($idstmt->rowCount()>0){
            $result['errorCode'] = 408;
            $result['errorMsg'] = '已有相同身分證字號';
        }

        
        
    };
    
}

echo json_encode($result, JSON_UNESCAPED_UNICODE);

