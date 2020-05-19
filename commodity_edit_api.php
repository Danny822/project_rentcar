<?php

require __DIR__. '/__connect_db.php';

header("Content-Type: application/json");

$result =[ 
    'success' => false,
    'errorCode' => 0,
    'errorMsg' => '資料輸入不完整',
    'POST' => $_POST,
    'FILE' => 12,
    'post' => [],
    
];





$pNo = isset($_POST["pNo"])? intval($_POST["pNo"]): 0;

if(isset($_POST["pBrand"]) and !empty($pNo)){
    $pNo=$_POST["pNo"];
    $pBrand=$_POST["pBrand"];
    $pModel=$_POST["pModel"];
    $pSit=$_POST["pSit"];
    $pType=$_POST["pType"];
    $pOdo=$_POST["pOdo"];
    $pCc=$_POST["pCc"];
    $pAge=$_POST["pAge"];
    $pRent=$_POST["pRent"];
    $rentState=$_POST["rentState"];
    $rentAssign=$_POST["rentAssign"];
    $shopAddressSelect=$_POST["shopAddressSelect"];
    $shopName=$_POST["shopName"];
}  

$result["post"] = $_POST;  // 做 echo 檢查

    if(empty($pBrand) or empty($pModel) or empty($pSit)){
        $result['errorCode'] = 400;
        echo json_encode($result, JSON_UNESCAPED_UNICODE);
        exit;
    }


    $sql = "UPDATE `commodity` SET 
    `pBrand`=?, 
    `pModel`=?, 
    `pSit`=?, 
    `pType`=?, 
    `pOdo`=?, 
    `pCc`=?, 
    `pAge`=?, 
    `pRent`=?,
    `rentState`=?, 
    `rentAssign`=?, 
    `shopAddressSelect`=?,
    `shopName`=?,
    `pImg`=?,
    `pImg2`=?,
    `pImg3`=?
    WHERE `pNo` = ?";
               
try{
    $stmt=$pdo->prepare($sql);
    $stmt->execute([
        $_POST["pBrand"],
        $_POST["pModel"],
        $_POST["pSit"],
        $_POST["pType"],
        $_POST["pOdo"],
        $_POST["pCc"],
        $_POST["pAge"],
        $_POST["pRent"],
        $_POST["rentState"],
        $_POST["rentAssign"],
        $_POST["shopAddressSelect"],
        $_POST["shopName"],
        $_POST["pImg"],
        $_POST["pImg2"],
        $_POST["pImg3"],
        $pNo
    ]);   

        if($stmt->rowCount()==1){
            $result["success"]=true;
            $result["errorCode"]=200;
            $result["errorMsg"]="";
        }else{
            $result["errorCode"]=402;
            $result["errorMsg"]="資料沒有修改";

        }
    }catch(PDOException $ex){
        $result["errorCode"]=403;
        $result["errorMsg"]="資料更新發生錯誤";
    }



echo json_encode($result, JSON_UNESCAPED_UNICODE);
   


    




        