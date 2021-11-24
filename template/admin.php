<?php
// admin delete page template

    if (!getUser()) {
        header ("Location: /login");
    }

?>

<h1>Admin panel</h1>
<hr>
<div style="text-align: center;">
    <a href="/admin/create">Create block</a>
    <a href="/logout" style="padding-left: 5%;" >Logout</a>
    <a href="http://projectz.by" style="padding-left: 15%;">На главную страницу</a>
</div>

<div>
    <?php echo main_block_admin() ?>
</div>