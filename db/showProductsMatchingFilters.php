<?php

include_once("dbConfig.php");

function showProductsMatchingFilters($name,$category,$priceFrom,$priceTo,$order){

    $select = "SELECT * FROM products WHERE";

    $validArgs = array();
    $validTypes = "";

    if (!empty($name)){
        $select.= " name LIKE CONCAT(?,'%') and";
        array_push($validArgs,$name);
    }

    if(!empty($category)){
        $select.=" categoria=? and";
        array_push($validArgs,$category);
    }

    if(!empty($priceFrom) || !empty($priceTo)){
        $select.= " precio BETWEEN ? and ? and";
        array_push($validArgs,$priceFrom);
        array_push($validArgs,$priceTo);
    }

    if (!empty($order)){

        if($order === 'precioasc'){
            $select.= " ORDER BY precio asc";
        } else if($order === 'preciodesc'){
            $select.= " ORDER BY precio desc";
        } else if($order === 'fechaasc'){
            $select.= " ORDER BY creado asc";
        } else if($order === 'fechadesc'){
            $select.= " ORDER BY creado desc";
        }

    }

    $connection = getConnection();

    if(!$connection){
        return false;
    }

    $types = "";

    for($i=0;$i<count($validArgs);$i++){
        if (is_numeric($validArgs[$i])){
            $validTypes.="i";
            continue;
        }

        $validTypes.="s";
    }

    // If there's and AND at the end , remove it
    if (strcmp(substr($select,-3,strlen($select)),"and") == 0){
        $select =  substr($select,0,strlen($select) - 3);
    }

    // In case there is WHERE followed to an Order , remove Where
    if (strpos($select,'WHERE ORDER') !== false) {
        $select = preg_replace("/WHERE ORDER/i","ORDER",$select);
    }

    // In case there is and followed to an Order , remove and
    if (strpos($select,'and ORDER') !== false) {
        $select = preg_replace("/and ORDER/i","ORDER",$select);
    }

    $query = $connection->prepare($select);
    array_unshift($validArgs,$validTypes);
    // Calling to bind_param depending on different valid variables to query properly
    if (strpos($select,'?') != false){
        call_user_func_array(array($query,'bind_param'),refValues($validArgs));
    }

    $query -> execute();

    if ($query -> affected_rows === 0){
        $connection -> close();
        return;
    }

    $query->bind_result($id,$user_id,$name,$description,$images,$category,$price,$createdAt,$visits);

    while($query->fetch()){
        
        echo "<div class='card product' style='width: 18rem;'>".
        "       <img class='card-img-top' src='".explode("\n",$images)[0]."' alt='Card image cap'>".
        "       <div class='card-body'>".
        "        <h5 class='card-title'>$name</h5>".
        "         <p class='card-text'>$description</p>".
        "         <p class='card-text'>Precio: $price</p>".
        "         <p class='card-text'>Publicado: $createdAt</p>".            
        "          <a href='specs.php?product_id=$id' class='btn btn-primary'>+ Info </a>". 
        "      </div></div>";

    }

    $connection->close();

}

// Method made to get reference of each value on parameters given to bind_param , if not 
// call_user_func_array does not accept it.

function refValues($arr){
    $refs = array();
    foreach($arr as $key => $value){
        $refs[$key] = &$arr[$key];
    }
    return $refs;
}



?>