<?php

require_once('inc/inc.php');

$pageTpl = Template::getTemplate('index');
$themeTpl = Template::getTemplate('theme');
$msg = "";


$catid = Form::getCatId();
if($catid){
    $selectTheme = $db->requestSelectTheme($catid);
    if($selectTheme){
        $templ->setListTheme($themeTpl, $selectTheme);
    }
    if(Utility::isUser()){
        $templ->setHtml("<form method=\"GET\" align=\"right\" action=\"addTheme.php\">
                     <input type=\"hidden\" name=\"id_cat\" value=\"".$catid."\"/>
                    <input type=\"submit\" name=\"submit\" value=\"Добавить тему\"/>
                    </form>"
        );
    }
}

$page = Template::processTemplace($pageTpl, array(
    'FORM' => $templ->getHtml(),
    'MSG' => $msg,
    'CAT' => '<div class="list-cat">'.$templ->getList().'</div>',
    'THEME' => '<div class="list-theme">'.$templ->getList().'</div>',
    'LOGIN' => $login,
    'TITLE-CAT' => '<div class="list-name">Темы</div>',
));
echo $page;