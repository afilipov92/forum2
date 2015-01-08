<?php

class Utility{

    /**
     * провряет является ли пользователь админом
     * @return bool
     */
    public static function isAdmin(){
        return isset($_SESSION['idStatus']) && $_SESSION['idStatus'] == ID_ADMIN;
    }

    /**
     * проверяет есть ли в сессии имя пользователя
     * @return bool
     */
    public static  function isUser(){
        return isset($_SESSION['userName']);
    }

    /**
     * проверка активации
     * @param $result
     * @param $db
     * @return string
     */
    public static function checkActivation($result, $db){
        if($result){
            $db->updateHashDB($result['id']);
            return "Ваша учетная записать активирована<br/><a href='index.php'>Перейти на главную страницу</a>";
        } else{
            return "Ошибка активации учетной записи";
        }
    }

    /**
     * преобразует url
     * @param string $url
     * @param array $data
     * @return string
     */
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