<?php
require('config/dbconnect.php');
session_start();
unset($_SESSION['username']);
session_destroy();
header('Location: auth.php');
exit;
?>