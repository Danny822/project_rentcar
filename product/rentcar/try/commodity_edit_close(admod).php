<?php

require __DIR__. '/__connect_db.php';

$page_name = "commodity_edit_close";

if(isset($_POST['pNo'])){


    $sql = "UPDATE `commodity` SET `pBrand`=?, `pModel`=?, `pSit`=?, `pType`=?, `pOdo`=?, `pCc`=?, `pAge`=?, `pRent`=?
    , `rentState`=?, `rentAssign`=?, `shopAddressSelect`=?
    WHERE `commodity`.`pNo` = ?;";
       $stmt = $pdo->prepare($sql);
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
        // $_POST["pImg"]
        $pNo
    ]);

}

    if($stmt->rowCount()==1){
        alert("資料修改完成");
        $goto ="commodity.php";
        header("Location: $goto");
    }else{
        alert("資料修改失敗");
        $goto2 ="commodity_edit.php";
        header("Location: $goto2");
    }

   




?>
<?php include __DIR__. '/__html_head.php';  ?>
<div class="text-center">
    

    
