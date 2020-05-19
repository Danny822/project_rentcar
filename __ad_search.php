<?php
require __DIR__ . '/__cred.php';

require __DIR__. '/__connect_db.php';
$per_page = 5;

?>
<?php include __DIR__."/__html_head.php"; ?>
<?php include __DIR__. "/__navbar.php"?>


<!-- <div class="container"> -->
   

    <div class="sea ">
        <div class="col-lg-12" >
            <nav class="text-center" >
                <div style="font-size: 20px;"><?= "第".$page."頁 / 共". $total_pages."頁" ?></div>
                <ul class="pagination pagination-sm" style="justify-content:center;">
                    <li class="page-item <?= $page<=1 ? 'disabled' : '' ?>">
                        <a class="page-link" href="?page= 1">	&laquo;</a>
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
                        <a class="page-link" href="?page=<?= $total_pages?>">	&raquo;</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="sea">
        <div class="col-lg-12">
            <table class="table table-striped table-active text-center">
                <thead>
                <tr>
                    
                    <th scope="col">廣告標號</th>
                    <th scope="col">廣告標題</th>
                    <th scope="col">上線日期</th>
                    <th scope="col">廣告圖片</th>
                    <th scope="col">廣告連結</th>
                    <th scope="col">上線狀態</th>

                    <th scope="col"><i class="fas fa-edit"></i></th>
                    <th scope="col"><i class="fas fa-trash-alt"></i></th>
                </tr>
                </thead>
                <tbody>
                <?php foreach($rows as $row): ?>
                    <tr>
                        
                        <td><?=  $row['adNo']?></td>
                        <td><?=  $row['adTitle'] ?></td>
                        <td><?=  $row['adDate']?></td>
                        <td><img src="./uploads/<?=  $row['adImg']?>" height="150" alt=""></td>
                        <td><?= $row['adUrl']?></td>
                        <td><?= $row['adState'] ?></td>
                        <td>
                            <a  href="__ad_edit.php?adNo=<?= $row['adNo'] ?>"><button type="button" class="btn btn-outline-success" style="width: 80px;">Edit</button></a>
                        </td>

                        <td>
                            <a href="javascript: delete_it(<?= $row['adNo'] ?>)"><button type="button" class="btn btn-outline-danger" style="width: 80px;">Delete</button></a>
                        </td>
                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>


<!-- </div> -->
    <script>
        function delete_it(adNo){
            if(confirm(`確定要刪除編號為 ${adNo} 的資料嗎?`)){
                location.href = '__ad_delete.php?adNo=' + adNo;
            }
        }

    </script>
<?php include __DIR__. '/__html_foot.php'; ?>
