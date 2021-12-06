<?php
require('config/dbconnect.php');
error_reporting(E_ALL);
ini_set('display_errors', 'On');

if (isset($_POST['username']) and isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM user WHERE username='$username' and password='$password'";
    $result = mysqli_query($connect, $query) or die(mysqli_error($connect));
    $count = mysqli_num_rows($result);
echo $count;
    if($count == 1){
        session_start();
        $_COOKIE['username'] = $username;
        $_SESSION['username'] = $username;
        header("Location: auth.php#success");
    } else {
        header("Location: auth.php#error");
    }
}
if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Kirill ʕ ᵔᴥᵔ ʔ</title>
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,400,700&display=swap&subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
    <link rel="stylesheet" href="css/auth.css" >
</head>
<body>

<div class="main-section">
    <div class="container">
        <form class="form-signin" method="POST">
            <h2>Авторизация </h2>
            <input type="text" name="username" class="form-control" placeholder="Имя" required="" autocomplete="off">
            <input type="password" name="password" class="form-control" placeholder="Пароль" required="" autocomplete="off">
            <button class="submit-btn" type="submit">Войти</button>
        </form>
    </div>
</div>
<div id="error" class="modalbackground">
    <div class="modalwindow">
        <h3>Ошибка!</h3>
        <p>Проверьте введенные данные</p>
        <a href=" ">Закрыть</a>
    </div>
</div>
<div id="success" class="modalbackground">
    <div class="modalwindow">
        <h3>Успешно!</h3>
        <p>Вы успешно авторизировались</p>
        <a href="index.php">Продолжить</a>
    </div>
</div>
<div id="unregistered" class="modalbackground">
    <div class="modalwindow">
        <h3>Ошибка!</h3>
        <p>Авторизуйтесь для работы с сайтом</p>
        <a href=" ">Закрыть</a>
    </div>
</div>
</body>
</html>