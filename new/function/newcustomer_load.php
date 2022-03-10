<?php

    $id=$_GET["id"];
    $pw=$_GET["pw"];
    $email=$_GET["email"];

// DB
    @$db=mysqli_connect("mysql201.phy.lolipop.lan","LAA1395326","Xuj29z9k","LAA1395326-syuupure");
    if(!$db){
        die("DB接続エラー");
    }
    // emailチェック
    $sear="SELECT * FROM wp20220207100038_user ";
    $where=" WHERE EMAIL = '$email' ";
    $sear=$sear.$where.";";
    $ret=mysqli_query($db,$sear);
    if (!$ret) {
        echo "SQLエラー";
    }
    $flg=1;
    // 既にメールアドレスが存在しているflg=0
    while($a=mysqli_fetch_assoc($ret)){
        if(isset($a))
        {
            $rec[]=$a;
            $flg=0;
        }
    }
    if($flg == 1){
        $messege="登録完了";
        // データを挿入
        $sql="INSERT INTO wp20220207100038_user (id, pw, email ) VALUES ('$id', $pw, '$email' ) ; ";
        $res=mysqli_query($db,$sql);
        if(!$res){
            die("SQLエラー");
        }
    }

    session_start();
    $_SESSION["id"]=$id;
    $_SESSION["pw"]=$pw;

    mysqli_free_result($ret);
    mysqli_close($db);




?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- link -->
    <link rel="stylesheet" href="../css/newcustomer_load.css">
    <link rel="stylesheet" href="../css/destyle.css">
</head>
<body>
        <div class="whole">  
            <div class="loader"><div>
                <?php if($flg == 0) {?>
                <meta charset="utf-8">
                <meta http-equiv="refresh" content="2;URL=newcustomer.php">
                <p>既にメールアドレスが存在しています</p>
                <?php $_SESSION["exist"]=1; ?>
    
                <?php } else { ?>
                <meta charset="utf-8">
                <meta http-equiv="refresh" content="3;URL=rog.php">
                <p>登録が完了しました</p>
                <?php }?>
        </div>
</body>
</html>
