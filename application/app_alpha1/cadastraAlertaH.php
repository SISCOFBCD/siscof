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
		$recebeValor = test_input($_POST["valor"]);		
		$recebeQdias = test_input($_POST["quantidade_dias"]);
		$recebeLimiar = test_input($_POST["limiar_tempo"]);
		$recebeDia_i = test_input($_POST["dia_i"]);
		$recebeMes_i = test_input($_POST["mes_i"]);
		$recebeAno_i = test_input($_POST["ano_i"]);
		$recebeDia_f = test_input($_POST["dia_f"]);
		$recebeMes_f = test_input($_POST["mes_f"]);
		$recebeAno_f = test_input($_POST["ano_f"]);
			
		if(empty($recebeValor)){
			echo "<p><b>Campo obrigatório</b></p>";
			echo "<meta http-equiv=\"refresh\" content=\"3;URL=".'principal.php'."\">";
			die();	
		}
		if(empty($recebeQdias)){
			echo "<p><b>Informe quantos dias deseja monitorar</b></p>";
			echo "<meta http-equiv=\"refresh\" content=\"3;URL=".'principal.php'."\">";
			die();		
		}
		if(empty($recebeLimiar)){
			echo "<p><b>Informe o limiar de tempo atrasado</b></p>";
			echo "<meta http-equiv=\"refresh\" content=\"3;URL=".'principal.php'."\">";
			die();		
		}
		if(empty($recebeDia_i) OR empty($recebeMes_i) OR empty($recebeAno_i)){
			echo "<p><b>Informe uma data inicio para monitorar</b></p>";
			echo "<meta http-equiv=\"refresh\" content=\"3;URL=".'principal.php'."\">";
			die();		
		}else{
			if(checkdate($recebeMes_i,$recebeDia_i,$recebeAno_i)){
				$dataInicio = date("Y-m-d", mktime(0, 0, 0, $recebeMes_i, $recebeDia_i, $recebeAno_i));
			}else{		
				echo "<p><b>Data inicio invalida</b></p>";
				echo "<meta http-equiv=\"refresh\" content=\"3;URL=".'principal.php'."\">";
				die();
			}
		}
		if(empty($recebeDia_f) OR empty($recebeMes_f) OR empty($recebeAno_f)){
			echo "<p><b>Informe uma data final para monitorar</b></p>";
			echo "<meta http-equiv=\"refresh\" content=\"3;URL=".'principal.php'."\">";
			die();		
		}else{
			if(checkdate($recebeMes_f,$recebeDia_f,$recebeAno_f)){
				$dataFim = date("Y-m-d", mktime(0, 0, 0, $recebeMes_f, $recebeDia_f, $recebeAno_f));
				if(strtotime($dataInicio) > strtotime($dataFim)){
					echo "<p><b>Data final não pode ser menor que a data inicio.</b></p>";
					echo "<meta http-equiv=\"refresh\" content=\"3;URL=".'principal.php'."\">";
					die();
				}					
			}else{
			echo "<p><b>Data final invalida</b></p>";
			echo "<meta http-equiv=\"refresh\" content=\"3;URL=".'principal.php'."\">";
			die();
			}
		}
		if($_POST["dias_consecutivos"] == 'dias_consecutivos'){
			$recebeDias_consec = 1;
		}else{
			$recebeDias_consec = 0;
		}
		if($_POST["gender"] == 'chegada'){
			$recebeChegada = 1;
		}else if($_POST["gender"] == 'saida'){
			$recebeChegada = 0;
		}
	}
	$recebeLogin = $_SESSION["login"];
	//faz a consulta no mysql, pegar ID do usuario
	$query="select * from Usuarios_Permitidos where login = '$recebeLogin'";	
	$result=db_mysql($query);
	$row = mysqli_fetch_assoc($result);
	$Uid= $row["UPid"];
	//se existir no mysql
	if(mysqli_num_rows($result) == 1) {		
		if($_POST["gender1"] == 'matricula'){
			$query="insert into Alertas_Horarios (AHid, dias_consecutivos, quantidade_dias, dataInicio, dataFim, matricula, turma, curso, chegada, limiar_tempo, UPid)
			values (0, $recebeDias_consec, $recebeQdias, '$dataInicio', '$dataFim', '$recebeValor', null, null, $recebeChegada, $recebeLimiar, $Uid)";
			$result=db_mysql($query);	
			echo "<p><b>Alerta inserido!</b></p>";
			echo "<meta http-equiv=\"refresh\" content=\"3;URL=".'principal.php'."\">";
		}else if($_POST["gender1"] == 'curso'){
			$query="insert into Alertas_Horarios (AHid, dias_consecutivos, quantidade_dias, dataInicio, dataFim, matricula, turma, curso, chegada, limiar_tempo, UPid)
			values (0, $recebeDias_consec, $recebeQdias, '$dataInicio', '$dataFim', null, null, '$recebeValor', $recebeChegada, $recebeLimiar, $Uid)";
			$result=db_mysql($query);	
			echo "<p><b>Alerta inserido!</b></p>";
			echo "<meta http-equiv=\"refresh\" content=\"3;URL=".'principal.php'."\">";
		}else if($_POST["gender1"] == 'turma'){
			$query="insert into Alertas_Horarios (AHid, dias_consecutivos, quantidade_dias, dataInicio, dataFim, matricula, turma, curso, chegada, limiar_tempo, UPid)
			values (0, $recebeDias_consec, $recebeQdias, '$dataInicio', '$dataFim', null, '$recebeValor', null, $recebeChegada, $recebeLimiar, $Uid)";
			$result=db_mysql($query);	
			echo "<p><b>Alerta inserido!</b></p>";
			echo "<meta http-equiv=\"refresh\" content=\"3;URL=".'principal.php'."\">";
		}					
	}else{
		echo "<p><b>Usuario não existe no sistema!</b></p>";
		echo "<meta http-equiv=\"refresh\" content=\"3;URL=".'principal.php'."\">";
	}
?>
</div>
</body>
</html>
