<?php

/*
define ("servidor","localhost");
define ("usuario","root");
define ("senha","mysqladmin");
define ("db","ControleDeFrequencia");
*/

	//variaveis para conexao com o banco MySQL local
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

	if(!function_exists("busca_query")) {
		function busca_query($query){

			$conexao = mysqli_connect(host, user, pw, db) or die ("Erro de conexão ao banco");
			$resposta = mysqli_query($conexao,$query) or die ("Erro de acesso ao banco");

			while($row = $resposta->fetch_array()){
				$rows[] = $row;
			}
			 
			fecha_conexao($conexao);
			return $rows;
		}
	}

	if(!function_exists("fecha_conexao")) {
		function fecha_conexao($conexao){
			mysqli_close($conexao);
		}
	}


?>
