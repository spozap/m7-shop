<?php

include_once("dbConfig.php");

$connection = getConnection();
if (!$connection){
    return;
}

$query = $connection->prepare("SELECT `id`,`username`,`email`,`lat`,`lng` FROM `customer`");
$query -> execute();

$users = array();

$pre = $query -> get_result();

while($user = $pre->fetch_assoc()){


    array_push($users,$user);

} 

$connection -> close();

echo json_encode($users);

?>