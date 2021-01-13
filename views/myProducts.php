<?php
        include_once('../common/header.php');

        if (!isLogged()){
            header('Location: main.php');
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