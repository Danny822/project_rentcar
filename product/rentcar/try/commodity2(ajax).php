<?php
    $page_name="commodity";

    $per_page=25;
    $page=isset($_GET["page"])? intval($_GET["page"]) : 1;

    require __DIR__. "/__connect_db.php";
    $t_sql="SELECT COUNT(1) FROM commodity";
    $t_stmt=$pdo->query($t_sql);
    $total_rows=$t_stmt->fetch(PDO::FETCH_NUM)[0];
    
    $total_pages=ceil($total_rows/$per_page);

    if($page < 1)$page = 1;
    if($page > $total_pages)$page=$total_pages;

    $sql=sprintf("SELECT *FROM commodity ORDER BY pNo DESC LIMIT %s,%s",($page-1)*$per_page,$per_page );
    $stmt = $pdo->query($sql);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>



<?php include __DIR__."/__html_head.php"; ?>
<body>
    <div class="container">
    
    <div class="row">
        <div class="col-lg-12">
            <nav >    
                <ul class="pagination">
                
                
                <?php /*
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
                */ ?>
             
                
                </ul>
            </nav>    
            <table class="table">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col"><i class="fas fa-edit"></i></th>
                    <th scope="col">商品編號</th>
                    <th scope="col">廠牌</th>
                    <th scope="col">車型(型號)</th>
                    <th scope="col">幾人座</th>
                    <th scope="col">車種</th>
                    <th scope="col">里程數</th>
                    <th scope="col">排氣量</th>
                    <th scope="col">車齡</th>
                    <th scope="col">照片</th>
                    <th scope="col">租金</th>
                    <th scope="col">車商名稱</th>
                    <th scope="col">租借狀態</th>
                    <th scope="col">是否提供指定地點取車</th>
                    <th scope="col">是否提供甲租乙還</th>
                    <th scope="col"><i class="fas fa-trash-alt"></i></th>
                    </tr>
                </thead>
                <tbody id="data_body">
                    <!-- <tr>
                        <td >1</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td >1</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td >1</td>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td >1</td>
                        <td>Mark</td>
                    </tr> -->
                </tbody>
            </table>
        </div>
    </div>
<?php include __DIR__. "/__html_foot.php";  ?>

<script>
    
    let page=1;
    let ori_data;
    const ul_pagi=document.querySelector(".pagination");
    const data_body = document.querySelector("#data_body");
    const tr_str=`<tr>
                    <td><%= pNo %></td>
                    <td><%= pBrand %></td>
                    <td><%= pModel %></td>
                    <td><%= pSit %></td>
                    <td><%= pType %></td>
                    <td><%= pOdo %></td>
                    <td><%= pCc %></td>
                    <td><%= pAge %></td>
                    <td><%= pImg %></td>
                    <td><%= pRent %></td>
                    <td><%= shopName %></td>
                    <td><%= rentState %></td>
                    <td><%= rentAssign %></td>
                    <td><%= shopAddressSelect %></td>
                </tr>`;
        const tr_func = _.template(tr_str);  

        const pagi_str=`<li class="page-item <%= active %>">
                            <a class="page-link" href="#<%= page %>">
                                <%= page %>
                            </a>
                        </li>`;
        const pagi_str1=`<li class="page-item <%=$page<=1 ? "disabled":""%>
                    <a class="page-link" href="#1 " >
                    &laquo;
                    </a>
                    </li>`;
        const pagi_str2=`<li class="page-item <%=$page>=$total_pages ? "disabled":""%>
                    <a class="page-link" href="#<%= $total_pages %>" >
                    &raquo;
                    </a>
                    </li>`;
        const pagi_func =_.template(pagi_str);

        const myHashChange=()=>{
            let h = location.hash.slice(1);
            page=parseInt(h);
            if(isNaN(page)){
                page=1;
            }
        
        
        //複習
        fetch("commodity_api.php?page="+page)
            .then(res=>{
                return res.json();
            })
            .then(json=>{
                ori_data=json;
                console.log(ori_data);
                    

                let str="";
              
                for(let v of ori_data.data){
                    str= str+tr_func(v);
                }
                data_body.innerHTML=str;

                str="";
                for(let i=1;i<=ori_data.totalPages;i++){
                    let active=ori_data.page ===i ?"active" :"";

                    str= str+pagi_func({
                        active:active,
                        page:i
                    })
                    
                }
                ul_pagi.innerHTML=pagi_str1+str+pagi_str2;
                
            });
        };
    
            window.addEventListener('hashchange', myHashChange);
            myHashChange();
    </script>
<?php include __DIR__. "/__html_foot.php";  ?>