<?php

require __DIR__. '/ming__connect_db.php';

$page_name = 'ming_data_insert';

//$couponSid='';
$couponNo = '';
$couponInfo = '';
$couponFunc = '';
$couponState = '';

if(isset($_POST['checkme'])){
    //$couponSid = htmlentities($_POST['couponSid']);
    $couponNo = htmlentities($_POST['couponNo']);
    $couponInfo = htmlentities($_POST['couponInfo']);
    $couponFunc = htmlentities($_POST['couponFunc']);
    $couponState = htmlentities($_POST['couponState']);
    


    $sql = "INSERT INTO `coupon`(
             `couponNo`, `couponInfo`, `couponFunc`, `couponState`
             
            ) VALUES (
              ?, ?, ?, ?
            )";

    

    try {
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            //$_POST['couponSid'],
            $_POST['couponNo'],
            $_POST['couponInfo'],
            $_POST['couponFunc'],
            $_POST['couponState'],
            

        ]);

        if($stmt->rowCount()==1) {
            $success = true;
            $msg = [
                'type' => 'success',
                'info' => '資料新增成功',
            ];
        } else {
            $msg = [
                'type' => 'danger',
                'info' => '資料新增錯誤',
            ];
        }
    } catch(PDOException $ex){
        $msg = [
            'type' => 'danger',
            'info' => 'couponInfo 重複輸入',
        ];
    }
    





    /*
    $sql = sprintf("INSERT INTO `address_book`(
            `name`, `email`, `mobile`, `birthday`, `address`
            ) VALUES (
              %s, %s, %s, %s, %s
            )",
        $pdo->quote($_POST['name']),
        $pdo->quote($_POST['email']),
        $pdo->quote($_POST['mobile']),
        $pdo->quote($_POST['birthday']),
        $pdo->quote($_POST['address'])
        );

    // echo $sql; exit; // 測試 SQL 長什麼樣子


    $stmt = $pdo->query($sql);

    */

}

?>
<?php include __DIR__. '/ming__html_head.php';  ?>
<?php include __DIR__. '/ming__navbar.php';  ?>
    <style>
        .form-group small {
            color: red !important;
        }

    </style>
<div class="container">

    <div class="row">
        <div class="col-lg-6">
        <?php if(isset($msg)): ?>
                <div class="alert alert-<?= $msg['type'] ?>" role="alert">
                    <?= $msg['info'] ?>
                </div>
            <?php endif ?>
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">新增資料</h5>

                    <form name="form1" method="post" onsubmit="return checkForm();">
                        <input type="hidden" name="checkme" value="check123">
                        <!-- <div class="form-group">
                            <label for="Cardealer_number">cardealer_number</label>
                            <input type="text" class="form-control" id="cardealer_number" name="cardealer_number" placeholder=""
                                   value="">
                            <small id="Cardealer_numberHelp" class="form-text text-muted"></small>
                        </div> -->
                        <div class="form-group">
                            <label for="couponNo">活動編號</label>
                            <input type="text" class="form-control" id="couponNo" name="couponNo" placeholder=""
                                   value="">
                            <small id="couponNoHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="couponInfo">內容</label>
                            <input type="text" class="form-control" id="couponInfo" name="couponInfo" placeholder=""
                                   value="">
                            <small id="couponInfoHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="couponFunc">內容計算公式</label>
                            <input type="text" class="form-control" id="couponFunc" name="couponFunc" placeholder=""
                                   value="">
                            <small id="couponFuncHelp" class="form-text text-muted"></small>
                        </div>
                        
                        <!-- <div class="form-group">
                            <label for="couponState">上架狀態</label>
                            <textarea class="form-control" id="couponState" name="couponState" cols="30" rows="3"></textarea>
                            <small id="couponStateHelp" class="form-text text-muted"></small>
                        </div> -->
                        
                        
                        <!-- <h5>上架狀態</h5>
  <fieldset>
    
    <label for="couponState">on</label>
    <input type="radio" name="couponState" id="couponState">
    <label for="couponState">off</label>
    <input type="radio" name="couponState" id="couponState">
    
  </fieldset> -->
<tr>
  <td>上架狀態</td> <td>
  <input type="radio" name="couponState" id= "couponState" value="on" checked>上架
  <input type="radio" name="couponState" id= "couponState" value="off" >下架
  </td>
  </tr>
                        



                        <button id="submit_btn" type="submit" class="btn btn-primary">新增</button>
                    </form>

                </div>
            </div>
        </div>
    </div>




</div>
    <script>
       
        // // 拿到每個欄位的參照
        // const fs = {};
        // for(let v of fields){
        //     fs[v] = document.form1[v];
        // }
        // console.log(fs);
        // console.log('couponState:', fs.couponState);


        const checkForm = ()=>{
            let isPassed = true;

            const fields = [ 
                'couponNo',
                'couponInfo',
                'couponFunc',
                'couponState',
            ];

            // 拿到每個欄位的值
            // const fsv = {};
            // for(let v of fields){
            //     fsv[v] = fs[v].value;
            // }
            // console.log(fsv);


            //let cardealer_phonenumber = /^09\d{2}\-?\d{3}\-?\d{3}$/;

            let couponNo = document.form1.couponNo.value;
            let couponInfo = document.form1.couponInfo.value;
            let couponFunc = document.form1.couponFunc.value;
            let couponState = document.form1.couponState.value;


            for(let k in fields){
            document.form1[fields[k]].style.borderColor = '#cccccc';
            document.querySelector('#' + fields[k] + 'Help').innerHTML = '';
            }

            if(document.form1[fields[0]].value == ""){
                document.form1.couponNo.style.borderColor = 'red';
                document.querySelector('#couponNoHelp').innerHTML = '請填寫正確的活動編號!!!!';

                isPassed = false;
            }
            if(document.form1[fields[1]].value == ""){
                document.form1.couponInfo.style.borderColor = 'red';
                document.querySelector('#couponInfoHelp').innerHTML = '請填寫正確的內容';
                isPassed = false;
            }
            if(document.form1[fields[2]].value == ""){
                document.form1.couponFunc.style.borderColor = 'red';
                document.querySelector('#couponFuncHelp').innerHTML = '請填寫正確的內容計算公式!';
                isPassed = false;
            }
            if(document.form1[fields[3]].value == ""){
                document.form1.couponState.style.borderColor = 'red';
                document.querySelector('#couponStateHelp').innerHTML = '請填寫正確的上架狀態';
                isPassed = false;
            }
            

            return isPassed;
        };

    </script>
<?php include __DIR__. '/ming__html_foot.php';  ?>