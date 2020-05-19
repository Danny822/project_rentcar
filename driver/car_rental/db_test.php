<?php

include __DIR__. '/__connect_db.php';


try {
    //$stmt有點像代理人
    $stmt = $pdo->query("SELECT * FROM `driver`");

} catch(PDOException $ex) {

    echo $ex->getMessage();

}

//$row = $stmt->fetch(PDO::FETCH_ASSOC)，跟代理人拿一筆資料，while會循環直到拿不到資料
while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
    print_r($row);
    echo "<br>";
};



//FETCH_ASSOC抓到關聯式陣列，FETCH_NUM抓到索引式陣列，FETCH_BOTH抓到關聯和索引陣列


//echo $row['name'];


