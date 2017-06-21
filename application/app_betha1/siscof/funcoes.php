<?php
//aqui irao ficar todas as funcoes que o servidor vai conter.
include("conexao/banco_mysql.php");

//include('./inicia.php');

//funcao para testar integridade de dados 
if(!function_exists("test_input")) {
	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
}

//deleta as variaveis de sessão e reenvia para a pagina index.php
if(!function_exists("logout_session")) {
	function logout_session(){
		unset($_SESSION["login"]);
		unset($_SESSION["senha"]);
		unset($_SESSION["email"]);
		unset($_SESSION["siscof"]);
		echo "<meta http-equiv=\"refresh\" content=\"2;URL=".'index.php'."\">";
	}
}

?>
