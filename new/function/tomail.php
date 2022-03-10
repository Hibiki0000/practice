<?php

    $date="";
    $to_mail="";
    $title="";
    $content="";
    $email=$_GET["email"];
    if(isset($_GET["date"])){
        $date=$_GET["date"];
    }
    if(isset($_GET["to_mail"])){
        $to_mail=$_GET["to_mail"];
    }
    if(isset($_GET["title"])){
        $title=$_GET["title"];
    }
    if(isset($_GET["content"])){
        $content=$_GET["content"];
    }
        
    session_start();
    unset($_SESSION['flg']);
    $_SESSION["email"]=$email;
    if(isset($_SESSION['num']))
    {
        $number = $_SESSION["num"];
    }
    //DB
    @$db=mysqli_connect("mysql201.phy.lolipop.lan","LAA1395326","Xuj29z9k","LAA1395326-syuupure");
    if(!$db){
        die("DB接続エラー");
    }
    // 送信か予約
    if(isset($_GET["reservation"])){
        $sear=" SELECT * FROM wp20220207100038_reservation ";
    }
    elseif(isset($_GET["send_re"])){
        $dele="DELETE FROM wp20220207100038_reservation WHERE NUM = $number AND EMAIL = '$email' ";
        $d=$dele.";";
        $ret=mysqli_query($db,$d);
        $sear=" SELECT * FROM wp20220207100038_mail ";
    }
    else{
        $sear=" SELECT * FROM wp20220207100038_mail ";
    }
        $where=" WHERE EMAIL = '$email' ";
        $sear=$sear.$where.";";
        $search=mysqli_query($db,$sear);
        if(!$search){
            die("SQLエラー2");
        }
        while($aaa=mysqli_fetch_assoc($search))
        {
            $rec[]=$aaa;
        }
        // numに数字を入れる
        $num=0;
        if(isset($rec))
        {
            foreach($rec as $i)
            {
                if(isset($i['num']))
                {
                    $num=$i['num']+1;    
                }
            }
        }


$flg=0;
    // futureテーブルにデータを挿入
    if(isset($_GET["reservation"])){
        $sql="INSERT INTO wp20220207100038_reservation (num,checked,date,email,to_mail,title,content) VALUES ('$num','','$date','$email','$to_mail','$title','$content');";
    }
    else
    {
        $sql="INSERT INTO wp20220207100038_mail (num,checked,date,email,to_mail,title,content) VALUES ('$num','','$date','$email','$to_mail','$title','$content');";
        $flg=1;
    }
    $res=mysqli_query($db,$sql);
    if(!$res){
        die("SQLエラー1");
    }

        
    // mail(宛先, 件名, メッセージ, ヘッダ)
    if($flg==1){
        $to = "$to_mail";
        $subject = "$title";
        $message = "$content";
        // $headers = "From: $email";
        // $from = "GRAYCODE事務局 <noreply@gray-code.com>";
        $from = "$email <$email>";
        $from_mail = "$email";
        $from_name = "$email";
        $pfrom   = "-f From: $email";

        $header = '';
        $header .= "Content-Type: text/plain \r\n";
        $header .= "Return-Path: " . $from_mail . " \r\n";
        $header .= "From: " . $from ." \r\n";
        $header .= "Sender: " . $from ." \r\n";
        $header .= "Reply-To: " . $from_mail . " \r\n";
        $header .= "Organization: " . $from_name . " \r\n";
        $header .= "X-Sender: " . $from_mail . " \r\n";
        $header .= "X-Priority: 3 \r\n";
        date_default_timezone_set('Asia/Tokyo');
        $current_date = date("Y/m/d H:i:s");
            if($current_date >= $date){
                mb_send_mail($to, $subject, $message, $header,$pfrom);
            }
        }

        header('Location:./home.php');
        exit();
?>
