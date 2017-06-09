<?php

require('inicia.php');

	$doc = new Relatorio();

	$filtro = 16;
	$ocorrencia = 2;
	
	//$doc=$doc->relatorio_aluno_falta($filtro,$ocorrencia);
	$doc=$doc->relatorio_turma_falta($filtro,$ocorrencia);

	//$doc=$doc->relatorio_aluno_horario($filtro,$ocorrencia); // 3 -> entrada , 1 ou 2 -> saida
	//$doc=$doc->relatorio_turma_horario($filtro,$ocorrencia);
	
	$doc->Output();

?>





