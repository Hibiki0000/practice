<?php

add_action("phpmailer_init", "send_mail_smtp");
function send_mail_smtp($phpmailer)
{
    $phpmailer->isSMTP();                     //SMTP有効設定
    $phpmailer->Host = "smtp.lolipop.jp ";  //メールサーバーのホスト名
    $phpmailer->SMTPAuth = true;              //SMTP認証の有無（true OR false）
    $phpmailer->Port = "465";                 //SMTPポート番号(ssl:465 tls:587)
    $phpmailer->Username = "host-first-130.pya.jp";        //ユーザー名
    $phpmailer->Password = "syuupure0522";   //パスワード
    $phpmailer->SMTPSecure = "tls";           //SMTP暗号化方式（ssl OR tls）
    $phpmailer->From = "info@host-first-130.pya.jp";    //送信者メールアドレス
//  $phpmailer->SMTPDebug = 2;                //デバッグ表示
}

?>