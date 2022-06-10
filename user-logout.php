<?php 
    require_once "includes/login.php";

    Logout();
    
    header('Location: ./index.php');
    die();

?>