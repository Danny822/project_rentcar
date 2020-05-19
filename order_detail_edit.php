<?php
require __DIR__ . '/__cred.php';
require __DIR__ . '/__connect_db.php';
$page_name = 'order_detail_edit';

$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$listNo = isset($_GET['listNo']) ? intval($_GET['listNo']) : 0;

$sql = "SELECT * FROM `order_detail` WHERE listNo = $listNo";

$stmt = $pdo->query($sql);
if ($stmt->rowCount() == 0) {
    header('Location: order_detail_list.php');
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

    .btn-top {
        right: 20px;
        bottom: 20px;
    }
</style>
<div class="container">

    <div class="row">
        <div class="col-lg-6 insert-form">

            <div id="info_bar" class="alert alert-success" role="alert" style="display: none">
            </div>

            <div class="card">
                <button class="btn btn-primary position-fixed btn-top rounded-circle" id="goTop"><i class="fas fa-arrow-up"></i></button>
                <div class="card-body">
                    <h5 class="card-title">修改訂單明細資料
                    </h5>

                    <form name="form1" method="post" onsubmit="return checkForm();">
                        <input type="hidden" name="checkme" value="check123">
                        <input type="hidden" name="listNo" value="<?= $row['listNo'] ?>">
                        <div class="form-group">
                            <label for="orderNo">訂單編號</label>
                            <input type="text" class="form-control" id="orderNo" name="orderNo" placeholder="" value="<?= $row['orderNo'] ?>">
                            <small id="orderNoHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="pNo">商品編號</label>
                            <input type="text" class="form-control" id="pNo" name="pNo" placeholder="" value="<?= $row['pNo'] ?>">
                            <small id="pNoHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="startDate">租車日期</label>
                            <input type="date" class="form-control" id="startDate" name="startDate" placeholder="" value="<?= $row['startDate'] ?>">
                            <small id="startDateHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="endDate">還車日期</label>
                            <input type="date" class="form-control" id="endDate" name="endDate" placeholder="" value="<?= $row['endDate'] ?>">
                            <small id="endDateHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="pRent">租金</label>
                            <input type="text" class="form-control" id="pRent" name="pRent" placeholder="" value="<?= $row['pRent'] ?>">
                            <small id="pRentHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="shopName">車商名稱</label>
                            <input type="text" class="form-control" id="shopName" name="shopName" placeholder="" value="<?= $row['shopName'] ?>">
                            <small id="shopNameHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group" name="form">
                            <label for=" rentcarStatus">租車方式</label>
                            <select id="rentcarStatus" name="rentcarStatus" placeholder="" onchange="status()">
                                <option value="0" <?= $row['rentcarStatus'] == 0 ? 'selected' : ' ' ?>>自取車</option>
                                <option value="1" <?= $row['rentcarStatus'] == 1 ? 'selected' : ' ' ?>>代駕取車</option>
                            </select>
                        </div>
                        <div class="form-group" name="tag1" id="tag1">
                            <label for="rentAddress">指定地點地址 </label>
                            <input type="text" class="form-control" id="rentAddress" name="rentAddress" placeholder="" value="<?= $row['rentAddress'] ?>">
                            <small id="rentAddressHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group" name="tag2" id="tag2">
                            <label for="deliveryFee">車輛送達費用</label>
                            <input type="text" class="form-control" id="deliveryFee" name="deliveryFee" placeholder="" value="<?= $row['deliveryFee'] ?>">
                            <small id="deliveryFeeHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group" name="tag3" id="tag3">
                            <label for="startPlace">取車車商地點</label>
                            <input type="text" class="form-control" id="startPlace" name="startPlace" placeholder="" value="<?= $row['startPlace'] ?>">
                            <small id="startPlaceHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group" name="tag4" id="tag4">
                            <label for="endPlace">還車地點</label>
                            <input type="text" class="form-control" id="endPlace" name="endPlace" placeholder="" value="<?= $row['endPlace'] ?>">
                            <small id="endPlaceHelp" class="form-text text-muted"></small>
                        </div>
                        <button id="submit_btn" type="submit" class="btn btn-primary" onclick="myFunction()">送出</button>
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
        'orderNo',
        'pNo',
        'startDate',
        'endDate',
        'pRent',
        'shopName',
        //'rentcarStatus', 
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
    //console.log('fs.orderNo:', fs.orderNo);

    function status() {
        let status_value = form1.rentcarStatus.value;
        //console.log(status_value);

        if (status_value == 1) {
            document.querySelector('#tag1').style.display = 'block';
            document.querySelector('#tag2').style.display = 'block';
            document.querySelector('#tag3').style.display = 'none';
            document.querySelector('#tag4').style.display = 'block';
        } else {
            document.querySelector('#tag1').style.display = 'none';
            document.querySelector('#tag2').style.display = 'block';
            document.querySelector('#tag3').style.display = 'block';
            document.querySelector('#tag4').style.display = 'block';
        }
    }

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
        // let status_value = form1.rentcarStatus.value;

        // 拿到每個欄位的值
        const fsv = {};
        for (let v of fields) {
            fsv[v] = fs[v].value;
        }
        //console.log(fsv.orderNo);


        let Date_pattern = /^\d{4}\-?\d{2}\-?\d{2}$/;


        for (let v of fields) {
            fs[v].style.borderColor = '#cccccc';
            document.querySelector('#' + v + 'Help').innerHTML = '';
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
            if (form1.rentAddress.value == '') {
                fs.rentAddress.style.borderColor = 'red';
                document.querySelector('#rentAddressHelp').innerHTML = '請填寫正確的指定地點地址!';

                isPassed = false;
            }
            //console.log('form1.deliveryFee.value:', form1.deliveryFee.value);
            if (form1.deliveryFee.value == 0) {

                fs.deliveryFee.style.borderColor = 'red';
                document.querySelector('#deliveryFeeHelp').innerHTML = '請填寫正確的車輛送達費用!';

                isPassed = false;
            }

            if (form1.endPlace.length == '') {
                fs.endPlace.style.borderColor = 'red';
                document.querySelector('#endPlaceHelp').innerHTML = '請填寫正確的還車地點!';

                isPassed = false;
            }

        } else {

            if (form1.deliveryFee.value !== 0) {
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
            if (form1.endPlace.length == '') {
                fs.endPlace.style.borderColor = 'red';
                document.querySelector('#endPlaceHelp').innerHTML = '請填寫正確的還車地點!';

                isPassed = false;
            }

        }


        if (isPassed) {
            let form = new FormData(document.form1);
            let orderNo = fs.orderNo;

            submit_btn.style.display = 'none';

            fetch('order_detail_edit_api.php', {
                    method: 'POST',
                    body: form
                })
                .then(response => response.json())
                .then(obj => {
                    console.log(obj);

                    // info_bar.style.display = 'block';

                    if (obj.success) {

                        swal("資料修改成功！", "即將返回明細列表", "success");
                        $(".swal-button--confirm").click(function() {
                            window.location.href = "order_detail_list.php?orderNo=" + `${fsv.orderNo}`;
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

    $("#goTop").click(function() {
        $("html").animate({
            scrollTop: 0
        }, 500)
    });

    status();
</script>

<script>
    function myFunction() {
        history.back();
        // let page = <?= $page ?>;
        // let orderNo = fs.orderNo;
        // window.location.href = "order_detail_list.php?page="
        // `${page}` + "&orderNo=" + `${orderNo}`;
        // console.log(window.location.href);
    };
</script>
<?php include __DIR__ . '/__html_foot.php';  ?> 