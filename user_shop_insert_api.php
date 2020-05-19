<?php
require __DIR__ . '/__connect_db.php';

$page_name = 'user_shop_list';

$result = [
    'success' => false,
    'errorCode' => 0,
    'errorMsg' => '資料錯誤或不完整！',
    'post' => [],
];


if (isset($_POST['shopName'])) {
    $shopName = $_POST['shopName'];
    $shopAccount = $_POST['shopAccount'];
    $shopPwd = $_POST['shopPwd'];
    $shopPhone = $_POST['shopPhone'];
    $shopEmail = $_POST['shopEmail'];
    $shopOwner = $_POST['shopOwner'];
    $shopAgent = $_POST['shopAgent'];
    $shopAddress = $_POST['shopAddress'];
    $shopAddressUrl = $_POST['shopAddressUrl'];
    $shopInfo = $_POST['shopInfo'];
    $shopId = $_POST['shopId'];
    $shopImg = $_POST['shopImg'];

    $result['post'] = $_POST;

    if (empty($shopName)
        or empty($shopAccount)
        or empty($shopPwd)
        or empty($shopPhone)
        or empty($shopEmail)
        or empty($shopOwner)
        or empty($shopAgent)
        or empty($shopAddress)
        or empty($shopId)) {
        $result['errorCode'] = 400;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }

    // 檢查name
    if (strlen($shopName) < 2) {
        $result['errorCode'] = 401;
        $result['errorMsg'] = '店家名稱格式錯誤';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }

    //檢查密碼
    if (strlen($shopPwd) < 6) {
        $result['errorCode'] = 402;
        $result['errorMsg'] = '密碼格式錯誤';
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }


    $sql = "INSERT INTO `user_shop`(
            `shopName`, `shopAccount`, `shopPwd`, `shopPhone`, 
            `shopEmail`, `shopOwner`, `shopAgent`, `shopAddress`, 
            `shopAddressUrl`, `shopInfo`, `shopId`, `shopImg`)
            VALUE (?,?,?,?,?,?,?,?,?,?,?,?)";

    try {
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['shopName'],
            $_POST['shopAccount'],
            $_POST['shopPwd'],
            $_POST['shopPhone'],
            $_POST['shopEmail'],
            $_POST['shopOwner'],
            $_POST['shopAgent'],
            $_POST['shopAddress'],
            $_POST['shopAddressUrl'],
            $_POST['shopInfo'],
            $_POST['shopId'],
            $_POST['shopImg'],
        ]);

        if ($stmt->rowCount() == 1) {
            $result['success'] = true;
            $result['errorCode'] = 200;
            $result['errorMsg'] = '';
        } else {
            $result['errorCode'] = 404;
            $result['errorMsg'] = '資料新增失敗';
        }
    }catch (PDOException $ex){
        //account
        $accountSql = "SELECT * FROM `user_shop` WHERE `shopAccount`=?";
        $accountstmt = $pdo->prepare($accountSql);
        $accountstmt->execute([
            $_POST['shopAccount'],
        ]);

        if ($accountstmt->rowCount()>0){
            $result['errorCode'] = 405;
            $result['errorMsg'] = '已有相同帳號';
        }

        //mail
        $emailSql = "SELECT * FROM `user_shop` WHERE `shopEmail`=?";
        $emailstmt = $pdo->prepare($emailSql);
        $emailstmt->execute([
            $_POST['shopEmail'],
        ]);

        if ($emailstmt->rowCount()>0){
            $result['errorCode'] = 406;
            $result['errorMsg'] = '信箱重複申請';
        }

        //id
        $idSql = "SELECT * FROM `user_shop` WHERE `shopid`=?";
        $idstmt = $pdo->prepare($idSql);
        $idstmt->execute([
            $_POST['shopId'],
        ]);

        if ($idstmt->rowCount()>0){
            $result['errorCode'] = 407;
            $result['errorMsg'] = '此營利事業登記證號已申請';
        }


    }
}
echo  json_encode($result, JSON_UNESCAPED_UNICODE);