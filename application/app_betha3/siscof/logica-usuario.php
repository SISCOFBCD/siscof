<?php

if(!isset($_SESSION)) { 
    session_start(); 
}

// Redireciona o usuário para a tela de login se não estiver logado

if(!function_exists("verificaUsuario")) {
   // declare your function
   
	function verificaUsuario() {
		if(!usuarioEstaLogado()) {
			$_SESSION["danger"] = "Você precisa se autenticar!";
			header("Location: index.php");
		}
	}
}


// Verifica se o usuário esta logado por meio de sessão

if(!function_exists("usuarioEstaLogado")) {
   // declare your function

	function usuarioEstaLogado() {
		return isset($_SESSION["siscof"]);
	}

}

// Retorna valor da sessão SISCOF
if(!function_exists("usuarioLogado")) {
   // declare your function

	function usuarioLogado() {
		if (isset($_SESSION["siscof"])) {
			return $_SESSION["siscof"];
		} else if(empty("siscof")){
			return $_SESSION;
		}
	}

}

// Define valor para a sessão
if(!function_exists("logaUsuario")) {
   // declare your function

	function logaUsuario($user){
		$_SESSION["siscof"] = $user;
	}

}

// Faz o logout do usuário (Destrói a sessão)
if(!function_exists("logout")) {
   // declare your function

	function logout() {
		session_destroy();
	}

}

?>
