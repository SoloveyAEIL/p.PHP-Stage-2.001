<?php

    // разбирает url на масс.(для чтения адреса url > работы $route)
function explodeURL($url) {     
    return explode("/", $url);
}

function getArticle($url) {     // обертка над ф.select
    $query = "SELECT * FROM info WHERE url='".$url."'";
    // var_dump(select($query));    // для проверки работоспособности
    return select($query)[0];
}

function getCategory($url) {
    $query = "SELECT * FROM category WHERE url='".$url."'";
    // var_dump(select($query));    // для проверки работоспособности
    return select($query)[0];
}

function getCategoryArticle($cid) {
    $query = "SELECT * FROM info WHERE cid=".$cid;
    // var_dump(select($query));    // для проверки работоспособности
    return select($query);
}

    //  проверка, существ ли пользоваьель (логин)
function isLoginExist($login) {
    $query = "SELECT id FROM users WHERE login='".$login."'";
    $result = select($query);
    // var_dump($result);           //  для проверки работоспособности
    if ( count($result) === 0) return false;
    return true;
}

    // регистрация пользователя
function createUser($login, $password) {
    $password = md5(md5(trim($password)));      // кешируем пароль(дважды) / trim -- удаление спец.символов
    $login = trim($login);
    $query = "INSERT INTO users SET login='".$login."', password='".$password."'";
    return execQuery($query);
}

    // авторизация пользователя
function login($login, $password) {
    $password = md5(md5(trim($password)));      // кешируем пароль(дважды) / trim -- удаление спец.символов
    $login = trim($login);
    $query = "SELECT id, login FROM users WHERE login='".$login."' AND password='".$password."'";
    // var_dump($query);
    $result = select($query);
    if ( count($result) != 0) return $result;
    return false;
}

    // генерация кода для хеша / делать случайные символы
function generateCode($length = 7) {
    $chars = "qazwsxedcrfvtgbyhnujmikolpQAZWSXEDCRFVTGBYHNUJMIKOLP0123456789";
    $code ="";
    $clen = strlen($chars)-1;
    while(strlen($code) < $length) {
        $code.=$chars[mt_rand(0, $clen)];
    }
    return $code;
}

    // обновление пользоателя по данным (ip, hash, id)
function updateUser($id, $hash, $ip) {
    if (is_null($ip)) {                 // проверка, не явл ли ip = 0
        $query = "UPDATE users SET hash='".$hash."' WHERE id=".$id;         // если ip = 0
    } else {
        //  если хотим хранить данн в БД, то пользуемся INET_ATON($ip)
        $query = "UPDATE users SET hash='".$hash."', ip=INET_ATON('".$ip."') WHERE id=".$id;
    }
    return execQuery($query);
}


///////////////////////////////////////////////////////////////// блоки

function main_block() {
    global $result;
    $out = '';
    for($i=0; $i < count($result); $i++) {
        $out .="<div class='block_main2'>";
        $out .="<h4>".$result[$i]['title']."</h4>";
        $out .="<p class='p_disp'>".$result[$i]['descr_min']."</p>";
        $out .="<img src=".$result[$i]['image']." height='100' width='100'>";
        $out .="<p class='disp'>".$result[$i]['description']."</p>";
        $out .='<a href="/article/'.$result[$i]['url'].'
        ">Читать полностью</a>';
        $out .="</div>";
    }
    echo $out;
}

function main_block_article() {
    global $result;
    $out = '';

        $out .="<div class='block_main2'>";
        $out .="<h4>".$result['title']."</h4>";
        $out .="<p class='p_disp'>".$result['descr_min']."</p>";
        $out .="<img src=".$result['image'].">";
        $out .="<p class='disp'>".$result['description']."</p>";
        $out .="</div>";

    echo $out;
}

function main_block_cat() {
    global $cat;
    $out = '';

        $out .="<div class='block_main2'>";
        $out .="<h4>Категория: ".$cat['title']."</h4>";
        $out .="<p class='disp'>Описание: ".$cat['description']."</p>";
        $out .="</div>";

    echo $out;
}
