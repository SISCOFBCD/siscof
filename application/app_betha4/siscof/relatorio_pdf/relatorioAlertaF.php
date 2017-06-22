<?php


//include('../inicia.php');

include '../banco_mysql.php';
include '../gerenciaAlertas.php';

$AFid = $_GET["id"];

if(verificaOcorrenciasF($AFid)) {
	echo "Chegamos aqui: Relatório de Alerta Falta requisitado!";
	$OFid = selectOcorrenciasF($AFid);
	
	if(verificaAF_Matricula($AFid)) {
		header("Location: ../relatorio_pdf/principal.php?=&por=1&tipo=1&filtro='$AFid'&ocor='$OFid'");
	} elseif(verificaAF_Turma($AFid)) {
		header("Location: ../relatorio_pdf/principal.php?=&por=1&tipo=2&filtro='$AFid'&ocor='$OFid'");
	}
	
} else {
	header('Location: ../painel.php?pagina=erro_relatorio');
}

?>
