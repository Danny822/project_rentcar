<?php
    require __DIR__. '/__cred.php';
    require __DIR__. '/__connect_db.php';
    $page_name = 'm_list_search';

    $per_page = 6;//決定每一頁有幾筆資料

    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;

    $mName = isset($_GET['mName']) ? $_GET['mName'] : '';
    $mGender = isset($_GET['mGender']) ? $_GET['mGender'] : '%';
    $mPhone = isset($_GET['mPhone']) ? $_GET['mPhone'] : '';

    //算總筆數
    $t_sql = " SELECT COUNT(1) FROM lessee  WHERE 1=1 ";


    // ----------

    if($mName!=''){
        $t_sql = $t_sql." AND `mName` like '%$mName%' ";
    }

    if($mGender!='%'){
        $t_sql = $t_sql." AND `mGender` like '$mGender' ";
    }

    if($mPhone!=''){
        $t_sql = $t_sql." AND `mPhone` like '%$mPhone%' ";
    }

    $t_stmt = $pdo->query($t_sql);
    $total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];

    //總頁數
    $total_pages = ceil($total_rows/$per_page);
//echo $page.'<br>';
    if($page < 1) $page = 1;
//echo $total_pages;
    if(($page > $total_pages) && $total_pages != 0) $page = $total_pages;
//echo $page.'<br>';
//echo $t_sql.'<br>';

//----------------------------------------------------------------------------------------------

$sql = "SELECT * FROM `lessee` WHERE 1=1 ";



if($mName!=''){
    $sql = $sql." AND `mName` like '%$mName%' ";
}

if($mGender!='%'){
    $sql = $sql." AND `mGender` like '$mGender' ";
}

if($mPhone!=''){
    $sql = $sql." AND `mPhone` like '%$mPhone%' ";
}


$sql = $sql." ORDER BY mNo ASC LIMIT ".($page-1)*$per_page.",".$per_page;
//echo $sql.'<br>';


//echo '$mName:'.$mName.'<br>';
//echo '$mGender:'.$mGender.'<br>';
//echo '$mPhone:'.$mPhone.'<br>';
//----------------------------------------------------------------------------
    $stmt = $pdo->query($sql);


    //所有資料一次拿出來
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>


<!--邏輯撰寫位置 都放在最上面-->

<?php include __DIR__. '/__html_head.php'; ?>
<?php include __DIR__. '/__navbar.php'; ?>
<!------------------------------------------------------------------------------------------------------------------------------->

    <!--<div class="container">-->
<!--    <div>--><?//= $page. " / ". $total_pages ?><!--</div>-->
<!--    <div>--><?//= $total_rows ?><!--</div>-->
    <!--    <div> $stmt->rowCount() </div> 計算單頁的總比數-->

    <div class="row"">
        <div class="col-lg-12" >
            <nav>
                <ul class="pagination pagination-sm">
                    <!--最前頁-->

                    <li class="page-item <?= $page<=1 ? 'disabled' : '' ?>"
                        <?php if($page<=1): ?>
                            ''
                        <?php else: ?>
                            onclick="myFunctionA()"
                        <?php endif ?>
                    >
                        <a class="page-link" id="p1" href="#">&lt;&lt;</a>
                    </li>
                    <!--上一頁-->
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
                    <!--最後頁-->
                    <li class="page-item <?= $page>=$total_pages ? 'disabled' : '' ?>"
                        <?php if($page>=$total_pages): ?>
                            ''
                        <?php else: ?>
                            onclick="myFunctionD()"
                        <?php endif ?>
                    >
                        <a class="page-link" id="p5" href="#">&gt;&gt;</a>
                    </li>


                </ul>
            </nav>
        </div>
    </div>




<!--    <body>-->

    <form id="form1" class="form-inline d-flex justify-content-center my-2" name="form1" method="get" action="">


        <div class="form-group mb-2">
            <label for="inputPassword2" class="sr-only">Password</label>
            <div class="title">姓名</div>
            <input type="text" class="form-control mr-sm-2 my-1" id="inputPassword2" name="mName" type="text" id="mName" value="<?= $mName ?>" placeholder="請輸入中文姓名">
        </div>
        <div class="gender mb-2">
            <div class="title">性別</div>
            <div class="gender-inner">
                <?php if($mGender == '男'): ?>
                    <input name="mGender" type="radio" id="radio" value="%" class="input-margin">
                    不拘&nbsp;&nbsp;
                    <input type="radio" name="mGender" id="radio2" value="男" checked="checked" class="input-margin">
                    男&nbsp;&nbsp;
                    <input type="radio" name="mGender" id="radio3" value="女" class="input-margin">
                    女&nbsp;&nbsp;
                <?php elseif($mGender == '女'): ?>
                    <input name="mGender" type="radio" id="radio" value="%" class="input-margin">
                    不拘&nbsp;&nbsp;
                    <input type="radio" name="mGender" id="radio2" value="男" class="input-margin">
                    男&nbsp;&nbsp;
                    <input type="radio" name="mGender" id="radio3" value="女" checked="checked" class="input-margin">
                    女&nbsp;&nbsp;
                <?php else: ?>
                    <input name="mGender" type="radio" id="radio" value="%" checked="checked" class="input-margin">
                    不拘&nbsp;&nbsp;
                    <input type="radio" name="mGender" id="radio2" value="男" class="input-margin">
                    男&nbsp;&nbsp;
                    <input type="radio" name="mGender" id="radio3" value="女" class="input-margin">
                    女&nbsp;&nbsp;
                <?php endif ?>
            </div>
        </div>
        <div class="form-group mb-2 ml-3 mr-3">
            <label for="inputPassword2" class="sr-only">Password</label>
            <div class="title">電話</div>
            <input type="text" class="form-control mr-sm-2 my-1" id="inputPassword2" name="mPhone" id="mPhone" value="<?= $mPhone ?>" placeholder="請輸入行動電話號碼">
        </div>
            <!--------------------------------------------------------------------------------->
        <div class="form-group mb-2 search">
            <input class="btn btn-primary" type="submit" name="button" id="button" value="搜尋" />
        </div>


    </form>

<!--    <form class="form-inline d-flex justify-content-center my-2" method="get" id="forms" name="forms">-->
<!--        <label class="my-1 mr-2" for="inlineFormCustomSelectPref"></label>-->
<!---->
<!---->
<!--        <input type="text" class="form-control  mr-sm-2" name="searchKey" id="searchKey" placeholder=""-->
<!--               value=""-->
<!--               class="custom-select my-1 mr-sm-2"">-->
<!---->
<!--        <button type="submit" class="btn btn-primary my-1">搜尋</button>-->
<!--    </form>-->



<!------------------------------------------------------------------------------------------------------------------------------->
    <style>
        body {
            font-family: "微軟正黑體";
        }
        .card img {
            width:150px;
            height:150px;
            margin:0 auto;
        }

        .card {
            margin:0 auto;
            margin-top: 50px;
            margin-bottom:50px;
        }



        .col-lg-12 {
            padding:0;
        }

        .row {
            margin:0;
        }

        @media screen and (max-width: 700px) {

            .tablerow {
                display:none;
            }
            .form-group {
                width: 300px;
            }
            .gender {
                width: 300px;
            }
            .search {
                display:flex;
                justify-content:center;
            }

        }

        @media screen and (min-width: 700px) {

            .cardcontainer {
                display:none;
            }
            .form-group {
                width: 260px;
            }
            .gender {
                width: 240px;
                margin-left:30px;
            }
            .gender-inner {
                width:140px;
            }
            .search {
                display:flex;
                justify-content:left;
            }
        }


        .input-margin {
            margin-right:3px;
        }

        .form-group {
            /*width:300px;*/
            display:flex;
            align-items:center;
        }
        .gender {
            /*width:300px;*/
            display:flex;
            align-items:center;
        }
        .gender-inner {
            width:240px;
        }
        .title {
            margin-right:10px;
            width:40px;
        }

    </style>


    <div class="row tablerow">
        <div class="col-lg-12">

            <table class="table table-striped table-bordered" id="toggled-element">
<!--                <thead>-->
                <tr>
                    <th scope="col"><i class="fas fa-edit"></i></th>
                    <th scope="col">#</th>
                    <th scope="col">姓名</th>
                    <th scope="col">帳號</th>
<!--                    <th scope="col">密碼</th>-->
                    <th scope="col">手機</th>
                    <th scope="col">大頭貼</th>
                    <th scope="col">Email</th>
                    <th scope="col">地址</th>
                    <th scope="col">生日</th>
                    <th scope="col">身分證字號</th>
                    <th scope="col">性別</th>
                    <th scope="col"><i class="far fa-trash-alt"></i></th>
                </tr>
<!--                </thead>-->
<!--                <tbody>-->
                <?php foreach($rows as $row): ?>
                    <tr>
                        <td>
                            <a href="m_edit.php?mNo=<?= $row['mNo'] ?>"><i class="fas fa-edit"></i></a>
                        </td>
                        <td><?= $row['mNo'] ?></td>
                        <td><?= $row['mName'] ?></td>
                        <td><?= $row['mAccount'] ?></td>
<!--                        <td>--><?//= $row['mPwd'] ?><!--</td>-->
                        <td><?= $row['mPhone'] ?></td>
                        <td>
                            <img id="myimg" src="<?= 'uploads/'.$row['mPhoto']?>" alt="" width="40px">

                        </td>
                        <td><?= $row['mEmail'] ?></td>
                        <td><?= $row['mAddress'] ?></td>
                        <td><?= $row['mBirthday'] ?></td>
                        <td><?= $row['mId'] ?></td>
                        <td><?= $row['mGender'] ?></td>
                        <td><a href="javascript:delete_it(<?= $row['mNo'] ?>)">
                                <i class="far fa-trash-alt"></i>
                            </a></td>
                    </tr>
                <?php endforeach; ?>

<!--                </tbody>-->
            </table>
        </div>
    </div>

<div class="container cardcontainer">
    <div class="row">
<?php foreach($rows as $row): ?>

    <div class="card col-md-4 col-sm-12 col-xs-12" style="width: 18rem;">
        <img id="myimg" src="<?= 'uploads/'.$row['mPhoto']?>" class="card-img-top" alt="...">

        <ul class="list-group list-group-flush">

            <li class="list-group-item">
                姓名
                <p>&nbsp;&nbsp;<?= $row['mName'] ?></p>
            </li>
            <li class="list-group-item">
                帳號
                <p>&nbsp;&nbsp;<?= $row['mAccount'] ?></p>
            </li>
            <li class="list-group-item">
                電話
                <p>&nbsp;&nbsp;<?= $row['mPhone'] ?></p>
            </li>
            <li class="list-group-item">
                Email
                <p>&nbsp;&nbsp;<?= $row['mEmail'] ?></p>
            </li>
            <li class="list-group-item">
                地址
                <p>&nbsp;&nbsp;<?= $row['mAddress'] ?></p>
            </li>
            <li class="list-group-item">
                生日
                <p>&nbsp;&nbsp;<?= $row['mBirthday'] ?></p>
            </li>
            <li class="list-group-item">
                身分證字號
                <p>&nbsp;&nbsp;<?= $row['mId'] ?></p>
            </li>
            <li class="list-group-item">
                性別
                <p>&nbsp;&nbsp;<?= $row['mGender'] ?></p>
            </li>
        </ul>
    </div>

<?php endforeach; ?>
    </div>
</div>

<!--</div>-->
    <script>
        function delete_it(mNo){
            if(confirm(`確定要刪除編號為 ${mNo} 的資料嗎？`)){
                location.href = 'm_delete.php?mNo=' + mNo;
            }
        }
    </script>

    <script>
        //'&mName=<?//= $mName ?>//&mGender=<?//= $mGender ?>//&mPhone=<?//= $mPhone ?>//'
        let page1 = document.querySelector('#p1');
        let page2 = document.querySelector('#p2');
        let page3 = document.querySelector('#p3');
        let page4 = document.querySelector('#p4');
        let page5 = document.querySelector('#p5');

        function myFunctionA() {
            window.location.href="?page=1"+"&mName=<?= $mName ?>&mGender=<?= $mGender ?>&mPhone=<?= $mPhone ?>";
            console.log(window.location.href);
        };

        function myFunctionB() {
            window.location.href="?page=<?= $page-1 ?>"+"&mName=<?= $mName ?>&mGender=<?= $mGender ?>&mPhone=<?= $mPhone ?>";
            console.log(window.location.href);
        };

        <?php for($i=1; $i<=$total_pages; $i++): ?>
        function myFunction<?=$i?>() {
            window.location.href="?page=<?= $i ?>"+"&mName=<?= $mName ?>&mGender=<?= $mGender ?>&mPhone=<?= $mPhone ?>";
            console.log(window.location.href);
        };
        <?php endfor ?>
        function myFunctionC() {
            window.location.href="?page=<?= $page+1 ?>"+"&mName=<?= $mName ?>&mGender=<?= $mGender ?>&mPhone=<?= $mPhone ?>";
            console.log(window.location.href);
        };
        function myFunctionD() {
            window.location.href="?page=<?= $total_pages ?>"+"&mName=<?= $mName ?>&mGender=<?= $mGender ?>&mPhone=<?= $mPhone ?>";
            console.log(window.location.href);
        };


    </script>

<?php include __DIR__. '/__html_foot.php'; ?>