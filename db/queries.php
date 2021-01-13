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

    function insertProduct($userId,$name,$description,$img,$category,$price){
        $connection = getConnection();
        
        if (!$connection){
            return false;
        }
        $query = $connection->prepare("INSERT INTO `products`(`user_id`,`name`,
        `description`,`images`,`categoria`,`precio`) VALUES (?,?,?,?,?,?)");
        $query -> bind_param("issssi",$userId,$name,$description,$img,$category,$price);
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

        $query->bind_result($id,$user_id,$name,$description,$images,$category,$price,$createdAt);

        while($query->fetch()){
            
            echo "<div class='card product' style='width: 18rem;'>";
            $image = explode("\n",$images);
            for($i = 0;$i < count($image);$i++){
                echo "   <img class='card-img-top' src='$image[$i]' alt='Card image cap'>";
            }
            echo "   <div class='card-body'>".
            "       <h5 class='card-title'>$name</h5>".
            "         <p class='card-text'>$description</p>".
            "         <p class='card-text'>Precio: $price</p>".
            "         <p class='card-text'>Publicado: $createdAt</p>".
            "       <p class='card-text'></p>".
            "</div></div>";

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

        $query->bind_result($id,$user_id,$name,$description,$images,$category,$price,$createdAt);

        while($query->fetch()){
            
            echo "<div class='card product' style='width: 18rem;'>".
            "       <img class='card-img-top' src='".explode("\n",$images)[0]."' alt='Card image cap'>".
            "       <div class='card-body'>".
            "        <h5 class='card-title'>$name</h5>".
            "         <p class='card-text'>$description</p>".
            "         <p class='card-text'>Precio: $price</p>".
            "         <p class='card-text'>Publicado: $createdAt</p>".
            "          <a href='specs.php?product_id=$id' class='btn btn-primary'>+ Info </a>".  
            "      </div></div>";
        } 

        $connection -> close();

    }

    function getProductinfo($id){

        $connection = getConnection();

        if(!$connection){
            return false;
        }

        $query = $connection->prepare("SELECT * FROM `products` WHERE ID =?");
        $query-> bind_param("i",$id);
        $query -> execute();        

        if ($query -> affected_rows === 0){
            $connection->close();
            return;
        }

        $query->bind_result($id,$user_id,$name,$description,$images,$category,$price,$createdAt);

        while($query->fetch()){
            
            echo "<h1> Nombre del producto : $name </h1> ";
            echo "<h2> Subido por: ".getNameByUserId($user_id)."</h2>";
            echo "<p> Descripción </br> $description</p>";
            echo "<p> Categoria: $category</p>CATEGORY";
            echo "<p class='card-text'>Precio: $price</p>";
            echo "<p class='card-text'>Publicado: $createdAt</p>";

            $image = explode("\n",$images);

            for($i = 0;$i < count($image);$i++){
                echo "   <img class='card-img-top' src='$image[$i]' alt='Card image cap'>";
            }

        } 

        $connection -> close();


    }

    function showProductsMatchingFilters($name,$category,$priceFrom,$priceTo,$order){

        $select = "SELECT * FROM products WHERE";

        $validArgs = array();
        $validTypes = "";

        if (!empty($name)){
            $select.= " name LIKE CONCAT(?,'%') and";
            array_push($validArgs,$name);
        }

        if(!empty($category)){
            $select.=" categoria=? and";
            array_push($validArgs,$category);
        }

        if(!empty($priceFrom) || !empty($priceTo)){
            $select.= " precio BETWEEN ? and ? and";
            array_push($validArgs,$priceFrom);
            array_push($validArgs,$priceTo);
        }

        if (!empty($order)){

            if($order === 'precioasc'){
                $select.= " ORDER BY precio asc";
            } else if($order === 'preciodesc'){
                $select.= " ORDER BY precio desc";
            } else if($order === 'fechaasc'){
                $select.= " ORDER BY creado asc";
            } else if($order === 'fechadesc'){
                $select.= " ORDER BY creado desc";
            }

        }

        $connection = getConnection();

        if(!$connection){
            return false;
        }

        $types = "";

        for($i=0;$i<count($validArgs);$i++){
            if (is_numeric($validArgs[$i])){
                $validTypes.="i";
                continue;
            }

            $validTypes.="s";
        }

        // If there's and AND at the end , remove it
        if (strcmp(substr($select,-3,strlen($select)),"and") == 0){
            $select =  substr($select,0,strlen($select) - 3);
        }

        // In case there is WHERE followed to an Order , remove Where
        if (strpos($select,'WHERE ORDER') !== false) {
            $select = preg_replace("/WHERE ORDER/i","ORDER",$select);
        }

        // In case there is and followed to an Order , remove and
        if (strpos($select,'and ORDER') !== false) {
            $select = preg_replace("/and ORDER/i","ORDER",$select);
        }

        $query = $connection->prepare($select);
        array_unshift($validArgs,$validTypes);

        // Calling to bind_param depending on different valid variables to query properly
        call_user_func_array(array($query,'bind_param'),refValues($validArgs));

        $query -> execute();

        if ($query -> affected_rows === 0){
            $connection -> close();
            return;
        }

        $query->bind_result($id,$user_id,$name,$description,$images,$category,$price,$createdAt);

        while($query->fetch()){
            
            echo "<div class='card product' style='width: 18rem;'>".
            "       <img class='card-img-top' src='".explode("\n",$images)[0]."' alt='Card image cap'>".
            "       <div class='card-body'>".
            "        <h5 class='card-title'>$name</h5>".
            "         <p class='card-text'>$description</p>".
            "         <p class='card-text'>Precio: $price</p>".
            "         <p class='card-text'>Publicado: $createdAt</p>".            
            "          <a href='specs.php?product_id=$id' class='btn btn-primary'>+ Info </a>". 
            "      </div></div>";

        }

        $connection->close();

    }

    // Method made to get reference of each value on parameters given to bind_param , if not 
    // call_user_func_array does not accept it.
    
    function refValues($arr){
        $refs = array();
        foreach($arr as $key => $value){
            $refs[$key] = &$arr[$key];
        }
        return $refs;
    }

    function getNameByUserId($id){
        $connection = getConnection();
        if (!$connection){
            return;
        }
        $query = $connection->prepare("SELECT `username` FROM `customer` WHERE ID=? LIMIT 1");
        $query-> bind_param("i",$id);
        $query -> execute();         

        if ($query -> affected_rows === 0){
            $connection->close();
            return;
        }
        $query->bind_result($name);
        while($query->fetch()){
            $connection->close();
            return $name;
        } 
    }

?>