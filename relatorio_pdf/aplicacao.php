<?php

require('inicia.php');

	$doc = new Relatorio();
	
	$filtro = 2; //id do alerta
	$ocorrencia = 4; //id da ocorrencia 
	
	//$doc=$doc->relatorio_aluno_falta($filtro,$ocorrencia);
	$doc=$doc->relatorio_turma_falta($filtro,$ocorrencia);

	//$doc=$doc->relatorio_aluno_horario($filtro,$ocorrencia);
	//$doc=$doc->relatorio_turma_horario($filtro,$ocorrencia);
	
	$doc->Output();

?>





