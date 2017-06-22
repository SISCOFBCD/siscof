<?php

//include('../inicia.php');

include_once ('../banco_mysql.php');
include_once ('../banco_oracle.php');
include_once ('fpdf/fpdf.php');
include_once ('relatorio.php');

	
	$doc = new Relatorio();

	$tipo = $_GET["tipo"];
	$filtro = $_GET["filtro"];
	$ocorrencia = $_GET["ocor"];
	$AF_ou_AH = $_GET["por"];
	
	if($AF_ou_AH == 1) {// O alerta ou filtro é por Faltas (AF)
		/*if ($tipo == 1) // O alerta é por aluno
			$doc=$doc->relatorio_aluno_falta($filtro,$ocorrencia);
		if ($tipo == 2) // O alerta é por matrícula
			$doc=$doc->relatorio_turma_falta($filtro,$ocorrencia);*/
			$doc->relatorio_falta($filtro,$ocorrencia); 
			
	} else if ($AF_ou_AH == 2) {// O alerta ou filtro é por Horário (AH)
		/*if ($tipo == 1) // O alerta é por aluno
			$doc=$doc->relatorio_aluno_horario($filtro,$ocorrencia);
		if ($tipo == 2) // O alerta é por matrícula
			$doc=$doc->relatorio_turma_horario($filtro,$ocorrencia);*/
			$doc->relatorio_horario($filtro,$ocorrencia); 
	}
	
	//$doc->Output();

?>





