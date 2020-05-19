<?php
require __DIR__ . '/__cred.php';
require __DIR__ . '/__connect_db.php';
$page_name = 'order_detail_insert.php';

$orderNo = '';
$pNo = '';
$startDate = '';
$endDate = '';
$pRent = '';
$shopName = '';
$rentcarStatus = '';
$rentAddress = '';
$deliveryFee = '';
$startPlace = '';
$endPlace = '';

if (isset($_POST['checkme'])) {

    $orderNo = htmlentities($_POST['orderNo']);
    $pNo = htmlentities($_POST['pNo']);
    $startDate = htmlentities($_POST['startDate']);
    $endDate = htmlentities($_POST['endDate']);
    $pRent = htmlentities($_POST['pRent']);
    $shopName = htmlentities($_POST['shopName']);
    $rentcarStatus = htmlentities($_POST['rentcarStatus']);
    $rentAddress = htmlentities($_POST['rentAddress']);
    $deliveryFee = htmlentities($_POST['deliveryFee']);
    $startPlace = htmlentities($_POST['startPlace']);
    $endPlace = htmlentities($_POST['endPlace']);

    $sql = "INSERT INTO `order_detail`(
`orderNo`, `pNo`,`startDate`, `endDate`, `pRent`,`shopName`, `rentcarStatus`, `rentAddress`, `deliveryFee`,`startPlace`, `endPlace`
) VALUES (
?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
)";

    try {
        $stmt = $pdo->prepare($sql);

        $stmt->execute([
            $_POST['orderNo'],
            $_POST['pNo'],
            $_POST['startDate'],
            $_POST['endDate'],
            $_POST['pRent'],
            $_POST['shopName'],
            $_POST['rentcarStatus'],
            $_POST['rentAddress'],
            $_POST['deliveryFee'],
            $_POST['startPlace'],
            $_POST['endPlace'],
        ]);

        if ($stmt->rowCount() == 1) {
            $success = true;
            // $msg = [
            //     'type' => 'success',
            //     'info' => '資料新增成功',
            // ];
            //----------sweet_alert-------------------------------------------------------------------------------
            echo '<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>';

            echo '<script
                  src="https://code.jquery.com/jquery-3.3.1.min.js"
                  integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
                  crossorigin="anonymous"></script>';
            echo '<script type="text/javascript">';
            echo 'setTimeout(function () { swal("資料新增成功","","success");';
            echo '$(".swal-button--confirm").click(function(){
                     window.location="order_detail_list.php?page=1&orderNo=1";
                  });';
            echo '}, 500);</script>';
            //----------------------------------------------------------------------------------------------------
        } else {
            $msg = [
                'type' => 'danger',
                'info' => '資料新增錯誤',
            ];
        }
    } catch (PDOException $ex) {
        $msg = [
            'type' => 'danger',
            'info' => '未新增資料',
        ];
    }



    //     $sql = sprintf(
    //         "INSERT INTO `order_detail`(
    // `orderNo`, `pNo`,`startDate`, `endDate`, `pRent`,`shopName`, `rentcarStatus`, `rentAddress`, `deliveryFee`,`startPlace`, `endPlace`
    // ) VALUES (
    // %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s
    // )",
    //          $pdo->quote($_POST['orderNo']),
    //         $pdo->quote($_POST['pNo']),
    //         $pdo->quote($_POST['startDate']),
    //         $pdo->quote($_POST['endDate']),
    //         $pdo->quote($_POST['pRent']),
    //         $pdo->quote($_POST['shopName']),
    //         $pdo->quote($_POST['rentcarStatus']),
    //         $pdo->quote($_POST['rentAddress']),
    //         $pdo->quote($_POST['deliveryFee']),
    //         $pdo->quote($_POST['startPlace']),
    //         $pdo->quote($_POST['endPlace'])
    //     );

    //     echo $sql;
    //     exit; // 測試 SQL 長什麼樣子



    //     $stmt = $pdo->query($sql);
}

?>
<?php include __DIR__ . '/__html_head.php'; ?>
<?php include __DIR__ . '/__navbar.php';  ?>
<style>
    .form-group small {
        color: red !important;
    }

    .btn-top {
        right: 10px;
        bottom: 10px;
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
                <button class="btn btn-primary position-fixed btn-top rounded-circle" id="goTop"><i class="fas fa-arrow-up"></i></button>
                <div class="card-body">
                    <h5 class="card-title">新增訂單明細資料
                    </h5>

                    <form name="form1" method="post" onsubmit="return checkForm();">
                        <input type="hidden" name="checkme" value="check123">

                        <div class="form-group">
                            <label for="orderNo">訂單編號</label>
                            <input type="text" class="form-control" id="orderNo" name="orderNo" placeholder="" value="<?= $orderNo ?>">
                            <small id="orderNoHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="pNo">商品編號</label>
                            <input type="text" class="form-control" id="pNo" name="pNo" placeholder="" value="<?= $pNo ?>">
                            <small id="pNoHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="startDate">租車日期</label>
                            <input type="date" class="form-control" id="startDate" name="startDate" placeholder="" value="<?= $startDate ?>">
                            <small id="startDateHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="endDate">還車日期</label>
                            <input type="date" class="form-control" id="endDate" name="endDate" placeholder="" value="<?= $endDate ?>">
                            <small id="endDateHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="pRent">租金</label>
                            <input type="text" class="form-control" id="pRent" name="pRent" placeholder="" value="<?= $pRent ?>">
                            <small id="pRentHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="shopName">車商名稱</label>
                            <input type="text" class="form-control" id="shopName" name="shopName" placeholder="" value="<?= $shopName ?>">
                            <small id="shopNameHelp" class="form-text text-muted"></small>
                        </div>

                        <div class="form-group">
                            <label for="rentcarStatus">租車方式</label>
                            <select id="rentcarStatus" name="rentcarStatus" placeholder="" onchange="status1()">
                                <option value="">請選擇租車方式</option>
                                <option value="0">自取車</option>
                                <option value="1">代駕取車</option>
                            </select>
                        </div>

                        <div class="form-group" name="tag1" id="tag1" style="display:none">
                            <label for="rentAddress">指定地點地址</label>
                            <input type="text" class="form-control" id="rentAddress" name="rentAddress" placeholder="" value="<?= $rentAddress ?>">
                            <small id="rentAddressHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group" name="tagall" id="tagall" style="display:none">
                            <label for="deliveryFee">車輛送達費用</label>
                            <input type="text" class="form-control" id="deliveryFee" name="deliveryFee" placeholder="" value="<?= $deliveryFee ?>">
                            <small id="deliveryFeeHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group" name="tag0" id="tag0" style="display:none">
                            <label for="startPlace">取車車商地點</label>
                            <input type="text" class="form-control" id="startPlace" name="startPlace" placeholder="" value="<?= $startPlace ?>">
                            <small id="startPlaceHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group" name="tagall" id="tagall">
                            <label for="endPlace">還車地點</label>
                            <input type="text" class="form-control" id="endPlace" name="endPlace" placeholder="" value="<?= $endPlace ?>">
                            <small id="endPlaceHelp" class="form-text text-muted"></small>
                        </div>
                        <button type="submit" class="btn btn-primary" onclick="myFunctionC()">送出</button>
                    </form>

                </div>
            </div>
        </div>
    </div>




</div>
<script>
    const fields = [
        'orderNo',
        'pNo',
        'startDate',
        'endDate',
        'pRent',
        'shopName',
        'rentAddress',
        'deliveryFee',
        'startPlace',
        'endPlace',
    ];

    // 拿到每個欄位的參照
    const fs = {};
    for (let v of fields) {
        fs[v] = document.form1[v];
    }
    //console.log(fs);
    //console.log('fs.orderDate:', fs.orderDate);

    function status1() {
        let status_value = form1.rentcarStatus.value;
        console.log(status_value);

        if (status_value == 1) {
            document.querySelector('#tag1').style.display = 'block';
            document.querySelector('#tagall').style.display = 'block';
            document.querySelector('#tag0').style.display = 'none';
        } else {
            document.querySelector('#tag1').style.display = 'none';
            document.querySelector('#tagall').style.display = 'block';
            document.querySelector('#tag0').style.display = 'block';
        }
    }

    const checkForm = () => {
        let isPassed = true;

        // 拿到每個欄位的值
        const fsv = {};
        for (let v of fields) {
            fsv[v] = fs[v].value;
        }
        console.log(fsv);

        // let email_pattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        let Date_pattern = /^\d{4}\-?\d{2}\-?\d{2}$/;


        for (let v of fields) {
            fs[v].style.borderColor = '#cccccc';
            console.log('#' + v + 'Help');
            document.querySelector('#' + v + 'Help').innerHTML = '';
            console.log(document.querySelector('#' + v + 'Help'));
        }

        if (fsv.orderNo.length == 0) {
            fs.orderNo.style.borderColor = 'red';
            document.querySelector('#orderNoHelp').innerHTML = '請填寫正確的訂單編號!';

            isPassed = false;
        }
        if (fsv.pNo.length == 0) {
            fs.pNo.style.borderColor = 'red';
            document.querySelector('#pNoHelp').innerHTML = '請填寫正確的商品編號!';

            isPassed = false;
        }
        if (!Date_pattern.test(fsv.startDate)) {
            fs.startDate.style.borderColor = 'red';
            document.querySelector('#startDateHelp').innerHTML = '請填寫正確的租車日期!';
            isPassed = false;
        }
        if (!Date_pattern.test(fsv.endDate)) {
            fs.endDate.style.borderColor = 'red';
            document.querySelector('#endDateHelp').innerHTML = '請填寫正確的還車日期!';

            isPassed = false;
        }

        if (fsv.pRent.length == 0) {
            fs.pRent.style.borderColor = 'red';
            document.querySelector('#pRentHelp').innerHTML = '請填寫正確的租金!';

            isPassed = false;
        }
        if (fsv.shopName.length == 0) {
            fs.shopName.style.borderColor = 'red';
            document.querySelector('#shopNameHelp').innerHTML = '請填寫正確的車商名稱!';

            isPassed = false;
        }
        if (form1.rentcarStatus.value == 1) {
            if (fsv.rentAddress.length == '') {
                fs.rentAddress.style.borderColor = 'red';
                document.querySelector('#rentAddressHelp').innerHTML = '請填寫正確的指定地點地址!';

                isPassed = false;
            }

            if (form1.deliveryFee.value == 0) {

                fs.deliveryFee.style.borderColor = 'red';
                document.querySelector('#deliveryFeeHelp').innerHTML = '請填寫正確的車輛送達費用!';

                isPassed = false;
            }

            if (fsv.endPlace.length == '') {
                fs.endPlace.style.borderColor = 'red';
                document.querySelector('#endPlaceHelp').innerHTML = '請填寫正確的還車地點!';

                isPassed = false;
            }

        } else {
            if (fsv.deliveryFee.value !== 0) {
                document.querySelector('#deliveryFee').value = "<?= 0 ?>";

                //fs.deliveryFee.style.borderColor = 'red';
                //document.querySelector('#deliveryFeeHelp').innerHTML = '請填寫正確的車輛送達費用!';

                isPassed = true;
            }
            if (form1.startPlace.value == '') {
                fs.startPlace.style.borderColor = 'red';
                document.querySelector('#startPlaceHelp').innerHTML = '請填寫正確的取車車商地點!';

                isPassed = false;
            }
            if (fsv.endPlace.length == '') {
                fs.endPlace.style.borderColor = 'red';
                document.querySelector('#endPlaceHelp').innerHTML = '請填寫正確的還車地點!';

                isPassed = false;
            }

        }
        // if (fsv.rentcarStatus.length == 0) {
        //     fs.rentcarStatus.style.borderColor = 'red';
        //     document.querySelector('#rentcarStatusHelp').innerHTML = '請填寫正確的租車方式 [ 0: 自取車 1: 代駕取車 ] !';

        //     isPassed = false;
        // }
        // if (fsv.rentAddress.length == 0) {
        //     fs.rentAddress.style.borderColor = 'red';
        //     document.querySelector('#rentAddressHelp').innerHTML = '請填寫正確的指定地點地址!';

        //     isPassed = false;
        // }
        // if (fsv.deliveryFee.length == 0) {
        //     fs.deliveryFee.style.borderColor = 'red';
        //     document.querySelector('#deliveryFeeHelp').innerHTML = '請填寫正確的車輛送達費用!';

        //     isPassed = false;
        // }
        // if (fsv.startPlace.length == 0) {
        //     fs.startPlace.style.borderColor = 'red';
        //     document.querySelector('#startPlaceHelp').innerHTML = '請填寫正確的取車車商地點!';

        //     isPassed = false;
        // }
        // if (fsv.endPlace.length == 0) {
        //     fs.endPlace.style.borderColor = 'red';
        //     document.querySelector('#endPlaceHelp').innerHTML = '請填寫正確的還車地點!';

        //     isPassed = false;
        // }

        return isPassed;
    };

    // function myFunctionC() {
    //     window.location.href = 'order_detail_list.php' + "?orderNo=<?= $orderNo ?>";
    //     console.log(window.location.href);
    // };

    $("#goTop").click(function() {
        $(window).scrollTop(0); //到最頂端
    });
</script>
<?php include __DIR__ . '/__html_foot.php';  ?> 