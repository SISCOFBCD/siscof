<?php

//require('../inicia.php');

include ("funcoes.php");
include("conexao/banco_mysql.php");

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
	
	// Funções de busca de alertas concluídos para um usuário específico
	
	if(!function_exists("buscarAlertasFConcluidos")) {
		// Busca todos os usuários
		function buscarAlertasFConcluidos($id_user){
			$query="select * from Alertas_Faltas where dataFim < NOW() and UPid = {$id_user}";
			$busca = db_mysql($query);
			
			$alertas = [];        
			while ($alerta = mysqli_fetch_array($busca)) {            
				$alertas[] = $alerta;
			}
			return $alertas;
		}
	}
			
	if(!function_exists("buscarAlertasHConcluidos")) {
		// Busca todos os usuários
		function buscarAlertasHConcluidos($id_user){
			$query="select * from Alertas_Horarios where dataFim < NOW() and UPid = {$id_user}";
			$busca = db_mysql($query);
			
			$alertas = [];        
			while ($alerta = mysqli_fetch_array($busca)) {            
				$alertas[] = $alerta;
			}
			return $alertas;
		}
	}
	
	// Funções de busca de alertas abertos para um usuário específico
	
	if(!function_exists("buscarAlertasFAbertos")) {
		// Busca todos os usuários
		function buscarAlertasFAbertos($id_user){
			$query="select * from Alertas_Faltas where dataFim >= NOW() and UPid = {$id_user}";
			$busca = db_mysql($query);
			
			$alertas = [];        
			while ($alerta = mysqli_fetch_array($busca)) {            
				$alertas[] = $alerta;
			}
			return $alertas;
		}
	}
	
	
	if(!function_exists("buscarAlertasHAbertos")) {
		// Busca todos os usuários
		function buscarAlertasHAbertos($id_user){
			$query="select * from Alertas_Horarios where dataFim >= NOW() and UPid = {$id_user}";
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
	
	
?>
