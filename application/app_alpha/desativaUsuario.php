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
		if(empty($recebeNome)){
			echo "<p><b>Usuario obrigatório</b></p>";
			logout_session();
			die();		
		}
	}
	//faz a consulta no mysql
	$query="select * from Usuarios_Permitidos where login ='$recebeNome'";
	$result=db_mysql($query);
	//se existir no mysql
	if(mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_assoc($result);	
		if($row["ativo"] == 1){
			$query="update Usuarios_Permitidos set ativo = 0 where login ='$recebeNome'";
			$result=db_mysql($query);
			echo "<p><b>Usuario desativado!</b></p>";
			echo "<meta http-equiv=\"refresh\" content=\"2;URL=".'principal.php'."\">";	
		}else{
			echo "<p><b>Usuario não esta ativado!</b></p>";
			echo "<meta http-equiv=\"refresh\" content=\"2;URL=".'principal.php'."\">";	
		}
	}else{
		echo "<p><b>Usuario não existe no sistema!</b></p>";
		echo "<meta http-equiv=\"refresh\" content=\"2;URL=".'principal.php'."\">";
	}
?>
</div>
</body>
</html>
