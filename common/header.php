<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">    
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="../css/header.css">
    </head>

    <body>
        <div id="header">
            <nav class="navbar navbar-expand-sm bg-light">         
                <ul class="navbar-nav"> 
                    <?php isLogged() ? showLoggedItems() : showNonLoggedItems(); ?>
                </ul> 
            </nav>           
        </div>       
    </body>
</html>

<?php


    function isLogged(){
        return false;
    }

    function showNonLoggedItems(){
        echo '<li class="nav-item item"> Iniciar sesión </li>';
        echo '<li class="nav-item item">No tienes cuenta? <a href="">Regístrate!</<></li>';
    }

    function showLoggedItems(){
        echo '<li class="nav-item item"> 
            <a href="privateArea.php">ÁREA PRIVADA</a>
        </li>';
    }

?>