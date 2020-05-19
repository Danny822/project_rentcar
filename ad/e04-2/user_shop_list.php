<?php
require __DIR__ . '/__cred.php';
require __DIR__ . '/__connect.php';

$page_name = 'user_shop_list';

$per_page = 6;  //每頁資料數

$page = isset($_GET['page']) ? $_GET['page'] : 1;

$key = isset($_GET['key']) ? $_GET['key'] : '';
$searchKey = isset($_GET['searchKey']) ? $_GET['searchKey'] : '';


//算總筆數

$t_sql = "SELECT COUNT(1) FROM user_shop where 1=1 ";

//----

if ($key != '' AND $searchKey != '') {
    if ($key == 'shopName') {
        $t_sql = $t_sql . " AND `shopName` LIKE '%$searchKey%'";
    }
    if ($key == 'shopAccount') {
        $t_sql = $t_sql . " AND `shopAccount` LIKE '%$searchKey%'";
    }
    if ($key == 'shopEmail') {
        $t_sql = $t_sql . " AND `shopEmail` LIKE '%$searchKey%'";
    }
    if ($key == 'shopPhone') {
        $t_sql = $t_sql . " AND `shopPhone` LIKE '%$searchKey%'";
    }
}
//if($searchKey!=''){
//    $t_sql = $t_sql." like '%$searchKey%' ";
//}


//------

$t_stmt = $pdo->query($t_sql);
$total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];

//總頁數

$total_pages = ceil($total_rows / $per_page);

if ($page < 1) $page = 1;
if (($page > $total_pages) && $total_pages != 0) $page = $total_pages;

$sql = "SELECT * FROM `user_shop` WHERE 1=1 ";

//-----'%a%'

if ($key != '' AND $searchKey != '') {
    if ($key == 'shopName') {
        $sql = $sql . " AND `shopName` LIKE '%$searchKey%'";
    }
    if ($key == 'shopAccount') {
        $sql = $sql . " AND `shopAccount` LIKE '%$searchKey%'";
    }
    if ($key == 'shopEmail') {
        $sql = $sql . " AND `shopEmail` LIKE '%$searchKey%'";
    }
    if ($key == 'shopPhone') {
        $sql = $sql . " AND `shopPhone` LIKE '%$searchKey%'";
    }
}

//if($searchKey!=''){
//    $sql = $sql." like '%$searchKey%' ";
//}

$sql = $sql . " LIMIT " . ($page - 1) * $per_page . "," . $per_page;

$stmt = $pdo->query($sql);

//所有資料
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


include __DIR__ . '/__html_head.php';
include __DIR__ . '/__navbar.php';
?>

<!--<div class="container">-->
<!--    <div>--><? //= $page. " / ". $total_pages ?><!--</div>-->
<!--<style>-->
<!--    .page{-->
<!--        padding: 0;-->
<!--    }-->
<!--</style>-->

<!--//search-->
<link rel="stylesheet" href="./css/shop_user.css">
<div class="container">
    <form class="form-inline d-flex justify-content-center my-4" method="get" id="forms" name="forms">
        <label class="my-1 mr-2" for="inlineFormCustomSelectPref"></label>
        <select class="custom-select my-1 mr-sm-2" id="key" name="key">
            <option selected>選擇搜尋項目</option>
            <option value="shopName">店名</option>
            <option value="shopAccount">帳號</option>
            <option value="shopEmail">信箱</option>
            <option value="shopPhone">電話</option>
        </select>

        <input type="text" class="form-control  mr-sm-2" name="searchKey" id="searchKey" placeholder="請輸入關鍵字"
               value="<?= $searchKey ?>"
               class="custom-select my-1 mr-sm-2"">

        <button type="submit" class="btn btn-primary my-1 search-btn">搜尋</button>
    </form>



    <div class="row">
        <div class="col-lg-12 page">
            <a href="user_shop_insert.php" class="shop-insert"><i class="fas fa-plus-circle"></i></a>

            <nav>
                <ul class="pagination pagination-sm justify-content-center">
                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>"
                    <?php if ($page <= 1): ?>''
                    <?php else: ?>onclick="myFunctionB()"
                    <?php endif ?>
                    >
                    <a class="page-link" href="?page=<?= $page - 1 ?>">&lt;</a>
                    </li>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>" onclick="myFunction<?= $i ?>()">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor ?>

                    <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>"
                    <?php if ($page >= $total_pages): ?>''
                    <?php else: ?>onclick="myFunctionC()"
                    <?php endif ?>
                    >
                    <a class="page-link" href="?page=<?= $page + 1 ?>">&gt;</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>


    <div class="row tablerow">
        <div class="">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th scope="col"><i class="fas fa-edit"></i></th>
                    <th scope="col">shopNo</th>
                    <th scope="col">shopName</th>
                    <th scope="col">shopAccount</th>
                    <th scope="col">shopPwd</th>
                    <th scope="col">shopPhone</th>
                    <th scope="col">shopEmail</th>
                    <th scope="col">shopOwner</th>
                    <th scope="col">shopAgent</th>
                    <th scope="col">shopAddress</th>
                    <th scope="col">shopAddressUrl</th>
                    <th scope="col">shopInfo</th>
                    <th scope="col">shopId</th>
                    <th scope="col">shopImg</th>
                    <th scope="col"><i class="fas fa-trash-alt"></i></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($rows as $row): ?>
                    <tr>
                        <td>
                            <a href="user_shop_edit.php?shopNo=<?= $row['shopNo'] ?>"><i class="fas fa-edit"></i></a>
                        </td>
                        <td><?= htmlentities($row['shopNo']) ?></td>
                        <td><?= htmlentities($row['shopName']) ?></td>
                        <td><?= htmlentities($row['shopAccount']) ?></td>
                        <td><?= htmlentities($row['shopPwd']) ?></td>
                        <td><?= htmlentities($row['shopPhone']) ?></td>
                        <td><?= htmlentities($row['shopEmail']) ?></td>
                        <td><?= htmlentities($row['shopOwner']) ?></td>
                        <td><?= htmlentities($row['shopAgent']) ?></td>
                        <td><?= htmlentities($row['shopAddress']) ?></td>
                        <td>
                            <iframe src="<?= htmlentities($row['shopAddressUrl']) ?>" frameborder="0"></iframe>
                        </td>
                        <td><?= htmlentities($row['shopInfo']) ?></td>
                        <td><?= htmlentities($row['shopId']) ?></td>
                        <td><img id="myimg" src="<?= 'uploads/' . $row['shopImg'] ?>" alt="" width="100px"></td>
                        <td><a href="javascript: delete_it(<?= $row['shopNo'] ?>)">
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


<!--</div>-->
<!--card-->


<!--card2-->
<div class="container cardcontainer">
    <div class="row">
        <?php foreach ($rows as $row): ?>

            <div class="card col-md-4 col-sm-12 col-xs-12" id="everycard" style="width: 18rem;">
                <img id="myimg" src="<?= 'uploads/' . $row['shopImg'] ?>" class="card-img-top mt-2" alt="...">

                <div class="d-flex justify-content-end">
                    <a href="user_shop_edit.php?shopNo=<?= $row['shopNo'] ?>" class="m-2 s-icon"><i
                                class="fas fa-edit"></i></a>
                    <a href="javascript: delete_it(<?= $row['shopNo'] ?>)" class="m-2 s-icon">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>


                <ul class="list-group list-group-flush">

                    <li class="list-group-item" style="border-top: none">
                        姓名
                        <p>&nbsp;&nbsp;<?= $row['shopName'] ?></p>
                    </li>
                    <li class="list-group-item">
                        帳號
                        <p>&nbsp;&nbsp;<?= $row['shopAccount'] ?></p>
                    </li>
                    <li class="list-group-item">
                        電話
                        <p>&nbsp;&nbsp;<?= $row['shopPhone'] ?></p>
                    </li>
                    <li class="list-group-item">
                        Email
                        <p>&nbsp;&nbsp;<?= $row['shopEmail'] ?></p>
                    </li>
                    <li class="list-group-item">
                        公司負責人
                        <p>&nbsp;&nbsp;<?= $row['shopOwner'] ?></p>
                    </li>
                    <li class="list-group-item">
                        公司管理人
                        <p>&nbsp;&nbsp;<?= $row['shopAgent'] ?></p>
                    </li>
                    <li class="list-group-item">
                        地址
                        <p>&nbsp;&nbsp;<?= $row['shopAddress'] ?></p>
                        <iframe src="<?= htmlentities($row['shopAddressUrl']) ?>" style="width: 100%"
                                frameborder="0"></iframe>
                    </li>
                </ul>
            </div>

        <?php endforeach; ?>
    </div>
</div>


<script>
    function delete_it(shopNo) {
        if (confirm(`確定要刪除編號為 ${shopNo} 的資料嗎?`)) {
            location.href = 'user_shop_delete.php?shopNo=' + shopNo;
        }
    }
</script>

<script>
    function myFunctionB() {
        window.location.href = "?page<? $page - 1 ?>" + "&key=<?= $key ?>" + "&searchKey=<?= $searchKey?>";
    };

    <?php for ($i = 1; $i <= $total_pages; $i++):?>
    function myFunction<?= $i ?>() {
        window.location.href = "?page<?= $i ?>" + "&key=<?= $key ?>" + "&searchKey=<?= $searchKey?>";
    };
    <?php endfor ?>

    function myFunctionC() {
        window.location.href = "?page<? $page + 1 ?>" + "&key=<?= $key ?>" + "&searchKey=<?= $searchKey?>";
    };

</script>
<?php include __DIR__ . '/__html_foot.php'; ?>








