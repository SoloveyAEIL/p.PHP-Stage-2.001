<?php
// create page template

$action = "Create";

if (isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    $url = trim($_POST['url']);
    $descr_min = trim($_POST['descr_min']);
    $description = trim($_POST['description']);
    $cid = $_POST['cid'];

    // делаем загрузку картинки сразу на сервер, перед отправкой. копирует файл из временной папки с ее же именем
    move_uploaded_file($_FILES['image']['tmp_name'], 'static/images/'.$_FILES['image']['name']);
    $image = $_FILES['image']['name'];

    $create = createArticle($title, $url, $descr_min, $description, $cid, $image);
    // проверка, выполн ли загрузка в БД
    if ($create) {
        header('Location: /admin');
    } else {
        setcookie("alert", "create error", time()+60*10);
    }
    // обновляем строку если происходит ошибка (так происходит вывод, без JS)
    if (isset($_COOKIE['alert'])) {
        $alert = $_COOKIE['alert'];
        setcookie("alert","", time()-60*10);
        unset($_COOKIE['alert']);
        echo $alert;
    }
} else {
    // создаем массив пустых значений, для читаемости
    $result = array(
        "title" => "",
        "url" => "",
        "descr_min" => "",
        "description" => "",
        "cid" => "",
        "image" => ""
    );
}
?>

<h1 style="text-align: center;">Create:</h1>
<hr>
<a style="margin-left: 75%" href="admin/">Back</a>
<?php require_once '_form.php'; ?>