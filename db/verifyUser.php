<?php

include_once("dbConfig.php");

function verifyUser($user,$password){
    $connection = getConnection();
    if(!$connection){
        return false;
    }

    $query = $connection->prepare("SELECT `id`,`username`,`password` FROM `customer` WHERE `username`=? LIMIT 1");
    $query->bind_param("s",$user);
    $query->execute();

    $query->store_result();

    if ($query->num_rows === 0){
        $connection->close();

        return false;
     }

    $query->bind_result($id,$username,$passwd);
    while($query->fetch()){

        if (password_verify($password,$passwd)){
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $passwd;
            
            $connection->close();

            header('Location:main.php');

            return true;
        } else {
            return false;
        }

    }

    return false;
}

?>