<?php
// admin delete page template

    if (!getUser()) {
        header ("Location: /login");
    }

?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ Панель</title>
</head>
<body>
<style>
    h1 {
        text-align: center;
    }
    .block_main2 {
        border: solid 1px black;
        margin: 10px 50px;
        padding: 1% 3%;
    }
    .block_a {
        text-align: center;
    }
    #main_title {
        font-weight: bold;
        padding-left: 5%;
    }

</style>

<h1>Admin panel</h1>
<hr>
<div style="text-align: center;">
    <a href="/admin/create">Create block</a>
    <a href="/logout" style="padding-left: 5%;" >Logout</a>
    <a href="/" style="padding-left: 15%;">На главную страницу</a>
</div>

<div>
    <?php echo main_block_admin() ?>
</div>
</body>
</html>