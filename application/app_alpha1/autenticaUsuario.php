<?php 
//cria uma sessao para segurança
session_start();
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
		if(empty($recebeNome)){
			echo "<p><b>Usuario obrigatório</b></p>";
			logout_session();
			die();			
		}
		if(empty($recebeSenha)){
			echo "<p><b>Senha obrigatória</b></p>";
			logout_session();
			die();
		}		
	}
	//faz a consulta no mysql para verificar se usuario esta cadastrado
	$query="select * from Usuarios_Permitidos where login ='$recebeNome'";
	$result=db_mysql($query);
	if(mysqli_num_rows($result) == 1) {
		$row = mysqli_fetch_assoc($result);	
		//verifica se é um super-usuario e local
		if(($row["super_usuario"] == 1) && ($row["local"] == 1)){
			if($recebeSenha == $row["senha"]) {
				//aqui loga com todos os direitos
				//cadastra novos usuarios, bloqueia usuario, cria alertas e monitora alertas
				echo "<p><b>Login efetuado com sucesso!</b></p>";
				//inicia as variaveis de sessao e direciona para a pagina principal
				$_SESSION["login"] = $recebeNome;
				echo "<meta http-equiv=\"refresh\" content=\"2;URL=".'principal.php'."\">";	
			}else{
				echo "<p><b>Senha errada!</b></p>";
				echo "<meta http-equiv=\"refresh\" content=\"2;URL=".'index.php'."\">";	
			}
		}else{
			//verifica se usuario esta ativo no sistema
			if($row["ativo"] == 1){
				//ja que ele existe no sistema e esta ativo 
				//fazer uma consulta no LDAP com o login passado
				//testar usuario e senha estão corretos no LDAP
				if(true){
					if($row["super_usuario"] == 1){
						//aqui o usuario ganha direitos de ser super-usuario
						//cadastra novos usuarios, bloqueia usuario, cria alertas e monitora alertas
						//com autenticação pelo LDAP				
						echo "<p><b>Em implantação</b></p>";
						//echo "<meta http-equiv=\"refresh\" content=\"2;URL=".'index.php'."\">";	
					}else{
						//aqui o usuario ganha direitos de usuarios 
						//cria alertas e monitora alertas
						echo "<p><b>Em implantação</b></p>";
						//echo "<meta http-equiv=\"refresh\" content=\"2;URL=".'index.php'."\">";
					}
				}else{
					echo "<p><b>Senha cadastrada no LDAP não confere!</b></p>";
					echo "<meta http-equiv=\"refresh\" content=\"2;URL=".'index.php'."\">";
				}
			}else{
				echo "<p><b>Usuario desativado do sistema</b></p>";
				echo "<meta http-equiv=\"refresh\" content=\"2;URL=".'index.php'."\">";
			}			
		}	
	}else {
		echo "<p><b>Voce não tem permissão para usar este sistema</b></p>";
		echo "<meta http-equiv=\"refresh\" content=\"2;URL=".'index.php'."\">";	
		logout_session();
		die();
	}
?>
</div>
</body>
</html>
