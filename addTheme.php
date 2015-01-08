<?php
require_once('inc/inc.php');

if(Utility::isUser()){
    $templ->setHtml(Template::getTemplate('form_add_theme'));
    $pageTpl = Template::getTemplate('index');
    $msg = "";

    Form::getFormData($ob);
    $ob->id_cat = Form::getCatId();
    if(Form::isFormSubmitted()){
        if($ob->id_cat === false){
            $msg = "Ошибка, вероятно неверная категория";
        } else{
            $validateFormResult = Form::isFormVaildTheme($ob);
            if($validateFormResult!== true) {
                $templ->setHtml($templ->processTemplateErrorOutput($validateFormResult));
            } else {
                if($db->saveTheme($ob)){
                    header('Location: '.Utility::getUrl($_SERVER['REQUEST_URI']));
                    die;
                } else {
                    $msg = 'Ошибка добавления темы';
                }
            }
        }
    }

    $templ->setHtml(Template::processTemplace($templ->getHtml(), array(
        'themeName' => $ob->themeName,
        'themeText' => $ob->themeText
    )));

    $page = Template::processTemplace($pageTpl, array(
        'FORM' => $templ->getHtml(),
        'MSG' => $msg,
        'CAT' => "",
        'TITLE-CAT' => "",
        'LOGIN' => $login
    ));
    echo $page;
} else{
    header('Location: '.Utility::getUrl());
    die;
}