<?php
// register page template


if (isset($_POST['submit'])) {
    $err =[];
    if (strlen($_POST['login']) < 4 OR strlen($_POST['login'] > 30)) {
        $err[] = "Логин должен из не менее 4ех символов, и не более 30";
    }
    /////////////////   проверка на уникальность логина
    if ( isLoginExist($_POST['login'])) {
        $err[] = "Такой логин уже существует";
    }
    if (count($err) === 0) {
        createUser($_POST['login'], $_POST['password']);
        header ('Location: /login');
        exit();
    } else {
        echo "<h4>Ошибка при регистрации</h4>";
        foreach ($err as $error) {
            echo $error."<br>";
        }
    }
}

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
</head>
<body>
<h2>Регистрация</h2>
<hr>
<a href="/">Главная страница</a>
<div class="reg">
<form method="POST">
    <p>Login: <input id="p_reg" type="text" name="login" required></p>
    <p>Password: <input type="password" name="password" required></p>
    <input id="inp_reg" type="submit" name="submit" value="Регистрация">
</form>
</div>

<style>
    h2 {
        text-align: center;
    }
    a {
        margin-left: 75%;
    }
    .reg {
        border: solid 1px black;
        margin: 5% 15%;
        padding: 1% 20%;
    }
    p {
        font-weight: bold;
    }
    input {
        margin-left: 20px;
    }
    #p_reg {
        margin-left: 47px;
    }
    #inp_reg {
        margin-left: 35%;
    }
</style>
</body>
</html>
