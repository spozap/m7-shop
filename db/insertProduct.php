<?php

include_once("dbConfig.php");
session_start();

$connection = getConnection();

if (!$connection){
    echo json_encode("No hay conexión con la bbdd!");
}

$userId = $_SESSION['id'];
$name = $_POST['name'];
$description = $_POST['description'];
$category =  $_POST['category'];
$price = $_POST['price'];
$imgs = $_FILES['images'];

$path = "";


if (count($_FILES['images']['name']) > 3){

    echo json_encode(["message" => "PRODUCTO INSERTADO OKKKKKKKKKKK"]);

} else {

    $id = $_SESSION['id'];

    for($i=0;$i<count($_FILES['images']['name']);$i++){
        

        $file = $_FILES['images']['name'][$i];
        $tmpName = $_FILES['images']['tmp_name'][$i];

        if($i == count($_FILES['images']['name']) - 1){
            
            $path.= "../img/products/$id".date("Y_m_d_h_i_sa").($i+1).".png";
            move_uploaded_file($tmpName,"../img/products/$id".date("Y_m_d_h_i_sa").($i+1).".png");
            break; 

        }

        $path.= "../img/products/$id".date("Y_m_d_h_i_sa").($i+1).".png\n"; // Some way to separate images
        move_uploaded_file($tmpName,"../img/products/$id".date("Y_m_d_h_i_sa").($i+1).".png");

    }
}

$query = $connection->prepare("INSERT INTO `products`(`user_id`,`name`,
`description`,`images`,`categoria`,`precio`) VALUES (?,?,?,?,?,?)");
$query -> bind_param("issssi",$userId,$name,$description,$path,$category,$price);
$query -> execute();

if ($query->affected_rows === 0){
    $connection->close();
    echo json_encode(["message" => "NO SE HA INSERTADO"]);
    return;
}
echo json_encode(["message" => "INSERTADO OK"]);
?>