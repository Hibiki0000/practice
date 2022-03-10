<?php
  session_start();
  unset($_SESSION['flg']);
    $email=$_SESSION["email"];
  
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
    <title>メールホーム</title>
</head>
<body>
  <div id="whole">
    <div class="top">
      <header>
        <img src="../img/aikon_white.png">
        <h1>HOBメール</h1>
      </header>
    </div>
        <div class="mail">
          <h1>MAIL</h1>
          <form action="tomail.php" method="GET" onsubmit="return cancelsubmit();">
            <div class="home">
            <div class="from">
                <label>From</label>
                <input class="inputs" type="text" name="email" value="<?=$email?>">
                <p class="alertText"></p>
              </div>
            <div class="to">
                <label>To</label>
                <input class="inputs" type="text" name="to_mail">
                <p class="alertText"></p>
              </div>
              <div class="ymd">
                <label>Date</label>
                <input class="inputs" type="date" name="date">
                <p class="alertText"></p>
              </div>
              <div class="tit">
                <label>Title</label>
                <input class="inputs" type="text" name="title">
                <p class="alertText"></p>
              </div>
              <div class="sentence">
                <label>Content</label>
                <textarea name="content" cols="50" rows="5"></textarea>
              </div>
              <div class="submit">
              <input class="btm" type="submit" name="reservation" value="予約">
                  <input class="btm" type="submit" name="send" value="送信">
              </div>
        </div>
</div>
        </form>
        <script src="../js/mail.js"></script>
</body>
</html>