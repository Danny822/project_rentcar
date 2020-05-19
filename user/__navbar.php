<style>
    ul.navbar-nav>li.nav-item.active {
        background-color: #6EB7B0;
    }

</style>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#"><img src="./images/LOGO.svg" alt="" style="width: 100px;"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto d-flex" style="width:100%">
                <li class="nav-item flex-grow-1 <?= $page_name=='index' ? 'active' : '' ?>">
                    <a class="nav-link" href="index_.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item flex-grow-1 <?= $page_name=='m_list' ? 'active' : '' ?>">
                    <a class="nav-link" href="m_list.php">列表</a>
                </li>
                <li class="nav-item flex-grow-1 <?= $page_name=='m_list_search4' ? 'active' : '' ?>">
                    <a class="nav-link" href="m_list_search.php">列表搜尋</a>
                </li>

                <li class="nav-item flex-grow-1 <?= $page_name=='m_insert1' ? 'active' : '' ?>">
                    <a class="nav-link" href="m_insert1.php">新增會員1</a>
                </li>
                <li>
                    <a href="./logout.php" class="btn btn-danger">登出</a>
                </li>
            </ul>

        </div>
    </div>
</nav>
