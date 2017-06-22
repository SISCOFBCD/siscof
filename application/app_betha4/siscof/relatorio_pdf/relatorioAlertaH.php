<?php
include '../banco_mysql.php';
include '../gerenciaAlertas.php';

//include('../inicia.php');

$AHid = $_GET["id"];

if(verificaOcorrenciasH($AHid)) {
	echo "Chegamos aqui: Relatório de Alerta Falta requisitado!";
	$OHid = selectOcorrenciasF($AHid);
	
	if(verificaAH_Matricula($AHid)) {
		header("Location: ../relatorio_pdf/principal.php?=&por=2&tipo=1&filtro='$AHid'&ocor='$OHid'");
		
	} elseif(verificaAH_Turma($AHid)) {
		header("Location: ../relatorio_pdf/principal.php?=&por=2&tipo=2&filtro='$AHid'&ocor='$OHid'");
	}
	
} else {
	header('Location: ../painel.php?pagina=erro_relatorio');
}

?>
