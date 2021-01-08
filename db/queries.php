<?php
    
    include_once("dbConfig.php");

    function verifyUser($user,$password){
        $connection = getConnection();
        if(!$connection){
            return false;
        }

        $query = $connection->prepare("SELECT `id`,`username`,`password` FROM customer WHERE `username`=?");
        $query->bind_param("s",$user);
        $query->execute();

        if ($query->affected_rows === 0){
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

    function insertProduct($userId,$name,$description,$img,$category){
        $connection = getConnection();
        
        if (!$connection){
            return false;
        }
        $query = $connection->prepare("INSERT INTO `products`(`user_id`,`name`,
        `description`,`images`,`categoria`) VALUES (?,?,?,?,?)");
        $query -> bind_param("issss",$userId,$name,$description,$img,$category);
        $query -> execute();
        
        if ($query->affected_rows === 0){
            $connection->close();
            return false;
        }

        echo "PRODUCTO INSERTADO OK";

        return true;
    }

?>