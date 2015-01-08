<?php
  require_once 'inc/inc.php';

    if (Utility::isUser()){
        session_destroy();
    }
    header('Location: '.Utility::getUrl());
    die;

