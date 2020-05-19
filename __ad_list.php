<?php
    require __DIR__. '/__cred.php';
    require __DIR__. '/__connect_db.php';
    $page_name = 'ad_list';
    $per_page = 10;
    $page = isset($_GET['page']) ? $_GET['page'] : 1;

    $searchselect = isset($_GET['searchselect']) ? $_GET['searchselect'] : '';
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    
    
    //算總筆數
    
    $t_sql = "SELECT COUNT(1) FROM advertisement where 1=1 ";
    
    //----
    
    if ($searchselect != '' AND $search != '') {
        if ($searchselect == 'adNo') {
            $t_sql = $t_sql . " AND `adNo` LIKE '%$search%'";
        }
        if ($searchselect == 'adTitle') {
            $t_sql = $t_sql . " AND `adTitle` LIKE '%$search%'";
        }
        if ($searchselect == 'adDate') {
            $t_sql = $t_sql . " AND `adDate` LIKE '%$search%'";
        }
        if ($searchselect == 'adState') {
            $t_sql = $t_sql . " AND `adState` LIKE '%$search%'";
        }
    }
    //if($search!=''){
    //    $t_sql = $t_sql." like '%$search%' ";
    //}
    
    
    //------
    
    $t_stmt = $pdo->query($t_sql);
    $total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];
    
    //總頁數
    
    $total_pages = ceil($total_rows / $per_page);
    
    if ($page < 1) $page = 1;
    if (($page > $total_pages) && $total_pages != 0) $page = $total_pages;
    
    $sql = "SELECT * FROM `advertisement` WHERE 1=1 ";
    
    //-----'%a%'
    
    if ($searchselect != '' AND $search != '') {
        if ($searchselect == 'adNo') {
            $sql = $sql . " AND `adNo` LIKE '%$search%'";
        }
        if ($searchselect == 'adTitle') {
            $sql = $sql . " AND `adTitle` LIKE '%$search%'";
        }
        if ($searchselect == 'adDate') {
            $sql = $sql . " AND `adDate` LIKE '%$search%'";
        }
        if ($searchselect == 'adState') {
            $sql = $sql . " AND `adState` LIKE '%$search%'";
        }
    }
    
    //if($search!=''){
    //    $sql = $sql." like '%$search%' ";
    //}
    
    $sql = $sql . " LIMIT " . (($page - 1) * $per_page ). "," . $per_page;
    
    $stmt = $pdo->query($sql);
    
    //所有資料
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

 

?>
<?php include __DIR__."/__html_head.php"; ?>
<?php include __DIR__. "/__navbar.php"?>


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
<br>
<br>
<div class="container">

         <form class="form-inline d-flex justify-content-center my-4"  method="GET" name="form2" style="">
            <select class="custom-select my-1" id="searchselect" name="searchselect">
                    <option value="adNo">廣告標號</option>
                    <option value="adTitle">廣告標題</option>
                   <option value="adDate">上線日期</option>
                    <option value="adState">上線狀態</option>
            </select>
            <input class="form-control mr-sm-2" type="search" name="search" id="search" placeholder="Search" aria-label="Search"  value="<?= $search?>">
             <button type="submit" class="btn btn-primary my-1 search-btn">搜尋</button>
        </form>
    <br>

    <div class="row ">
        <div class="col-lg-12" >
            <a href="__ad_insert.php" class="shop-insert"><i class="fas fa-plus-circle"></i></a>
            <nav class="text-center" >
                
              <ul class="pagination pagination-sm justify-content-center">
              <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
      
                    <a class="page-link"   href = "
                    <?php if (isset($_GET['search'])):?>
                    ?page=1&searchselect=<?= $searchselect ?>&search=<?= $search?>
                    <?php else :?>
                    ?page=1
                    <?php endif ?>
                    ">&lt;&lt;</a>
                    </li>
                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
      
                    <a class="page-link" href = "
                    <?php if (isset($_GET['search'])):?>
                    ?page=<?=$page - 1 ?>&searchselect=<?= $searchselect ?>&search=<?= $search?>
                    <?php else :?>
                    ?page=<?=$page - 1 ?>
                    <?php endif?>
                    ">&lt;</a>
                    </li>

                    <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                        <li class="page-item <?= $i == $page ? 'active' : '' ?>" onclick="myFunction<?= $i ?>()">
                            <a class="page-link" href="
                            <?php if (isset($_GET['search'])):?>
                            ?page=<?= $i ?>&searchselect=<?= $searchselect ?>&search=<?= $search?>
                            <?php else :?>
                            ?page=<?= $i ?>
                            <?php endif?>
                            "><?= $i ?></a>
                        </li>
                    <?php endfor ?>

                    <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                    <a class="page-link" href = "
                    <?php if (isset($_GET['search'])):?>
                    ?page=<?=$page + 1 ?>&searchselect=<?= $searchselect ?>&search=<?= $search?>
                    <?php else :?>
                    ?page=<?=$page + 1 ?>
                    <?php endif?>
                    ">&gt;</a>
                    </li>
                    <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                    <a class="page-link" href = "
                    <?php if (isset($_GET['search'])):?>
                    ?page=<?=$total_pages?>&searchselect=<?= $searchselect ?>&search=<?= $search?>
                    <?php else :?>
                    ?page=<?=$total_pages?>
                    <?php endif?>
                    ">&gt;&gt;</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="row tablerow">
        <div class="col-lg-12">
            <table class="table table-striped  text-center table-bordered">
                <thead>
                <tr>
                    <th scope="col"><i class="fas fa-edit"></i></th>
                    <th scope="col">廣告標號</th>
                    <th scope="col">廣告標題</th>
                    <th scope="col">上線日期</th>
                    <th scope="col">廣告圖片</th>
                    <th scope="col">廣告連結</th>
                    

                    
                    <th scope="col"><i class="fas fa-trash-alt"></i></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($rows as $row): ?>
                    <tr>
                        <td>
                            <a  href="__ad_edit.php?adNo=<?= $row['adNo'] ?>" class="s-icon"><i class="fas fa-edit"></i></a>
                        </td>
                        <td><?=  $row['adNo']?></td>
                        <td><?=  $row['adTitle'] ?></td>
                        <td><?=  $row['adDate']?></td>
                        <td><img src="./uploads/<?=  $row['adImg']?>" height="150" alt=""></td>
                        <td><?= $row['adUrl']?></td>
                        <!-- <td><?= $row['adState'] ?></td> -->
                     

                        <td>
                            <a href="javascript: delete_it(<?= $row['adNo'] ?>)" class="s-icon"><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>


</div>
<div class="container cardcontainer">
    <div class="row">
        <?php foreach ($rows as $row): ?>

            <div class="card col-md-4 col-sm-12 col-xs-12" id="everycard" style="width: 18rem;">
                <img id="myimg" src="./uploads/<?=  $row['adImg']?>" class="card-img-top mt-2" alt="...">

                <div class="d-flex justify-content-end">
                    <a  href="__ad_edit.php?adNo=<?= $row['adNo'] ?>" class="m-2 s-icon"><i
                                class="fas fa-edit"></i></a>
                    <a href="javascript: delete_it(<?= $row['adNo'] ?>)" class="m-2 s-icon">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>


                <ul class="list-group list-group-flush">

                    <li class="list-group-item" style="border-top: none">
                    廣告標號
                        <p>&nbsp;&nbsp;<?= $row['adTitle'] ?></p>
                    </li>
                    <li class="list-group-item">
                    上線日期
                        <p>&nbsp;&nbsp;<?= $row['adDate'] ?></p>
                    </li>
                    <li class="list-group-item">
                    廣告連結
                        <p>&nbsp;&nbsp;<?= $row['adUrl'] ?></p>
                    </li>
                    <li class="list-group-item">
                    上線狀態
                        <p>&nbsp;&nbsp;<?= $row['adState'] ?></p>
                    </li>
                    
                </ul>
            </div>

        <?php endforeach; ?>
    </div>
</div>
    <script>
        function delete_it(adNo){
            if(confirm(`確定要刪除編號為 ${adNo} 的資料嗎?`)){
                location.href = '__ad_delete.php?adNo=' + adNo;
            }
        }
       
    </script>

<?php include __DIR__. '/__html_foot.php'; ?>
