<?php
error_reporting(E_ALL);
session_start();

require_once('PHPMailer/PHPMailerAutoload.php');

function autoload($className) {
    require_once __DIR__ . DIRECTORY_SEPARATOR . $className . '.php';
}
/*
define('DB_HOST', 'mysql.hostinger.ru');
define('DB_USER', '-------');
define('DB_PASSWORD', '---------');
define('DB_NAME', '--------------');*/


define('DB_HOST', 'localhost');
define('DB_USER', '-----------');
define('DB_PASSWORD', '------------');
define('DB_NAME', '---------');

define('CHAR_SET', 'UTF-8');
define('SMTP_SEC', 'ssl');
define('MAIL_HOST', 'smtp.yandex.ru');
define('MAIL_PORT', 465);
define('MAIL_USERNAME', 'al.oz2015@yandex.ru');
define('MAIL_PASSWORD', '---------------');

define('ID_ADMIN', 1);
define('ID_USER', 2);

spl_autoload_register('autoload');

$db = new DB();
$templ = new Template();
$ob = new FormData();


if(empty($_SESSION['userName'])){
    $login = "<div align='right'><a href='".Utility::getUrl('./login.php')."'>Авторизация</a> <a href='".Utility::getUrl('./registration.php')."'>Регистрация</a></div>";
} else{
    $login = "<div align='right'><a href='".Utility::getUrl('profile.php')."'>".$_SESSION['userName']."</a> <a href='".Utility::getUrl('logout.php')."'>Выйти</a></div>";
}
