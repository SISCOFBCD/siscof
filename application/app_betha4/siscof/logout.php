<?php 

//include('./inicia.php');

include("logica-usuario.php");

// Faz logout
logout();
header("Location: index.php");
die();

?>