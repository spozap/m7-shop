<?php

include_once("dbConfig.php");

if(isset($_POST['username'],$_POST['password'],$_POST['email'])){
        
    $user = $_POST['username'];
    $pwd = $_POST['password'];
    $email = $_POST['email'];

    $connection = getConnection();

    if (!$connection){
        echo json_encode(["message" => "RCACAAAA"]);
    }
    
    $pwd = password_hash($pwd,PASSWORD_DEFAULT);
    
    $query = $connection->prepare("INSERT INTO `customer`(`username`,`password`,`email`) VALUES (?,?,?)");
    $query -> bind_param("sss",$user,$pwd,$email);
    $id = $connection -> insert_id;
    $query -> execute();
    
    $last_id = mysqli_insert_id($connection); // Getting ID from last Insert
    
    if ($query->affected_rows === 0){
        $connection -> close();
        echo json_encode(["message" => "CACA"]);
    }
    
    session_start();
    
    $_SESSION['id'] = $last_id;
    $_SESSION['username'] = $user;
    $_SESSION['password'] = $pwd;
    $_SESSION['email'] = $email;
    
    
    $connection->close();
    
    $main = "../views/main.php";
    
    echo json_encode(["message" => "REGISTRADO OK"]);
    return;
}

echo json_encode(["message" => "RELLENA TODOS LOS CAMPOS"]);

?>