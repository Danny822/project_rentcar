<?php
require __DIR__ . '/__cred.php';
require __DIR__ . '/__connect_db.php';

$page_name = 'user_shop_list01';

$per_page = 5;  //每頁資料數

$page = isset($_GET['page']) ? $_GET['page'] : 1;


    $t_sql = "SELECT COUNT(1) FROM `user_shop`";
    $t_stmt = $pdo->query($t_sql);
    $total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];

//總頁數

    $total_pages = ceil($total_rows / $per_page);

    if ($page < 1) $page = 1;
    if ($page > $total_pages) $page = $total_pages;

    $sql = sprintf("SELECT * FROM `user_shop` LIMIT %s ,%s", ($page - 1) * $per_page, $per_page);
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
<form class="form-inline" method="get">
    <label class="my-1 mr-2" for="inlineFormCustomSelectPref"></label>
    <select class="custom-select my-1 mr-sm-2" id="inlineFormCustomSelectPref" name="key">
        <option selected>選擇搜尋項目</option>
        <option value="shopName">店名</option>
        <option value="shopAccount">帳號</option>
        <option value="shopEmail">信箱</option>
        <option value="shopPhone">電話</option>
    </select>

    <input type="text" class="form-control  mr-sm-2" id="searchKey" placeholder="" value="" style="margin: 4px 0 4px 8px">

    <button type="submit" class="btn btn-primary my-1">搜尋</button>
</form>


<div class="row">
    <div class="col-lg-12 page">
        <nav>
            <ul class="pagination pagination-sm">
                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page - 1 ?>">&lt;</a>
                </li>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
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
</div>


<div class="row">
    <div class="col-lg-12">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th scope="col"><i class="fas fa-edit"></i></th>
                <th scope="col">shopNo</th>
                <th scope="col">shopAccount</th>
                <th scope="col">shopPwd</th>
                <th scope="col">shopPhon</th>
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


<!--</div>-->

<script>
    function delete_it(shopNo) {
        if (confirm(`確定要刪除編號為 ${shopNo} 的資料嗎?`)) {
            location.href = 'user_shop_delete.php?shopNo=' + shopNo;
        }
    }
</script>
<?php include __DIR__ . '/__html_foot.php'; ?>








