<?php
    $id=$_GET["id"];
    $pw=$_GET["pw"];
    $email=$_GET["email"];
    session_start();
    $_SESSION["id"]=$id;
    $_SESSION["pw"]=$pw;
    $_SESSION["email"]=$email;

    @$db=mysqli_connect("mysql201.phy.lolipop.lan","LAA1395326","Xuj29z9k","LAA1395326-syuupure");
    if(!$db){
      die("DB接続エラー");
    }
    // ログインシステム
    $sear="SELECT * FROM wp20220207100038_user ";
    $where=" WHERE ID = '$id' AND PW = '$pw' AND EMAIL = '$email'";
    $sear=$sear.$where.";";
    $ret=mysqli_query($db,$sear);
    if(!$ret){
        die("SQLエラー".$ret);
    }
    while($a=mysqli_fetch_assoc($ret))
    {
        $rec[]=$a;
    }
    if(isset($rec)){
        // ログイン成功
        $flg=0;
        unset($_SESSION['id']);
    }
    else
    {
        $flg=1;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link -->
    <link rel="stylesheet" href="../css/rog_load.css">
    <link rel="stylesheet" href="../css/destyle.css">
    <title>Document</title>
</head>
<body>
    <div class="whole">
        <div class="loader"><div>
        <?php if($flg == 0) {?>
            <meta charset="utf-8">
            <meta http-equiv="refresh" content="2;URL=home.php">
        <?php } else { ?>
            <meta charset="utf-8">
            <meta http-equiv="refresh" content="3;URL=rog.php">
        <?php }?>
        </div>
</body>
</html>