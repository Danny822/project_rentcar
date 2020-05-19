<?php
require __DIR__ . '/__cred.php';
require __DIR__ . '/__connect_db.php';
$page_name = 'order_list';
$per_page = 5;
$page = isset($_GET['page']) ? intval($_GET['page']) : 1;

$key = isset($_GET['key']) ? $_GET['key'] : '';
$searchKey = isset($_GET['searchKey']) ? $_GET['searchKey'] : '';

//算總比數
$t_sql = "SELECT COUNT(1) FROM `order` where 1=1";


//----

if ($key != '' and $searchKey != '') {
    if ($key == 'orderNo') {
        $t_sql = $t_sql . " AND `orderNo` LIKE '%$searchKey%'";
    }
    if ($key == 'mNo') {
        $t_sql = $t_sql . " AND `mNo` LIKE '%$searchKey%'";
    }
}

$t_stmt = $pdo->query($t_sql);
$total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];

// 總頁數
$total_pages = ceil($total_rows / $per_page);

// if ($page < 1) {
//     $page = 1;
// }

// if ($page > $total_pages) {
//     $page = $total_pages;
// }
if ($page < 1) $page = 1;
if (($page > $total_pages) && $total_pages != 0) $page = $total_pages;

$sql = "SELECT * FROM `order` WHERE 1=1 ";

//-----'%a%'

if ($key != '' and $searchKey != '') {
    if ($key == 'orderNo') {
        $sql = $sql . " AND `orderNo` LIKE '%$searchKey%'";
    }
    if ($key == 'mNo') {
        $sql = $sql . " AND `mNo` LIKE '%$searchKey%'";
    }
}

//$sql = sprintf("SELECT * FROM `order` ORDER BY orderNo DESC LIMIT %s, %s", ($page - 1) * $per_page, $per_page);
//$sql = sprintf("SELECT * FROM `order` ORDER BY orderNo  LIMIT %s, %s", ($page - 1) * $per_page, $per_page);
$sql = $sql . " LIMIT " . ($page - 1) * $per_page . "," . $per_page;
$stmt = $pdo->query($sql);

// 所有資料一次拿出來
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<?php include __DIR__ . '/__html_head.php'; ?>
<?php include __DIR__ . '/__navbar.php'; ?>

<link rel="stylesheet" href="./css/driver.css">
<style>
    th {
        justify-content: center !important;
        text-align: center !important;
        vertical-align: middle !important;
    }

    td {
        justify-content: center !important;
        text-align: center !important;
        vertical-align: middle !important;
    }
</style>
<div class="container">
    <br>
    <br>

    <!-- <div class="row">
        <div class="col-lg-12">
            <nav>
                <ul class="pagination pagination-sm">
                    <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page - 1 ?>">&lt;</a>
                    </li>
                    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <li class="page-item <?= $i == $page ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php endfor ?>
                    <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page + 1 ?>">&gt;</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div> -->
    <form class="form-inline d-flex justify-content-center my-4" method="get" id="forms" name="forms">
        <label class="my-1 mr-2" for="inlineFormCustomSelectPref"></label>
        <select class="custom-select my-1 mr-sm-2" id="key" name="key">
            <option selected>選擇搜尋項目</option>
            <option value="orderNo">訂單編號</option>
            <option value="mNo">顧客編號</option>
        </select>

        <input type="text" class="form-control  mr-sm-2" name="searchKey" id="searchKey" placeholder="請輸入關鍵字" value="<?= $searchKey ?>" class="custom-select my-1 mr-sm-2">

        <button type=" submit" class="btn btn-primary my-1 search-btn">搜尋</button>
    </form>
    <br>
    <div class="row">
        <div class="col-lg-12 page">
            <a href="order_insert.php" class="shop-insert"><i class="fas fa-plus-circle"></i></a>

            <nav>
                <ul class="pagination pagination-sm justify-content-center">
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
    <br>
    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped text-center table-bordered">
                <thead>
                    <tr>
                        <th scope="col"><i class="fas fa-list-alt"></i></th>
                        <th scope="col">訂單編號</th>
                        <th scope="col">顧客編號</th>
                        <th scope="col">顧客姓名</th>
                        <th scope="col">訂單成立時間</th>
                        <th scope="col">總金額</th>
                        <th scope="col"><i class="fas fa-edit"></i></th>
                        <th scope="col"><i class="fas fa-trash-alt"></i></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($rows as $row) : ?>
                    <tr>
                        <td>
                            <a href="javascript: list(<?= $row['orderNo'] ?>)" class="s-icon"><i class="fas fa-list-alt"></i></a>
                        </td>
                        <td><?= $row['orderNo'] ?></td>
                        <td><?= $row['mNo'] ?></td>
                        <td><?= $row['mName'] ?></td>
                        <td><?= htmlentities($row['orderDate']) ?></td>
                        <!--  htmlentities函數把字符轉換為 HTML 實體。 -->
                        <!-- <td><? ?></td> -->
                        <td><?= $row['total'] ?></td>
                        <td>
                            <a href="order_edit.php?orderNo=<?= $row['orderNo'] ?>" class="s-icon"><i class="fas fa-edit"></i></a>
                        </td>
                        <td><a href="javascript: delete_it(<?= $row['orderNo'] ?>)" class="s-icon">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>





</div>

<script>
    function list(orderNo) {
        location.href = 'order_detail_list.php?orderNo=' + orderNo;
    }

    // function delete_it(orderNo) {
    //     if (confirm(`確定要刪除訂單編號為 ${orderNo}的資料嗎 ?`)) {
    //         location.href = 'order_delete.php?orderNo=' + orderNo;
    //     }
    // }
</script>
<script>
    function delete_it(orderNo) {
        swal({
                title: `確定要刪除編號為 ${orderNo} 的資料嗎？`,
                //text: "Once deleted, you will not be able to recover this imaginary file!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("您已成功刪除此筆訂單資料!", {
                        icon: "success",
                    });
                } else {
                    swal("您已取消刪除此筆訂單資料!");
                }
            });
        $(".swal-button--confirm").click(function() {
            // sleep(3000);
            $(".swal-button--confirm").click(function() {
                // sleep(3000);
                location.href = 'order_delete.php?orderNo=' + orderNo;
            })
        })
    }
</script>
<script>
    function myFunctionB() {
        window.location.href = "?page=<?= $page - 1 ?>" + "&key=<?= $key ?>&searchKey=<?= $searchKey ?>";
        console.log(window.location.href);
    };

    <?php for ($i = 1; $i <= $total_pages; $i++) : ?>

    function myFunction<?= $i ?>() {
        window.location.href = "?page=<?= $i ?>" + "&key=<?= $key ?>&searchKey=<?= $searchKey ?>";
        console.log(window.location.href);
    };
    <?php endfor ?>

    function myFunctionC() {
        window.location.href = "?page=<?= $page + 1 ?>" + "&key=<?= $key ?>&searchKey=<?= $searchKey ?>";
        console.log(window.location.href);
    };
</script>
<?php include __DIR__ . '/__html_foot.php'; ?> 