<?php
require_once('inc/inc.php');

Form::getActivateData($ob);
$result = $db->getHashDB($ob->userName, $ob->hash);
if($result){
    $db->updateHashDB($result['id']);
    echo "Ваша учетная записать активирована";
}
else{
    echo "Ошибка активации учетной записи";
}