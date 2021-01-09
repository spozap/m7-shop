<?php
        include_once('../common/header.php');

        if (!isLogged()){
            header('Location: main.php');
        }
?>

<h1> MIS PRODUCTOS </h1>
<div class="my-products">
    <?php showMyProducts(); ?>
</div>