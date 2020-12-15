<?php

function getConnection(){
    return new mysqli('localost','root','','m7-shop');
}

function isLogged(){
    return (isset($_SESSION['username'],$_SESSION['password']));
}

?>