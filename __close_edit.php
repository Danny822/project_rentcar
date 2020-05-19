<?php
    require __DIR__. '/__cred.php';
require __DIR__. '/__connect_db.php';
    $page_name = 'ad_insert';
    $upload_dir = __DIR__. '/uploads/';
    if(empty($_FILES['adImg'])){
        exit;
    }

    $result = [
        'success' => false,
        'filename' => '',
        'info' => '',
    ];
    if( $_POST['adImgname']==""){
        $filename = "AD".preg_replace('/[^\d]/','',$_POST['adDate']). preg_replace('/[^\d]/','',date("H:i:s"));
    
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
    }else{
        $y = $_POST['adImgname'];
        $x=strrchr("$y",".");
        $filename = str_replace("$x","","$y");
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
}

   
    $result['filename'] = $filename;
    $upload_file = $upload_dir. $filename;

    if(move_uploaded_file($_FILES['adImg']['tmp_name'], $upload_file)){
        $result['success'] = true;
    } else {
        $result['info'] = '暫存檔無法搬移';
    }
    if(isset($_POST['adNo'])){ 


        $sqls = "UPDATE `advertisement` SET `adTitle` =
         ?, `adDate` = ?,`adImg`=?, `adUrl` = ?, `adState` = ?
         WHERE `advertisement`.`adNo` = ?;";
            $stmts = $pdo->prepare($sqls);
            $stmts->execute([
                $_POST['adTitle'],
                $_POST['adDate'],
                $filename,
                $_POST['adUrl'],
                $_POST['adState'],
                $_POST['adNo']
            ]);   
            

            
        }
        
        

?>
<?php include __DIR__. '/__htmlheader.php';  ?>
<div class="text-center">
    <H1>!!!資料修改完成!!!</H1>
    <h2 id="close"></h2>
</div>
<script>
//     let t = 3
// function closeedit(){
//
//     document.querySelector('#close').innerHTML="!!!在"+ t + "秒後自動跳轉!!!"
//
//
//     if (t<=0){
//         window.history.go(-2);
//     }
//     t = t-1 ;
//     setTimeout(" closeedit()", 1000);
// }
//     closeedit();

window.alert('資料新增成功');
window.location.href='__ad_list.php';


</script>

<?php //include  __DIR__. './__htmlfoot.php';  ?>