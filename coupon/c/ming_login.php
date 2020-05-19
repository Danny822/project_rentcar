<?php
session_start();

$user = 'adaptor2006';
$password = 'year002';

if(isset($_POST['user']) and isset($_POST['password'])){
    $user = $_POST['user'];
    $password =  $_POST['password'];
    if($_POST['user']==='adaptor2006' and $_POST['password']==='test'){
        $_SESSION['user'] = 'adaptor2006';
    }else{
        $msg = '帳號或密碼錯誤';
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="bootstrap-4.3.1-dist/css/bootstrap.css">
    <script src="js/jquery-3.3.1.js"></script>
    <script src="bootstrap-4.3.1-dist/js/bootstrap.bundle.js"></script>

</head>
<body>
<div class="container" >

<?php if(! isset($_SESSION['user'])): ?>

<?php if (isset($msg)): ?>
    <div class="alert alert-danger" role="alert">
        <?= $msg ?>
    
    
    </div>


<?php endif ?>
<form method="post" >

    <div class="form-group">
        <input type="text" class="form-control" name="user" placeholder="用戶名稱" value="<?= $user ?>">
        <small id="emailHelp" class="form-text text-muted"></small>
    </div>
    <div class="form-group">
    
        <input type="password" class="form-control" name="password" placeholder="密碼"value="<?= $password ?>" >
    </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
  
</form>
<?php else: ?>

    <div class="alert alser-primary" role="alert">
        <?= $_SESSION['user'] ?> 您好
    </div>

    <a href="ming_data_list.php" class="btn btn-danger" >回資料列</a>
<?php endif; ?>
</div>
</body>
</html>