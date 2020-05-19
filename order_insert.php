<?php
require __DIR__ . '/__cred.php';
require __DIR__ . '/__connect_db.php';
$page_name = 'order_insert';

$mNo = '';
$mName = '';
$orderDate = '';
$total = '';

if (isset($_POST['checkme'])) {
    $mNo = htmlentities($_POST['mNo']);
    $mName = htmlentities($_POST['mName']);
    $orderDate = htmlentities($_POST['orderDate']);
    $total = htmlentities($_POST['total']);

    $sql = "INSERT INTO `order`(
            `mNo`, `mName`,`orderDate`, `total`
            ) VALUES (
             ?, ?, ?, ?
            )";

    try {
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['mNo'],
            $_POST['mName'],
            $_POST['orderDate'],
            $_POST['total'],
        ]);

        if ($stmt->rowCount() == 1) {
            // $success = true;
            // $msg = [
            //     'type' => 'success',
            //     'info' => '資料新增成功',
            // ];

            //         echo("<script LANGUAGE='JavaScript'>
            // //window.alert('資料新增成功');
            // window.location.href='order_list.php';
            // </script>");

            //----------sweet_alert-------------------------------------------------------------------------------
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';

            echo '<script
                  src="https://code.jquery.com/jquery-3.3.1.min.js"
                  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                  crossorigin="anonymous"></script>';
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("資料新增成功","","success");';
            echo '$(".swal-button--confirm").click(function(){
                     window.location="order_list.php";
                  });';
            echo '}, 500);</script>';
        } else {
            $msg = [
                'type' => 'danger',
                'info' => '資料新增錯誤',
            ];
        }
    } catch (PDOException $ex) {
        $msg = [
            'type' => 'danger',
            'info' => '資料新增錯誤',
        ];
    }


    /*
    $sql = sprintf(
        "INSERT INTO `order`(
            `mNo`, `mName`, `orderDate`, `total`
            ) VALUES (
              %s, %s, %s, %s
            )",
        $pdo->quote($_POST['mNo']),
        $pdo->quote($_POST['mName']),
        $pdo->quote($_POST['orderDate']),
        $pdo->quote($_POST['total'])
    );

    echo $sql;
    exit; // 測試 SQL 長什麼樣子


    $stmt = $pdo->query($sql);

    */
}

?>
<?php include __DIR__ . '/__html_head.php'; ?>
<?php include __DIR__ . '/__navbar.php';  ?>
<style>
    .form-group small {
        color: red !important;
    }
</style>

<link rel="stylesheet" href="./css/driver.css">

<div class="container">

    <div class="row">
        <div class="col-lg-6 insert-form">
            <?php if (isset($msg)) : ?>
            <div class="alert alert-<?= $msg['type'] ?>" role="alert">
                <?= $msg['info'] ?>
            </div>
            <?php endif ?>
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">新增訂單資料
                    </h5>

                    <form name="form1" method="post" onsubmit="return checkForm();">
                        <input type="hidden" name="checkme" value="check123">

                        <div class="form-group">
                            <label for="mNo">顧客編號</label>
                            <input type="text" class="form-control" id="mNo" name="mNo" placeholder="" value="<?= $mNo ?>">
                            <small id="mNoHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="mName">顧客姓名</label>
                            <input type="text" class="form-control" id="mName" name="mName" placeholder="" value="<?= $mName ?>">
                            <small id="mNameHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="orderDate">訂單成立時間</label>
                            <input type="date" class="form-control" id="orderDate" name="orderDate" placeholder="" value="<?= $orderDate ?>">
                            <small id="orderDateHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="total">總金額</label>
                            <input type="text" class="form-control" id="total" name="total" placeholder="" value="<?= $total ?>">
                            <small id="totalHelp" class="form-text text-muted"></small>
                        </div>

                        <button type="submit" class="btn btn-primary">送出</button>
                    </form>

                </div>
            </div>
        </div>
    </div>




</div>
<script>
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
    //console.log('fs.orderDate:', fs.orderDate);


    const checkForm = () => {
        let isPassed = true;

        // 拿到每個欄位的值
        const fsv = {};
        for (let v of fields) {
            fsv[v] = fs[v].value;
        }
        console.log(fsv);


        // let email_pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
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


        return isPassed;
    };
</script>
<?php include __DIR__ . '/__html_foot.php';  ?> 