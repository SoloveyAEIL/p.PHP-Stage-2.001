<?php
require_once 'config/db.php';
require_once 'core/db_function.php';
require_once 'core/function.php';

$conn = connect();

$route = $_GET['route']; // NULL!
$route = explodeURL($route);
// var_dump(explodeURL($route));

switch ($route) {
    case ($route[0] == ''):
        $query = 'SELECT * from info';
        $result = select($query);
        require_once 'template/main.php';
        break;
    case ($route[0] == 'article' AND isset($route[1])):
        $url = $route[1];
        $result = getArticle($url);
        require_once 'template/article.php';
        break;
    case ($route[0] == 'cat' AND isset($route[1])):
        $url = $route[1];
        $cat = getCategory($url);
        $result = getCategoryArticle($cat['id']);
        require_once 'template/cat.php';
        break;
    default:
        require_once 'template/404.php';
}