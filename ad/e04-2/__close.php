<?php
    require __DIR__. '/__cred.php';
    require __DIR__. '/__connect.php';
    $page_name = 'ad_insert';



if(isset($_POST['checkme'])){ 


    $sql = "INSERT INTO `advertisement`(
        `adTitle`, `adDate`,`adImg`, `adUrl`, `adState`
        ) VALUES (
          ?,?,?,?,?
        )";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['adTitle'],
            $_POST['adDate'],
            $_POST['adImg'],
            $_POST['adUrl'],
            $_POST['adState']
        ]);
        
        
    }
?>
<?php include __DIR__. '/__htmlheader.php';  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <H1>資料上傳完成!!!</H1>
    <div id="close"></div>
</body>
<script>
    let t = 3
function closewin(){
    
    document.querySelector('#close').innerHTML="!!!在"+ t + "秒後關閉視窗!!!"

    
    if (t<=0){
    window.close();    
    }
    t = t-1 ;
    setTimeout("closewin()", 1000);
}
    closewin();
   

</script>
</html>