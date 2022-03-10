<?php
    if(isset($_GET['email'])){
        $email=$_GET['email'];
    }
    if(isset($_GET['num'])){
        $id=$_GET['num'];
    }
    session_start();
    session_destroy();
    //DB 
    @$db=mysqli_connect("mysql201.phy.lolipop.lan","LAA1395326","Xuj29z9k","LAA1395326-syuupure");
    if(!$db){
        die("DB接続エラー");
    }
    // 履歴メール.予約メールの表示
    $sear="SELECT * FROM wp20220207100038_mail ";
    $where=" WHERE email = '$email' AND NUM = '$id' ";
    $sear=$sear.$where.";";
    $retret=mysqli_query($db,$sear);
    if(!$retret){
        die("SQLエラー");
    }
    while($aaa=mysqli_fetch_assoc($retret))
    {
        $recrec[]=$aaa;
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- link -->
        <link rel="stylesheet" href="../css/page_star.css">
    <link rel="stylesheet" href="../css/destyle.css">
    <title>メールホーム</title>
</head>
<body>

    <div class="top">
      <header>
        <img src="../img/aikon_white.png">
        <h1>HOBメール</h1>
      </header>
    </div>
    <div class="mail">
    <h1>MAIL</h1>
        <?php foreach($recrec as $i){ ?>
        <div class="from">
            <label>From</label>
            <p><?=$i['email']?></p>
        </div>
        <div class="to">
            <label>To</label>
            <p><?=$i['to_mail']?></p>
        </div>
        <div class="ymd">
            <label>Date</label>
            <p><?=$i['date']?></p>
        </div>
        <div class="tit">
            <label>Title</label>
            <p><?=$i['title']?></p>
        </div>
        <div class="sentence">
            <label>Content</label>
            <p><?=$i['content']?></p>
        </div>
        <?php } ?>
        <div class="submit">
            <a href="star.php?num=<?=$recrec[0]['num']?>&email=<?=$email?> ">Return</a>
        </div>
        </div>
</body>
</html>