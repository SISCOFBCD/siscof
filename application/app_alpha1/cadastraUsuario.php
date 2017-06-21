<?php 
//cria uma sessao para segurança
include "check_sessao.php";
?>
<!DOCTYPE HTML>
<html lang="br" class="no-js">
<head>
<meta charset="utf-8">
<title>SISCOF</title>
<link href="style.css" rel="stylesheet" />
</head>
<body>
<div id="conteudo">
<h1>SISCOF</h1>
<div class="borda"></div>

<?php
include "conexao.php";
include "funcoes.php";
	//recebe os dados do index.php, faz verificações de integridade
	//para realizar as consultas nos bancos	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$recebeNome = test_input($_POST["login"]);
		$recebeSenha = test_input($_POST["senha"]);
		$recebeEmail = test_input($_POST["email"]);
		if(empty($recebeNome)){
			echo "<p><b>Usuario obrigatório</b></p>";
			echo "<meta http-equiv=\"refresh\" content=\"2;URL=".'principal.php'."\">";
			die();		
		}
		//if(empty($recebeSenha)){
			//echo "<p><b>Senha obrigatória</b></p>";
			//logout_session();
			//die();
		//}	
		if(empty($recebeEmail)){
			echo "<p><b>Email obrigatório</b></p>";
			echo "<meta http-equiv=\"refresh\" content=\"2;URL=".'principal.php'."\">";
			die();
		}
		if($_POST["super"] == 'super'){
			$recebeAdmin = 1;
		}else{
			$recebeAdmin = 0;
		}
	}
	//faz a consulta no mysql
	$query="select * from Usuarios_Permitidos where login ='$recebeNome'";
	$result=db_mysql($query);
	//se existir no mysql
	if(mysqli_num_rows($result) == 1) {
		echo "<p><b>Usuario já existente!</b></p>";
		echo "<meta http-equiv=\"refresh\" content=\"2;URL=".'principal.php'."\">";	
	}else{
	//senão consulta no LDAP o login que deseja cadastrar
		if(true){
			//se usuario existir no LDAP,
			//cadastrar usuario;	
			$query="insert into Usuarios_Permitidos (UPid, super_usuario, local, login, senha, email, ativo) values (0, $recebeAdmin, 0, '$recebeNome', '$recebeSenha', '$recebeEmail', 1)";
			$result=db_mysql($query);
			echo "<p><b>Usuario inserido!</b></p>";
			echo "<meta http-equiv=\"refresh\" content=\"2;URL=".'principal.php'."\">";	
		}else{
		//senao existir no LDAP não deve permitir que cadastre usuario;	
			echo "<p><b>Usuario não existe no LDAP e não pode ser inserido no sistema!</b></p>";
			echo "<meta http-equiv=\"refresh\" content=\"2;URL=".'principal.php'."\">";
		}
	}
?>
</div>
</body>
</html>
