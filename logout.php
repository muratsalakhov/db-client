<?php
require('config/dbconnect.php');
unset($_SESSION['username']);
session_destroy();
header('Location: auth.php');
exit;
?>