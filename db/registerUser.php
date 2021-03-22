<?php

include_once("dbConfig.php");

function registerUser($user,$password,$email){
    $connection = getConnection();

    if (!$connection){
        return false;
    }

    $pwd = password_hash($password,PASSWORD_DEFAULT);

    $query = $connection->prepare("INSERT INTO `customer`(`username`,`password`,`email`) VALUES (?,?,?)");
    $query -> bind_param("sss",$user,$pwd,$email);
    $id = $connection -> insert_id;
    $query -> execute();
    
    $last_id = mysqli_insert_id($connection); // Getting ID from last Insert

    if ($query->affected_rows === 0){
        $connection -> close();
        return false;
    }

    session_start();

    $_SESSION['id'] = $last_id;
    $_SESSION['username'] = $user;
    $_SESSION['password'] = $pwd;
    $_SESSION['email'] = $email;


    $connection->close();

    header('Location:main.php');
    return true;

}

?>