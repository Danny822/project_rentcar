<?php
    require __DIR__. '/__cred.php';
    require __DIR__. '/__connect.php';
    $page_name = 'ad_insert';
    $upload_dir = __DIR__. '/uploads/';

    
    $result = [
        'success' => false,
        'filename' => '',
        'info' => '',
    ];
    
   
    if(isset($_POST['checkme'])){ 
    $filename = "AD".preg_replace('/[^\d]/','',$_POST['adDate']). preg_replace('/[^\d]/','',date("H:i:s"));
    if(empty($_FILES['adImg']['name'])){
        $filename="";
    }
    
    switch($_FILES['adImg']['type']){
        case 'image/jpeg':
            $filename .= '.jpg';
            break;
        case 'image/png':
            $filename .= '.png';
            break;
        default:
            break;
    }
    $result['filename'] = $filename;
    $upload_file = $upload_dir. $filename;
    
    if(move_uploaded_file($_FILES['adImg']['tmp_name'], $upload_file)){
        $result['success'] = true;
    } else {
        $result['info'] = '暫存檔無法搬移';
    }
    // echo json_encode($result, JSON_UNESCAPED_UNICODE);
    
    $imgname = $_FILES['adImg']['name'];
   


    $sql = "INSERT INTO `advertisement`(
        `adTitle`, `adImg`,`adDate`, `adUrl`, `adState`
        ) VALUES (
          ?,?,?,?,?
        )";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['adTitle'],
            $filename,
            $_POST['adDate'],
            $_POST['adUrl'],
            $_POST['adState']
        ]);
        
        
    }
?>
<?php include __DIR__. '/__htmlheader.php';  ?>

<div class="text-center">
    <H1>!!!資料上傳完成!!!</H1>
    <h2 id="close"></h2>
</div>
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