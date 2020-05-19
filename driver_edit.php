<?php

require __DIR__ . '/__cred.php';
require __DIR__. '/__connect_db.php';
$page_name = 'data_edit';

$driverNo = isset($_GET['driverNo']) ? intval($_GET['driverNo']) : 0;

$sql = "SELECT * FROM `driver` WHERE `driverNo`=$driverNo";

//e.g.假如拿到driver=1000，抓不到資料，自動轉到datalist
$stmt = $pdo->query($sql);
if($stmt->rowCount()==0){
    header('Location: driver_list.php');
    exit;
}
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>


<?php include __DIR__. '/__html_head.php'; ?>
<?php include __DIR__. '/__navbar.php'; ?>

<style>
    /*調整權重*/
    .form-group small {
        color: red !important;
    }

</style>
<link rel="stylesheet" href="./css/driver.css">

<div class="container">
    <div class="row">
        <div class="col-lg-6 insert-form">
            
                <div id="info_bar" class="alert alert-success" role="alert" style="display: none"></div>
<!--                <br>-->
<!--                <a href="driver_list.php"><button type="button" class="btn btn-primary">回主畫面</button></a>-->
<!--                <br>-->
<!--                <br>-->

            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">修改資料
                    </h5>
                    <form method="post" name="form1" onsubmit="return checkForm();">
                        <!-- <input type="hidden" name="checkme" value="check123"> -->
                        <input type="hidden" name="driverNo" value="<?= $row['driverNo']?>">
                        <div class="form-group">
                            <label for="driverName">駕駛姓名</label>
                            <input type="text" class="form-control" id="driverName" name="driverName" placeholder=""
                            value="<?= $row['driverName']?>">
                            <small id="driverNameHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="driverGender">性別</label>
                            <input type="text" class="form-control" id="driverGender" name="driverGender" placeholder=""
                            value="<?= $row['driverGender']?>">
                            <small id="driverGenderHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="driverAccount">駕駛帳號</label>
                            <input type="text" class="form-control" id="driverAccount" name="driverAccount" placeholder=""
                            value="<?= $row['driverAccount']?>">
                            <small id="driverAccountHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="driverPwd">駕駛密碼</label>
                            <input type="password" class="form-control" id="driverPwd" name="driverPwd" placeholder=""
                            value="<?= $row['driverPwd']?>">
                            <small id="driverPwdHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="driverPhone">連絡電話</label>
                            <input type="text" class="form-control" id="driverPhone" name="driverPhone" placeholder=""
                            value="<?= $row['driverPhone']?>">
                            <small id="driverPhoneHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="driverEmail">Email</label>
                            <input type="text" class="form-control" id="driverEmail" name="driverEmail" placeholder=""
                            value="<?= $row['driverEmail']?>">
                            <small id="driverEmailHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="driverAddress">地址</label>
                            <textarea class="form-control" id="driverAddress" name="driverAddress" cols="30" rows="3"><?= $row['driverAddress']?></textarea>
                            <small id="driverAddressHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="driverBirthday">生日</label>
                            <input type="text" class="form-control" id="driverBirthday" name="driverBirthday" placeholder=""
                            value="<?= $row['driverBirthday']?>">
                            <small id="driverBirthdayHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="driverId">身分證字號</label>
                            <input type="text" class="form-control" id="driverId" name="driverId" placeholder=""
                            value="<?= $row['driverId']?>">
                            <small id="driverIdHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="driverPhotoName">大頭照</label><br>
                            <input type="hidden" class="form-control" id="driverPhotoName" name="driverPhotoName" value="<?= $row['driverPhotoName'] ?>" style="display: block">
                            <img id="myimg" src="uploads/<?= $row['driverPhotoName'] ?>" alt="" width="200px"><br>
                            <small id="driverPhotoNameHelp" class="form-text text-muted"></small>
                            <input type="file" id="my_file" name="my_file">
                        </div>

                        <button type="submit" class="btn btn-primary my-1 search-btn" id="submit_btn">送出</button>
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
            'driverName',
            'driverGender',
            'driverAccount',
            'driverPwd',
            'driverPhone',
            'driverEmail',
            'driverAddress',
            'driverBirthday',
            'driverId',
            'driverPhotoName',
        ];

        // 拿到每個欄位的參照
        const fs = {};
        for(let v of fields){
            fs[v] = document.form1[v];
        }
        console.log(fs);
        console.log('fs.driverName:', fs.driverName);


        function sleep(milliseconds) {
            var start = new Date().getTime();
            for (var i = 0; i < 1e7; i++) {
                if ((new Date().getTime() - start) > milliseconds) {
                    break;
                }
            }
        }

        const checkForm = ()=>{
            let isPassed = true;

            // 拿到每個欄位的值
            const fsv = {};
            for(let v of fields){
                fsv[v] = fs[v].value;
            }
            console.log(fsv);


            let email_pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            let phone_pattern = /^09\d{2}\-?\d{3}\-?\d{3}$/;
            let birthday_pattern = /^\d{4}\-\d{2}\-\d{2}$/;
            let id_pattern = /^[A-Z]{1}\d{9}$/;

            for(let v of fields){
                fs[v].style.borderColor = '#cccccc';
                document.querySelector('#' + v + 'Help').innerHTML = '';
            }

            if(fsv.driverName.length < 2){
                fs.driverName.style.borderColor = 'red';
                document.querySelector('#driverNameHelp').innerHTML = '請填寫正確的姓名!';

                isPassed = false;
            }

            if (fsv.driverAccount.length < 4) {
            fs.driverAccount.style.borderColor = 'red';
            document.querySelector('#driverAccountHelp').innerHTML = '請填寫正確的帳號!';
            isPassed = false;
            }

            if (fsv.driverPwd.length < 6) {
            fs.driverPwd.style.borderColor = 'red';
            document.querySelector('#driverPwdHelp').innerHTML = '請填寫密碼!';
            isPassed = false;
            }

            if(! phone_pattern.test(fsv.driverPhone)){
                fs.driverPhone.style.borderColor = 'red';
                document.querySelector('#driverPhoneHelp').innerHTML = '請填寫正確的手機號碼!';
                isPassed = false;
            }

            if(! email_pattern.test(fsv.driverEmail)){
                fs.driverEmail.style.borderColor = 'red';
                document.querySelector('#driverEmailHelp').innerHTML = '請填寫正確的 Email!';
                isPassed = false;
            }

            if (! birthday_pattern.test(fsv.driverBirthday)) {
            fs.driverBirthday.style.borderColor = 'red';
            document.querySelector('#driverBirthdayHelp').innerHTML = '請填寫正確生日';
            isPassed = false;
            }

            if(! id_pattern.test(fsv.driverId)){
                fs.driverId.style.borderColor = 'red';
                document.querySelector('#driverIdHelp').innerHTML = '請填寫正確的身分證字號!';
                isPassed = false;
            }

            if(isPassed){
                let form = new FormData(document.form1);

                submit_btn.style.display = 'none';

                fetch('driver_edit_api.php', {
                    method: 'POST',
                    body: form
                })
                    .then(response=>response.json())
                    .then(obj=>{

                    console.log(obj);

                    info_bar.style.display = 'block';

                    if(obj.success){
                        // info_bar.className = 'alert alert-success';
                        // info_bar.innerHTML = '資料修改成功';
                        alert('資料修改成功！');
                        sleep(1000);
                        history.back();
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
<script>

        const myimg = document.querySelector('#myimg');
        const my_file = document.querySelector('#my_file');
        const driverPhotoName = document.querySelector('#driverPhotoName');
        const driverName = document.querySelector('#driverName');
        
        my_file.addEventListener('change', event=>{
            //console.log(event.target);
            const fd = new FormData();
                
        
            fd.append('my_file', my_file.files[0]);
            fd.append('driverName', driverName.value);
            // fd.append('test', '123');
        
            fetch('driverPhoto_upload_ajax.php', {
                method: 'POST',
                body: fd
            })
                .then(response=>response.json())
                .then(obj=>{
                    console.log(obj);
                    myimg.setAttribute('src', 'uploads/' +obj.filename);
                    driverPhotoName.setAttribute('value', obj.filename);
                });
        });


</script>

<?php include __DIR__. '/__html_foot.php'; ?>
