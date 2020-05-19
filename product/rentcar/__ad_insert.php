<?php
    require __DIR__. '/__cred.php';
    require __DIR__. '/__connect.php';
    $page_name = 'ad_insert';



if(isset($_POST['checkme'])){ 


    $sql = "INSERT INTO `advertisement`(
        `adTitle`, `adImg`, `adUrl`, `adState`
        ) VALUES (
          ?,?,?,?
        )";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $_POST['adTitle'],
            $_POST['adImg'],
            $_POST['adUrl'],
            $_POST['adState'],

        ]);
        
        
    }
?>
<?php include __DIR__. '/__htmlheader.php';  ?>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">新增廣告</h5>

                        <form method="post" name="form1" onsubmit="reture checkForm()">
                            <input type="hidden"name="checkme"value="check123">
                            <div class="form-group">
                                <label for="adTitle">廣告標題</label>
                                <input type="text" class="form-control" id="adTitle" name='adTitle' aria-describedby="adTitleHelp" placeholder="輸入廣告標題">
                                <small id="adTitleHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="adImg">廣告圖片</label>
                                <input type="text" class="form-control" id="adImg" name='adImg' aria-describedby="adImgHelp" placeholder="輸入廣告圖片">
                                <small id="adImgHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="adUrl">廣告連結</label>
                                <input type="text" class="form-control" id="adUrl" name='adUrl' aria-describedby="adUrlHelp" placeholder="輸入廣告連結">
                                <small id="adUrlHelp" class="form-text text-muted"></small>
                            </div>
                            <div class="form-group">
                                <label for="adState">線上狀態</label>
                                <input type="text" class="form-control" id="adState" name='adState' aria-describedby="adStateHelp" placeholder="線上狀態:0(下線)/1(上線)">
                                <small id="adStateHelp" class="form-text text-muted"></small>
                            </div>

                            <button type="submit" class="btn btn-primary" onclick="closewin()">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    const checkForm = ()=>{
        let name= dounment.form1.name.value;
        
    }
    </script>
<?php include  __DIR__. './__htmlfoot.php';  ?>