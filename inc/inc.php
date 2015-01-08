<?php
error_reporting(E_ALL);
session_start();

require_once('PHPMailer/PHPMailerAutoload.php');

function my_autoload($className) {
    require_once __DIR__ . DIRECTORY_SEPARATOR . $className . '.php';
}
/*
define('DB_HOST', 'mysql.hostinger.ru');
define('DB_USER', 'u230910915_root');
define('DB_PASSWORD', 'Blackpearl99');
define('DB_NAME', 'u230910915_study');*/


define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', 'Blackpearl99');
define('DB_NAME', 'study3');

define('CHAR_SET', 'UTF-8');
define('SMTP_SEC', 'ssl');
define('MAIL_HOST', 'smtp.yandex.ru');
define('MAIL_PORT', 465);
define('MAIL_USERNAME', 'al.oz2015@yandex.ru');
define('MAIL_PASSWORD', 'Paradise90');

define('ID_ADMIN', 1);

spl_autoload_register('my_autoload');

$db = new DB();
$templ = new Template();
$ob = new FormData();


if(empty($_SESSION['userName'])){
    $login = "<div align='right'><a href='./login.php'>Авторизация</a> <a href='./registration.php'>Регистрация</a></div>";
} else{
    $login = "<div align='right'><a href='profile.php'>".$_SESSION['userName']."</a> <a href='logout.php'>Выйти</a></div>";
}