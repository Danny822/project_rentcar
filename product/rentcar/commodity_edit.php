<?php

require __DIR__. '/__connect_db.php';

$page_name = "commodity_edit";

$pNo= isset($_GET["pNo"])? intval($_GET["pNo"]): 0;

$sql="SELECT * FROM commodity WHERE pNo=$pNo";

$stmt=$pdo->query($sql);
if($stmt->rowCount()==0){
    header('Location: commodity.php');
    exit;
}
$row=$stmt->fetch(PDO::FETCH_ASSOC);

$rentState=$row["rentState"];
$rentAssign=$row["rentAssign"];
$shopAddressSelect=$row["shopAddressSelect"];




?>
<?php include __DIR__. '/__html_head.php';  ?>

<style>
        .form-group small {
            color: red !important;
        }

    </style>
<div class="container">
    <div class="row">
        <div class="col-lg-6 pt-3">
            <div id="info_bar" class="alert alert-success" role="alert" style="display: none">
            </div>
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">修改資料   
                    </h5>
                    <button type="button" class="btn btn-primary"onclick="history.back(-2)">返回上一頁</button>
                    <form name="form1" method="post" onsubmit="return checkForm()">
                        <input type="hidden" name="pNo"  value="<?=$row['pNo']?>">
                        <div class="form-group">
                            <label for="pBrand">廠牌</label>
                            <input type="text" class="form-control" id="pBrand" name="pBrand" placeholder="請輸入車子廠牌"
                                    value="<?=$row['pBrand']?>">
                            <small id="pBrandHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="pModel">車型(型號)</label>
                            <input type="text" class="form-control" id="pModel" name="pModel" placeholder="請輸入車子型號"
                                    value="<?=$row['pModel']?>">
                            <small id="pModelHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="pSit">幾人座</label>
                            <input type="text" class="form-control" id="pSit" name="pSit" placeholder="請輸入車子為幾人座"
                                    value="<?=$row['pSit']?>">
                            <small id="pSitHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="pType">車種</label>
                            <input type="text" class="form-control" id="pType" name="pType" placeholder="請輸入車子種類"
                                    value="<?=$row['pType']?>">
                            <small id="pTypeHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="pOdo">里程數</label>
                            <input type="text" class="form-control" id="pOdo" name="pOdo" placeholder="請輸入車子排氣量"
                                    value="<?=$row['pOdo']?>">
                            <small id="pOdoHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="pCc">排氣量</label>
                            <input type="text" class="form-control" id="pCc" name="pCc" placeholder="請輸入車子排氣量"
                                    value="<?=$row['pCc']?>">
                            <small id="pCcHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="pAge">車齡</label>
                            <input type="text" class="form-control" id="pAge" name="pAge" placeholder="請輸入車子年齡"
                                    value="<?=$row['pAge']?>">
                            <small id="pAgeHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="pRent">租金</label>
                            <input type="text" class="form-control" id="pRent" name="pRent" placeholder="請輸入車子每日租金"
                                    value="<?=$row['pRent']?>">
                            <small id="pRentHelp" class="form-text text-muted"></small>
                        <div class="form-group">
                            <label for="rentState">租借狀態</label>
                                <select name="rentState" id="rentState" >
                                    <option value="" <?php if($rentState=="") echo 'selected';?>>請選擇</option>
                                    <option value="已出租" <?php if($rentState=="已出租") echo 'selected';?>>已出租</option>
                                    <option value="未出租" <?php if($rentState=="未出租") echo 'selected';?>>未出租</option>
                                    <!-- <option value="" >請選擇</option>
                                    <option value="0">已出租</option>
                                    <option value="1">未出租</option>        -->
                                </select>
                            <small id="rentStateHelp" class="form-text text-muted"></small>
                        </div>
                        </div>
                        <div class="form-group " >
                            <label for="rentAssign">是否提供指定地點取車</label>
                                <select name="rentAssign" id="rentAssign">
                                    <option value="" <?php if($rentAssign=="") echo 'selected';?>>請選擇</option>
                                    <option value="不提供" <?php if($rentAssign=="不提供") echo 'selected';?>>不提供</option>
                                    <option value="提供" <?php if($rentAssign=="提供") echo 'selected';?>>提供</option>
                                    <!-- <option value="">請選擇</option>
                                    <option value="0">不提供</option>
                                    <option value="1">提供</option>        -->
                                </select>
                            <small id="rentAssignHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group ">
                            <label for="shopAddressSelect">是否提供甲租乙還</label>
                                <select name="shopAddressSelect" id="shopAddressSelect">
                                    <option value="" <?php if($shopAddressSelect=="") echo 'selected';?>>請選擇</option>
                                    <option value="不提供" <?php if($shopAddressSelect=="不提供") echo 'selected';?>>不提供</option>
                                    <option value="提供" <?php if($shopAddressSelect=="提供") echo 'selected';?>>提供</option>
                                    <!-- <option value="">請選擇</option>
                                    <option value="0">不提供</option>
                                    <option value="1">提供</option>        -->
                                </select>
                            <small id="shopAddressSelectHelp" class="form-text text-muted"></small>
                        </div>
                        <div class="form-group">
                            <label for="pImg">照片</label>
                            <small id="pImgHelp" class="form-text text-muted"></small>
                            1.<img id="myimg" src="uploads/<?= $row['pImg']?>" alt="" width="200px"><br>
                            2.<img id="myimg2" src="uploads/<?= $row['pImg2']?>" alt="" width="200px"><br>
                            3.<img id="myimg3" src="uploads/<?= $row['pImg3']?>" alt="" width="200px"><br>
                            <input type="hidden" class="form-control" id="pImg" name="pImg" placeholder=""
                                   value="<?= $row['pImg']?>" style="display: block">
                            <input type="hidden" class="form-control" id="pImg2" name="pImg2" placeholder=""
                                   value="<?= $row['pImg2']?>" style="display: block">
                            <input type="hidden" class="form-control" id="pImg3" name="pImg3" placeholder=""
                                   value="<?= $row['pImg3']?>" style="display: block">
                            1.<input type="file" name="my_file" id="my_file" >
                            <br>2.<input type="file" name="my_file2" id="my_file2" >
                            <br>3.<input type="file" name="my_file3" id="my_file3" >
                        </div>


                        <button id="submit_btn" type="submit" class="btn btn-primary">Submit</button>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
   
<?php include __DIR__. '/__html_foot.php';  ?>
<script>
    
    const info_bar = document.querySelector("#info_bar");
    const submit_btn=document.querySelector("#submit_btn");


    const fields =[
        "pBrand",
        "pModel",
        "pSit",
        "pType",
        "pOdo",
        "pCc",
        "pAge",
        "pRent",
        "rentState",
        "rentAssign",
        "shopAddressSelect"
    ];
  

    const checkForm=()=>{
            let isPassed =true;
            info_bar.style.display = 'none';

            
    
    let pBrand= document.form1.pBrand.value;
    let pModel= document.form1.pModel.value;
    let pSit= document.form1.pSit.value;
    let pType= document.form1.pType.value;
    let pOdo= document.form1.pOdo.value;
    let pCc= document.form1.pCc.value;
    let pAge= document.form1.pAge.value;
    let pRent= document.form1.pRent.value;
    let rentState= document.form1.rentState.value;
    let rentAssign= document.form1.rentAssign.value;
    let shopAddressSelect= document.form1.shopAddressSelect.value;
   

        //    for(let k in fields)
        // {
        //     document.querySelector('#'+fields[k]+'Help').innerHTML='';
        //     document.form1[fields[k]].style.borderColor='#cccccc';
        // }
          
            if (pBrand===''){
                document.querySelector('#pBrandHelp').innerHTML='請填入車子廠牌!!!';
                document.form1.pBrand.style.borderColor='red';
                isPassed=false;
            };
            if (pModel===''){
                document.querySelector('#pModelHelp').innerHTML='請填入車型(型號)!!!';
                document.form1.pModel.style.borderColor='red';
                isPassed=false;
            };
            if (pSit===''){
                document.querySelector('#pSitHelp').innerHTML='請填入車為幾人座!!!';
                document.form1.pSit.style.borderColor='red';
                isPassed=false;
            };
            if (pType===''){
                document.querySelector('#pTypeHelp').innerHTML='請填入車種!!!';
                document.form1.pType.style.borderColor='red';
                isPassed=false;
            };
            if (pOdo===''){
                document.querySelector('#pOdoHelp').innerHTML='請填入里程數!!!';
                document.form1.pOdo.style.borderColor='red';
                isPassed=false;
            };
            
            if (pCc===''){
                document.querySelector('#pCcHelp').innerHTML='請填入排氣量!!!';
                document.form1.pCc.style.borderColor='red';
                isPassed=false;
            };
            if (pAge===''){
                document.querySelector('#pAgeHelp').innerHTML='請填入車齡!!!';
                document.form1.pAge.style.borderColor='red';
                isPassed=false;
            };
            if (pRent===''){
                document.querySelector('#pRentHelp').innerHTML='請填入租金/(天)!!!';
                document.form1.pRent.style.borderColor='red';
                isPassed=false;
            };
            if (rentState===''){
                document.querySelector('#rentStateHelp').innerHTML='請填入租借狀態!!!';
                document.form1.rentState.style.borderColor='red';
                isPassed=false;
                
            };
            if (rentAssign===''){
                document.querySelector('#rentAssignHelp').innerHTML='請填入是否提供指定地點取車(是/否)!!!';
                document.form1.rentAssign.style.borderColor='red';
                isPassed=false;
            };
            if (shopAddressSelect===''){
                document.querySelector('#shopAddressSelectHelp').innerHTML='請填入是否提供甲租乙還(是/否)!!!';
                document.form1.shopAddressSelect.style.borderColor='red';
                isPassed=false;
            };
            if(isPassed){
                let form = new FormData(document.form1);

                submit_btn.style.display ="none";

                fetch("commodity_edit_api.php",{
                    method: "POST",
                    body: form
                })
                .then(response=>response.json())
                .then(obj=>{
                    console.log(obj);
                    info_bar.style.display ="block";

                    if(obj.success){
                        info_bar.className="alert alert-success";
                        info_bar.innerHTML="資料修改成功";
                    }else{
                            info_bar.className= "alert alert-danger";
                            info_bar.innerHTML=obj.errorMsg;
                        }
                        submit_btn.style.display ="block";
                });
                
            }
            return false;
    };
        

    const myimg = document.querySelector('#myimg');
        const myimg2 = document.querySelector('#myimg2');
        const myimg3 = document.querySelector('#myimg3');
        const my_file = document.querySelector('#my_file');
        const my_file2 = document.querySelector('#my_file2');
        const my_file3 = document.querySelector('#my_file3');
        const pImg = document.querySelector('#pImg');
        const pImg2 = document.querySelector('#pImg2');
        const pImg3 = document.querySelector('#pImg3');
        const pNo = document.querySelector('#pNo');


        my_file.addEventListener('change', event=>{
            console.log('EventListener', event.target);
            const fd = new FormData();

            fd.append('my_file', my_file.files[0]); //my_file.files[0]拿到陣列中的第一個檔案
            

            fetch('a20190313_04_upload_ajax.php', {method: 'POST', body: fd})
                .then(response=>response.json())
                .then(obj=>{
                    console.log(obj);
                    myimg.setAttribute('src', 'uploads/' +obj.filename);
                    pImg.setAttribute('value', obj.filename);
                    
                    
                });
        });
        my_file2.addEventListener('change', event=>{
            console.log('EventListener', event.target);
            const fd = new FormData();

            fd.append('my_file2', my_file2.files[0]);

            fetch('a20190313_04_upload_ajax2.php', {method: 'POST', body: fd})
                .then(response=>response.json())
                .then(obj=>{
                    console.log(obj);
                    myimg2.setAttribute('src', 'uploads/' +obj.filename);
                    pImg2.setAttribute('value', obj.filename);
                });
        });
        my_file3.addEventListener('change', event=>{
            console.log('EventListener', event.target);
            const fd = new FormData();

            fd.append('my_file3', my_file3.files[0]);

            fetch('a20190313_04_upload_ajax3.php', {method: 'POST', body: fd})
                .then(response=>response.json())
                .then(obj=>{
                    console.log(obj);
                    myimg3.setAttribute('src', 'uploads/' +obj.filename);
                    pImg3.setAttribute('value', obj.filename);
                });
        });
    

</script>
