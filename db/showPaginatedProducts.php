<?php

include_once("dbConfig.php");

function showPaginatedProducts($id){
        
    $connection = getConnection();

    if (!$connection){ return; }

    $from = ($id - 1)* 10;

    $query = $connection->prepare("SELECT * FROM `products` LIMIT ?,10");
    $query-> bind_param("i",$from);
    $query -> execute();

    if ($query -> affected_rows === 0){
        $connection->close();
        return;
    }

    $query->bind_result($id,$user_id,$name,$description,$images,$category,$price,$createdAt,$visitas);

    while($query->fetch()){
        
        echo "<div class='card product' style='width: 18rem;'>".
        "       <img class='card-img-top' src='".explode("\n",$images)[0]."' alt='Card image cap'>".
        "       <div class='card-body'>".
        "        <h5 class='card-title'>$name</h5>".
        "         <p class='card-text'>$description</p>".
        "         <p class='card-text'>Precio: $price</p>".
        "         <p class='card-text'>Publicado: $createdAt</p>".
        "          <a href='specs.php?product_id=$id' class='btn btn-primary'>+ Info </a>".  
        "      </div></div>";
    } 

    $connection -> close();

}

?>