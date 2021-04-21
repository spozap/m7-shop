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

            $id = $_SESSION['id'];

            for($i=0;$i<count($_FILES['images']['name']);$i++){
                
                $file = $_FILES['images']['name'][$i];
                $tmpName = $_FILES['images']['tmp_name'][$i];

                if($i == count($_FILES['images']['name']) - 1){
                    
                    $path.= "../img/products/$id".date("Y_m_d_h_i_sa").($i+1).".png";
                    move_uploaded_file($tmpName,"../img/products/$id".date("Y_m_d_h_i_sa").($i+1).".png");
                    break; 

                }

                $path.= "../img/products/$id".date("Y_m_d_h_i_sa").($i+1).".png\n"; // Some way to separate images
                move_uploaded_file($tmpName,"../img/products/$id".date("Y_m_d_h_i_sa").($i+1).".png");

            }


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
                <input type="product" class="form-control" name="name" id="product-name" placeholder="Nombre..">
                <div class="invalid-feedback"></div>

                <label class="label-product">Precio del producto</label>
                <input type="number" class="form-control" name="price" id="product-price" placeholder="Precio..">
                <div class="invalid-feedback"></div>
            </div>
           
            <div class="form-group">
                <label class="label-product">Descripción</label>
                <textarea type="text" cols="40" rows="5" class="form-control"
                id="product-description" name="description" placeholder="Password"></textarea>
                <div class="invalid-feedback"></div>

                <label class="label-product">Imágenes:</label>
                </br><input type="file" id="product-images" name="images[]" multiple></br>
                <div class="invalid-feedback"></div>
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

            <button id="product-submit" class="btn btn-primary submit-product">Subir producto</button>
            </form> 
    </div>

    </div>
    <link rel="stylesheet" href="../css/privateArea.css">
    <script src="../js/productForm.js"></script>

</body>