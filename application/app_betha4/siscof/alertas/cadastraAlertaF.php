<?php 
//cria uma sessao para segurança
include("../check_sessao.php");
include("../banco_mysql.php");
include("../funcoes.php");
include("../mostra-alerta.php");

	//recebe os dados do index.php, faz verificações de integridade
	//para realizar as consultas nos bancos	
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$recebeValor = test_input($_POST["valor"]);
		$recebeQdias = test_input($_POST["quantidade_dias"]);
		$recebeDia_i = test_input($_POST["dia_i"]);
		$recebeMes_i = test_input($_POST["mes_i"]);
		$recebeAno_i = test_input($_POST["ano_i"]);
		$recebeDia_f = test_input($_POST["dia_f"]);
		$recebeMes_f = test_input($_POST["mes_f"]);
		$recebeAno_f = test_input($_POST["ano_f"]);
			
		if(empty($recebeValor)){
			header("Location: ../painel.php?pagina=mostra_alerta/warning_campoObrigatorio");
			
			die();	
		}
		if(empty($recebeQdias)){
			
			header("Location: ../painel.php?pagina=mostra_alerta/warning_campoObrigatorio");
			
			die();		
		}
		if(empty($recebeDia_i) OR empty($recebeMes_i) OR empty($recebeAno_i)){
			
			header("Location: ../painel.php?pagina=mostra_alerta/warning_campoObrigatorio");

			die();	
			
		}else{
			if(checkdate($recebeMes_i,$recebeDia_i,$recebeAno_i)){
				$dataAtual = date("Y-m-d");
				$dataInicio = date("Y-m-d", mktime(0, 0, 0, $recebeMes_i, $recebeDia_i, $recebeAno_i));
			}else{
				
				header("Location: ../painel.php?pagina=mostra_alerta/warning_campoInvalido");
			
				die();
			}
		}
		if(empty($recebeDia_f) OR empty($recebeMes_f) OR empty($recebeAno_f)){
			
			header("Location: ../painel.php?pagina=mostra_alerta/warning_campoObrigatorio");
			
			die();	
			
		}else{
			if(checkdate($recebeMes_f,$recebeDia_f,$recebeAno_f)){
				$dataFim = date("Y-m-d", mktime(0, 0, 0, $recebeMes_f, $recebeDia_f, $recebeAno_f));
				if(strtotime($dataInicio) > strtotime($dataFim)){
					
					header("Location: ../painel.php?pagina=mostra_alerta/warning_campoInvalido");

					die();
				}					
			}else{
				header("Location: ../painel.php?pagina=mostra_alerta/warning_campoInvalido");
				
				die();
			}
		}
		if($_POST["dias_consecutivos"] == 'dias_consecutivos'){
			$recebeDias_consec = 1;
		}else{
			$recebeDias_consec = 0;
		}
	}
	$recebeLogin = $_SESSION["siscof"];
	//faz a consulta no mysql, pegar ID do usuario
	$query="select * from Usuarios_Permitidos where UPid = '{$recebeLogin}'";	
	$result=db_mysql($query);
	$row = mysqli_fetch_assoc($result);
	$Uid= $row["UPid"];

	//se existir no mysql
	if(mysqli_num_rows($result) == 1) {
		if($_POST["gender1"] == 'matricula'){
			$query="insert into Alertas_Faltas (AFid, dias_consecutivos, quantidade_dias, dataInicio, dataFim, matricula, turma, curso, UPid)
			values (0, $recebeDias_consec, $recebeQdias, '$dataInicio', '$dataFim', '$recebeValor', null, null, $Uid)";
			$result=db_mysql($query);
			
			header("Location: ../painel.php?pagina=mostra_alerta/sucesso_addAlerta");

			
		}else if($_POST["gender1"] == 'curso'){
			$query="insert into Alertas_Faltas (AFid, dias_consecutivos, quantidade_dias, dataInicio, dataFim, matricula, turma, curso, UPid)
			values (0, $recebeDias_consec, $recebeQdias, '$dataInicio', '$dataFim', null, null, '$recebeValor', $Uid)";
			$result=db_mysql($query);
			
			header("Location: ../painel.php?pagina=mostra_alerta/sucesso_addAlerta");

			
		}else if($_POST["gender1"] == 'turma'){
			$query="insert into Alertas_Faltas (AFid, dias_consecutivos, quantidade_dias, dataInicio, dataFim, matricula, turma, curso, UPid)
			values (0, $recebeDias_consec, $recebeQdias, '$dataInicio', '$dataFim', null, '$recebeValor', null, $Uid)";
			$result=db_mysql($query);
			
			header("Location: ../painel.php?pagina=mostra_alerta/sucesso_addAlerta");
				  
			
		}		
	}else{
		header("Location: ../painel.php?pagina=mostra_alerta/warning_noUser");
		
	}
?>