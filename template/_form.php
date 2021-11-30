<!-- enctype='multipart/form-data тип кодировки, который позволяет отправлять файлы через POST . Проще говоря, без этой кодировки файлы не могут быть отправлены через POST . Если вы хотите разрешить пользователю загружать файл через форму, вы должны использовать этот enctype . -->
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма</title>
</head>
<body>
    

<div class="main_form">
<form action="" method="POST" enctype="multipart/form-data">
    <p> Title(название): <input type="text" name="title" value="<?php echo $result['title']; ?>"></p>
    <p> URL: <input id="inp_url" type="text" name="url" value="<?php echo $result['url']; ?>"></p>
    <p> min descr(жанр): <textarea cols="50" rows="2" name="descr_min"><?php echo $result['descr_min']; ?></textarea></p>
    <p> Descr(описание): <textarea cols="50" rows="7" name="description"><?php echo $result['description']; ?></textarea></p>
    <p>Category(категория):
        <select id="sel_cat" name="cid">
            <?php
                $out = "";
                for ($i =0; $i < count($category); $i++) {
                    //
                    if ($category[$i]['id'] === $result['cid']) {
                        $out .= '<option value="'.$category[$i]['id'].'" selected>'.$category[$i]['title']."</option>";
                    } else $out .= '<option value="'.$category[$i]['id'].'">'.$category[$i]['title']."</option>";
                }
                echo $out;
            ?>
        </select>
    </p>
    <p>Photo(Лого): <input type="file" name="image" value="<?php echo $result['image']; ?>"></p>
    <?php
        if (isset($result['image']) AND $result['image'] !="") {
            echo '<img src="/static/images/'.$result['image'].'" style="wigth:150px">';
        }
    ?>
    <p><input type="submit" name="submit" value="<?php echo $action; ?>"></p>
</form>
</div>
<hr>
<a style="margin-left: 60%;" href="/">Главная страница</a>

<style>
    .main_form {
        margin: 2% 25%;
    }
    p {
        font-weight: bold;
    }
    input {
        margin-left: 145px;
    }
    textarea {
        margin-left: 5%;
    }
    #inp_url {
        margin-left: 220px;
    }
    #sel_cat {
        margin-left: 100px;
    }
</style>

</body>
</html>