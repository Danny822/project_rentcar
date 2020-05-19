
<nav class="navbar navbar-expand-lg navbar-light " style="background-color: #faa; ">
    <div class="container " >
       <div style=" font-weight: 900; font-size: 24px; margin-right: 10px; text-shadow: 5px 5px 5px  rgba(236, 87, 87, 0.705);  "> Advertisement Management </div>
 

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item text-center <?= $page_name=='index' ? 'active' : '' ?>" style="width: 80px;" >
                    <a class="nav-link" href="__index.php"  >Home</a>
                </li>
                <li class="nav-item  text-center <?= $page_name=='ad_list' ? 'active' : '' ?>" style="width: 80px;">
                    <a class="nav-link" href="./__ad_list.php">List</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
             <a class="nav-link" href="" >
             <button class="btn btn-outline-danger my-2 my-sm-0 addbtn" type="新增資料"  onclick="openinsert()" style=" font-weight: 600; width: 80px;">Add</button>
            </a>
                </div>
    </div>
</nav>
<script>
function openinsert() {
         window.open("__ad_insert.php", "_blank", "toolbar=no,scrollbars=no,resizable=no,top=25%,left=50%,width=500,height=600");
            }        
</script>