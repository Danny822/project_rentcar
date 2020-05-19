<?php
require __DIR__. '/__cred.php';
require __DIR__. '/__connect_db.php';
$page_name = 'm_insert1';

//讓這些值 一開始是空字串
$mName = '';
$mAccount = '';
$mPwd = '';
$mPhone = '';
$mPhoto = '';
$mEmail = '';
$mAddress = '';
$mBirthday = '';
$mId = '';
$mGender = '';

//假如有輸入，當新增錯誤發生，將保留輸入的值
if(isset($_POST['checkme'])){
    $mName = htmlentities($_POST['mName']);
    $mAccount = htmlentities($_POST['mAccount']);
    $mPwd = htmlentities($_POST['mPwd']);
    $mPhone = htmlentities($_POST['mPhone']);
    $mPhoto = htmlentities($_POST['mPhoto']);
    $mEmail = htmlentities($_POST['mEmail']);
    $mAddress = htmlentities($_POST['mAddress']);
    $mBirthday = $_POST['mBirthday'];
    $mId = htmlentities($_POST['mId']);
    $mGender = $_POST['mGender'];

    $sql = "INSERT INTO `lessee`(
            `mName`, `mAccount`, `mPwd`, `mPhone`, `mPhoto`, `mEmail`, `mAddress`, `mBirthday`, `mId`, `mGender`
            ) VALUES (
              ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
            )";



    try {
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['mName'],
            $_POST['mAccount'],
            $_POST['mPwd'],
            $_POST['mPhone'],
            $_POST['mPhoto'],
            $_POST['mEmail'],
            $_POST['mAddress'],
            $_POST['mBirthday'],
            $_POST['mId'],
            $_POST['mGender'],
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
            'info' => 'Email 重複輸入',
        ];
    }

}
?>
<?php include __DIR__. '/__html_head.php';  ?>
<?php include __DIR__. '/__navbar.php';  ?>
    <style>
        .form-group small {
            color: red;
        }

    </style>
    <div class="container">

        <div class="row">
            <div class="col-lg-6">
                <?php if(isset($msg)): ?>
                    <div class="alert alert-<?= $msg['type'] ?>" role="alert">
                        <?= $msg['info']?>
                    </div>
                <?php endif ?>
                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">新增會員
                         </h5>

                        <form name="form1" method="post" onsubmit="return checkForm();">
                            <input type="hidden" name="checkme" value="check123">
                            <div class="form-group">
                                <label for="mName">姓名</label>
                                <input type="text" class="form-control" id="mName" name="mName" placeholder=""
                                       value="<?= $mName ?>">
                                <small id="mNameHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="mAccount">帳號</label>
                                <input type="text" class="form-control" id="mAccount" name="mAccount" placeholder=""
                                       value="<?= $mAccount ?>">
                                <small id="mAccountHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="mPwd">密碼</label>
                                <input type="password" class="form-control" id="mPwd" name="mPwd" placeholder=""
                                       value="<?= $mPwd ?>">
                                <small id="mPwdHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="mPhone">手機</label>
                                <input type="text" class="form-control" id="mPhone" name="mPhone" placeholder=""
                                       value="<?= $mPhone ?>">
                                <small id="mPhoneHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="mPhoto">大頭貼</label>
                                <input type="hidden" class="form-control" id="mPhoto" name="mPhoto" placeholder=""
                                       value="" style="display: none">
                                <small id="mPhotoHelp" class="form-text text-muted"></small>
                                <img id="myimg" src="" alt="" width="200px">

                                <input type="file" name="my_file" id="my_file">
                            </div>
                            <div class="form-group">
                                <label for="mEmail">Email</label>
                                <input type="text" class="form-control" id="mEmail" name="mEmail" placeholder=""
                                       value="<?= $mEmail ?>">
                                <small id="mEmailHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="mAddress">地址</label>
                                <input type="text" class="form-control" id="mAddress" name="mAddress"
                                       value="<?= $mAddress ?>">
                                <small id="mAddressHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="mBirthday">生日</label>
                                <input type="text" class="form-control" id="mBirthday" name="mBirthday" placeholder="YYYY-MM-DD"
                                       value="<?= $mBirthday ?>">
                                <small id="mBirthdayHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="mId">身分證字號</label>
                                <input type="text" class="form-control" id="mId" name="mId"
                                       value="<?= $mId ?>">
                                <small id="mIdHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="mGender">性別</label>
                                <input type="radio" name="mGender" value="男">男
                                <input type="radio" name="mGender" value="女">女
                                <small id="mGenderHelp" class="form-text text-muted"></small>
                            </div>
<!--                            <div class="form-group" id="mGender">-->
<!--                                <label for="mGender">性別</label>-->
<!--                                <input type="text" class="form-control" name="mGender"-->
<!--                                       value="--><?//= $mGender ?><!--">-->
<!--                                <small id="mGenderHelp" class="form-text text-muted"></small>-->
<!--                            </div>-->


<!--                            <button type="button" class="btn btn-primary" onclick="checkForm()">test</button>-->
                            <button type="submit" class="btn btn-primary" id="location">Submit</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>




    </div>
    <script>

        const fields = [
            'mName',
            'mAccount',
            'mPwd',
            'mPhone',
            'mPhoto',
            'mEmail',
            'mAddress',
            'mBirthday',
            'mId',
            'mGender',
        ];

            // 用迴圈拿到每個欄位的參照
            const fs = {};
            for(let v of fields){
                fs[v] = document.form1[v];
            }
            console.log(fs);
            console.log('fs.mName:', fs.mName);


            const checkForm = ()=>{
            let isPassed = true;

            // 用迴圈拿到每個欄位的值
            const fsv = {};
            for(let v of fields){
                fsv[v] = fs[v].value;
            }
            console.log(fsv);

            let mEmail_pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            let mPhone_pattern = /^09\d{2}\-?\d{3}\-?\d{3}$/;
            let mBirthday_pattern = /^\d{4}\-\d{2}\-\d{2}$/;
            let mId_pattern = /^[A-Z]\d{9}$/;


            for(let v of fields){
                console.log({v})
                if(v !== 'mGender'){
                    fs[v].style.borderColor = '#cccccc';
                    document.querySelector('#' + v + 'Help').innerHTML = '';
                }

            }

            if(fsv.mName.length < 2){
                fs.mName.style.borderColor = 'red';
                document.querySelector('#mNameHelp').innerHTML = '請填寫正確的姓名!';
                isPassed = false;
            }
            if(fsv.mAccount.length < 4){
                fs.mAccount.style.borderColor = 'red';
                document.querySelector('#mAccountHelp').innerHTML = '請填寫正確的帳號!';
                isPassed = false;
            }
            if(fsv.mPwd.length < 5){
                fs.mPwd.style.borderColor = 'red';
                document.querySelector('#mPwdHelp').innerHTML = '請填寫密碼!';
                isPassed = false;
            }
            if(! mPhone_pattern.test(fsv.mPhone)){
                fs.mPhone.style.borderColor = 'red';
                document.querySelector('#mPhoneHelp').innerHTML = '請填寫正確的手機號碼!';
                isPassed = false;
            }
            if(! mEmail_pattern.test(fsv.mEmail)){
                fs.mEmail.style.borderColor = 'red';
                document.querySelector('#mEmailHelp').innerHTML = '請填寫正確的 Email!';
                isPassed = false;
            }
            if(! mBirthday_pattern.test(fsv.mBirthday)) {
                fs.mBirthday.style.borderColor = 'red';
                document.querySelector('#mBirthdayHelp').innerHTML = '請填寫正確生日';
                isPassed = false;
            }

            if(fsv.mAddress.length < 5){
                fs.mAddress.style.borderColor = 'red';
                document.querySelector('#mAddressHelp').innerHTML = '請填寫正確的地址!';
                isPassed = false;
            }
            if(fsv.mGender.length == 0){
                // fs.mGender.style.borderColor = 'red';
                document.querySelector('#mGenderHelp').innerHTML = '請填寫性別!';
                isPassed = false;
            }

            if(! mId_pattern.test(fsv.mId)){
                fs.mId.style.borderColor = 'red';
                document.querySelector('#mIdHelp').innerHTML = '請填寫正確的 Email!';
                isPassed = false;
            }


            return isPassed;
        };




    </script>

    <script>
        const myimg = document.querySelector('#myimg');
        const my_file = document.querySelector('#my_file');
        const mPhoto = document.querySelector('#mPhoto');
        const mAccount = document.querySelector('#mAccount');

        my_file.addEventListener('change', event=>{
            console.log('EventListener', event.target);
            const fd = new FormData();

        fd.append('my_file', my_file.files[0]); //my_file.files[0]拿到陣列中的第一個檔案
        fd.append('mAccount', mAccount.value);
        fd.append('test', '123');
        // {
        //     my_file: {filename:'xxxx', type:'ssssss'},
        //     mAccount: 'asdf',
        //    test :'123'
        // }
        fetch('__m_upload.php', {method: 'POST', body: fd})
            .then(response=>response.json())
            .then(obj=>{
                console.log(obj);
                // obj.json();
                myimg.setAttribute('src', 'uploads/' +obj.filename);
                mPhoto.setAttribute('value', obj.filename);
            });
        });



    </script>
<?php include __DIR__. '/__html_foot.php';  ?>
<?php
//if($stmt->rowCount()==1) {
//    header('Location: m_list.php');
//} else {
//    $msg = '帳號或密碼錯誤';
//}
//?>
