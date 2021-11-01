<?php
$hostname="localhost";
$username="root";
$password="root";
$dbname="cycle";

$connect = mysqli_connect($hostname, $username, $password, $dbname) or die ("html>script language='JavaScript'>alert('Не удается подключиться к базе данных. Повторите попытку позже.'),history.go(-1)/script>/html>");