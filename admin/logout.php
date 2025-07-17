<?php
session_start();
session_destroy();

setcookie("admin_token", "", time() - 3600, "/");

header("Location: admin_login.php");
exit();
?>
