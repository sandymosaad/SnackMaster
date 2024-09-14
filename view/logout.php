<?php

error_reporting(E_ALL);
ini_set('display_errors', '1');

session_start();

unset($_SESSION['email']);
unset($_SESSION['User_ID']);
unset($_SESSION['Role']);

session_destroy();

header("Location: login.php");


echo "you are logout";
?>
<a href="login.php">login</a>