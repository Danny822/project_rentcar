<?php
require __DIR__. '/__connect_db.php';


$begin = microtime(true);
echo $begin."<br>";


    $sql = "INSERT INTO `driver`(`driverName`, `driverAccount`, `driverPwd`, 
    `driverPhoto`, `driverPhone`, `driverEmail`, `driverAddress`, `driverBirthday`,
    `driverId`, `driverGender`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $pdo->prepare($sql);


    //如果想一整包執行，用transaction
    //開始transaction
    $pdo->beginTransaction();

    for($i=1; $i<10; $i++) {
        $stmt->execute([
            "李中明$i",
            "ming$i",
            "ming$i",
            "",
            "0918$i",
            "ming{$i}@gmail.com",
            "台南市$i",
            "1990-02-03",
            "D12680512{$i}",
            "男",
        ]);
    }

    //如果中間加rollback，中間做的都不算，直接回到beginTransaction

    //提交transaction
    $pdo->commit();


$end = microtime(true);
echo $end."<br>";
echo $end-$begin."<br>";