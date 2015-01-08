<?php

require_once('inc/inc.php');

$pageTpl = Template::getTemplate('index');
$themeTpl = Template::getTemplate('theme');
$msg = "";

if(Utility::isUser()){
    $templ->setHtml("<form method=\"GET\" align=\"right\" action=\"addTheme.php\">
                    <input type=\"submit\" name=\"submit\" value=\"Добавить тему\"/>
                    </form>"
    );
}

$selectTheme = $db->requestSelectTheme();
if($selectTheme){
    $templ->setListTheme($themeTpl, $selectTheme);
}

$page = Template::processTemplace($pageTpl, array(
    'FORM' => $templ->getHtml(),
    'MSG' => $msg,
    'CAT' => '<div class="list-cat">'.$templ->getList().'</div>',
    'THEME' => '<div class="list-theme">'.$templ->getList().'</div>',
    'LOGIN' => $login,
    'TITLE-CAT' => '<div class="list-name">Катергории</div>',
    'TITLE-THEME' => '<div class="list-name">Темы</div>'
));
echo $page;