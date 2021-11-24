<?php
// update page template

// var_dump($result);
$action = "Update";


if (isset($_POST['submit'])) {
    $title = trim($_POST['title']);
    $url = trim($_POST['url']);
    $descr_min = trim($_POST['descr_min']);
    $description = trim($_POST['description']);
    $cid = $_POST['cid'];

    // если картинка умееться в БД, то по умолчанию она и стоит в update
    if (isset($_FILES['image']['tmp_name']) AND $_FILES['image']['tmp_name'] != '') {
        move_uploaded_file($_FILES['image']['tmp_name'], 'static/images/'.$_FILES['image']['name']);
        $image = $_FILES['image']['name'];
    } else $image = $result['image'];

    $id = $route[2];

    $update = updateArticle($id, $title, $url, $descr_min, $description, $cid, $image);
    // проверка, выполн ли update в БД
    if ($update) {
        setcookie("alert", "update ok", time()+60*10);
        // после update обовляемся и остаемся на этой же странице
        header('Location: '.$_SERVER['REQUEST_URI']);
    } else {
        setcookie("alert", "update error", time()+60*10);
    }
    // обновляем строку если происходит ошибка (так происходит вывод, без JS)
}
// при кукки ошибке:
if (isset($_COOKIE['alert'])) {
    $alert = $_COOKIE['alert'];
    setcookie("alert","", time()-60*10);
    unset($_COOKIE['alert']);
    echo $alert;
}
?>

<h1>Update:</h1>
<a href="/admin">Back</a>
<?php require_once '_form.php'; ?>
