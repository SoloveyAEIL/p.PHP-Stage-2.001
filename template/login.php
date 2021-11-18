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
} else echo "Не верно введен логин или пароль";
?>

<a href="http://projectz.by">Вернуться на главную страницу</a>
<h2>Авторизация</h2>
<hr>
<form method="POST">
    Login: <input type="text" name="login" required><br>
    Password: <input type="text" name="password" required><br>
    Приклеплять к IP: <input type="checkbox" name="ip"><br>
    <input type="submit" name="submit" value="Войти">
</form>