<?php

//cria uma sessao para segurança
if(!isset($_SESSION)) { 
    session_start(); 
}

//include('./inicia.php');

include("banco_mysql.php");
include("gerenciaUsuarios.php");
include("mostra-alerta.php");
include("logica-usuario.php"); 

$recebeNome = test_input($_POST["login"]);
$recebeSenha = test_input($_POST["senha"]);
// Chama a função para autenticação do usuário
$usuario = login($recebeNome, $recebeSenha);

// Verifica se retorna algum usuário
if($usuario == null) {
	
	//$_SESSION["danger"] = "Usuário ou senha inválidos.";
    //mostraAlerta($danger);
	//header("Location: index.php");
	
	//echo "<p><b>Usuário ou senha inválidos.</b></p>";
	//echo "<meta http-equiv=\"refresh\" content=\"2;URL=".'index.php'."\">";
	
	$_SESSION["danger"] = "Usuário ou senha inválidos.";
	header("Location: index.php");
	
	
} else { 
    logaUsuario($usuario["UPid"]);
    header("Location: painel.php");
	
	//echo "<p><b>Login efetuado com sucesso!</b></p>";
	//echo "<meta http-equiv=\"refresh\" content=\"2;URL=".'index.php'."\">";	
}
die();

?>
