<?php
require __DIR__ . '/__cred.php';
require __DIR__ . '/__connect_db.php';
$page_name = 'order_list';

//決定每一頁有幾筆資料
$per_page = 5;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;
$orderNo = isset($_GET['orderNo']) ? intval($_GET['orderNo']) : '';

//算總比數
$t_sql = "SELECT COUNT(1)  FROM `order` LEFT JOIN `order_detail` ON `order`.`orderNo` = `order_detail`.`orderNo` WHERE `order`.`orderNo` = $orderNo ";
$t_stmt = $pdo->query($t_sql);
$total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];
//$total_rows = $stmt->rowCount();
// 總頁數
$total_pages = ceil($total_rows / $per_page);

if ($page < 1) {
    $page = 1;
}

if (($page > $total_pages) && $total_pages != 0) {
    $page = $total_pages;
}


// $orderNo = isset($_GET['orderNo']) ? intval($_GET['orderNo']) : 0;


//$sql = sprintf("SELECT * FROM `order` JOIN `order_detail` ON `order`.`orderNo` =  `order_detail`.`orderNo` ORDER BY listNo  LIMIT %s, %s", ($page - 1) * $per_page, $per_page);
$sql = "SELECT * FROM `order` LEFT JOIN `order_detail` ON `order`.`orderNo` = `order_detail`.`orderNo` WHERE `order`.`orderNo` = $orderNo ";
$sql = $sql . " LIMIT " . ($page - 1) * $per_page . "," . $per_page;
$stmt = $pdo->query($sql);

// 所有資料一次拿出來
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>

<?php include __DIR__ . '/__html_head.php'; ?>
<?php include __DIR__ . '/__navbar.php'; ?>

<style>
    th {
        justify-content: center !important;
        text-align: center !important;
        vertical-align: middle !important;
    }

    .btn-top {
        right: 10px;
        bottom: 10px;
    }
</style>

<link rel="stylesheet" href="./css/driver.css">

<div class="container">

    <button class="btn btn-primary position-fixed btn-top rounded-circle" id="goTop"><i class="fas fa-arrow-up"></i></button>
    <div class="d-flex justify-content-center">
        <a class="btn btn-primary my-3" href="./order_list.php" role="button">回訂單列表頁</a>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <a href="order_detail_insert.php" class="shop-insert"><i class="fas fa-plus-circle"></i></a>

            <nav>
                <ul class="pagination pagination-sm justify-content-center">
                    <!--跳轉頁面後orderNo Get不到需寫三個myFunction-->
                    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>" <?php if ($page <= 1) : ?> '' <?php else : ?> onclick="myFunctionB()" <?php endif ?>>
                        <a class="page-link" id="p2" href="#">&lt;</a>
                    </li>
                    <!--用迴圈取出每一個頁面-->
                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>" onclick="myFunction<?= $i ?>()">
                        <a class="page-link" id="p3" href="#"><?= $i ?></a>
                    </li>
                    <?php endfor ?>
                    <!--下一頁-->
                    <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>" <?php if ($page >= $total_pages) : ?> '' <?php else : ?> onclick="myFunctionC()" <?php endif ?>>
                        <a class="page-link" id="p4" href="#">&gt;</a>
                    </li>

                </ul>
            </nav>
        </div>
    </div>
</div>

<div class="row tablerow">
    <div class="col-lg-12">
        <table class="table table1 text-center table-striped table-bordered">
            <thead>
                <tr>
                    <th scope="col">明細編號</th>
                    <th scope="col">訂單編號</th>
                    <th scope="col">商品編號</th>
                    <th scope="col">租車日期</th>
                    <th scope="col">還車日期</th>
                    <th scope="col">租金</th>
                    <th scope="col">車商名稱</th>
                    <th scope="col">租車方式<br>0: 自取 / 1: 代駕</th>
                    <th scope="col">指定地點地址</th>
                    <th scope="col">車輛送達費用</th>
                    <th scope="col">取車車商地點</th>
                    <th scope="col">還車地點</th>
                    <th scope="col"><i class="fas fa-edit"></i></th>
                    <th scope="col"><i class="fas fa-trash-alt"></i></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($rows as $row) : ?>
                <tr>
                    <td><?= $row['listNo'] ?></td>
                    <td><?= $row['orderNo'] ?></td>
                    <td><?= $row['pNo'] ?></td>
                    <td><?= htmlentities($row['startDate']) ?></td>
                    <td><?= htmlentities($row['endDate']) ?></td>
                    <td><?= $row['pRent'] ?></td>
                    <td><?= $row['shopName'] ?></td>
                    <td><?= $row['rentcarStatus'] ?></td>
                    <td><?= $row['rentAddress'] ?></td>
                    <td><?= $row['deliveryFee'] ?></td>
                    <td><?= $row['startPlace'] ?></td>
                    <td><?= $row['endPlace'] ?></td>
                    <td>
                        <a href="order_detail_edit.php?listNo=<?= $row['listNo'] ?>" class="s-icon"><i class="fas fa-edit"></i></a>
                    </td>
                    <td><a href="javascript: detail_delete_it(<?= $row['listNo'] ?>)" class="s-icon">

                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>

<!--card-->

<div class="container cardcontainer">
    <div class="row">
        <?php foreach ($rows as $row) : ?>

        <div class="card col-md-4 col-sm-12 col-xs-12" id="everycard" style="width: 18rem;">

            <div class="d-flex justify-content-end">
                <a href="order_detail_edit.php?listNo=<?= $row['listNo'] ?>" class="m-2 s-icon"><i class="fas fa-edit"></i></a>
                <a href="javascript: delete_it(<?= $row['listNo'] ?>)" class="m-2 s-icon">
                    <i class="fas fa-trash-alt"></i>
                </a>
            </div>


            <ul class="list-group list-group-flush">

                <li class="list-group-item" style="border-top: none">
                    明細編號
                    <p>&nbsp;&nbsp;<?= $row['listNo'] ?></p>
                </li>
                <li class="list-group-item">
                    訂單編號
                    <p>&nbsp;&nbsp;<?= $row['orderNo'] ?></p>
                </li>
                <li class="list-group-item">
                    商品編號
                    <p>&nbsp;&nbsp;<?= $row['pNo'] ?></p>
                </li>
                <li class="list-group-item">
                    租車日期
                    <p>&nbsp;&nbsp;<?= htmlentities($row['startDate']) ?></p>
                </li>
                <li class="list-group-item">
                    還車日期
                    <p>&nbsp;&nbsp;<?= htmlentities($row['endDate']) ?></p>
                </li>
                <li class="list-group-item">
                    租金
                    <p>&nbsp;&nbsp;<?= $row['pRent'] ?></p>
                </li>
                <li class="list-group-item">
                    車商名稱
                    <p>&nbsp;&nbsp;<?= $row['shopName'] ?></p>
                </li>
                <li class="list-group-item">
                    租車方式
                    <p>&nbsp;&nbsp;<?= $row['rentcarStatus'] ?></p>
                </li>
                <li class="list-group-item">
                    指定地點地址
                    <p>&nbsp;&nbsp;<?= $row['rentAddress'] ?></p>
                </li>
                <li class="list-group-item">
                    車輛送達費用
                    <p>&nbsp;&nbsp;<?= $row['deliveryFee'] ?></p>
                </li>
                <li class="list-group-item">
                    取車車商地點
                    <p>&nbsp;&nbsp;<?= $row['startPlace'] ?></p>
                </li>
                <li class="list-group-item">
                    還車地點
                    <p>&nbsp;&nbsp;<?= $row['endPlace'] ?></p>
                </li>
            </ul>
        </div>

        <?php endforeach; ?>
    </div>
</div>






<script>
    function myFunctionB() {
        window.location.href = "?page=<?= $page - 1 ?>" + "&orderNo=<?= $orderNo ?>";
        console.log(window.location.href);
    };

    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>

    function myFunction<?= $i ?>() {
        window.location.href = "?page=<?= $i ?>" + "&orderNo=<?= $orderNo ?>";
        console.log(window.location.href);
    };
    <?php endfor ?>

    function myFunctionC() {
        window.location.href = "?page=<?= $page + 1 ?>" + "&orderNo=<?= $orderNo ?>";
        console.log(window.location.href);
    };

    function detail_delete_it(listNo) {
        // if (confirm(`確定要刪除明細編號為 ${listNo}的資料嗎 ?`)) {
        //     location.href = 'order_detail_delete.php?listNo=' + listNo;
        // }
        swal({
                title: `確定要刪除編號為 ${listNo} 的資料嗎？`,
                //text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("您已成功刪除此筆明細資料!", {
                        icon: "success",
                    });
                } else {
                    swal("您已取消刪除此筆明細資料!");
                }
            });
        $(".swal-button--confirm").click(function() {
            // sleep(3000);
            $(".swal-button--confirm").click(function() {
                // sleep(3000);
                location.href = 'order_detail_delete.php?listNo=' + listNo;
            })
        })
    };

    $("#goTop").click(function() {
        $(window).scrollTop(0); //到最頂端
    });
</script>
<?php include __DIR__ . '/__html_foot.php'; ?> 