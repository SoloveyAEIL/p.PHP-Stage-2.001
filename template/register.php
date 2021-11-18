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
<a href="http://projectz.by">Вернуться на главную страницу</a>
<h2>Регистрация</h2>
<hr>
<form method="POST">
    Login: <input type="text" name="login" required><br>
    Password: <input type="text" name="password" required><br>
    <input type="submit" name="submit" value="Регистрация">
</form>