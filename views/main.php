<?php

    include_once('../common/header.php');

?>

<head>
    <link rel="stylesheet" href="../css/main.css">
</head>
<body>
    <div id="container">
    </br>
    <form class="product-filter" method="GET" action="main.php">
        <input type="text" name="product" placeholder="Buscar productos..."> 
        <select name="category" class="custom-select">
            <option disabled selected>Seleccionar categoría</option>
            <option value="muebles">Muebles y hogar</option>
            <option value="deporte">Deporte</option>
            <option value="otros">Otros</option>
        </select>
        <label style="margin-left:10px;">Filtrar por precio: </label>
        <input class="price-input" type="text" name="from" placeholder="Desde">     
        <input class="price-input" type="text" name="to" placeholder="Hasta">
        <select name="order" class="custom-select">
            <option disabled selected>Ordenar por...</option>
            <option value="precioasc">Precio - Ascendente</option>
            <option value="precioasc">Precio - Descendente</option>
            <option value="fechaasc">Fecha - Ascendente</option>
            <option value="fechadesc">Fecha - Descendente</option>
        </select>
        <button type="submit">BUSCAR </button>  
   </form>
        <?php 

        if(isset($_POST['']))

        echo "<div class='product-pagination'>";

            selectProductsPaginator();
        echo "</div>";
        echo "<div class='product-container'>";
            if(isset($_GET['id'])){
                $actual = intval($_GET['id']);

                showPaginatedProducts($actual);
            
            } else {

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