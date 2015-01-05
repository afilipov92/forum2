<?php

require_once('inc/inc.php');

$pageTpl = Template::getTemplate('index');
$catTpl = Template::getTemplate('cat');
$user = "alex";
$msg = "";
if($user == "alex"){
   $templ->setHtml("<form method=\"GET\" action=\"./addCat.php\">
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
    'CAT' => $templ->getList()
   // 'PAG' => $objPage->getPag()
));
echo $page;