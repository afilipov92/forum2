<?php
require_once('inc/inc.php');
//Output page views user profile
$pageTpl = Template::getTemplate('page');
if(!isset($_GET['id']) and isset($_SESSION['userId'])){
    $templ->setHtml(Template::getTemplate('myprofile'));
    $result=$db->requestSelectUserId($_SESSION['userId']);
    if(isset($_GET['tpl'])){
        $templ->setHtml(Template::getTemplate('editprofile'));
    }
} elseif (isset($_GET['id'])) {
    $templ->setHtml(Template::getTemplate('profile'));
    $result=$db->requestSelectUserId($_GET['id']);
} else {
    die('You are not logged in. <a href="login.php">Log in please!</a>');
}
//The page edits data for registered  user
if(Form::isFormSubmitted()){
    Form::getFormData($ob);
    $validateFormResult = Form::isFormVaild($ob, $db);
    if($result['password'] == md5($_POST['oldPassword'])){
        $db->updateUser($ob);
    } else {
        $templ->setHtml($templ->processTemplateErrorOutput($validateFormResult));
    }
}
$msg = "";

$page = Template::processTemplace($pageTpl, array(
    'FORM' => $templ->getHtml(),
    'MSG' => $msg,
    'USERID' => $result['id'],
    'USERNAME' => $result['userName'],
    'USEREMAIL' => $result['userEmail'],
    'EXTINFO' => $result['extInfo'],
    'TPL' => '?tpl=editprofile'
));
echo $page;