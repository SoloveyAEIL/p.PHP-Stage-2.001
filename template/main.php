<?php
// main page template

// echo '<pre>';
// print_r($result);
?>

<!-- /////////////////////////////////////////// -->

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Фильмы и сериалы</title>
</head>
<body>
    <div class="main_cat">
        <p>Категории:</p>
        <a href="http://projectz.by/cat/films">Фильмы</a>
        <a href="http://projectz.by/cat/serials">Сериалы</a>
        <a id="main_reglog" href="http://projectz.by/register">Регистрация</a>
        <a href="http://projectz.by/login">Авторизация</a>
        <a href="http://projectz.by/admin">Кабинет</a>
    </div>
    <hr>
    <div>
        <?php echo main_block(); ?>
    </div>
<style>
    .main_cat {
        margin: 0 15%;
    }
    .main_cat > a {
        padding-right: 3%;
    }
    #main_reglog {
        padding-left: 44%;
    }

    .block_main2 {
        border: 1px solid black;
        margin: 1% 15%;
        padding: 1% 1%;
    }
    .p_disp {
        margin-top: -20px;
        margin-left: 20px;
        padding-bottom: 10px;
    }
    .block_main2 > a {
        padding-left: 75%;
    }
</style>
</body>
</html>


