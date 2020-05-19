<?php
    require __DIR__. '/__cred.php';
    require __DIR__. '/__connect.php';
    $page_name = 'ad_insert';



?>
<?php include __DIR__. '/__htmlheader.php';  ?>
    <style>
    small{
        color:red !important;
    }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">新增廣告</h5>

                        <form action="__close_insert.php" method="post" name="form1" onsubmit="return checkForm()" enctype="multipart/form-data">
                            <input type="hidden"name="checkme"value="check123">
                            <div class="form-group">
                                <label for="adTitle">廣告標題</label>
                                <input type="text" class="form-control" id="adTitle" name='adTitle' aria-describedby="adTitleHelp" placeholder="輸入廣告標題">
                                <small id="adTitleHelp" name="adTitleHelp" class="form-text  "></small>
                            </div>
                           
                            <div class="form-group">
                                <label for="adImg">廣告圖片</label>
                                <img id="myimg" src="" alt="" width="200px">
                                <br>
                                <input type="file" targetID="myimg" onchange="readURL(this)" id="adImg" name='adImg' aria-describedby="adImgHelp" accept="image/jpeg,image/jpg,image/gif,image/png">
                                <small id="adImgHelp" class="form-text  "></small>
                            </div>
                            <div class="form-group">
                                <label for="adUrl">廣告連結</label>
                                <input type="text" class="form-control" id="adUrl" name='adUrl' aria-describedby="adUrlHelp" placeholder="輸入廣告連結">
                                <small id="adUrlHelp" class="form-text  "></small>
                            </div>
                            <div class="form-group">
                                <label for="adState">上線狀態</label>
                                <input type="text" class="form-control" id="adState" name='adState' aria-describedby="adStateHelp" placeholder="線上狀態:0(下線)/1(上線)">
                                <small id="adStateHelp" class="form-text  "></small>
                            </div>
                            <div class="form-group">
                                <label for="adDate">上線日期</label>
                                <input type="date" class="form-control" id="adDate" name='adDate' aria-describedby="adDateHelp" placeholder="YYYY-MM-DD">
                                <small id="adDateHelp" class="form-text  "></small>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    //     const myimg = document.querySelector('#myimg');
    //     const my_file = document.querySelector('#adImg');

    //     my_file.addEventListener('change', event=>{
    //    //console.log(event.target);
    //     const fd = new FormData();

    //     fd.append('adImg', my_file.files[0]);

    //     fetch('a20190313_04_upload_ajax.php', {
    //         method: 'POST',
    //         body: fd
    //     })
    //         .then(response=>response.json())
    //         .then(obj=>{
    //             console.log(obj);
    //             myimg.setAttribute('src', 'uploads/' +obj.filename);
    //         });
    //     });

        function readURL(input){
        if(input.files && input.files[0]){
        var imageTagID = input.getAttribute("targetID");
        var reader = new FileReader();
        reader.onload = function (e) {
        var img = document.getElementById(imageTagID);
        img.setAttribute("src", e.target.result)
    }
    reader.readAsDataURL(input.files[0]);
  }
}






    const checkForm = ()=>{ 
        let isPassed = true;

        const fields =[
            'adTitle',
            'adUrl',
            'adState',
            'adDate'
        ];

        let adTitle= document.form1.adTitle.value;
        let adUrl = document.form1.adUrl.value;
        let adState=document.form1.adState.value;
        let adState_pattern =/^([0-1])$/i;
        let adDate_pattern =/^\d{4}\-?\d{2}\-?\d{2}$/;
        let adDate=document.form1.adDate.value;

        for(let k in fields)
        {
            document.querySelector('#'+fields[k]+'Help').innerHTML='';
            document.form1[fields[k]].style.borderColor='#cccccc';
        }

        if (adTitle===''){
            document.querySelector('#adTitleHelp').innerHTML='請填入廣告標題!!!';
            document.form1.adTitle.style.borderColor='red';
            isPassed=false;
            
        };
        if (adImg===''){
            document.querySelector('#adImgHelp').innerHTML='請上傳廣告圖片!!!';
            document.form1.adTitle.style.borderColor='red';
            isPassed=false;
            
        }
        
        if (adUrl===''){
            document.querySelector('#adUrlHelp').innerHTML='請填入廣告連結!!!';
            document.form1.adUrl.style.borderColor='red';
            isPassed=false;
        };
        if (!adState_pattern.test(adState )){
            document.querySelector('#adStateHelp').innerHTML='請輸入1或0!!!';
            document.form1.adState.style.borderColor='red';
            isPassed=false;
        };
        if (!adDate_pattern.test(adDate)){
            document.querySelector('#adDateHelp').innerHTML='請輸入年(YYYY)/月(MM)/日(DD)';
            document.form1.adDate.style.borderColor='red';
            isPassed=false;
        };
        
        return isPassed;
        
        }


    </script>
<?php include  __DIR__. './__htmlfoot.php';  ?>