<?php

 $connection = new mysqli('localhost','root','','m7-shop');
 if ($connection){
    echo "conectado con bbdd";
    $response = $connection->query("SELECT * FROM Customer");
    echo $response->num_rows;

 }

?>