<?php

class Mail{
    public static function goMail(FormData $ob){
        $mail = new PHPMailer();
        $message = "Уважаемый ".$ob->userName.",<br/>
            Спасибо за то, что Вы  создали аккаунт у нас. Для того чтобы активировать Ваш профайл нажмите на ссылку ниже:<br/>
            <a href='"."http://".$_SERVER['HTTP_HOST']."/forum/activation-".$ob->userName."-".$ob->hash."' target='_blank'>
            "."http://".$_SERVER['HTTP_HOST']."/forum/activation"."</a>";
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPKeepAlive = true;
        $mail->SMTPSecure = SMTP_SEC;
        $mail->Host = MAIL_HOST;
        $mail->Port = MAIL_PORT;
        $mail->Username = MAIL_USERNAME;
        $mail->Password = MAIL_PASSWORD;

        $mail->SetFrom(MAIL_USERNAME);
        $mail->CharSet = CHAR_SET;
        $mail->Subject = 'Регистрация на форуме';
        $mail->MsgHTML($message);
        $mail->AddAddress($ob->userEmail);
        if(!$mail->send()) {
            return false;
        } else {
            return true;
        }
    }
}