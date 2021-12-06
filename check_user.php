<?php
session_start();
if (!isset($_SESSION['username']) && !isset($_COOKIE['username'])){
    header('Location: auth.php#unregistered');
}
?>