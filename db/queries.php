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


        echo "ASDASDAS".$query->num_rows;
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

    function selectProductsPaginator(){
        $connection = getConnection();

        if (!$connection){
            return false;
        }

        $query = $connection->prepare("SELECT * from `products`");
        $query -> execute();
        $query -> store_result();

        if ($query -> num_rows === 0){
            return;
        }
        
        $pages = ceil($query -> num_rows / 10);
        echo "<ul class='pagination'>";
        for($i = 1;$i<=$pages;$i++){
            echo "<li class='page-item'><a class='page-link' href='main.php?id=$i'>$i</a></li>";
        }
        echo "</ul>";
        
        $connection -> close();

    }

    function showMyProducts(){

        $connection = getConnection();

        if (!$connection) { return; }
        if (isset($_SESSION['id'])){ $id = $_SESSION['id'];}

        $query = $connection ->prepare("SELECT * FROM `products` WHERE user_id=?");
        $query -> bind_param("i",$id);
        $query-> execute();

        if ($query -> affected_rows === 0){
            $connection->close();
            return;
        }

        $query->bind_result($id,$user_id,$name,$description,$images,$category);

        while($query->fetch()){
            
            echo "</br>";
            echo $id;
            echo $user_id;
            echo $name;
            echo $description;
            echo $images;
            echo $category;
            echo "</br>";
        } 

    }

    function showPaginatedProducts($id){
        
        $connection = getConnection();

        if (!$connection){ return; }

        $from = ($id - 1)* 10;

        $query = $connection->prepare("SELECT * FROM `products` LIMIT ?,10");
        $query-> bind_param("i",$from);
        $query -> execute();

        if ($query -> affected_rows === 0){
            $connection->close();
            return;
        }

        $query->bind_result($id,$user_id,$name,$description,$images,$category);

        while($query->fetch()){
            
            echo "</br>";
            echo $id;
            echo $user_id;
            echo $name;
            echo $description;
            echo $images;
            echo $category;
            echo "</br>";
        } 

        $connection -> close();


    }

?>