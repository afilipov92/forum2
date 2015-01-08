<?php

class Utility{

    public static function isAdmin(){
        return isset($_SESSION['idStatus']) && $_SESSION['idStatus'] == ID_ADMIN;
    }

    public static  function isUser(){
        return isset($_SESSION['userName']);
    }

    public static function checkActivation($result, $db){
        if($result){
            $db->updateHashDB($result['id']);
            return "Ваша учетная записать активирована<br/><a href='index.php'>Перейти на главную страницу</a>";
        } else{
            return "Ошибка активации учетной записи";
        }
    }

    public static function getUrl($url = "./index.php", array $data = array()){
        if(!empty($data)) {
            $url .= '?';
            foreach ($data as $key => $a) {
                $url .= $key.'='.$a.'&';
            }
            $url = rtrim($url, '&');
        }
        return $url;
    }
}