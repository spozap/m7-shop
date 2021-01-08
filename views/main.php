<?php

    include_once('../common/header.php');

?>

<head>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div id="container">
    </br>
    <form method="POST" action="main.php">
        <div class="input-container">
            <i class="fa fa-search icon" width="75px"></i> 
            <input class="input-field" type="text" name="product" placeholder="Buscar productos...">
        </div>
    </form>
    <div class="product-container">
            <?php showProducts(); ?>
        </div>
    </div>
</body>

<?php 

    

?>