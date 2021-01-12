<?php

    include_once('../common/header.php');

?>

<head>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div id="container">
    </br>
    <form class="product-filter" method="GET" action="main.php" id="products">
        <input type="text" name="product" placeholder="Buscar productos..."> 
        <select name="category" class="custom-select">
            <option disabled selected hidden>Seleccionar categoría</option>
            <option value="muebles">Muebles y hogar</option>
            <option value="deporte">Deporte</option>
            <option value="otros">Otros</option>
        </select>
        <label style="margin-left:10px;">Filtrar por precio: </label>
        <input class="price-input" type="text" name="from" placeholder="Desde">     
        <input class="price-input" type="text" name="to" placeholder="Hasta">
        <select name="order" class="custom-select" form="products">
            <option disabled selected hidden>Ordenar por...</option>
            <option value="precioasc">Precio - Ascendente</option>
            <option value="precioasc">Precio - Descendente</option>
            <option value="fechaasc">Fecha - Ascendente</option>
            <option value="fechadesc">Fecha - Descendente</option>
        </select>
        <button type="submit">BUSCAR </button>  
   </form>
        <?php 

        
        echo "<div class='product-pagination'>";

            selectProductsPaginator();
        echo "</div>";
        echo "<div class='product-container'>";
            if(isset($_GET['id'])){ // If there is no filters , show corresponding 10 entries of products
                $actual = intval($_GET['id']);

                showPaginatedProducts($actual);
            
            } else if (!(empty($_GET['category'])) || (!empty($_GET['order'])) || (!empty($_GET['from']))
            || (!empty($_GET['to'])) || (!empty($_GET['product']))){ // Query products matching filters

                if (empty($_GET['order'])){
                    $order = "";
                } else {
                    $order = $_GET['order'];
                }

                if (empty($_GET['category'])){
                    $category = "";
                } else {
                    $category = $_GET['category'];
                }

                showProductsMatchingFilters($_GET['product'],$category,$_GET['from'],$_GET['to'],$order);

            } else { // If there is no filters and no Id is specified , show 10 first products

                showPaginatedProducts(1);
            }
        echo "</div>";
               
         ?>
    </div>

    <style>
        .product-container{
            display:flex;
            flex-wrap:wrap;
        }
        .product-container div{
            width:50% !important;
        }

        .product-container button{
            width:100% !important;
            margin-top: 10px;
        }
        .product-filter{
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
        }

        .product-filter input,select{
            width: 49%;
            margin-left: 10px;
        }

        .product-filter .price-input{
            width: 20%;
            margin-left: 10px;
        }
    </style>
</body>