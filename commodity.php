<?php
require __DIR__ . '/__cred.php';

    $page_name="commodity";

    $per_page=25;
    $page=isset($_GET["page"])? intval($_GET["page"]) : 1;

    $key = isset($_GET['key']) ? $_GET['key'] : '';
    $searchKey = isset($_GET['searchKey']) ? $_GET['searchKey'] : '';


    require __DIR__. "/__connect_db.php";
    $t_sql="SELECT COUNT(1) FROM `commodity`";
    $t_stmt=$pdo->query($t_sql);
    $total_rows=$t_stmt->fetch(PDO::FETCH_NUM)[0];
    
    $total_pages=ceil($total_rows/$per_page);

    if($page < 1)$page = 1;
    if($page > $total_pages)$page=$total_pages;

    $sql=sprintf("SELECT * FROM commodity ORDER BY pNo ASC LIMIT %s, %s", ($page-1)*$per_page, $per_page);
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $s_sql = "SELECT COUNT(1) FROM commodity where 1=1 ";

    if ($key != '' AND $searchKey != '') {
        if ($key == 'pBrand') {
            $s_sql = $s_sql . " AND `pBrand` LIKE '%$searchKey%'";
        }
        if ($key == 'pModel') {
            $s_sql = $s_sql . " AND `pModel` LIKE '%$searchKey%'";
        }
        if ($key == 'pSit') {
            $s_sql = $s_sql . " AND `pSit` LIKE '%$searchKey%'";
        }
        if ($key == 'pType') {
            $s_sql = $s_sql . " AND `pType` LIKE '%$searchKey%'";
        }
        if ($key == 'pOdo') {
            $s_sql = $s_sql . " AND `pOdo` < '$searchKey'";
        }
        if ($key == 'pCc') {
            $s_sql = $s_sql . " AND `pCc` LIKE '%$searchKey%'";
        }
        if ($key == 'pAge') {
            $s_sql = $s_sql . " AND `pAge` < '$searchKey'";
        }
        if ($key == 'pRent') {
            $s_sql = $s_sql . " AND `pRent` < '$searchKey'";
        }
        if ($key == 'rentState') {
            $s_sql = $s_sql . " AND `rentState` LIKE '%$searchKey%'";
        }

    }
    $s_stmt = $pdo->query($s_sql);
    $total_rows = $s_stmt->fetch(PDO::FETCH_NUM)[0];
    $total_pages = ceil($total_rows / $per_page);

    if ($page < 1) $page = 1;
    if (($page > $total_pages) && $total_pages != 0) $page = $total_pages;

    $q_sql = "SELECT * FROM `commodity` WHERE 1=1 ";

    if ($key != '' AND $searchKey != '') {
        if ($key == 'pBrand') {
            $q_sql = $q_sql . " AND `pBrand` LIKE '%$searchKey%'";
        }
        if ($key == 'pModel') {
            $q_sql = $q_sql . " AND `pModel` LIKE '%$searchKey%'";
        }
        if ($key == 'pSit') {
            $q_sql = $q_sql . " AND `pSit` LIKE '%$searchKey%'";
        }
        if ($key == 'pType') {
            $q_sql = $q_sql . " AND `pType` LIKE '%$searchKey%'";
        }
        if ($key == 'pOdo') {
            $q_sql = $q_sql . " AND `pOdo` < '$searchKey'";
        }
        if ($key == 'pCc') {
            $q_sql = $q_sql . " AND `pCc` LIKE '%$searchKey%'";
        }
        if ($key == 'pAge') {
            $q_sql = $q_sql . " AND `pAge` < '$searchKey'";
        }
        if ($key == 'pRent') {
            $q_sql = $q_sql . " AND `pRent` < '$searchKey'";
        }
        if ($key == 'rentState') {
            $s_sql = $s_sql . " AND `rentState` LIKE '$searchKey'";
        }

    }
    $q_sql = $q_sql . " LIMIT " . ($page - 1) * $per_page . "," . $per_page;

    $q_stmt = $pdo->query($q_sql);

//所有資料
    $rows = $q_stmt->fetchAll(PDO::FETCH_ASSOC);


    // //取圖片名稱
    // $sql_pic="SELECT `commodity`.`pImg`,`albums`.`pImg1` 
    //                     FROM `commodity` 
    //                     JOIN `albums` 
    //                     ON `commodity`.`pImg`= `albums`.`pImg`";
    // $stmt_pic = $pdo->query($sql_pic);
    // $rows_pic = $stmt_pic->fetchAll(PDO::FETCH_ASSOC);
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
    <form class="form-inline d-flex justify-content-center my-4" method="get" id="forms" name="forms">
        <label class="my-1 mr-2" for="inlineFormCustomSelectPref"></label>
        <select class="custom-select my-1 mr-sm-2" id="key" name="key">
            <option selected>選擇搜尋項目</option>
            <option value="pBrand">廠牌</option>
            <option value="pModel">車型(型號)</option>
            <option value="pSit">幾人座</option>
            <option value="pType">車種</option>
            <option value="pOdo">里程數(小於)</option>
            <option value="pCc">排氣量</option>
            <option value="pAge">車齡(小於)</option>
            <option value="pRent">租金(小於)</option> 
            <option value="rentState">租借狀態</option>
            <option value="shopName">車商資訊</option>
        </select>

        <input type="text" class="form-control  mr-sm-2" name="searchKey" id="searchKey" placeholder="請輸入關鍵字"
               value="<?= $searchKey ?>"
               class="custom-select my-1 mr-sm-2">

        <button type="submit" class="btn btn-primary my-1 search-btn">搜尋</button>
    </form>




    <br>

    <div class="row">
        <div class="col-lg-12 page ">
            <a href="commodity_insert.php" class="driver-insert shop-insert "><i class="fas fa-plus-circle"></i></a>
            <nav >
                <ul class="pagination justify-content-center">
                    <li class="page-item <?=$page<=1 ? "disabled":""?>">
                        <a class="page-link" href="?page=<?= 1 ?>" >
                            &laquo;
                        </a>
                    </li>
                    <li class="page-item <?=$page<=1 ? "disabled":""?>">
                        <a class="page-link " href="?page=<?= $page-1 ?>">&lt</a>
                    </li>
                    <?php for($i=1 ;$i<=$total_pages; $i++): ?> 
                    <li class="page-item <?= $i==$page ? "active":  "" ?>">
                        <a class="page-link " href="?page=<?= $i ?>"><?=$i?></a>
                    </li>
                    <?php endfor ?>
                    <li class="page-item <?=$page>=$total_pages ? "disabled":""?>">
                        <a class="page-link" href="?page=<?= $page+1 ?>">&gt;</a>
                    </li>
                    <li class="page-item <?=$page>=$total_pages ? "disabled":""?>">
                        <a class="page-link" href="?page=<?= $page=$total_pages ?>" >
                        <span >&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>
<br>
<div class="row tablerow justify-content-center" style="">

            <table class="table table-striped text-center table-bordered">
                <thead class="">
                    <tr>
                    <th scope="col">商品編號</th>
                    <th scope="col">廠牌</th>
                    <th scope="col">車型(型號)</th>
                    <th scope="col">幾人座</th>
                    <th scope="col">車種</th>
                    <th scope="col">里程數</th>
                    <th scope="col">排氣量</th>
                    <th scope="col">車齡</th> 
                    <th scope="col">租金</th>
                    <th scope="col">車商名稱</th>
                    <th scope="col">租借狀態</th>
                    <th scope="col">是否提供<br>指定地點取車</th>
                    <th scope="col">是否提供<br>甲租乙還</th>
                    <th scope="col">照片</th>
                    <th scope="col">修改</i></th>
                    <th scope="col">刪除</i></th>
                    </tr>
                </thead>
                <tbody id="data_body">
                    <?php 
                    // $apply=array(0=>'不提供',1=>'提供');
                    // $status=array(0=>'已出租',1=>'未出租');
                    
                    
                    foreach($rows as $row):
                         
                      
                    ?>
                    <tr>
                        <td ><?=strip_tags($row["pNo"]) ?></td>
                        <td ><?=strip_tags($row["pBrand"]) ?></td>
                        <td ><?=strip_tags($row["pModel"]) ?></td>
                        <td ><?=strip_tags($row["pSit"]) ?></td>
                        <td ><?=strip_tags($row["pType"]) ?></td>
                        <td ><?=strip_tags($row["pOdo"])."/公里"?></td>
                        <td ><?=strip_tags($row["pCc"])."/cc" ?></td>
                        <td ><?=strip_tags($row["pAge"])."/年" ?></td>
                        <td ><?=strip_tags($row["pRent"])."/天" ?></td>
                        <td ><?= strip_tags($row["shopName"]) ?></td>
                        <td ><?=strip_tags($row["rentState"]) ?></td>
                        <td ><?=strip_tags($row["rentAssign"]) ?></td>
                        <td ><?=strip_tags($row["shopAddressSelect"]) ?></td>
                        
                        <td><img id="" src="<?= 'uploads/'.$row['pImg']?>" alt="" style="object-fit:contain" width="200px" height="100px">
                            <img id="" src="<?= 'uploads/'.$row['pImg2'] ?>" alt="" width="0px" height="0px ">
                            <img id="" src="<?= 'uploads/'.$row['pImg3']?>" alt="" width="0px" height="0px">
                        </td>
                 

                        <td><a  href="commodity_edit.php?pNo=<?= $row["pNo"] ?>" class="s-icon"><i class="fas fa-edit"></i></a></td>
                        <td><a href="javascript: delete_it(<?= $row['pNo'] ?>)" class="s-icon"><i class="fas fa-trash-alt"></i></a></td>
                    </tr>
                        <?php endforeach; ?>
                </tbody>
            </table>
</div>







    <div class="container cardcontainer">
    <div class="row">
        <?php foreach ($rows as $row): ?>

            <div class="card col-md-4 col-sm-12 col-xs-12" id="everycard" style="width: 18rem;">
                <img id="myimg" src="<?= 'uploads/' . $row['pImg'] ?>" class="card-img-top mt-2" alt="...">

                <div class="d-flex justify-content-end">
                    <a href="commodity_edit.php?pNo=<?= $row['pNo'] ?>" class="m-2 s-icon"><i
                                class="fas fa-edit"></i></a>
                    <a href="javascript: delete_it(<?= $row['pNo'] ?>)" class="m-2 s-icon">
                        <i class="fas fa-trash-alt"></i>
                    </a>
                </div>


                <ul class="list-group list-group-flush">
                <td ><?=strip_tags($row["pNo"]) ?></td>
                

                    <li class="list-group-item" style="border-top: none">
                        廠牌
                        <p>&nbsp;&nbsp;<?= $row['pBrand'] ?></p>
                    </li>
                    <li class="list-group-item">
                        車型(型號)
                        <p>&nbsp;&nbsp;<?= $row['pModel'] ?></p>
                    </li>
                    <li class="list-group-item">
                        幾人座
                        <p>&nbsp;&nbsp;<?= $row['pSit']." 人座" ?></p>
                    </li>
                    <li class="list-group-item">
                        車種
                        <p>&nbsp;&nbsp;<?= $row['pType'] ?></p>
                    </li>
                    <li class="list-group-item">
                        里程數
                        <p>&nbsp;&nbsp;<?= $row['pOdo']." 公里" ?></p>
                    </li>
                    <li class="list-group-item">
                        排氣量
                        <p>&nbsp;&nbsp;<?= $row['pCc']." c.c" ?></p>
                    </li>
                    <li class="list-group-item">
                        車齡
                        <p>&nbsp;&nbsp;<?= $row['pAge']." 年" ?></p>
                    </li>
                    <li class="list-group-item">
                        租金
                        <p>&nbsp;&nbsp;<?= $row['pRent']." /日" ?></p>
                    </li>

                    <li class="list-group-item">
                        租借狀態
                        <p>&nbsp;&nbsp;<?= $row['rentState'] ?></p>
                    </li>
                    <li class="list-group-item">
                        是否提供指定地點取車
                        <p>&nbsp;&nbsp;<?= $row['rentAssign'] ?></p>
                    </li>
                    <li class="list-group-item">
                        是否提供甲租乙還
                        <p>&nbsp;&nbsp;<?= $row['shopAddressSelect'] ?></p>
                    </li>
                     <li class="list-group-item">
                        車商名稱
                        <p>&nbsp;&nbsp;<?= $row['shopName'] ?></p>
                    </li>

                </ul>
            </div>

        <?php endforeach; ?>
    </div>
    </div>


    <script>
        function delete_it(pNo){
            if(confirm(`確定要刪除編號為 ${pNo} 的資料嗎?`)){
                location.href = 'commodity_delete.php?pNo=' + pNo;
               
            }
        }

        
    </script>
<?php include __DIR__. "/__html_foot.php";  ?>

