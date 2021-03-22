<?php

include_once("dbConfig.php");

function selectProductsPaginator(){
    $connection = getConnection();

    if (!$connection){
        return false;
    }

    $query = $connection->prepare("SELECT * from `products`");
    $query -> execute();
    $query -> store_result();

    if ($query -> num_rows === 0){
        return;
    }
    
    $pages = ceil($query -> num_rows / 10);
    echo "<ul class='pagination'>";
    for($i = 1;$i<=$pages;$i++){
        echo "<li class='page-item'><a class='page-link' href='main.php?id=$i'>$i</a></li>";
    }
    echo "</ul>";
    
    $connection -> close();

}

?>