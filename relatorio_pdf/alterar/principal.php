<?php

require('inicia.php');

	$doc = new Relatorio();
	
	$filtro = 1;
	$ocorrencia = 1; //1 e 3 aluno falta
			 //2 e 4 turma falta

			// 1 e 1 aluno horario
			// 2 e 5 turma horario

	//$doc->relatorio_falta($filtro,$ocorrencia);
	$doc->relatorio_horario($filtro,$ocorrencia); 

?>





