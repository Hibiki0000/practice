<?php
    session_start();
    $id="";
    $pw="";
    $email="";
    $alert="";
    if(isset($_SESSION['id']))
    {
        $id=$_SESSION['id'];
    }
    if(isset($_SESSION['pw']))
    {
        $pw=$_SESSION['pw'];
    }
    if(isset($_SESSION['exist']))
    {
        $alert="既にメールアドレスが存在しています";
    }
    session_destroy();
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>登録</title>
    <!-- link -->
    <link rel="stylesheet" href="../css/newcustomer0.css">
    <link rel="stylesheet" href="../css/destyle.css">
</head>
<body>
    <div class="whole">
      <div class="left"></div>
        <h1 class="rogo">Register<h1>
        
    <div class="right">
      <img src="../img/aikon.png">
    <h1>HOBメール</h1>
    <h2><?=$alert?></h2>
    <form action="newcustomer_load.php" method="GET" onsubmit="return cancelsubmit();">
      <div class="home">
        <div class="example">
          <input class="inputs" name="id"  placeholder="Name" value="<?=$id?>">
          <p class="alertText"></p>
        </div>
        <div class="example">
          <input class="inputs" type="text" name="pw" placeholder="Password" value="<?=$pw?>">
          <p class="alertText"></p>
        </div>
        <div class="example">
          <input class="inputs" type="email" name="email" placeholder="Email">
          <p class="alertText"></p>
        </div>
        <div class="example">
          <input class="btm" type="submit" value="Register">
        </div>
    </div>
    <a href="rog.php" class="btn-border">Return</a>
  </div>
    </div>
    
    </form>
    <script src="../js/rog.js"></script>
</body>
</html>