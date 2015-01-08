<?php
  require_once 'inc/inc.php';

  if (isset($_SESSION['userName'])){
      session_destroy();
      echo "<div class='main'>You have been logged out. Please " .
      "<a href='login.php'>click here</a> to proceed for login screen.</div>";
  } else {
      echo "<div class='main'><br></div>" .
          " cannot log out because you are not logged in";
  }