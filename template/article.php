<?php
// article page template

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
    <title>Article</title>
</head>
<body>
    <div>
        <?php echo main_block_article(); ?>
        <a href="/">Вернуться на главную страницу</a>
    </div>
    

<style>
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
    a {
        margin-left: 68%;
    }
</style>
</body>
</html>