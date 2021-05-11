<?php

function getConnection(){
    return new mysqli('localhost','austria','Austria123!','m7-shop');
}

function getPDOConnection(){
    return new PDO("mysql:host=localhost;dbname=m7-shop","austria","Austria123!");
}

function isLogged(){
    return (isset($_SESSION['username'],$_SESSION['password']));
}

?>