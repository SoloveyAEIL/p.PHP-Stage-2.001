<!-- enctype='multipart/form-data тип кодировки, который позволяет отправлять файлы через POST . Проще говоря, без этой кодировки файлы не могут быть отправлены через POST . Если вы хотите разрешить пользователю загружать файл через форму, вы должны использовать этот enctype . -->

<form action="" method="POST" enctype="multipart/form-data">
    <p> Title: <input type="text" name="title" value="<?php echo $result['title']; ?>"></p>
    <p> URL: <input type="text" name="url" value="<?php echo $result['url']; ?>"></p>
    <p> min descr: <textarea name="descr_min"><?php echo $result['descr_min']; ?></textarea></p>
    <p> Descr: <textarea name="description"><?php echo $result['description']; ?></textarea></p>
    <p>Category:
        <select name="cid">
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
    <p>Photo: <input type="file" name="image" value="<?php echo $result['image']; ?>"></p>
    <?php
        if (isset($result['image']) AND $result['image'] !="") {
            echo '<img src="/static/images/'.$result['image'].'" style="wigth:150px">';
        }
    ?>
    <p><input type="submit" name="submit" value="<?php echo $action; ?>"></p>
</form>