<?php
  $flg=0;
  $id="";
  $pw="";
  $email="";
  session_start();
  unset($_SESSION['flg']);
  if(isset($_SESSION['load'])){
    $flg=0;
    unset($_SESSION['load']);
  }
  elseif(isset($_SESSION["id"]) && isset($_SESSION["pw"]) && isset($_SESSION["email"])){
    $id=$_SESSION["id"];
    $pw=$_SESSION["pw"];
    $email=$_SESSION["email"];
    $_SESSION['load']="flg";
    $flg=1;
  }
  unset($_SESSION['pw']);
  unset($_SESSION['id']);
?>


<!DOCTYPE html>
<html lang="jp">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link -->
    <link rel="stylesheet" href="../css/rog.css">
    <link rel="stylesheet" href="../css/destyle.css">
    <title>Document</title>
</head>
<body>
  <div class="whole">
    <div class="left">
    </div>
    <h1 class="rogo">Login<h1>
    <div class="right">
      <img src="../img/aikon.png"> 
        <h1>HOBメール</h1>
        <?php if($flg == 1){ ?>
          <h2>ログインに失敗しました。</h2>
        <?php }?>
      <div class="form">
        <form action="rog_load.php" method="GET" onsubmit="return cancelsubmit();">
          <div class="example">
            <input class="inputs" type="text" name="id" value="<?=$id?>" placeholder="Name" >
            <p class="alertText"></p>
          </div>
          <div class="example">
            <input class="inputs" type="text" name="pw" value="<?=$pw?>" placeholder="Password" >
            <p class="alertText"></p>
          </div>
          <div class="example">
            <input class="inputs" type="email" name="email" value="<?=$email?>" placeholder="Email" >
            <p class="alertText"></p>
          </div>
          <div class="example">
            <input class="btm" type="submit" value="Login">
          </div>
      </div>
      <a href="newcustomer.php" class="btn-border">Create</a>
  </div>
     </form>

     <script src="../js/rog.js"></script>
</body>
</html>