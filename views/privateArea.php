<?php

    include_once('../common/header.php');

    if (!isLogged()){
        header('Location: main.php');
    }
?>
<head>
    <link rel="stylesheet" href="../css/privateArea.css">
</head>
<body>

<div class="jumbotron">
    <h1 class="display-4 text-center">Bienvenido, <?php echo $_SESSION['username'].' '.$_SESSION['id'] ; ?></h1>
    <p class="lead text-center">Esta es tu área de cliente , dónde podrás subir tus productos.</p>
    <hr class="my-4">
</div>

    <div class="d-flex justify-content-center">

        <div>
        <form method="POST" action="privateArea.php">
            <div class="form-group">
                <label class="label-product">Nombre del producto</label>
                <input type="product" class="form-control" id="inputEmail" placeholder="Enter email">
            </div>
           
            <div class="form-group">
                <label class="label-product">Descripción</label>
                <textarea type="text" cols="40" rows="5" class="form-control" id="inputDescription" placeholder="Password"></textarea>
                <label class="label-product">Imágenes:</label>
                </br><input type="file" id="images" name="images" multiple></br>
            </div>

            <div class="form-group">
                <label class="label-product">Categoria: </label>
                <input type="radio" class="radio" name="home" value="Muebles y hogar">
                <label for="home">Muebles y hogar</label>
                <input type="radio" class="radio" name="sport" value="Deporte">
                <label for="home">Deporte</label>
                <input type="radio" class="radio" name="other" value="Otros">
                <label for="other">Otros</label>
            </div>

            <button type="submit " class="btn btn-primary submit-product">Subir producto</button>
            </form> 
    </div>

    </div>

</body>