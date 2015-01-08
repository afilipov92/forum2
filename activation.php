<?php
require_once('inc/inc.php');

Form::getActivateData($ob);
$result = $db->getHashDB($ob->userName, $ob->hash);
echo Utility::checkActivation($result, $db);