<?php
    
    require __DIR__. '/ming__connect_db.php';
    $page_name = 'ming_data_list';

    $per_page = 6;
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
    $key = isset($_GET['key']) ? $_GET['key'] : '';
    $searchKey = isset($_GET['searchKey']) ? $_GET['searchKey'] : '';


    // 算總筆數
    $t_sql = "SELECT COUNT(1) FROM coupon WHERE 1=1";

    
    if ($key != '' AND $searchKey != '') {
        if ($key == 'couponNo') {
            $t_sql = $t_sql . " AND `couponNo` LIKE '%$searchKey%'";
        }
        if ($key == 'couponInfo') {
            $t_sql = $t_sql . " AND `couponInfo` LIKE '%$searchKey%'";
        }
        if ($key == 'couponFunc') {
            $t_sql = $t_sql . " AND `couponFunc` LIKE '%$searchKey%'";
        }
        if ($key == 'couponState') {
            $t_sql = $t_sql . " AND `couponState` LIKE '%$searchKey%'";
        }
    }
$t_stmt = $pdo->query($t_sql);
    $total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];

    // 總頁數
    $total_pages = ceil($total_rows/$per_page);

    if($page < 1) $page = 1;
    if($page > $total_pages) $page = $total_pages;


    $sql = "SELECT * FROM `coupon` WHERE 1=1 ";

    if ($key != '' AND $searchKey != '') {
        if ($key == 'couponNo') {
            $sql = $sql . " AND `couponNo` LIKE '%$searchKey%'";
        }
        if ($key == 'couponInfo') {
            $sql = $sql . " AND `couponInfo` LIKE '%$searchKey%'";
        }
        if ($key == 'couponFunc') {
            $sql = $sql . " AND `couponFunc` LIKE '%$searchKey%'";
        }
        if ($key == 'couponState') {
            $sql = $sql . " AND `couponState` LIKE '%$searchKey%'";
        }
    }
    $sql = $sql . " LIMIT " . ($page - 1) * $per_page . "," . $per_page;
    $stmt = $pdo->query($sql);

    // 所有資料一次拿出來
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>
<?php include __DIR__. '/ming__html_head.php';  ?>
<?php include __DIR__. '/ming__navbar.php';  ?>
<link rel="stylesheet" href="./css/shop_user.css">
<div class="container">

    <form class="form-inline d-flex justify-content-center my-4" method="get" id="forms" name="forms">
        <label class="my-1 mr-2" for="inlineFormCustomSelectPref"></label>
        <select class="custom-select my-1 mr-sm-2" id="key" name="key">
            <option selected>選擇搜尋項目</option>
            <option value="couponNo">活動編號</option>
            <option value="couponInfo">內容</option>
            <option value="couponFunc">內容計算公式</option>
            <option value="couponState">上架狀態</option>
        </select>

        <input type="text" class="form-control  mr-sm-2" name="searchKey" id="searchKey" placeholder="請輸入關鍵字"
               value="<?= $searchKey ?>"
               class="custom-select my-1 mr-sm-2">

        <button type="submit" class="btn btn-primary my-1 search-btn">搜尋</button>
    </form>

    <div><?= $page. " / ". $total_pages ?></div>

    <div class="row">
        <div class="col-lg-12 page">
            <a href="data_index.php" class="shop-insert"><i class="fas fa-plus-circle"></i></a>

            <nav>
                <ul class="pagination pagination-sm justify-content-center">
                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>"
                    <?php if ($page <= 1): ?>''
                    <?php else: ?>onclick="myFunctionB()"
                    <?php endif ?>
                    >
                    <a class="page-link" href="#">&lt;</a>
                    </li>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>" onclick="myFunction<?= $i ?>()">
                            <a class="page-link" href="#"><?= $i ?></a>
                        </li>
                    <?php endfor ?>

                    <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>"
                    <?php if ($page >= $total_pages): ?>''
                    <?php else: ?>onclick="myFunctionC()"
                    <?php endif ?>
                    >
                    <a class="page-link" href="#">&gt;</a>
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
                <th scope="col">活動流水號</th>
                <th scope="col">活動編號</th>
                <th scope="col">內容</th>
                <th scope="col">內容計算公式</th>
                <th scope="col">上架狀態</th>
                <th scope="col"><i class="fas fa-trash-alt"></i></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach($rows as $row): ?>
    <tr>
        <td>
            <a href="ming_data_edit.php?couponSid=<?= $row['couponSid'] ?>"><i class="fas fa-edit"></i></a>
        </td>
        <td><?= $row['couponSid'] ?></td>
        <td><?= $row['couponNo'] ?></td>
        <td><?= $row['couponInfo'] ?></td>
        <td><?= $row['couponFunc'] ?></td>
        <td><?= $row['couponState'] ?></td>
        <td><a href="javascript: delete_it(<?= $row['couponSid'] ?>)">
            <i class="fas fa-trash-alt"></i></a>
        </td>
        

                        
    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>

    <!--card2-->
    <div class="container cardcontainer">
        <div class="row">
            <?php foreach ($rows as $row): ?>

                <div class="card col-md-4 col-sm-12 col-xs-12" id="everycard" style="width: 18rem;">

                    <div class="d-flex justify-content-end">
                        <a href="data_edit.php?couponSid=<?= $row['couponSid'] ?>" class="m-2 s-icon"><i
                                    class="fas fa-edit"></i></a>
                        <a href="javascript: delete_it(<?= $row['couponSid'] ?>)" class="m-2 s-icon">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </div>


                    <ul class="list-group list-group-flush">

                        <li class="list-group-item" style="border-top: none">
                            活動編號
                            <p>&nbsp;&nbsp;<?= $row['couponNo'] ?></p>
                        </li>
                        <li class="list-group-item">
                            內容
                            <p>&nbsp;&nbsp;<?= $row['couponInfo'] ?></p>
                        </li>
                        <li class="list-group-item">
                            內容計算公式
                            <p>&nbsp;&nbsp;<?= $row['couponFunc'] ?></p>
                        </li>
                        <li class="list-group-item">
                            上架狀態
                            <p>&nbsp;&nbsp;<?= $row['couponState'] ?></p>
                        </li>
                    </ul>
                </div>

            <?php endforeach; ?>
        </div>
    </div>


</div>
    

<script>

    function delete_it(couponSid){
        if(confirm(`確定要刪除編號為 ${couponSid} 的資料嗎?`)){
            location.href = 'ming_data_delete.php?couponSid=' + couponSid;
        }
    }

</script>
<script>

function myFunctionB() {
        window.location.href="?page=<?= $page-1 ?>"+"&key=<?= $key ?>&searchKey=<?= $searchKey?>";
        console.log(window.location.href);
    };

    <?php for($i=1; $i<=$total_pages; $i++): ?>
    function myFunction<?=$i?>() {
        window.location.href="?page=<?= $i ?>"+"&key=<?= $key ?>&searchKey=<?= $searchKey?>";
        console.log(window.location.href);
    };
    <?php endfor ?>
    function myFunctionC() {
        window.location.href="?page=<?= $page+1 ?>"+"&key=<?= $key ?>&searchKey=<?= $searchKey?>";
        console.log(window.location.href);
    };

</script>

<?php include __DIR__. '/ming__html_foot.php';  ?>