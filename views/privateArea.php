<?php

    include_once('../common/header.php');
    
    if (!isLogged()){
        header('Location: main.php');
    }
    
    if (isset($_FILES['images'],$_POST['name'],$_POST['description'],$_POST['category'],$_POST
    ['price'])){

        $name = $_POST['name'];
        $description = $_POST['description'];
        $category =  $_POST['category'];
        $price = $_POST['price'];

        $path = "";

        if (count($_FILES['images']['name']) > 3){
            echo "No puedes subir mas de 3 imagenes!";
        } else {
            for($i=0;$i<count($_FILES['images']['name']);$i++){
                
                $file = $_FILES['images']['name'][$i];
                $tmpName = $_FILES['images']['tmp_name'][$i];

                if($i == count($_FILES['images']['name']) - 1){
                    
                    $path.= "../img/products/".$file;
                    move_uploaded_file($tmpName,"../img/products/".$file);
                    break; 

                }

                $path.= "../img/products/".$file."\n"; // Some way to separate images
                move_uploaded_file($tmpName,"../img/products/".$file);

            }

            $id = $_SESSION['id'];
            echo $path;

            insertProduct($id,$name,$description,$path,$category,$price);
        }
    }
?>
<head>
</head>
<body>

<div class="jumbotron">
    <h1 class="display-4 text-center">Bienvenido, <?php echo $_SESSION['username']; ?></h1>
    <p class="lead text-center">Esta es tu área de cliente , dónde podrás subir tus productos.</p>
    <hr class="my-4">
</div>

    <div class="d-flex justify-content-center">

        <div>
        <form class="form-register" method="POST" action="privateArea.php" enctype="multipart/form-data">
            <div class="form-group">
                <label class="label-product">Nombre del producto</label>
                <input type="product" class="form-control" name="name" placeholder="Nombre..">

                <label class="label-product">Precio del producto</label>
                <input type="number" class="form-control" name="price" placeholder="Precio..">
            </div>
           
            <div class="form-group">
                <label class="label-product">Descripción</label>
                <textarea type="text" cols="40" rows="5" class="form-control" name="description" placeholder="Password"></textarea>
                <label class="label-product">Imágenes:</label>
                </br><input type="file" id="images" name="images[]" multiple></br>
                <!-- images[] means that will be an array of files uploaded-->
            </div>

            <div class="form-group">
                <label class="label-product">Categoria: </label>
                <input type="radio" class="radio" name="category" value="Muebles y hogar">
                <label for="home">Muebles y hogar</label>
                <input type="radio" class="radio" name="category" value="Deporte">
                <label for="home">Deporte</label>
                <input type="radio" class="radio" name="category" value="Otros">
                <label for="other">Otros</label>
            </div>

            <button type="submit" class="btn btn-primary submit-product">Subir producto</button>
            </form> 
    </div>

    </div>
    <link rel="stylesheet" href="../css/privateArea.css">

</body>