<?php

include_once("dbConfig.php");
include_once("getNameByUserId.php");

$id = $_GET['product_id'];

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


$product = array();

while($query -> fetch()){
    
    //array_push($products , $product);
    $product = [
        "id" => $id,
        "user_id" => $user_id,
        "name" => $name,
        "description" => $description,
        "images" => $images,
        "category" => $category,
        "price" => $price,
        "createdAt" => $createdAt,
        "visits" => $visits
    ];
} 

$connection -> close();

echo json_encode($product);



?>