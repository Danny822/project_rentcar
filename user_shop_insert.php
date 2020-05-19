<?php

require __DIR__ . '/__cred.php';
require __DIR__ . '/__connect_db.php';

$page_name = 'user_shop_insert';

include __DIR__ . '/__html_head.php';
include __DIR__ . '/__navbar.php';
?>

<style>
    .form-group small {
        color: red !important;
    }
</style>

<link rel="stylesheet" href="./css/shop_user.css">

<div class="container">

    <div class="row">
        <div class="col-lg-6 insert-form">

            <div id="info_bar" class="alert alert-success" role="alert" style=" display: none">
            </div>

            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">新增車商會員資料
                    </h5>

                    <form name="form1" method="post" onsubmit="return checkForm();">
                        <!--                        <input type="hidden" name="checkme" value="check123">-->
                        <div class="form-group">
                            <label for="shopName">車商名稱</label>
                            <input type="text" class="form-control" id="shopName" name="shopName" placeholder=""
                                   value="">
                            <small id="shopNameHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="shopAccount">帳號</label>
                            <input type="text" class="form-control" id="shopAccount" name="shopAccount" placeholder=""
                                   value="">
                            <small id="shopAccountHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="shopPwd">密碼</label>
                            <input type="text" class="form-control" id="shopPwd" name="shopPwd" placeholder=""
                                   value="">
                            <small id="shopPwdHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="shopPhone">電話</label>
                            <input type="text" class="form-control" id="shopPhone" name="shopPhone" placeholder=""
                                   value="">
                            <small id="shopPhoneHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="shopEmail">信箱</label>
                            <input type="text" class="form-control" id="shopEmail" name="shopEmail" placeholder="">
                            <small id="shopEmailHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="shopOwner">公司負責人</label>
                            <input type="text" class="form-control" id="shopOwner" name="shopOwner" placeholder="">
                            <small id="shopOwnerHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="shopAgent">公司管理人</label>
                            <input type="text" class="form-control" id="shopAgent" name="shopAgent" placeholder="">
                            <small id="shopAgentHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="shopAddress">地址</label>
                            <textarea class="form-control" id="shopAddress" name="shopAddress" cols="30"
                                      rows="3"></textarea>
                            <small id="shopAddressHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="shopAddressUrl">地址URL</label>
                            <textarea class="form-control" id="shopAddressUrl" name="shopAddressUrl" cols="30"
                                      rows="3"></textarea>
                            <small id="shopAddressUrlHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="shopInfo">店家簡介</label>
                            <textarea class="form-control" id="shopInfo" name="shopInfo" cols="30" rows="3"></textarea>
                            <small id="shopInfoHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="shopId">營利事業登記證號</label>
                            <textarea class="form-control" id="shopId" name="shopId"></textarea>
                            <small id="shopIdHelp" class="form-text text-muted"></small>
                        </div>
                        <!--                        <div class="form-group">-->
                        <!--                            <label for="shopImg">照片</label>-->
                        <!--                            <input type="file" class="shopImg" name="shopImg" id="shopImg">-->
                        <!--                            <small id="shopImgHelp" class="form-text text-muted"></small>-->
                        <!--                        </div>-->
                        <div class="form-group">
                            <label for="shopImg">照片</label>
                            <input type="hidden" class="form-control" id="shopImg" name="shopImg" placeholder=""
                                   value="" style="display: block">
                            <small id="shopImgHelp" class="form-text text-muted"></small>
                            <img id="myimg" src="uploads/" alt="" width="200px">

                            <input type="file" name="my_file" id="my_file">
                        </div>

                        <button id="submit_btn" type="submit" class="btn btn-primary">送出</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

    <script>
        const info_bar = document.querySelector('#info_bar');
        const submit_btn = document.querySelector('#submit_btn');

        const fields = [
            'shopName',
            'shopAccount',
            'shopPwd',
            'shopPhone',
            'shopEmail',
            'shopOwner',
            'shopAgent',
            'shopAddress',
            'shopAddressUrl',
            'shopInfo',
            'shopId',
        ];

        //拿到各欄參照
        const fs = {};
        for (let v of fields) {
            fs[v] = document.form1[v];
        }
        console.log(fs);
        console.log('fs.name:', fs.shopName);

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
            info_bar.style.display = 'none';

            //拿到各欄位的值
            const fsv = {};
            for (let v of fields) {
                fsv[v] = fs[v].value;
            }
            console.log(fsv);

            let email_pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
            let mobile_pattern = /^09\d{2}\-?\d{3}\-?\d{3}$/;

            for (let v of fields) {
                fs[v].style.borderColor = '#cccccc';
                console.log('#' + v + 'Help');
                document.querySelector('#' + v + 'Help').innerHTML = '';


                console.log(document.querySelector('#' + v + 'Help'));

            }

            if (fsv.shopName.length == 0) {
                fs.shopName.style.borderColor = 'red';
                document.querySelector('#shopNameHelp').innerHTML = '請填寫正確格式';

                isPassed = false;
            }
            if (!email_pattern.test(fsv.shopEmail)) {
                fs.shopEmail.style.borderColor = 'red';
                document.querySelector('#shopEmailHelp').innerHTML = '請填寫正確的信箱';

                isPassed = false;
            }
            if (fsv.shopOwner.length < 2) {
                fs.shopOwner.style.borderColor = 'red';
                document.querySelector('#shopOwnerHelp').innerHTML = '請填寫正確姓名';

                isPassed = false;
            }
            if (fsv.shopAgent.length < 2) {
                fs.shopAgent.style.borderColor = 'red';
                document.querySelector('#shopAgentHelp').innerHTML = '請填寫正確姓名';

                isPassed = false;
            }
            if (fsv.shopAddress.length == 0) {
                fs.shopAddress.style.borderColor = 'red';
                document.querySelector('#shopAddressHelp').innerHTML = '請填寫正確地址';

                isPassed = false;
            }
            if (!fsv.shopId.length == 8) {
                fs.shopId.style.borderColor = 'red';
                document.querySelector('#shopIdHelp').innerHTML = '請填寫正確營利事業登記證號';

                isPassed = false;
            }

            if (isPassed) {
                let form = new FormData(document.form1);

                submit_btn.style.display = 'none';

                fetch('user_shop_insert_api.php', {
                    method: 'POST',
                    body: form
                })
                    .then(response => response.json())
                    .then(obj => {
                        console.log(obj);

                        info_bar.style.display = 'block';

                        if (obj.success) {
                            // info_bar.className = 'alert alert-success';
                            // info_bar.innerHTML = '資料新增成功';

                            alert('資料新增成功！');
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


        }

        // const shopImg = document.querySelector('#shopImg');
        //
        // shopImg.addEventListener('change', event => {
        //     const fd = new FormData();
        //
        //     fd.append('shopImg', shopImg.files[0]);
        //
        //     fetch('upload_ajax.php', {
        //         method: 'post',
        //         body: fd
        //     })
        //
        //         .then(response => response.jason())
        //         .then(obj => {
        //             console.log(obj);
        //             shopImg.setAttribute('src', 'uploads/' + obj.filename);
        //         });
        // });



        const myimg = document.querySelector('#myimg');
        const my_file = document.querySelector('#my_file');
        const shopImg = document.querySelector('#shopImg');
        const shopName = document.querySelector('#shopName');

        my_file.addEventListener('change', event=>{
            console.log('EventListener', event.target);
            const fd = new FormData();

            fd.append('my_file', my_file.files[0]); //my_file.files[0]拿到陣列中的第一個檔案
            fd.append('shopName', shopName.value);
            fd.append('test', '123');

            fetch('user_shop_upload.php', {method: 'POST', body: fd})
                .then(response=>response.json())
                .then(obj=>{
                    console.log(obj);
                    myimg.setAttribute('src', 'uploads/' +obj.filename);
                    shopImg.setAttribute('value', obj.filename);

                });
        });



    </script>
    <?php include __DIR__ . '/__html_foot.php'; ?>

