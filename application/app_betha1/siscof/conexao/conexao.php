<?php 
//variaveis para conexao com o banco

	if (!defined("host")) define ("host","localhost");
	if (!defined("user")) define ("user","root");
	if (!defined("pw")) define ("pw","");
	if (!defined("db")) define ("db","ControleDeFrequencia");
	

	if(!function_exists("db_mysql")) {
		//funcao para conexao com o mysql
		function db_mysql($query) {
			$conecta = mysqli_connect(host, user, pw, db) or die ("erro de conexao ao banco");
			$resp=mysqli_query($conecta,$query) or die ("erro de acesso ao banco");
			mysqli_close($conecta);
			return $resp;
		}
	}
?>
