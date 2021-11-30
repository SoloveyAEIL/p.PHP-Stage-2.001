<?php
// login page template


    if (isset($_POST['submit'])) {
        $user = login($_POST['login'], $_POST['password']);
        if ($user) {
            $user = $user[0];
            $hash = md5(generateCode(10));
            $ip = null;
            // запись инфор. в куки
            if (!empty($_POST['ip'])) {             // проверка, поставленна ли галочки на checkbox'е
                $ip = $_SERVER['REMOTE_ADDR'];      // получение ip пользователя
            }
            updateUser($user['id'], $hash, $ip);    // обновление пользоателя по данным
            // сохраняем куки. (--файлы, котор генерир сервр и отдает в браузер).
            //! привязка идет к хосту
            setcookie('id', $user['id'], time()+60*60*24*30, "/");   // 
            setcookie('hash', $hash, time()+60*60*24*30, "/");
            header("Location: /admin");             // после входа, делаем отправку на гл.станицу
            exit();
        }
    
    } else {
        null;
        // echo "Не верно введен логин или пароль";
    }


?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ВзВход в личный кабинет</title>
</head>
<body>
<h2>Авторизация</h2>
<hr>
<a href="/">Главная страница</a>
<div class="log">
<form method="POST">
    <p>Login: <input id="p_log" type="text" name="login" required></p>
    <p>Password: <input type="password" name="password" required></p>
    <p>Приклеплять к IP: <input type="checkbox" name="ip"></p>
    <input id="inp_log" type="submit" name="submit" value="Войти">
</form>
</div>

<style>
    h2 {
        text-align: center;
    }
    a {
        margin-left: 75%;
    }
    .log {
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
    #p_log {
        margin-left: 47px;
    }
    #inp_log {
        margin-left: 40%;
    }
</style>
</body>
</html>
