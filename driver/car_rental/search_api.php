<?php
    header('Content-Type: application/json'); //設定資料類型為 json

    if ($_SERVER['REQUEST_METHOD'] == "POST") { //如果是 POST 請求
        @$name = $_POST["name"]; //取得 name POST 值
        @$phoneNumber = $_POST["phoneNumber"];
        @$identity = $_POST["identity"];
        @$gender = $_POST["gender"]; //取得 gender POST 值
        if ($name != null || $phoneNumber != null || $identity != null || $gender != null) { //如果 name 或 gender 有填寫
            //回傳 name 和 gender json 資料
            echo json_encode(array(
                'name' => $name,
                'phoneNumber' => $phoneNumber,
                'identity' => $identity,
                'gender' => $gender
            ));
        } else {
            //回傳 errorMsg json 資料
            echo json_encode(array(
                'errorMsg' => '資料未輸入完全！'
            ));
        }
    } else {
        //回傳 errorMsg json 資料
        echo json_encode(array(
            'errorMsg' => '請求無效，只允許 POST 方式訪問！'
        ));
    }
?>