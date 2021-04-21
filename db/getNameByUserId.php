<?php

include_once("dbConfig.php");

$id = $_GET['id'];

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

$name = array();

while($query->fetch()){

    $name = [
        "name" => $name
    ];
    
}

$connection->close();

echo json_encode($name);

?>