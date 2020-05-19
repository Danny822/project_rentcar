<?php
require __DIR__ . '/__cred.php';

    require __DIR__. '/__connect_db.php';
    $page_name = 'driver_list';

    //決定每頁有幾筆資料，並讓用戶決定要看的頁數，若沒設定，則跳出第一頁
    $per_page = 6;
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

    $key = isset($_GET['key']) ? $_GET['key'] : '';
    $searchKey = isset($_GET['searchKey']) ? $_GET['searchKey'] : '';
 
 
    //算總筆數
    $t_sql = "SELECT COUNT(1) FROM `driver` where 1=1";

     
    if ($key != '' AND $searchKey != '') {
        if ($key == 'driverName') {
            $t_sql = $t_sql . " AND `driverName` LIKE '%$searchKey%'";
        }
        if ($key == 'driverAccount') {
            $t_sql = $t_sql . " AND `driverAccount` LIKE '%$searchKey%'";
        }
        if ($key == 'driverEmail') {
            $t_sql = $t_sql . " AND `driverEmail` LIKE '%$searchKey%'";
        }
        if ($key == 'driverPhone') {
            $t_sql = $t_sql . " AND `driverPhone` LIKE '%$searchKey%'";
        }
    }

    $t_stmt = $pdo->query($t_sql);
    $total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];
 
    
    //總頁數
    $total_pages = ceil($total_rows/$per_page);
 
     
    //頁面導向
    if($page < 1) {
        header("Location: driver_list.php?page=1");
    }
 
    if($page > $total_pages) {
        header("Location: driver_list.php?page=$total_pages");
    }


    $sql = "SELECT * FROM `driver` WHERE 1=1 ";


     //-----'%a%'
    if ($key != '' AND $searchKey != '') {
        if ($key == 'driverName') {
            $sql = $sql . " AND `driverName` LIKE '%$searchKey%'";
        }
        if ($key == 'driverAccount') {
            $sql = $sql . " AND `driverAccount` LIKE '%$searchKey%'";
        }
        if ($key == 'driverEmail') {
            $sql = $sql . " AND `driverEmail` LIKE '%$searchKey%'";
        }
        if ($key == 'driverPhone') {
            $sql = $sql . " AND `driverPhone` LIKE '%$searchKey%'";
        }
    }

    $sql = $sql . " LIMIT " . ($page - 1) * $per_page . "," . $per_page;
 
     
    $stmt = $pdo->query($sql);


    //所有資料一次拿出來
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<?php include __DIR__. '/__html_head.php'; ?>
<?php include __DIR__. '/__navbar.php'; ?>


<link rel="stylesheet" href="./css/driver.css">
<style>
    th
    {
        justify-content: center !important;
        text-align: center !important;
        vertical-align:middle !important;
    }
    td{
        justify-content: center !important;
        text-align: center !important;
        vertical-align:middle !important;
    }
</style>
<!--<div class="container">-->
<br>
<br>
<div class="container">
    <form class="form-inline d-flex justify-content-center my-4" method="get" id="forms" name="forms">
        <label class="my-1 mr-2" for="inlineFormCustomSelectPref"></label>
        <select class="custom-select my-1 mr-sm-2" id="key" name="key">
            <option selected>選擇搜尋項目</option>
            <option value="driverName">駕駛姓名</option>
            <option value="driverAccount">駕駛帳號</option>
            <option value="driverEmail">Email</option>
            <option value="driverPhone">聯絡電話</option>
        </select>

        <input type="text" class="form-control  mr-sm-2" name="searchKey" id="searchKey" placeholder="請輸入關鍵字"
               value="<?= $searchKey ?>"
               class="custom-select my-1 mr-sm-2">

        <button type="submit" class="btn btn-primary my-1 search-btn">搜尋</button>
    </form>


    <!--    分頁-->
    <!-- <div class="row">
        <div class="col-lg-12">
            <nav id="pagination">
                <ul class="pagination pagination-sm">
                    <li class="page-item <?= $page<=1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=1">&lt;&lt;</a>
                    </li>
                    <li class="page-item <?= $page<=1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page-1 ?>">&lt;</a>
                    </li>
                    <?php for($i=1; $i<=$total_pages; $i++): ?>
                        <li class="page-item <?= $i==$page ? 'active' : '' ?>">
                            <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                        </li>
                    <?php endfor ?>
                    <li class="page-item <?= $page>=$total_pages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $page+1 ?>">&gt;</a>
                    </li>
                    <li class="page-item <?= $page>=$total_pages ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page=<?= $total_pages ?>">&gt;&gt;</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div> -->
    <br>
    <div class="row">
        <div class="col-lg-12 page">
            <a href="driver_insert.php" class="driver-insert shop-insert "><i class="fas fa-plus-circle"></i></a>

            <nav>
                <ul class="pagination pagination-sm justify-content-center">
                    <li class="page-item <?= $page<=1 ? 'disabled' : '' ?>"
                    <?php if($page<=1): ?>
                        ''
                    <?php else: ?>
                        onclick="myFunctionB()"
                    <?php endif ?>
                    >
                    <a class="page-link" id="p2" href="#">&lt;</a>
                    </li>
                    <!--用迴圈取出每一個頁面-->
                    <?php for($i=1; $i<=$total_pages; $i++): ?>
                        <li class="page-item <?= $i==$page ? 'active' : '' ?>" onclick="myFunction<?=$i?>()">
                            <a class="page-link" id="p3" href="#"><?= $i ?></a>
                        </li>
                    <?php endfor ?>
                    <!--下一頁-->
                    <li class="page-item <?= $page>=$total_pages ? 'disabled' : '' ?>"
                    <?php if($page>=$total_pages): ?>
                        ''
                    <?php else: ?>
                        onclick="myFunctionC()"
                    <?php endif ?>
                    >
                    <a class="page-link" id="p4" href="#">&gt;</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<br>

    <div class="row tablerow justify-content-center" style="">
        <div class="">
            <table class="table table-striped table-bordered text-center"  id="table1">
                <thead>
                <tr>
                    <th scope="col"><i class="fas fa-edit"></i></th>
                    <th scope="col">駕駛編號</th>
                    <th scope="col">駕駛姓名</th>
                    <th scope="col">性別</th>
                    <th scope="col">駕駛帳號</th>
                    <th scope="col">駕駛密碼</th>
                    <th scope="col">連絡電話</th>
                    <th scope="col">Email</th>
                    <th scope="col">地址</th>
                    <th scope="col">生日</th>
                    <th scope="col">身分證字號</th>
                    <th scope="col">大頭照</th>
                    <th scope="col"><i class="fas fa-trash-alt"></i></th>
                </tr>
                </thead>
                <tbody id="data_body">
                <?php foreach($rows as $row): ?>
                <tr>
                    <td>
                        <a href="driver_edit.php?driverNo=<?= $row['driverNo'] ?>" class="s-icon"><i class="fas fa-edit"></i></a>
                    </td>
                    <td><?= htmlentities($row['driverNo']) ?></td>
                    <td><?= htmlentities($row['driverName']) ?></td>
                    <td><?= htmlentities($row['driverGender']) ?></td>
                    <td><?= htmlentities($row['driverAccount']) ?></td>
                    <td><?= htmlentities($row['driverPwd']) ?></td>
                    <td><?= htmlentities($row['driverPhone']) ?></td>
                    <td><?= htmlentities($row['driverEmail']) ?></td>
                    <td><?= htmlentities($row['driverAddress']) ?></td>
                    <td><?= htmlentities($row['driverBirthday']) ?></td>
                    <td><?= htmlentities($row['driverId']) ?></td>
                    <td><img id="myimg" src="uploads/<?= $row['driverPhotoName'] ?>" alt="" width="100px"></td>
                    <td>
                        <a href="javascript:delete_it(<?= $row['driverNo'] ?>)" class="s-icon">
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


<!--card2-->
<div class="container cardcontainer">
    <div class="row">
        <?php foreach ($rows as $row): ?>

            <div class="card col-md-4 col-sm-12 col-xs-12" id="everycard" style="width: 18rem;">
                <img id="myimg" src="<?= 'uploads/' . $row['driverPhotoName'] ?>" class="card-img-top mt-2" alt="...">

                <div class="d-flex justify-content-end">
                    <a href="driver_edit.php?driverNo=<?= $row['driverNo'] ?>" class="m-2 s-icon"><i
                                class="fas fa-edit"></i></a>
                    <a href="javascript: delete_it(<?= $row['driverNo'] ?>)" class="m-2 s-icon">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>


                <ul class="list-group list-group-flush">

                    <li class="list-group-item" style="border-top: none">
                        駕駛姓名
                        <p>&nbsp;&nbsp;<?= $row['driverName'] ?></p>
                    </li>
                    <li class="list-group-item">
                        性別
                        <p>&nbsp;&nbsp;<?= $row['driverGender'] ?></p>
                    </li>
                    <li class="list-group-item">
                        駕駛帳號
                        <p>&nbsp;&nbsp;<?= $row['driverAccount'] ?></p>
                    </li>
                    <li class="list-group-item">
                        聯絡電話
                        <p>&nbsp;&nbsp;<?= $row['driverPhone'] ?></p>
                    </li>
                    <li class="list-group-item">
                        Email
                        <p>&nbsp;&nbsp;<?= $row['driverEmail'] ?></p>
                    </li>
                    <li class="list-group-item">
                        地址
                        <p>&nbsp;&nbsp;<?= $row['driverAddress'] ?></p>
                    </li>
                    <li class="list-group-item">
                        生日
                        <p>&nbsp;&nbsp;<?= $row['driverBirthday'] ?></p>
                    </li>
                    <li class="list-group-item">
                        身分證字號
                        <p>&nbsp;&nbsp;<?= $row['driverId'] ?></p>
                    </li>
                </ul>
            </div>

        <?php endforeach; ?>
    </div>
</div>

<script>

    function delete_it(driverNo){
        if(confirm(`確定要刪除駕駛編號為 ${driverNo} 的資料嗎？`)){
            location.href = 'driver_delete.php?driverNo=' + driverNo;
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

<?php include __DIR__. '/__html_foot.php'; ?>
