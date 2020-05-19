<?php
require __DIR__ . '/__cred.php';
require __DIR__ . '/__connect_db.php';
$page_name = 'order_edit';

$orderNo = isset($_GET['orderNo']) ? intval($_GET['orderNo']) : 0;

$sql = "SELECT * FROM `order` WHERE orderNo=$orderNo";

$stmt = $pdo->query($sql);
if ($stmt->rowCount() == 0) {
    header('Location: order_list.php');
    exit;
}
$row = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<?php include __DIR__ . '/__html_head.php'; ?>
<?php include __DIR__ . '/__navbar.php';  ?>

<link rel="stylesheet" href="./css/driver.css">


<style>
    .form-group small {
        color: red !important;
    }
</style>
<div class="container">

    <div class="row">
        <div class="col-lg-6 insert-form">

            <div id="info_bar" class="alert alert-success" role="alert" style="display: none">
            </div>

            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">修改訂單資料
                    </h5>

                    <form name="form1" method="post" onsubmit="return checkForm();">
                        <input type="hidden" name="checkme" value="check123">
                        <input type="hidden" name="orderNo" value="<?= $row['orderNo'] ?>">
                        <div class="form-group">
                            <label for="mNo">顧客編號</label>
                            <input type="text" class="form-control" id="mNo" name="mNo" placeholder="" value="<?= $row['mNo'] ?>">
                            <small id="mNoHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="mName">顧客姓名</label>
                            <input type="text" class="form-control" id="mName" name="mName" placeholder="" value="<?= $row['mName'] ?>">
                            <small id="mNameHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="orderDate">訂單成立時間</label>
                            <input type="date" class="form-control" id="orderDate" name="orderDate" placeholder="" value="<?= $row['orderDate'] ?>">
                            <small id="orderDateHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="total">總金額</label>
                            <input type="text" class="form-control" id="total" name="total" placeholder="" value="<?= $row['total'] ?>">
                            <small id="totalHelp" class="form-text text-muted"></small>
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
        'mNo',
        'mName',
        'orderDate',
        'total',
    ];

    // 拿到每個欄位的參照
    const fs = {};
    for (let v of fields) {
        fs[v] = document.form1[v];
    }
    console.log(fs);
    console.log('fs.mNo:', fs.mNo);

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
        //info_bar.style.display = 'none';

        // 拿到每個欄位的值
        const fsv = {};
        for (let v of fields) {
            fsv[v] = fs[v].value;
        }
        console.log(fsv);


        let orderDate_pattern = /^\d{4}\-?\d{2}\-?\d{2}$/;


        for (let v of fields) {
            fs[v].style.borderColor = '#cccccc';
            document.querySelector('#' + v + 'Help').innerHTML = '';
        }

        if (fsv.mNo.length == 0) {
            fs.mNo.style.borderColor = 'red';
            document.querySelector('#mNoHelp').innerHTML = '請填寫正確的顧客編號!';

            isPassed = false;
        }
        if (fsv.mName.length < 2) {
            fs.mName.style.borderColor = 'red';
            document.querySelector('#mNameHelp').innerHTML = '請填寫正確的顧客姓名!';

            isPassed = false;
        }

        if (!orderDate_pattern.test(fsv.orderDate)) {
            fs.orderDate.style.borderColor = 'red';
            document.querySelector('#orderDateHelp').innerHTML = '請填寫正確的訂單日期!';
            isPassed = false;
        }

        if (fsv.total.length == 0) {
            fs.total.style.borderColor = 'red';
            document.querySelector('#totalHelp').innerHTML = '請填寫正確的總金額!';

            isPassed = false;
        }

        if (isPassed) {
            let form = new FormData(document.form1);

            submit_btn.style.display = 'none';

            fetch('order_edit_api.php', {
                    method: 'POST',
                    body: form
                })
                .then(response => response.json())
                .then(obj => {
                    console.log(obj);

                    // info_bar.style.display = 'block';


                    if (obj.success) {

                        swal("資料修改成功！", "即將返回訂單列表", "success");
                        $(".swal-button--confirm").click(function() {
                            window.location = "order_list.php";
                        });

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
<?php include __DIR__ . '/__html_foot.php';  ?> 