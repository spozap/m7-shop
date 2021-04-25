<?php

include_once("dbConfig.php");

if (isset($_GET['id'])){
    $id = $_GET['id'];
} else {
    $id = 1;
}

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


$products = array();

$pre = $query -> get_result();

while($product = $pre->fetch_assoc()){

    array_push($products,$product);

} 

$connection -> close();

echo json_encode($products);

?>