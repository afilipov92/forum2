<?php

require_once('inc/inc.php');

$pageTpl = Template::getTemplate('index');
$catTpl = Template::getTemplate('cat');
$msg = "";

if(Utility::isAdmin()){
   $templ->setHtml("<form method=\"GET\" align=\"right\" action=\"addCat.php\">
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
    'CAT' => '<div class="list-cat">'.$templ->getList().'</div>',
    'LOGIN' => $login,
	'TITLE-CAT' => '<div class="list-name">Категории</div>'
));
echo $page;