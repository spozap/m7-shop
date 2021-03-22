<?php

include_once("dbConfig.php");

function insertProduct($userId,$name,$description,$img,$category,$price){
    $connection = getConnection();
    
    if (!$connection){
        return false;
    }
    $query = $connection->prepare("INSERT INTO `products`(`user_id`,`name`,
    `description`,`images`,`categoria`,`precio`) VALUES (?,?,?,?,?,?)");
    $query -> bind_param("issssi",$userId,$name,$description,$img,$category,$price);
    $query -> execute();
    
    if ($query->affected_rows === 0){
        $connection->close();
        return false;
    }

    echo "PRODUCTO INSERTADO OK";

    return true;
}

?>