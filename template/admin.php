<?php
// main page template

    if (!getUser()) {
        header ("Location: /login");
    }

?>

<h1>Admin panel</h1>

<div>
    <?php echo main_block_admin() ?>
</div>