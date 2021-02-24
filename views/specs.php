<?php

    include_once('../common/header.php');

    if (!isLogged()){
        header('Location: main.php');
    }
?>

<div class="product-container">

    <?php
        if (isset($_GET['product_id'])){

            $id = $_GET['product_id'];

            echo verifyProductId($id);
            if (!verifyProductId($id)){
                echo "EL PRODUCTO ESPECIFICADO NO EXISTE";
            } else {
                $conn = getConnection();
                if (!$conn){
                    return;
                }

                $query = $conn->prepare("UPDATE `products` SET `visitas` = (SELECT sum(`visitas` + 1) from products WHERE id= ?) WHERE id=?");
                $query -> bind_param("ii",$id,$id);
                $query -> execute();

                if ($query -> affected_rows === 0){
                    $conn -> close();
                }
                //update products set visitas = (SELECT sum(visitas + 1) where id='5') where id='5'
                getProductinfo($id);
            }
        }
    ?>

</div>