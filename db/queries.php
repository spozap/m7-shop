<?php
    
    include_once("dbConfig.php");

    function verifyUser($user,$password){
        $connection = getConnection();
        if(!$connection){
            return false;
        }

        $query = $connection->prepare("SELECT `id`,`username`,`password` FROM customer WHERE `username`=? AND `password`=?");
        $query->bind_param("ss",$user,$password);
        $query->execute();

        if ($query->affected_rows === 0){
            $connection->close();
 
            return false;
         }

        $query->bind_result($id,$username,$passwd);
        while($query->fetch()){
            session_start();
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $passwd;
            break;

        }
        $connection->close();

        header('Location:main.php');
        return true;
    }

    function registerUser($user,$password,$email){
        $connection = getConnection();

        if (!$connection){
            return false;
        }
        $query = $connection->prepare("INSERT INTO `customer`(`username`,`password`,`email`) VALUES (?,?,?)");
        $query -> bind_param("sss",$user,$password,$email);
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
        $_SESSION['password'] = $password;
        $_SESSION['email'] = $email;


        $connection->close();

        header('Location:main.php');
        return true;

    }

?>