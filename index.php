<?php

ob_start();
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

$str = ob_get_clean();

$str = preg_replace('/addCat\.php/', 'addCat', $str);
$str = preg_replace('/profile\.php/', 'profile', $str);
$str = preg_replace('/logout\.php/', 'logout', $str);
$str = preg_replace('/login\.php/', 'login', $str);
$str = preg_replace('/registration\.php/', 'registration', $str);
$str = preg_replace('/cat\.php\?id_cat=(\d+)/', 'cat-$1', $str);
echo $str;