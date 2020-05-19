<?php
    require __DIR__. '/__connect_db.php';


    $per_page = 5;

    $result = [
        'success' => false,
        'page' => 0,
        'totalRows' => 0,
        'perPage' => $per_page,
        'totalPages' => 0,
        'data' => [],
        'errorCode' => 0,
        'errorMsg' => '',
    ];

    //決定每頁有幾頁，並讓用戶決定要看的頁數，若沒設定，則跳出第一頁
    $page = isset($_GET['page']) ? intval($_GET['page']) : 1;


    //算總筆數
    $t_sql = "SELECT COUNT(1) FROM driver";
    $t_stmt = $pdo->query($t_sql);
    //FETCH_NUM拿出來只有一個值，後面加[0]代表拿第一個值
    $total_rows = $t_stmt->fetch(PDO::FETCH_NUM)[0];
    $result['totalRows'] = intval($total_rows);


    //總頁數
    $total_pages = ceil($total_rows/$per_page);
    $result['totalPages'] = $total_pages;


    //避免頁數不對的bug
    //後面大括號可省略，因為只有一行
    //用header做做看
    if($page < 1) $page = 1;
    if($page > $total_pages) $page = $total_pages;
    $result['page'] = $page;


    $sql = sprintf("SELECT * FROM `driver` ORDER BY driverNo ASC LIMIT %s, %s", ($page-1)*$per_page, $per_page);
    $stmt = $pdo->query($sql);





    // 所有資料一次拿出來
    $result['data'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $result['success'] = true;

    // 將陣列轉換成 json 字串，JSON_UNESCAPED_UNICODE可以讓中文字不用跳脫
    echo json_encode($result, JSON_UNESCAPED_UNICODE);