<?php 
//variaveis para conexao com o banco

	define ("host","localhost");
	define ("user","root");
	define ("pw","luiz");
	define ("db","ControleDeFrequencia");

	//funcao para conexao com o mysql
	function db_mysql($query) {
	$conecta = mysqli_connect(host, user, pw, db) or die ("erro de conexao ao banco");
	$resp=mysqli_query($conecta,$query) or die ("erro de acesso ao banco");
	mysqli_close($conecta);
	return $resp;
	}
?>
