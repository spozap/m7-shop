<?php

    include_once('../common/header.php');


    if(isset($_GET['product_id'])){
        $id = $_GET['product_id'];
    }

?>

<div class="product-container">

    <?php

        getProductinfo($id);

    ?>

</div>