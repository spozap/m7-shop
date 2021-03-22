<?php

include_once("dbConfig.php");

function getProductinfo($id){

    $connection = getConnection();

    if(!$connection){
        return false;
    }

    $query = $connection->prepare("SELECT * FROM `products` WHERE ID =?");
    $query-> bind_param("i",$id);
    $query -> execute();        

    if ($query -> affected_rows === 0){
        $connection->close();
        return;
    }

    $query->bind_result($id,$user_id,$name,$description,$images,$category,$price,$createdAt,$visits);

    while($query->fetch()){
        
        echo "<h1> Nombre del producto : $name </h1> ";
        echo "<h2> Subido por: ".getNameByUserId($user_id)."</h2>";
        echo "<p> Descripción </br> $description</p>";
        echo "<p> Categoria: $category</p>CATEGORY";
        echo "<p class='card-text'>Precio: $price</p>";
        echo "<p class='card-text'>Publicado: $createdAt</p>";

        $image = explode("\n",$images);

        for($i = 0;$i < count($image);$i++){
            echo "   <img class='card-img-top' src='$image[$i]' alt='Card image cap'>";
        }

    } 

    $connection -> close();


}

?>