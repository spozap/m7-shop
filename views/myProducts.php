<?php
        include_once('../common/header.php');

        if (!isLogged()){
            header('Location: main.php');
        }

        if(isset($_GET['remove_product'])) {
            $idForm = $_GET['remove_product'];
            $idSession = $_SESSION['id'];
            
            $connection = getConnection();

            if ($connection) {

                $query = $connection -> prepare("SELECT `user_id` FROM `products` WHERE id = ? LIMIT 1");
                $query -> bind_param('i',$idForm);
                $query -> execute();
                $query -> bind_result($idUser);
                $query -> store_result();
                
                while($query -> fetch()){
                    if ($idUser === $idSession){
                        echo "ID OK";
                        try{
                            $pdoConn = getPDOConnection();
                            $pdoConn ->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            
                            $pdoQuery = "DELETE FROM `products` WHERE id = ?";
                            $pdoStatement = $pdoConn -> prepare($pdoQuery);
                            $pdoStatement -> execute(array($idForm));
                            
                            $pdoStatement -> closeCursor();
                            echo "PRODUCTO BORRADO";

                        } catch(PDOException $e){
                            die($e->getMessage());
                        }
                        
                        break;
                    }
                }

                $connection -> close();


            }

        }
?>

<body>
    <h1> MIS PRODUCTOS </h1>
    <div class="my-products">
        <?php showMyProducts(); ?>

    </div>

    <style>
            div .my-products{
                display:flex;
                flex-wrap:wrap;
            }

            div .product{
                width: 50%;
            }

    </style>
     <link rel="stylesheet" href="../css/myProducts.css">
</body>