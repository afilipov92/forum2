<?php // Example 26-12: logout.php
  require_once 'inc/inc.php';

  if (isset($_SESSION['userName'])){
      destroySession();
      echo "<div class='main'>You have been logged out. Please " .
      "<a href='login.php'>click here</a> to proceed for login screen.";
  } else
        echo "<div class='main'><br>" .
        "You cannot log out because you are not logged in";