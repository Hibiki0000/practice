<?php
    if(isset($_GET['email'])){
        $email=$_GET['email'];
    }
    session_start();
    if(isset($email))
    {
        $_SESSION["email"]=$email;
    }
    elseif(isset($_SESSION["email"]))
    {
        $email=$_SESSION["email"];
    }
    
    //DB 
    @$db=mysqli_connect("mysql201.phy.lolipop.lan","LAA1395326","Xuj29z9k","LAA1395326-syuupure");
    if(!$db){
        die("DB接続エラー");
    }
    // チェックが入っているmailを格納
    $sear="SELECT * FROM wp20220207100038_mail ";
    $where=" WHERE email = '$email' AND checked = 'check' order by num desc" ;
    $sear=$sear.$where.";";
    $update=mysqli_query($db,$sear);
    if(!$update){
        die("SQLエラー");
    }
    while($iii=mysqli_fetch_assoc($update))
    {
        $ans_update[]=$iii;
    }
    // 予約メール用プログラム
    $sear="SELECT * FROM wp20220207100038_reservation ";
    $where=" WHERE EMAIL = '$email' ";
    $sear=$sear.$where.";";
    $ww=mysqli_query($db,$sear);
    if(!$ww){
        die("SQLエラー");
    }
    while($ooo=mysqli_fetch_assoc($ww))
    {
        $reserve[]=$ooo;
    }
    $current_date = date("Y-m-d");
    $coming_soon="";
    if(isset($reserve)){
        foreach($reserve as $i)
        {
            if($current_date <= $i['date'])
            {
                $day=$i['date'];
            }
            if($current_date == $i['date'])
            {
                $coming_soon="１日以内に送る予定のメールがあります！";
            }
            elseif(date("Y-m-d" , strtotime('+1 day')) == $i['date']){
                $coming_soon="１日以内に送る予定のメールがあります！";
            }
        } 
        // 予約メール削除
        for($i=0;$i<count($reserve);$i++){
            if(isset($_GET["dele$i"])){
                $delete_num=$_GET["dele$i"];
                $dele="DELETE FROM wp20220207100038_reservation WHERE NUM = '$delete_num' AND EMAIL = '$email' ";
                $res=$dele.";";
                $ret=mysqli_query($db,$res);
                if(!$ret){
                    die("SQLエラー");
                }
                $ww=mysqli_query($db,$sear);
                if(!$ww){
                    die("SQLエラー");
                }
                $reserve=[];
                while($ooo=mysqli_fetch_assoc($ww))
                {
                    $reserve[]=$ooo;
                }
            }
        }
    }
    // お気に入り機能のflg作り
    if(isset($_SESSION['flg'])){
        $flg=1;
        // 更新された時のセッション
        $_SESSION['flg']=0;
    }
    else{
        $flg=0;
        $_SESSION['flg']=0;
    }
    if(isset($ans_update)){
        for($e=0;$e<=count($ans_update);$e++){
            $check[$e]="";
            if(isset($ans_update[$e]) && $flg == 1)
            {
                if($ans_update[$e]['checked'] == "check")
                {
                    $check[$e]="checked";
                }
            }
            // 削除ボタン
            elseif(isset($_GET["delete_btn"]))
            {
                // データベースにチェック入っている物をここで出力
                if(isset($ans_update[$key]['checked'])){
                    if($e == $ans_update[$key]['num'])
                    {
                        $flg=1;
                        $check[$e] = "checked"; 
                        $key=$key+1;
                    }
                }                    
            }
            else
            {
                unset($_SESSION["name$e"]);
            }
}

}
unset($_SESSION['flg']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link -->
    <link rel="stylesheet" href="../css/spam.css">
    <link rel="stylesheet" href="../css/destyle.css">
    <title>ホーム</title>
</head>
<body>
    
    <div id="whole">
        <header>
            <img src="../img/aikon_white.png">
            <h1>HOBメール</h1>
        </header>
        <div class="left">
            <div class="function">
                <a class="create" href="mail.php">メール作成</a>
                <div class="up">
                    <a href="Receive.php?email=<?=$email?>">受信トレイ</a>
                    <a href="home.php?email=<?=$email?>">送信済みトレイ</a>
                    <a href="star.php?email=<?=$email?>">お気に入り</a>
                    <p class="box">迷惑メール</p>
                    <a href="trash.php?email=<?=$email?>">ゴミ箱</a>
                </div>
                <p>アカウント</p>
                <p class="aikon"><?=$email?></p>
                <a href="rog.php" class="out">ログアウト</a>
            </div>
        </div>
        <div class="center">
            <div class="category">
                <p>― History ―</p>
                <p></p>
                <ul>
                    <li class="a">Title</li>
                    <li class="b">Content</li>
                    <li class="c">To</li>
                    <li class="d">Date</li>
                </ul>
            </div>
                <div class="checkbox">
                    <form action="Receive.php" method="GET">
                        <ul>
                
                            <div class="check clear_box">
                            </div>
                            <div  class="mail">
                                <p>現在受信しているメールはございません</p>
                            </div>
                    <div class="submitbtn">
                        <input type="submit" value="お気に入り更新">
                    </div>
                </form>
                       </ul>
                </div>
        </div>
                
       
        <div class="right">
            <div class="category">
                <p>― Reminder ―</p>
                <p></P>
                <ul>
                    <li class="a">Title</li>
                    <li class="b">To</li>
                    <li class="c">Date</li>
                </ul>
            </div>
            <?php if(isset($coming_soon)){?>
                <h1 class="alert"><?php echo $coming_soon ; } ?></h1>
                <?php if(isset($reserve)){ ?>
                    <div class="delete">
                        <form action="home.php" method="GET">
                        <ul>
                            <?php for($i=0;$i<count($reserve);$i++){
                            if($current_date <= $reserve[$i]['date']){ ?>
                            <div class="check2 clear_box">
                                <li><input type="checkbox" name="dele<?=$i?>" value="<?=$reserve[$i]['num']?> check"></li>
                            <div>
                            <div  class="reserve">
                                <a href="reserve.php?num=<?=$reserve[$i]['num']?> ">
                                    <li>
                                        <div class="a"><?=$reserve[$i]['title']?></div> 
                                        <div class="b"><?=$reserve[$i]['to_mail']?></div>
                                        <div class="c"><?=$reserve[$i]['date']?></div>
                                    </li>
                            </div></a> <?php }}} ?>
                            <input class="submit" type="submit" name="delete_btn" value="削除">
                        </ul>
                        </from>
                    </div>
    </div>

</body>
</html>