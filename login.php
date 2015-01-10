<?php
  ob_start();
  require_once 'inc/inc.php';
  $pageTpl = Template::getTemplate('page');
  if(!Utility::isUser()){
      $str = "<div id='block'><p align=\"center\"><b>Авторизация</b></p>";
      $error = $user = $pass = "";
      if (isset($_POST['userName'])){
          $user = $_POST['userName'];
          $pass = $_POST['password'];
          if ($user == "" || $pass == "")
              $error = "Не все поля формы были заполнены<br>";
          else {
              $result = $db->requestSelectUser($user, md5($pass));
              if (!$result){
                  $error = "<span class='error'>Имя пользователя/Пароль не существует</span><br><br>";
              } else {
                  $_SESSION['userName'] = $user;
                  $_SESSION['password'] = $pass;
                  $_SESSION['userId'] = $result['id'];
                  $_SESSION['idStatus'] = $result['id_status'];
                  header('Location: '.Utility::getUrl());
                  die();
              }
          }
      }
      $str .= "
          <form method='post' action='login.php'>$error
          <span class='fieldname'>Логин&nbsp;&nbsp;&nbsp;:  </span><input type='text'
          maxlength='16' name='userName' value='$user'><br>
          <span class='fieldname'>Пароль&nbsp;: </span><input type='password'
          maxlength='16' name='password' value='$pass'><br>
          <input type=\"submit\" name=\"submit\" id=\"submit\" value=\"Войти\"><br>
          <a href='".Utility::getUrl('registration.php')."'>Регистрация</a></form></div>";

      $page = Template::processTemplace($pageTpl, array(
          'FORM' => $str,
          'MSG' => ""
      ));
      echo $page;
  }

   $str = ob_get_clean();

   $str = preg_replace('/login\.php/', 'login', $str);
   $str = preg_replace('/registration\.php/', 'registration', $str);
echo $str;