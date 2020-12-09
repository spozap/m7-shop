<!DOCTYPE html>
<html>
    <head>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">    
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
        return true;
    }

    function showNonLoggedItems(){
        echo '<li class="nav-item"> NO LOGUEADO </li>';
    }

    function showLoggedItems(){
        echo '<li class="nav-item"> LOGUEADO </li>';
    }

?>