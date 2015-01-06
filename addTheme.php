<?php
require_once('inc/inc.php');

if(!empty($_SESSION['userName'])){
    $templ->setHtml(Template::getTemplate('form_add_theme'));
    $pageTpl = Template::getTemplate('index');
    $msg = "";

    Form::getFormData($ob);

    if(Form::isFormSubmitted()){
        $validateFormResult = Form::isFormVaildCat($ob);
        if($validateFormResult!== true) {
            $templ->setHtml($templ->processTemplateErrorOutput($validateFormResult));
        } else {
            if($db->saveTheme($ob)){
                header('Location: '.$_SERVER['REQUEST_URI']);
                die;
            } else {
                $msg = 'Ошибка добавления темы';
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
    header('Location: http://'.$_SERVER['HTTP_HOST'].'/forum/index.php');
    die;
}