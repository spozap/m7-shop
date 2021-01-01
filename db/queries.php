<?php
    
    include_once("dbConfig.php");

    function verifyUser($user,$password){
        $connection = getConnection();

        if(!$connection){
            return false;
        }

        $query = $connection->prepare("SELECT * FROM Customer WHERE username=? and password=?");
        $query->bind_param("ss",$user,$password);
        $query->execute();
        
        if ($query->affected_rows === 0){
           return true;
        } else {
            return false;
        }

        $connection->close();
    }

    function registerUser($user,$password,$email){
        $connection = getConnection();

        if (!$connection){
            return false;
        }

        $query = $connection->prepare("INSERT INTO `customer`(`username`,`password`,`email`) VALUES (?,?,?)");
        $query -> bind_param("sss",$user,$password,$email);
        $query -> execute();

        if ($query->affected_rows === 0){
            return false;
        }

        header(Location: 'main.php');
        return true;

    }

?>