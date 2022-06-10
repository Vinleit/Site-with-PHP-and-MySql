<?php 
$banco = new mysqli("127.0.0.1","vinicius","admin","bd_games");

if($banco->connect_errno){
     echo "Erro $banco->errno --> $banco->connect_error";
     die();
}

?>