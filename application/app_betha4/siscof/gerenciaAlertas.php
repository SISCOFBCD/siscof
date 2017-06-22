<?php

//require('../inicia.php');

include ("funcoes.php");
include("banco_mysql.php");

// //include("mostra-alerta.php");
	
	// Funções de busca de alertas para um usuário específico
	
	if(!function_exists("buscarAlertasF")) {
		// Busca todos os usuários
		function buscarAlertasF($id_user){
			$query="select * from Alertas_Faltas where UPid = {$id_user}";
			$busca = db_mysql($query);
			
			$alertas = [];        
			while ($alerta = mysqli_fetch_array($busca)) {            
				$alertas[] = $alerta;
			}
			return $alertas;
		}
	}
	
	if(!function_exists("buscarAlertasH")) {
		// Busca todos os usuários
		function buscarAlertasH($id_user){
			$query="select * from Alertas_Horarios where UPid = {$id_user}";
			$busca = db_mysql($query);
			
			$alertas = [];        
			while ($alerta = mysqli_fetch_array($busca)) {            
				$alertas[] = $alerta;
			}
			return $alertas;
		}
	}
	
	
	// Busca Ocorrências de um Alerta_Falta pelo seu id
	if(!function_exists("selectOcorrenciasF")) {
		function selectOcorrenciasF($AFid){
			
			$result = db_mysql("select MAX(RFid) as RFid from Registro_Faltas where AFid = {$AFid}");
			$RFid_row =  mysqli_fetch_assoc($result);
			$RFid = $RFid_row["RFid"];
			
			$result = db_mysql("select MAX(OFid) as OFid from Ocorrencia_Faltas where RFid = {$RFid}");
			$OFid_row =  mysqli_fetch_assoc($result);
			$OFid = $OFid_row["OFid"];
				
			return $OFid;
		}
	}
	
		
	// Busca Ocorrências de um Alerta_Horário pelo seu id
	if(!function_exists("selectOcorrenciasH")) {
		function selectOcorrenciasH($AHid){	
			$result = db_mysql("select MAX(RHid) as RHid from Registro_Horario where AHid = {$AHid}");
			$RHid_row =  mysqli_fetch_assoc($result);
			$RHid = $RHid_row["RHid"];
			
			$result = db_mysql("select MAX(OHid) as OHid from Ocorrencia_Horario where RHid = {$RHid}");
			$OHid_row =  mysqli_fetch_assoc($result);
			$OHid = $OHid_row["OHid"];
				
			return $OHid;
		}
	}
	

	// Verifica se possui ocorrências de um Alerta_Falta pelo seu id
	if(!function_exists("verificaOcorrenciasF")) {
		function verificaOcorrenciasF($AFid){
			
			$result = db_mysql("select MAX(RFid) as RFid from Registro_Faltas where AFid = {$AFid}");
			$RFid_row =  mysqli_fetch_assoc($result);
			$RFid = $RFid_row["RFid"];
			
			if ($RFid == null) return false;
			else {
				
				$result = db_mysql("select MAX(OFid) as OFid from Ocorrencia_Faltas where RFid = {$RFid}");
				
				$OFid_row =  mysqli_fetch_assoc($result);
				$OFid = $OFid_row["OFid"];
				
				if ($OFid == null) return false;
				else return true;
				
			}
		}
	}
	
	
	// Verifica se possui ocorrências de um Alerta_Falta pelo seu id
	if(!function_exists("verificaOcorrenciasH")) {
		function verificaOcorrenciasH($AHid){
			
			$result = db_mysql("select MAX(RHid) as RHid from Registro_Horario where AHid = {$AHid}");
			$RHid_row =  mysqli_fetch_assoc($result);
			$RHid = $RHid_row["RHid"];
			
			if ($RHid == null) return false;
			else {
				
				$result = db_mysql("select MAX(OHid) as OHid from Ocorrencia_Horario where RHid = {$RHid}");
				
				$OHid_row =  mysqli_fetch_assoc($result);
				$OHid = $OHid_row["OHid"];
				
				if ($OHid == null) return false;
				else return true;
				
			}
		}
	}
	
	
	// Verifica pelo id se o Alerta específico é de Aluno (matrícula)
	if(!function_exists("verificaAF_Matricula")) {
		function verificaAF_Matricula($AFid){
			
			$result = db_mysql("select matricula from Alertas_Faltas where AFid = {$AFid}");
			$matricula =  mysqli_fetch_assoc($result);
			
			if($matricula == null) return false;
			else return true;
			
		}
	}
	
	
	// Verifica pelo id se o Alerta específico é de Turma
	if(!function_exists("verificaAF_Turma")) {
		function verificaAF_Turma($AFid){
			
			$result = db_mysql("select turma from Alertas_Faltas where AFid = {$AFid}");
			$turma =  mysqli_fetch_assoc($result);
			
			if($turma == null) return false;
			else return true;
			
		}
	}
	
	
	// Verifica pelo id se o Alerta específico é de Aluno (matrícula)
	if(!function_exists("verificaAH_Matricula")) {
		function verificaAH_Matricula($AHid){
			
			$result = db_mysql("select matricula from Alertas_Horarios where AHid = {$AHid}");
			$matricula =  mysqli_fetch_assoc($result);
			
			if($matricula == null) return false;
			else return true;
			
		}
	}
	
	
	// Verifica pelo id se o Alerta específico é de Turma
	if(!function_exists("verificaAH_Turma")) {
		function verificaAH_Turma($AHid){
			
			$result = db_mysql("select turma from Alertas_Horarios where AHid = {$AHid}");
			$turma =  mysqli_fetch_assoc($result);
			
			if($turma == null) return false;
			else return true;
			
		}
	}
	
	
	// Busca Alerta de Falta específico através do seu ID
	if(!function_exists("buscaAFporID")) {
		function buscaAFporID($AFid){
			
			$query="select * from Alertas_Faltas where AFid = {$AFid}";
			$result = db_mysql($query);
			
			$alerta =  mysqli_fetch_assoc($result);
			
			return $alerta;
		}
	}
	
	
	// Busca Alerta de Horário específico através do seu ID
	if(!function_exists("buscaAHporID")) {
		function buscaAHporID($AHid){
			
			$query="select * from Alertas_Horarios where AHid = {$AHid}";
			$result = db_mysql($query);
			
			$alerta =  mysqli_fetch_assoc($result);
			
			return $alerta;
		}
	}
	
	
	// Desativar Alerta de Falta
	if(!function_exists("desativarAlertaF")) {
		function desativarAlertaF($AFid){
			
			$diaAtual = date("d");
			$mesAtual = date("m");
			$anoAtual = date("Y");
			
			$novoDataFim = date("Y-m-d", mktime(0, 0, 0, $mesAtual, $diaAtual-1, $anoAtual));
			
			$query="update Alertas_Faltas set dataFim = CAST('{$novoDataFim}' AS DATETIME)  where AFid = {$AFid}; ";
			$result = db_mysql($query);
			
			return $result;

		}
	}
	
	
	// Desativar Alerta de Horário
	if(!function_exists("desativarAlertaH")) {
		function desativarAlertaH($AHid){
			
			$diaAtual = date("d");
			$mesAtual = date("m");
			$anoAtual = date("Y");
			
			$novoDataFim = date("Y-m-d", mktime(0, 0, 0, $mesAtual, $diaAtual-1, $anoAtual));
			
			$query="update Alertas_Horarios set dataFim = CAST('{$novoDataFim}' AS DATETIME)  where AHid = {$AHid}; ";
			$result = db_mysql($query);
			
			return $result;

		}
	}
	
	
	// Funções que retornam os valores de datas corretamente formatados
	if(!function_exists("dataInicioF")) {
		function dataInicioF($AFid){
			
			$query="select DAY(DataInicio), MONTH(DataInicio), YEAR(DataInicio) from Alertas_Faltas where AFid = {$AFid}";
			$result = db_mysql($query);

			$data =  mysqli_fetch_assoc($result);
			
			return implode("/",$data);
		}
	}
	
	if(!function_exists("dataFimF")) {
		function dataFimF($AFid){
			
			$query="select DAY(DataFim), MONTH(DataFim), YEAR(DataFim) from Alertas_Faltas where AFid = {$AFid}";
			$result = db_mysql($query);

			$data =  mysqli_fetch_assoc($result);
			
			return implode("/",$data);
		}
	}
	
	if(!function_exists("dataInicioH")) {
		function dataInicioH($AHid){
			
			$query="select DAY(DataInicio), MONTH(DataInicio), YEAR(DataInicio) from Alertas_Horarios where AHid = {$AHid}";
			$result = db_mysql($query);

			$data =  mysqli_fetch_assoc($result);
			
			return implode("/",$data);
		}
	}
	
	if(!function_exists("dataFimH")) {
		function dataFimH($AHid){
			
			$query="select DAY(DataFim), MONTH(DataFim), YEAR(DataFim) from Alertas_Horarios where AHid = {$AHid}";
			$result = db_mysql($query);

			$data =  mysqli_fetch_assoc($result);
			
			return implode("/",$data);
		}
	}
	
	//================================================================================
	// Funções para Verificar o status dos Alertas
	
	// Verifica o status de um Alerta de Falta, se está ativo ou não (já finalizado)
	if(!function_exists("verificaStatusAF")) {
		function verificaStatusAF($AFid){
			
			if(seAnoFim_Igual("F",$AFid)) {
				if(seMesFim_Igual("F",$AFid)) {
					if(seDiaFim_Igual("F",$AFid)) {
						return true;
					} elseif(seDiaFim_Maior("F",$AFid)) {
						return true;
					} else {
						return false;
					}
					
				} elseif(seMesFim_Maior("F",$AFid)) {
					return true;
				} else {
					return false;
				}
					
			} elseif(seAnoFim_Maior("F",$AFid)) {
				return true;
			} else
				return false;
				
		}
	}
	
	
	
	// Verifica o status de um Alerta de Horário, se está ativo ou não (já finalizado)
	if(!function_exists("verificaStatusAH")) {
		function verificaStatusAH($AHid){
				
			if(seAnoFim_Igual("H",$AHid)) {
				if(seMesFim_Igual("H",$AHid)) {
					if(seDiaFim_Igual("H",$AHid)) {
						return true;
					} elseif(seDiaFim_Maior("H",$AHid)) {
						return true;
					} else {
						return false;
					}
						
				} elseif(seMesFim_Maior("H",$AHid)) {
					return true;
				} else {
					return false;
				}
			} elseif(seAnoFim_Maior("H",$AHid)) {
				return true;
			} else
				return false;	
				
		}
	}
	
	
	//================================================================================
	
	// Funções para verificar se a Data Fim do Alerta é igual a data de hoje
	// Se sim, então o Alerta ainda não está finalizado, ele está ativo
	
	
	// Verifica se o valor Ano da Data Fim do Alerta de Horário é igual ao ano atual
	if(!function_exists("seAnoFim_Igual")) {
		function seAnoFim_Igual($tipo,$Aid){
			
				
			$anoIgual = false; //inicialmente a condição é falsa
			
			$tabela = retornaTabelaAlerta($tipo);
			$id_do_tipo = retornaIDAlerta($tipo);
			
			// Verifica os campos do ano
			$query="select * from {$tabela} where YEAR(dataFim) = YEAR(NOW()) and {$id_do_tipo} = {$Aid}";
			$busca = db_mysql($query);
			
			$alertas = [];        
			while ($alerta = mysqli_fetch_array($busca)) {            
				$alertas[] = $alerta;
				if($alerta != null) $anoIgual = true;
			}
			
			return $anoIgual;
				
		}
	}

	// Verifica se o valor Mês da Data Fim do Alerta de Horário é igual ao mês atual
	if(!function_exists("seMesFim_Igual")) {
		function seMesFim_Igual($tipo,$Aid){
				
			$mesIgual = false; //inicialmente a condição é falsa
			
			$tabela = retornaTabelaAlerta($tipo);
			$id_do_tipo = retornaIDAlerta($tipo);
			
			
			// Verifica os campos do ano
			$query="select * from {$tabela} where MONTH(dataFim) = MONTH(NOW()) and {$id_do_tipo} = {$Aid}";
			$busca = db_mysql($query);
			
			$alertas = [];        
			while ($alerta = mysqli_fetch_array($busca)) {            
				$alertas[] = $alerta;
				if($alerta != null) $mesIgual = true;
			}
			
			return $mesIgual;
				
		}
	}
	
	// Verifica se o valor Dia da Data Fim do Alerta de Horário é igual ao mês atual
	if(!function_exists("seDiaFim_AH_Igual")) {
		function seDiaFim_Igual($tipo,$Aid){
			
			$diaIgual = false; //inicialmente a condição é falsa
			
			$tabela = retornaTabelaAlerta($tipo);
			$id_do_tipo = retornaIDAlerta($tipo);
			
			// Verifica os campos do ano
			$query="select * from {$tabela} where DAY(dataFim) = DAY(NOW()) and {$id_do_tipo} = {$Aid}";
			$busca = db_mysql($query);
			
			$alertas = [];        
			while ($alerta = mysqli_fetch_array($busca)) {            
				$alertas[] = $alerta;
				if($alerta != null) $diaIgual = true;
			}
			
			return $diaIgual;
				
		}
	}
	
	
	//================================================================================
	// Funções para verificar se a Data Fim do Alerta é maior que a data de hoje	
	
	// Verifica se o valor Ano da Data Fim do Alerta de Horário é maior ao ano atual
	if(!function_exists("seAnoFim_Maior")) {
		function seAnoFim_Maior($tipo,$Aid){
			
				
			$anoMaior = false; //inicialmente a condição é falsa
			
			$tabela = retornaTabelaAlerta($tipo);
			$id_do_tipo = retornaIDAlerta($tipo);
			
			// Verifica os campos do ano
			$query="select * from {$tabela} where YEAR(dataFim) > YEAR(NOW()) and {$id_do_tipo} = {$Aid}";
			$busca = db_mysql($query);
			
			$alertas = [];        
			while ($alerta = mysqli_fetch_array($busca)) {            
				$alertas[] = $alerta;
				if($alerta != null) $anoMaior = true;
			}
			
			return $anoMaior;
				
		}
	}
	
	// Verifica se o valor Mês da Data Fim do Alerta de Horário é maior ao mês atual
	if(!function_exists("seMesFim_Maior")) {
		function seMesFim_Maior($tipo,$Aid){
				
			$mesMaior= false; //inicialmente a condição é falsa
			
			$tabela = retornaTabelaAlerta($tipo);
			$id_do_tipo = retornaIDAlerta($tipo);
			
			
			// Verifica os campos do ano
			$query="select * from {$tabela} where MONTH(dataFim) > MONTH(NOW()) and {$id_do_tipo} = {$Aid}";
			$busca = db_mysql($query);
			
			$alertas = [];        
			while ($alerta = mysqli_fetch_array($busca)) {            
				$alertas[] = $alerta;
				if($alerta != null) $mesMaior = true;
			}
			
			return $mesMaior;
				
		}
	}
	
	// Verifica se o valor Dia da Data Fim do Alerta de Horário é Maior ao dia atual
	if(!function_exists("seDiaFim_Maior")) {
		function seDiaFim_Maior($tipo,$Aid){
			
			$diaMaior = false; //inicialmente a condição é falsa
			
			$tabela = retornaTabelaAlerta($tipo);
			$id_do_tipo = retornaIDAlerta($tipo);
			
			// Verifica os campos do ano
			$query="select * from {$tabela} where DAY(dataFim) > DAY(NOW()) and {$id_do_tipo} = {$Aid}";
			$busca = db_mysql($query);
			
			$alertas = [];        
			while ($alerta = mysqli_fetch_array($busca)) {            
				$alertas[] = $alerta;
				if($alerta != null) $diaMaior = true;
			}
			
			return $diaMaior;
				
		}
	}
	

	//================================================================================

	// Retorna a tabela referente ao tipo do Alerta que será usada para consulta ao Banco de Dados
	if(!function_exists("retornaTabelaAlerta")) {
		function retornaTabelaAlerta($tipo){
				
			if($tipo == "F")
				$tabela = "Alertas_Faltas";
			elseif($tipo == "H")
				$tabela = "Alertas_Horarios";
				
			return $tabela;
		}
	}
	
	// Retorna o ID referente ao tipo do Alerta que será usada para consulta ao Banco de Dados
	if(!function_exists("retornaIDAlerta")) {
		function retornaIDAlerta($tipo){
				
			if($tipo == "F")
				$Aid = "AFid";
			elseif($tipo == "H")
				$Aid = "AHid";
				
			return $Aid;
		}
	}
	

?>
