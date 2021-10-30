<?php
$hostname="192.168.1.68:3306";
$username="denilai";
$password="12345";
$dbname="cycle";

$connect = mysqli_connect($hostname, $username, $password, $dbname) or die ("html>script language='JavaScript'>alert('Не удается подключиться к базе данных. Повторите попытку позже.'),history.go(-1)/script>/html>");