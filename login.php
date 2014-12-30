<?php
  require_once 'inc/inc.php';
  echo "<div class='main'><h3>Please enter your details to log in</h3>";
  $error = $user = $pass = "";

  if (isset($_POST['userName']))
  {
    $user = sanitizeString($_POST['userName']);
    $pass = sanitizeString($_POST['password']);
    
    if ($user == "" || $pass == "")
        $error = "Not all fields were entered<br>";
    else
    {
      $result = queryMySQL("SELECT user,pass FROM members
        WHERE user='$user' AND pass='$pass'");

      if ($result->num_rows == 0)
      {
        $error = "<span class='error'>Username/Password
                  invalid</span><br><br>";
      }
      else
      {
        $_SESSION['userName'] = $user;
        $_SESSION['password'] = $pass;
        die("You are now logged in. Please <a href='members.php?view=$user'>" .
            "click here</a> to continue.<br><br>");
      }
    }
  }

  echo <<<_END
    <form method='post' action='login.php'>$error
    <span class='fieldname'>Username</span><input type='text'
      maxlength='16' name='userName' value='$user'><br>
    <span class='fieldname'>Password</span><input type='password'
      maxlength='16' name='password' value='$pass'><br>
    <a href='registration.php'>Or click here for registration</a>
_END;
