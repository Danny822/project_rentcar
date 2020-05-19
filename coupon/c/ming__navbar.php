<style>

    ul.navbar-nav>li.nav-item.active{
        background-color: blue;
    }

</style>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item <?= $page_name=='index' ? 'active' : '' ?>">
                    <a class="nav-link" href="ming_index_.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item <?= $page_name=='data_list' ? 'active' : '' ?>">
                    <a class="nav-link" href="ming_data_list.php">列表</a>
                </li>
                
                </li>
                <li class="nav-item <?= $page_name=='data_insert' ? 'active' : '' ?>">
                    <a class="nav-link" href="ming_data_insert.php">新增資料</a>
                </li>
                <li class="nav-item <?= $page_name=='login.php' ? 'active' : '' ?>">
                    <a class="nav-link" href="ming_login.php">登入</a>
                </li>
                <li class="nav-item <?= $page_name=='logout.php' ? 'active' : '' ?>">
                    <a class="nav-link" href="ming_logout.php">登出</a>
                </li>
            </ul>

        </div>
    </div>
</nav>
