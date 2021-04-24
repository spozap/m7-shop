<?php

include_once("dbConfig.php");

$connection = getConnection();
if(!$connection){
    echo json_encode(["validated" => false]);
    return;
}

if (isset($_POST['username'],$_POST['password'])){

    $user = $_POST['username'];
    $password = $_POST['password'];

    $query = $connection->prepare("SELECT `id`,`username`,`password` FROM `customer` WHERE `username`=? LIMIT 1");
    $query->bind_param("s",$user);
    $query->execute();
    
    $query->store_result();
    
    if ($query->num_rows === 0){
        $connection->close();
        return;
    }
    
    $query->bind_result($id,$username,$passwd);
    while($query->fetch()){
    
        if (password_verify($password,$passwd)){
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $passwd;
            
            $connection->close();
     
            echo json_encode(["validated" => true]);
            return;
        }
    
    }
    
    echo json_encode(["validated" => false]);
}

echo json_encode(["validated" => false]);

?>