<style>
    ul.navbar-nav > li.nav-item.active {
        background-color: #6EB7B0;
    }
    ul.nav-ul > li {
        margin: 0 10px 0 10px;
        padding: 5px 10px 5px 10px;
    }
</style>
<div class="">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="width: 100%">
    <div class="container ">
        <a class="navbar-brand" href="#"><img src="./images/LOGO.svg" alt="" style="width: 100px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto nav-ul d-flex " style="width:100%">
<!--                <li class="nav-item flex-grow-1 --><?//= $page_name == 'index' ? 'active' : '' ?><!--">-->
<!--                    <a class="nav-link" href="index_.php">Home <span class="sr-only">(current)</span></a>-->
<!--                </li>-->
                <li class="nav-item flex-grow-1 <?= $page_name=='m_list_search4' ? 'active' : '' ?>">
                    <a class="nav-link" href="m_list_search4.php">會員資訊</a>
                </li>
                <li class="nav-item flex-grow-1 <?= $page_name == 'user_shop_list' ? 'active' : '' ?>">
                    <a class="nav-link" href="user_shop_list.php">車商會員資訊</a>
                </li>
                <li class="nav-item flex-grow-1 <?= $page_name == 'driver_list' ? 'active' : '' ?>">
                    <a class="nav-link" href="driver_list.php">駕駛會員資訊</a>
                </li>
                <li class="nav-item flex-grow-1 <?= $page_name == 'coupon_list' ? 'active' : '' ?>">
                    <a class="nav-link" href="ming_data_list.php">優惠活動</a>
                </li>
                <li class="nav-item flex-grow-1 <?= $page_name == 'order_list' ? 'active' : '' ?>">
                    <a class="nav-link" href="order_list.php">訂單</a>
                </li>
                <li class="nav-item flex-grow-1 <?= $page_name == 'commodity' ? 'active' : '' ?>">
                    <a class="nav-link" href="commodity.php">商品資訊</a>
                </li>
                <li class="nav-item flex-grow-1 <?= $page_name == 'ad_list' ? 'active' : '' ?>">
                    <a class="nav-link" href="__ad_list.php">廣告</a>
                </li>
            </ul>

        </div>
    </div>
</nav>
</div>