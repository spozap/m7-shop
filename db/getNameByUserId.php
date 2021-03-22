<?php

include_once("dbConfig.php");

function getNameByUserId($id){
    $connection = getConnection();
    if (!$connection){
        return;
    }
    $query = $connection->prepare("SELECT `username` FROM `customer` WHERE ID=? LIMIT 1");
    $query-> bind_param("i",$id);
    $query -> execute();         

    if ($query -> affected_rows === 0){
        $connection->close();
        return;
    }
    $query->bind_result($name);
    while($query->fetch()){
        $connection->close();
        return $name;
    } 
}

?>