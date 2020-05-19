<?php
    require __DIR__. '/__cred.php';
    require __DIR__. '/__connect.php';
    $page_name = 'ad_list';
    $per_page = 5;
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
    
    $sql = $sql . " LIMIT " . ($page - 1) * $per_page . "," . $per_page;
    
    $stmt = $pdo->query($sql);
    
    //所有資料
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

 

?>
<?php include __DIR__. '/__htmlheader.php';  ?>
<?php include __DIR__. '/__navbar.php';  ?>


<div class="container">
</form>
         <form class="form-inline my-2 my-lg-0"  method="GET" name="form2">
            <select class="custom-select"style="width:120px" id="searchselect" name="searchselect">
                    <option value="adNo">廣告標號</option>
                    <option value="adTitle">廣告標題</option>
                   <option value="adDate">上線日期</option>
                    <option value="adState">上線狀態</option>
            </select>
            <input class="form-control mr-sm-2" type="search" name="search" id="search" placeholder="Search" aria-label="Search"  value="<?= $search?>">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>

    <div class="row ">
        <div class="col-lg-12" >
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

    <div class="row">
        <div class="col-lg-12">
            <table class="table table-striped table-active text-center">
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
                            <a  href="__ad_edit.php?adNo=<?= $row['adNo'] ?>"><i class="fas fa-edit"></i></a>
                        </td>
                        <td><?=  $row['adNo']?></td>
                        <td><?=  $row['adTitle'] ?></td>
                        <td><?=  $row['adDate']?></td>
                        <td><img src="./uploads/<?=  $row['adImg']?>" height="150" alt=""></td>
                        <td><?= $row['adUrl']?></td>
                        <!-- <td><?= $row['adState'] ?></td> -->
                     

                        <td>
                            <a href="javascript: delete_it(<?= $row['adNo'] ?>)"><i class="fas fa-trash-alt"></i></a>
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

<?php include __DIR__. '/__htmlfoot.php';  ?>