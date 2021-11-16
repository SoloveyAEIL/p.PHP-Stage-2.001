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
    global $result, $cat;
    $out = '';

        $out .="<div class='block_main2'>";
        $out .="<h4>Категория: ".$cat['title']."</h4>";
        $out .="<p class='disp'>Описание: ".$cat['description']."</p>";
        $out .="</div>";

    echo $out;
}
