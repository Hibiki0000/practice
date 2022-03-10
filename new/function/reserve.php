<?php
  session_start();
  unset($_SESSION['flg']);
    $email=$_SESSION["email"];
      if(isset($_GET["num"]))
      {
          $num = $_GET["num"];
          $_SESSION["num"]=$_GET["num"];
      }
    // 下書き保存か保存か予約
    @$db=mysqli_connect("mysql201.phy.lolipop.lan","LAA1395326","Xuj29z9k","LAA1395326-syuupure");
    if(!$db){
        die("DB接続エラー");
    }
    $sear=" SELECT * FROM wp20220207100038_reservation ";
    $where=" WHERE NUM = '$num' AND EMAIL = '$email' ";
    $sear=$sear.$where.";";
    $ret=mysqli_query($db,$sear);
    if(!$ret){
        die("SQLエラー");
    }
    while($res=mysqli_fetch_assoc($ret))
    {
        $rec[]=$res;
    } 
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link -->
    <link rel="stylesheet" href="../css/mail.css">
    <link rel="stylesheet" href="../css/destyle.css">
    <title>Document</title>
</head>
<body>
  <div id="whole">
  <div class="top">
      <header>
        <img src="../img/aikon_white.png">
        <h1>OHBメール</h1>
      </header>
    </div>
        <div class="mail">
          <h1>MAIL</h1>
          <form action="tomail.php" method="GET">
            <div class="home">
            <div class="from">
                <label>From</label>
                <input class="inputs" type="text" name="email" value="<?=$rec[0]['email']?>">
              </div>
            <div class="to">
                <label>To</label>
                <input class="inputs" type="text" name="to_mail" value="<?=$rec[0]['to_mail']?>">
              </div>
              <div class="ymd">
                <label>Date</label>
                <input class="inputs" type="date" name="date" value="<?=$rec[0]['date']?>">
              </div>
              <div class="tit">
                <label>Title</label>
                <input class="inputs" type="text" name="title" value="<?=$rec[0]['title']?>">
              </div>
              <div class="sentence">
                <label>Content</label>
                <textarea name="content" cols="50" rows="5"><?=$rec[0]['content']?></textarea>
              </div>
              <div class="submit">
              <input class="btm" type="submit" name="reservation" value="予約">
                  <input class="btm" type="submit" name="send_re" value="送信">
              </div>
        </div>
</div>
        </form>
</body>
</html>