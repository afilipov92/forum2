<?php
require_once('inc/inc.php');

Form::getActivateData($ob);
$result = $db->getHashDB($ob->userName, $ob->hash);
if($result && $result['hash'] != 'actived'){
    $db->updateHashDB($result['id']);
    echo "Ваша учетная записать активирована<br/><a href='index.php'>Перейти на главную страницу</a>";
}
else{
    echo "Ошибка активации учетной записи";
}