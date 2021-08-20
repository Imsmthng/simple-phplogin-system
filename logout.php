<?php
if(!isset($_SESSION)){
  session_start();
}

unset($_SESSION['authenticated']);
unset($_SESSION['admin_authenticated']);
unset($_SESSION['auth_user']);
unset($_SESSION['auth_admin']);

$_SESSION['status'] = "Logged Out";
header("Location:index.php");

?>
