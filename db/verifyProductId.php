<?php

include_once("dbConfig.php");

function verifyProductId($id){
    $connection = getConnection();
    if(!$connection){
        return false;
    }

    $query = $connection->prepare("SELECT `id` FROM `products` WHERE id=?");
    $query -> bind_param("i",$id);
    $query -> execute();  
    $query -> store_result();
    
    if ($query -> num_rows === 0){
        $connection->close();
        return false;
    }
    echo "AAAAA";
    $connection->close();
    return true;
}

?>