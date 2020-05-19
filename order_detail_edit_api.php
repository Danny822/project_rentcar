<?php
 //require __DIR__ . '/__cred.php';
require __DIR__ . '/__connect_db.php';

header('Content-Type: application/json');

$result = [
    'success' => false,
    'errorCode' => 0,
    'errorMsg' => '資料輸入不完整',
    'post' => [], //做echo檢查
];

$listNo = isset($_POST['listNo']) ? intval($_POST['listNo']) : 0;

if (isset($_POST['orderNo']) and !empty($listNo)) {

    //1.修改資料之前可以先確認該筆資料是否存在

    $orderNo = $_POST['orderNo'];
    $pNo = $_POST['pNo'];
    $startDate = $_POST['startDate'];
    $endDate = $_POST['endDate'];
    $pRent = $_POST['pRent'];
    $shopName = $_POST['shopName'];
    $rentcarStatus = $_POST['rentcarStatus'];
    $rentAddress = $_POST['rentAddress'];
    $deliveryFee = $_POST['deliveryFee'];
    $startPlace = $_POST['startPlace'];
    $endPlace = $_POST['endPlace'];

    $result['post'] = $_POST; //做echo檢查

    if ($rentcarStatus == 1) {
        $startPlace = '';
        if (
            empty($orderNo) or empty($pNo) or empty($startDate) or empty($endDate) or empty($pRent) or empty($shopName)
            or empty($rentAddress) or empty($deliveryFee) or empty($endPlace)
        ) {
            $result['errorCode'] = 400;
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            exit;
        }

    } else {
        $deliveryFee = 0;
        $rentAddress = '';
        if (
            empty($orderNo) or empty($pNo) or empty($startDate) or empty($endDate) or empty($pRent) or empty($shopName)
            or empty($startPlace) or empty($endPlace)
        ) {
            $result['errorCode'] = 401;
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            exit;
        }
        
    }


    $s_sql = "SELECT * FROM `order_detail` WHERE `listNo`=? OR `orderNo`=?";
    $s_stmt = $pdo->prepare($s_sql);
    $s_stmt->execute([$listNo, $_POST['orderNo']]);

    switch ($s_stmt->rowCount()) {
        case 0:
            $result['errorCode'] = 410;
            $result['errorMsg'] = '該筆資料不存在';
            echo json_encode($result, JSON_UNESCAPED_UNICODE);
            exit;
            //break;
            // case 2:
            //     $result['errorCode'] = 420;
            //     $result['errorMsg'] = 'Email 已存在';
            //     echo json_encode($result, JSON_UNESCAPED_UNICODE);
            //     exit;
        case 1:
            $row = $s_stmt->fetch(PDO::FETCH_ASSOC);
            if ($row['orderNo'] != $orderNo) {
                $result['errorCode'] = 430;
                $result['errorMsg'] = '該筆訂單資料不存在';
                echo json_encode($result, JSON_UNESCAPED_UNICODE);
                exit;
            }
    }

    $sql = "UPDATE `order_detail` SET 
                `orderNo`=?,
                `pNo`=?,
                `startDate`=?,
                `endDate`=?,
                `pRent`=?,
                `shopName`=?,
                `rentcarStatus`=?,
                `rentAddress`=?,
                `deliveryFee`=?,
                `startPlace`=?,
                `endPlace`=?   
                WHERE `listNo`=?";

    try {
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['orderNo'],
            $_POST['pNo'],
            $_POST['startDate'],
            $_POST['endDate'],
            $_POST['pRent'],
            $_POST['shopName'],
            $_POST['rentcarStatus'],
            $rentAddress,
            $deliveryFee,
            $startPlace,
            $_POST['endPlace'],
            $listNo
        ]);

        if ($stmt->rowCount() == 1) {
            $result['success'] = true;
            $result['errorCode'] = 200;
            $result['errorMsg'] = '';
        } else {
            $result['errorCode'] = 402;
            $result['errorMsg'] = '資料沒有修改';
        }
    } catch (PDOException $ex) {
        $result['errorCode'] = 403;
        $result['errorMsg'] = '資料更新發生錯誤';
    }
}
echo json_encode($result, JSON_UNESCAPED_UNICODE);

