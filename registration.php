<?php

require_once('inc/inc.php');

if(!Utility::isUser()){
    $pageTpl = Template::getTemplate('page');
    $templ->setHtml(Template::getTemplate('form_registration'));

    $msg = "";

    Form::getFormData($ob);

    if(Form::isFormSubmitted()){
        $validateFormResult = Form::isFormVaild($ob, $db);
        if($validateFormResult !== true) {
            $templ->setHtml($templ->processTemplateErrorOutput($validateFormResult));
        } else {
            $ob->hash = md5($ob->userName);
            if(Mail::goMail($ob)){
                if($db->addUser($ob)) {
                    header('Location: ./registration-1');
                    die;
                } else {
                    $msg .= 'Ошибка сохранения';
                }
            } else {
                $msg = 'Сообщение не было отправлено. Mailer ошибка';
            }
        }
    }
    if(Form::isSuccess()){
        $templ->setHtml('Письмо для подтверждения регистрации было отправленно на ваш E-mail<br/><a href="'.Utility::getUrl().'">Перейти на главную страницу</a>');
    } else{
        $templ->setHtml(Template::processTemplace($templ->getHtml(), array(
            'userName' => $ob->userName,
            'userEmail' => $ob->userEmail,
            'password' => "",
            'passwordConfirm' => ""
        )));
        $templ->setHtml(Template::processTemplace($templ->getHtml(), array('CAPTCHA' => Form::generateCaptcha())));
    }

    $page = Template::processTemplace($pageTpl, array(
        'FORM' => $templ->getHtml(),
        'MSG' => $msg
    ));
    echo $page;
} else{
    header('Location: '.Utility::getUrl());
    die;
}