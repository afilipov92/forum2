<?php

require_once('inc/inc.php');

if(isset($_SESSION['idStatus']) && $_SESSION['idStatus'] == 1){
    $templ->setHtml(Template::getTemplate('form_add_cat'));
    $pageTpl = Template::getTemplate('index');
    $msg = "";

    Form::getFormData($ob);

    if(Form::isFormSubmitted()){
        $validateFormResult = Form::isFormVaildCat($ob);
        if($validateFormResult!== true) {
            $templ->setHtml($templ->processTemplateErrorOutput($validateFormResult));
        } else {
            if($db->saveCat($ob)){
                header('Location: '.$_SERVER['REQUEST_URI']);
                die;
            } else {
                $msg = 'Ошибка добавления категории';
            }
        }
    }

    $templ->setHtml(Template::processTemplace($templ->getHtml(), array(
        'catName' => $ob->catName,
        'catText' => $ob->catText
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
