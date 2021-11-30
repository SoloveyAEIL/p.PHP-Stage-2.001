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

    // проверка в админ панеле, на юзера
function getUser() {
    if (isset($_COOKIE['id']) AND isset($_COOKIE['hash'])) {
        $query = "SELECT id, login, hash, INET_ATON(ip) as ip FROM users WHERE id=".intval($_COOKIE['id'])." LIMIT 1";
        $user = select($query);     // проверка, есть ли user с таким id
        // проверка, есть ли user такой в БД
        if (count($user) === 0) {
            return false;
        } else {
            $user = $user[0];   // есть такой user
            // проверка совпадение hash and cookie
            if ($user['hash'] !== $_COOKIE['hash']) {
                clearCookies();
                return false;
            }
            // проверка по ip
            if (!is_null($user['ip'])) {
                if ($user['ip'] !== $_SERVER['REMOTE_ADDR']) {
                    clearCookies();
                    return false;
                }
            }
            $_GET['login'] = $user['login'];
            return true;
        }
    } else {
        clearCookies();
        return false;
    }
}

    // очистка кукки
function clearCookies() {
    setcookie('id', "", time()-60*60*24*30, "/");  
    setcookie('hash', "", time()-60*60*24*30, "/", null, null, true);       // просмотреть параметры!!!
    unset($_GET['login']);         // удаление()
}


    // добавление через admin create
function createArticle($title, $url, $descr_min, $description, $cid, $image) {
    $query = "INSERT INTO info (title, url, descr_min, description, cid, image) VALUES('".$title."', '".$url."', '".$descr_min."', '".$description."', ".$cid.", '".$image."' )";
    return execQuery($query);
}

    // update чепез admin 
function updateArticle($id, $title, $url, $descr_min, $description, $cid, $image) {
    global $id;
    $query = "UPDATE info SET title='".$title."', url='".$url."', descr_min='".$descr_min."', description='".$description."', cid=".$cid.", image='".$image."' WHERE id=".$id;
    return execQuery($query);
}

    // logout
function logout() {
    clearCookies();             // очитска кукки
    header("Location: /");      // вывод наглавную страницу
    exit;
}

///////////////////////////////////////////////////////////////// блоки

function main_block() {
    global $result;
    $out = '';
    for($i=0; $i < count($result); $i++) {
        $out .="<div class='block_main2'>";
        $out .="<h4>".$result[$i]['title']."</h4>";
        $out .="<p class='p_disp'>".$result[$i]['descr_min']."</p>";
        $out .='<img src="/static/images/'.$result[$i]['image'].'" height="120" width="120" >';
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
        $out .='<img src="/static/images/'.$result['image'].'" height="250" width="210" >';
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

function main_block_admin() {
    global $result;
    $out = '';
    for($i=0; $i < count($result); $i++) {
        $out .="<div class='block_main2'>";
        $out .="<p id='main_title'>".$result[$i]['title']."</p>";
        $out .='<img src="/static/images/'.$result[$i]['image'].'" 
        height="100" width="100" >';
        $out .="<p class='disp'>".$result[$i]['description']."</p>";
        $out .='<div class="block_a"><a href="/admin/delete/'.$result[$i]['id'].'" onclick="return confirm(\'точно?\')">Удалить</a>';
        $out .='<a style="padding-left: 5%" href="/admin/update/'.$result[$i]['id'].'" >Обновить</a></div>';
        $out .="</div>";
    }
    echo $out;
}