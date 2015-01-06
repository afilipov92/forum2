<?php

require_once('inc/inc.php');

$pageTpl = Template::getTemplate('index');
$catTpl = Template::getTemplate('cat');
$msg = "";

if(!empty($_SESSION['idStatus']) && $_SESSION['idStatus'] == 1){
   $templ->setHtml("<form method=\"GET\" action=\"addCat.php\">
                    <input type=\"submit\" name=\"submit\" value=\"Добавить категорию\"/>
                    </form>"
   );
}

$selectCat = $db->requestSelectCat();
if($selectCat){
    $templ->setListCat($catTpl, $selectCat);
}

$page = Template::processTemplace($pageTpl, array(
    'FORM' => $templ->getHtml(),
    'MSG' => $msg,
    'CAT' => $templ->getList(),
    'LOGIN' => $login
));
echo $page;