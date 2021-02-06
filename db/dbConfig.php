<?php

function getConnection(){
    return new mysqli('localhost','root','','m7-shop');
}

function getPDOConnection(){
    return new PDO("mysql:host=localhost;dbname=m7-shop","root","");
}

function isLogged(){
    return (isset($_SESSION['username'],$_SESSION['password']));
}

?>