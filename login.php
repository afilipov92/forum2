<?php
  require_once 'inc/inc.php';
  $pageTpl = Template::getTemplate('page');
  if(!isset($_SESSION['userName'])){
      $str = "<div id='block'><p align=\"center\"><b>Авторизация</b></p>";
      $error = $user = $pass = "";
      if (isset($_POST['userName'])){
          $user = $_POST['userName'];
          $pass = $_POST['password'];
          if ($user == "" || $pass == "")
              $error = "Not all fields were entered<br>";
          else {
              $result = $db->requestSelectUser($user, md5($pass));
              if (!$result){
                  $error = "<span class='error'>Username/Password invalid</span><br><br>";
              } else {
                  $_SESSION['userName'] = $user;
                  $_SESSION['password'] = $pass;
                  $_SESSION['userId'] = $result['id'];
                  $_SESSION['idStatus'] = $result['id_status'];
                  header('Location: ./index.php');
                  die("You are now logged in. Please <a href='profile.php'>" . "click here</a> to continue.<br><br>");
              }
          }
      }
      $str .= "
          <form method='post' action='login.php'>$error
          <span class='fieldname'>Логин</span><input type='text'
          maxlength='16' name='userName' value='$user'><br>
          <span class='fieldname'>Пароль</span><input type='password'
          maxlength='16' name='password' value='$pass'><br>
          <input type=\"submit\" name=\"submit\" id=\"submit\" value=\"Войти\"><br>
          <a href='registration.php'>Регистрация</a></form></div>";

      $page = Template::processTemplace($pageTpl, array(
          'FORM' => $str,
          'MSG' => ""
      ));
      echo $page;
  }

