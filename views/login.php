<?php
    include_once("../db/dbConfig.php");
    include_once("../db/queries.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">    
    <title>Login</title>
</head>
<body>
    <div class="align-items-center d-flex justify-content-center flex-column">
        <form class="login" method="POST" action="login.php">
        <div class="mb-3">
            <label for="exampleInputUsername" class="form-label">Usuario</label>
            <input type="text" class="form-control" id="exampleInputUsername" aria-describedby="emailHelp">
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="exampleInputPassword">
        </div>
        <button type="submit" class="btn btn-primary">Acceder</button>
        </form>
    </div>

</body>
</html>

<?php

    if(isset($_POST['username'],$_POST['password'])){
        $username = $_POST['username'];
        $passwd = $_POST['password'];

    }

?>