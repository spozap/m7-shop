<?php
        include_once('../common/header.php');

        if (!isLogged()){
            header('Location: main.php');
        }

        if (isset($_GET['id'])){

            $productId = $_GET['id'];

            try {
                $connection = getPDOConnection();
                $productSelect = "SELECT name,description,categoria,precio from products WHERE id = ?";
                $statement = $connection -> prepare($productSelect);
                $statement -> execute(array($productId));

                while($fila = $statement -> fetch(PDO::FETCH_ASSOC)){
                    echo "<form class='form-register' method='GET' action='editMyProduct.php'>".
                        "<div class='mb-3'>".
                        "<label for='usernameInput' class='form-label'>Nombre del producto</label>".
                        "<input class='form-control' name='name' value='$fila[name]'>".
                        "<input class='form-control' name='edit' value='true' type='hidden'>".
                        "<input class='form-control' name='id' value='$productId' type='hidden'>".
                    "</div>".
                    "<div class='mb-3'>".
                        "<label for='passwdInput' class='form-label'>Descripción del producto</label>".
                        "<input type='text' class='form-control' name='description' value='$fila[description]'>".
                    "</div>".
                    "<div class='mb-3'>".
                    "<label for='passwdInput' class='form-label'>Precio del producto</label>".
                    "<input type='text' class='form-control' name='price' value='$fila[precio]'>".
                "</div>".
                "<div class='mb-3'>".
                "<label for='passwdInput' class='form-label'>Categoría del producto</label>".
                "<input type='text' class='form-control' name='category' value='$fila[categoria]'>".
            "</div>".
                    "<button type='submit' class='btn btn-primary'>Guardar cambios</button>".
                "</form>";
                }

                $statement -> closeCursor();

            } catch(PDOException $e){
                die($e->getMessage());
            }
        } else {
            echo "Página inválida. No se ha especificado ningún producto";
        }
    if (isset($_GET['edit'])){

        $productId = $_GET['id'];
        $name = $_GET['name'];
        $desc = $_GET['description'];
        $price = $_GET['price'];
        $category = $_GET['category'];

        try{
            $connection = getPDOConnection();
            $productUpdate = "UPDATE `products` SET name = ? , 
            description = ? , categoria = ? ,
            precio = ? WHERE id = ?";
            $statement = $connection -> prepare($productUpdate);
            $statement -> execute(array($name,$desc,$category,$price,$productId));

            $statement -> closeCursor();
            
            header("Location: editMyProduct.php?id=$productId");
        } catch(PDOException $e){
            die($e->getMessage());
        }

    }
?>