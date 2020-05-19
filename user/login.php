<?php
require __DIR__. '/__connect_db.php';

$user = '';
$password = '';

if(isset($_POST['user']) and isset($_POST['password'])){

    $user = $_POST['user'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM `admins` WHERE `admin_id`=? AND `password`=SHA1(?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        $user,
        $password,
    ]);


    if($stmt->rowCount()==1) {
        $_SESSION['admin'] = $user;
        header('Location: index_.php');
        exit;
    } else {
        $msg = '帳號或密碼錯誤';
    }

}


?>
<!doctype html>
<html lang="zh">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
    <script src="./js/jquery-3.3.1.js"></script>
    <script src="./bootstrap/js/bootstrap.bundle.js"></script>
</head>
<body>
<div class="container">

    <?php if(! isset($_SESSION['admin'])): ?>

        <?php if(isset($msg)): ?>
        <div class="alert alert-danger" role="alert">
            <?= $msg ?>
        </div>
    <?php endif ?>

        <form method="post">
            <div class="form-group">
                <input type="text" class="form-control" name="user" placeholder="用戶名稱" value="<?= $user ?>">
                <small id="emailHelp" class="form-text text-muted"></small>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="密碼" value="<?= $password ?>">
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    <?php else: ?>
        <script>
            location.href = './index_.php';
        </script>

    <?php endif; ?>
</div>

</body>
</html>