<?php

include_once("dbConfig.php");

function showMyProducts(){

    $connection = getConnection();

    if (!$connection) { return; }
    if (isset($_SESSION['id'])){ $id = $_SESSION['id'];}

    $query = $connection ->prepare("SELECT * FROM `products` WHERE user_id=?");
    $query -> bind_param("i",$id);
    $query-> execute();

    if ($query -> affected_rows === 0){
        $connection->close();
        return;
    }

    $query->bind_result($id,$user_id,$name,$description,$images,$category,$price,$createdAt,$visitas);

    while($query->fetch()){
        
        echo "<div class='card product' style='width: 18rem;'>";
        $image = explode("\n",$images);
        for($i = 0;$i < count($image);$i++){
            echo "   <img class='card-img-top' src='$image[$i]' alt='Card image cap'>";
        }
        echo "   <div class='card-body'>".
        "       <h5 class='card-title'>$name</h5>".
        "         <p class='card-text'>$description</p>".
        "         <p class='card-text'>Precio: $price</p>".
        "         <p class='card-text'>Publicado: $createdAt</p>".
        "         <a href='myProducts.php?remove_product=$id' class='btn btn-primary'>Eliminar producto </a>".
        "         <a href='editMyProduct.php?id=$id' class='btn btn-primary'>Editar Producto </a>".
        "       <p class='card-text'></p>".
        "</div></div>";

    } 

}

?>