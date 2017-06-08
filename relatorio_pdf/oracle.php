<?php

	// Define o servidor, banco de dados, usuário e senha
	define("BD_SERVIDOR", "191.36.9.27:1522/xe");
	define("BD_USUARIO", "Projeto");
	define("BD_SENHA", "projsenha");

function busca_query_o($query){

	$conn = oci_connect(BD_USUARIO, BD_SENHA, BD_SERVIDOR);
	
	if (!$conn) {
		$erro = oci_error();
		trigger_error(htmlentities($erro['message'], ENT_QUOTES), E_USER_ERROR);
		exit;
	}

	$resposta = oci_parse($conn, $query);
	oci_execute($resposta, OCI_DEFAULT);
	while ($row = oci_fetch_array($resposta, OCI_ASSOC)) {
		$rows[] = $row;
	}

	oci_free_statement($resposta);
	fecha_conexao_o($conn);
	return $rows;

}

function fecha_conexao_o($conexao){
	oci_close($conexao);
}
?>
