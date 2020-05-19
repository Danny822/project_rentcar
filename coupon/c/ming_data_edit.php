<?php

require __DIR__. '/ming__connect_db.php';
$page_name = 'ming_data_edit';

$couponSid = isset($_GET['couponSid']) ? intval($_GET['couponSid']) : 0;

$sql = "SELECT * FROM `coupon` WHERE `couponSid`=$couponSid";

$stmt = $pdo->query($sql);
if($stmt->rowCount()==0){
    header('Location: ming_data_list.php');
    exit;
}
$row = $stmt->fetch(PDO::FETCH_ASSOC);

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

                <div id="info_bar" class="alert alert-success" role="alert" style="display: none">
                </div>

            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">修改資料
                    </h5>

                    <form name="form1" method="post" onsubmit="return checkForm();">
                        <!-- <input type="hidden" name="checkme" value="check123"> -->
                        <input type="hidden" name="couponSid" value="<?= $row['couponSid']?>">
                        <div class="form-group">
                            <label for="couponNo">活動編號</label>
                            <input type="text" class="form-control" id="couponNo" name="couponNo" placeholder=""
                                   value="<?= $row['couponNo']?>">
                            <small id="couponNoHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="couponInfo">內容</label>
                            <input type="text" class="form-control" id="couponInfo" name="couponInfo" placeholder=""
                                   value="<?= $row['couponInfo']?>">
                            <small id="couponInfoHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="couponFunc">活動計算公式</label>
                            <input type="text" class="form-control" id="couponFunc" name="couponFunc" placeholder=""
                                   value="<?= $row['couponFunc']?>">
                            <small id="couponFuncHelp" class="form-text text-muted"></small>
                        </div>
                        <!-- <div class="form-group">
                            <label for="couponState">上架狀態</label>
                            <input type="text" class="form-control" id="couponState" name="couponState" placeholder=""
                                   value="<?= $row['couponState']?>">
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
                       
                        <button id="submit_btn" type="submit" class="btn btn-primary">確定</button>
                    </form>

                </div>
            </div>
        </div>
    </div>




</div>
    <script>
        const info_bar = document.querySelector('#info_bar');
        const submit_btn = document.querySelector('#submit_btn');

        const fields = [
            'couponNo',
            'couponInfo',
            'couponFunc',
            'couponState',
        ];

        // 拿到每個欄位的參照
        const fs = {};
        for(let v of fields){
            fs[v] = document.form1[v];
        }
        console.log(fs);
        //console.log('fs.couponSid:', fs.couponSid);


        const checkForm = ()=>{
            let isPassed = true;
            info_bar.style.display = 'none';

            // 拿到每個欄位的值
            const fsv = {};
            for(let v of fields){
                fsv[v] = fs[v].value;
            }
            console.log(fsv);


            let couponNo = document.form1.couponNo.value;
            let couponInfo = document.form1.couponInfo.value;
            let couponFunc = document.form1.couponFunc.value;
            let couponState = document.form1.couponState.value;

            for(let v of fields){
                //fs[v].style.borderColor = '#cccccc';
                document.form1.couponNo.style.borderColor = '#cccccc';
                document.form1.couponInfo.style.borderColor = '#cccccc';
                document.form1.couponFunc.style.borderColor = '#cccccc';
                //document.querySelector('#' + v + 'Help').innerHTML = '';
                document.querySelector("#couponNoHelp").innerHTML = "";
                document.querySelector("#couponInfoHelp").innerHTML = "";
                document.querySelector("#couponFuncHelp").innerHTML = "";
            }

            if(couponNo == ""){
                document.form1.couponNo.style.borderColor = 'red';
                document.querySelector('#couponNoHelp').innerHTML = '請填寫正確的名稱!';

                isPassed = false;
            }
            if(couponInfo == ""){
                document.form1.couponInfo.style.borderColor = 'red';
                document.querySelector('#couponInfoHelp').innerHTML = '請填寫正確的內容';
                isPassed = false;
            }
            if(couponFunc == ""){
                document.form1.couponFunc.style.borderColor = 'red';
                document.querySelector('#couponFuncHelp').innerHTML = '請填寫正確的內容計算公式!';
                isPassed = false;
            }
            if(couponState == ""){
                document.form1.couponState.style.borderColor = 'red';
                document.querySelector('#couponStateHelp').innerHTML = '請填寫正確的上架狀態';
                isPassed = false;
            }
          


            if(isPassed) {
                let form = new FormData(document.form1);

                submit_btn.style.display = 'none';

                fetch('ming_data_edit_api.php', {
                    method: 'POST',
                    body: form
                })
                    .then(response=>response.json())
                    .then(obj=>{
                        console.log(obj);

                        info_bar.style.display = 'block';

                        if(obj.success){
                            info_bar.className = 'alert alert-success';
                            info_bar.innerHTML = '資料修改成功';
                        } else {
                            info_bar.className = 'alert alert-danger';
                            info_bar.innerHTML = obj.errorMsg;
                        }

                        submit_btn.style.display = 'block';
                    });



            }
            return false;
        };

    </script>
<?php include __DIR__. '/ming__html_foot.php';  ?>