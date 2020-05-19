<?php
require __DIR__ . '/__cred.php';
require __DIR__ . '/__connect_db.php';
$page_name = 'm_edit';

$mNo = isset($_GET['mNo']) ? intval($_GET['mNo']) : 0; //要確認欲編輯的是哪一筆資料 所以要取得主鍵mNo

$sql = "SELECT * FROM lessee WHERE mNo=$mNo";

$stmt = $pdo->query($sql);
if ($stmt->rowCount() == 0) {  //如果沒有拿到資料的話 直接導向列表頁
    header('Location: m_list.php');
    exit;
}
//如果rowCount()是1的話，就把資料拿一筆出來
$row = $stmt->fetch(PDO::FETCH_ASSOC);


?>
<?php include __DIR__ . '/__html_head.php'; ?>
<?php include __DIR__ . '/__navbar.php'; ?>
    <style>
        .form-group small {
            color: red !important;
        }
        .insert-form{
            margin: 30px auto;
        }
        .form-group img{
            margin: 20px auto;
        }
    </style>

<!--    <link rel="stylesheet" href="./css/member.css">-->


    <div class="container">

        <div class="row">
            <div class="col-lg-6 insert-form">

                <div id="info_bar" class="alert alert-success" role="alert" style="display: none">
                </div>

                <div class="card">

                    <div class="card-body">
                        <h5 class="card-title">修改資料
                        </h5>

                        <form name="form1" method="post" onsubmit="return checkForm();">
                            <input type="hidden" name="checkme" value="check123">
                            <input type="hidden" name="mNo" value="<?= $row['mNo'] ?>">

                            <div class="form-group">
                                <label for="mName">姓名</label>
                                <input type="text" class="form-control" id="mName" name="mName" placeholder=""
                                       value="<?= $row['mName'] ?>">
                                <small id="mNameHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="mAccount">帳號</label>
                                <input type="text" class="form-control" id="mAccount" name="mAccount" placeholder=""
                                       value="<?= $row['mAccount'] ?>">
                                <small id="mAccountHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="mPwd">密碼</label>
                                <input type="password" class="form-control" id="mPwd" name="mPwd" placeholder=""
                                       value="<?= $row['mPwd'] ?>">
                                <small id="mPwdHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="mPhone">手機</label>
                                <input type="text" class="form-control" id="mPhone" name="mPhone" placeholder=""
                                       value="<?= $row['mPhone'] ?>">
                                <small id="mPhoneHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="mPhoto">大頭貼</label>
                                <input type="hidden" class="form-control" id="mPhoto" name="mPhoto" placeholder=""
                                       value="<?= $row['mPhoto'] ?>" style="display: block">
                                <small id="mPhotoHelp" class="form-text text-muted"></small>
                                <img id="myimg" src="uploads/<?= $row['mPhoto'] ?>" alt="" width="200px">

                                <input type="file" name="my_file" id="my_file">
                            </div>
                            <div class="form-group">
                                <label for="mEmail">Email</label>
                                <input type="text" class="form-control" id="mEmail" name="mEmail" placeholder=""
                                       value="<?= $row['mEmail'] ?>">
                                <small id="mEmailHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="mAddress">地址</label>
                                <input type="text" class="form-control" id="mAddress" name="mAddress"
                                       value="<?= $row['mAddress'] ?>">
                                <small id="mAddressHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="mBirthday">生日</label>
                                <input type="text" class="form-control" id="mBirthday" name="mBirthday"
                                       placeholder="YYYY-MM-DD"
                                       value="<?= $row['mBirthday'] ?>">
                                <small id="mBirthdayHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="mId">身分證字號</label>
                                <input type="text" class="form-control" id="mId" name="mId"
                                       value="<?= $row['mId'] ?>">
                                <small id="mIdHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="mGender">性別</label>
                                <?php if ($row['mGender'] == '男'): ?>
                                    <input type="radio" name="mGender" value="男" checked>男
                                    <input type="radio" name="mGender" value="女">女
                                <?php elseif ($row['mGender'] == '女'): ?>
                                    <input type="radio" name="mGender" value="男">男
                                    <input type="radio" name="mGender" value="女" checked>女
                                <?php else: ?>
                                    <input type="radio" name="mGender" value="男">男
                                    <input type="radio" name="mGender" value="女">女
                                <?php endif ?>
                                <small id="mGenderHelp" class="form-text text-muted"></small>
                            </div>


                            <button id="submit_btn" type="submit" class="btn btn-primary">送出</button>
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
        for (let v of fields) {
            fs[v] = document.form1[v];
        }
        console.log(fs);
        console.log('fs.mName:', fs.mName);
        //-----------------------------------------------------

        function sleep(milliseconds) {
            var start = new Date().getTime();
            for (var i = 0; i < 1e7; i++) {
                if ((new Date().getTime() - start) > milliseconds) {
                    break;
                }
            }
        }


        const checkForm = () => {
            let isPassed = true;
            info_bar.style.display = 'none'; //一開始先把訊息欄藏起來

            // 用迴圈拿到每個欄位的值
            const fsv = {};
            for (let v of fields) {
                fsv[v] = fs[v].value;
            }
            console.log(fsv);


            let mEmail_pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            let mPhone_pattern = /^09\d{2}\-?\d{3}\-?\d{3}$/;
            let mBirthday_pattern = /^\d{4}\-\d{2}\-\d{2}$/;
            let mId_pattern = /^[A-Z]\d{9}$/;

            for (let v of fields) {
                console.log({v})
                if (v !== 'mGender') {
                    fs[v].style.borderColor = '#cccccc';
                    document.querySelector('#' + v + 'Help').innerHTML = '';
                }

            }

            if (fsv.mName.length < 2) {
                fs.mName.style.borderColor = 'red';
                document.querySelector('#mNameHelp').innerHTML = '請填寫正確的姓名!';
                isPassed = false;
            }
            if (fsv.mAccount.length < 5) {
                fs.mAccount.style.borderColor = 'red';
                document.querySelector('#mAccountHelp').innerHTML = '請填寫正確的帳號!';
                isPassed = false;
            }
            if (fsv.mPwd.length < 5) {
                fs.mPwd.style.borderColor = 'red';
                document.querySelector('#mPwdHelp').innerHTML = '請填寫密碼!';
                isPassed = false;
            }
            if (!mPhone_pattern.test(fsv.mPhone)) {
                fs.mPhone.style.borderColor = 'red';
                document.querySelector('#mPhoneHelp').innerHTML = '請填寫正確的手機號碼!';
                isPassed = false;
            }
            if (!mEmail_pattern.test(fsv.mEmail)) {
                fs.mEmail.style.borderColor = 'red';
                document.querySelector('#mEmailHelp').innerHTML = '請填寫正確的 Email!';
                isPassed = false;
            }
            if (!mBirthday_pattern.test(fsv.mBirthday)) {
                fs.mBirthday.style.borderColor = 'red';
                document.querySelector('#mBirthdayHelp').innerHTML = '請填寫正確生日';
                isPassed = false;
            }

            if (fsv.mAddress.length < 5) {
                fs.mAddress.style.borderColor = 'red';
                document.querySelector('#mAddressHelp').innerHTML = '請填寫正確的地址!';
                isPassed = false;
            }
            if (fsv.mGender.length == 0) {
                // fs.mGender.style.borderColor = 'red';
                document.querySelector('#mGenderHelp').innerHTML = '請填寫性別!';
                isPassed = false;
            }

            if (!mId_pattern.test(fsv.mId)) {
                fs.mId.style.borderColor = 'red';
                document.querySelector('#mIdHelp').innerHTML = '請填寫正確的身分證字號!';
                isPassed = false;
            }

            if (isPassed) {   //如果資料是正確的 才用AJAX去送出資料
                let form = new FormData(document.form1); //拿到本頁表單的參照，建立一個formData物件
                                                         //屆時，form要丟到fetch裡面

                submit_btn.style.display = 'none'; //進到fetch之前 讓這個按鈕隱藏

                fetch('m_edit_api.php', {
                    method: 'POST',
                    body: form
                })
                    .then(response => response.json())
                    .then(obj => {
                        console.log(obj);

                        info_bar.style.display = 'block';

                        if (obj.success) {
                            // info_bar.className = 'alert alert-success';
                            // info_bar.innerHTML = '資料更新成功';

                            alert('資料修改成功！');
                            sleep(1000);
                            history.back();

                        } else {
                            info_bar.className = 'alert alert-danger';
                            info_bar.innerHTML = obj.errorMsg;
                        }

                        submit_btn.style.display = 'block'; //fetch回應之後 讓按鈕顯現出來

                    });
            }

            return false; //不是在此頁直接送出表單結果 所以設為false
        };

    </script>
    <script>
        const myimg = document.querySelector('#myimg');
        const my_file = document.querySelector('#my_file');
        const mPhoto = document.querySelector('#mPhoto');
        const mAccount = document.querySelector('#mAccount');
        console.log('A');
        my_file.addEventListener('change', event => {
            console.log('EventListener', event.target);
            const fd = new FormData();
            console.log('B');
            fd.append('my_file', my_file.files[0]); //my_file.files[0]拿到陣列中的第一個檔案
            fd.append('mAccount', mAccount.value);
            fd.append('actrul_file_name', 'adsfasdfsdfa');
            console.log('C');
            fetch('__m_upload.php', {method: 'POST', body: fd})
                .then(response => response.json())
                .then(obj => {
                    console.log(obj);
                    myimg.setAttribute('src', 'uploads/' + obj.filename);
                    mPhoto.setAttribute('value', obj.filename);
                    console.log('D');
                });
        });
        console.log('E');

        // function fncA(){
        //     console.log('i am function A')
        // }
        //
        // function fncB(test){
        //     console.log('i am test :' , test)
        //     test *= 5;
        //     test = test * 5;
        //     console.log('i am test :' , test)
        // }
        //
        //
        // fncA();
        // fncB(5);
        //
        // var a = {
        //     name: 'paul',
        //     age: 28,
        //     A: function(){
        //         console.log(this.name)
        //     }
        // }
        // a.A();


    </script>
<?php include __DIR__ . '/__html_foot.php'; ?>