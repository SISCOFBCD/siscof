<?php


//include('../inicia.php');

include '../conexao/banco_mysql.php';
include '../gerenciaAlertas.php';

$AFid = $_GET["id"];

if(verificaOcorrenciasF($AFid)) {
	echo "Chegamos aqui: Relatório de Alerta Falta requisitado!";
	$OFid = selectOcorrenciasF($AFid);
	
	if(verificaAF_Matricula($AFid)) {
		//header("Location: ../painel.php?pagina=relatorio_pdf/principal&por=1&tipo=1&filtro='$AFid'&ocor='$OFid'");
		header("Location: ../relatorio_pdf/principal.php?=&por=1&tipo=1&filtro='$AFid'&ocor='$OFid'");
	} elseif(verificaAF_Turma($AFid)) {
		//header("Location: ../painel.php?pagina=relatorio_pdf/principal&por=1&tipo=2&filtro='$AFid'&ocor='$OFid'");
		header("Location: ../relatorio_pdf/principal.php?=&por=1&tipo=2&filtro='$AFid'&ocor='$OFid'");
	}
	
} else {
	header('Location: ../painel.php?pagina=alertas/listAlertasF&cat=3&erro=1');
}

?>
