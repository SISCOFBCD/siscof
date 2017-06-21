<?php
include '../conexao/banco_mysql.php';
include '../gerenciaAlertas.php';

//include('../inicia.php');

$AHid = $_GET["id"];

if(verificaOcorrenciasH($AHid)) {
	echo "Chegamos aqui: Relatório de Alerta Falta requisitado!";
	$OHid = selectOcorrenciasF($AHid);
	
	if(verificaAH_Matricula($AHid)) {
		header("Location: ../painel.php?pagina=relatorio_pdf/principal&por=1&tipo=1&filtro='$AHid'&ocor='$OHid'");
		//header("Location: ./principal&por=2&tipo=1&filtro='$AHid'&ocor='$OHid'");
	} elseif(verificaAH_Turma($AHid)) {
		header("Location: ../painel.php?pagina=relatorio_pdf/principal&por=1&tipo=2&filtro='$AHid'&ocor='$OHid'");
		//header("Location: ./principal&por=2&tipo=2&filtro='$AHid'&ocor='$OHid'");
	}
	
} else {
	header('Location: ../painel.php?pagina=alertas/listAlertasH&cat=3&erro=1');
}

?>
