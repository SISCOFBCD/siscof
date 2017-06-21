<?php
include "conexao.php";
//aqui irao ficar todas as funcoes que o servidor vai conter.

//funcao para testar integridade de dados 
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//deleta as variaveis de sessão e reenvia para a pagina index.php
function logout_session(){
	unset($_SESSION["login"]);
	unset($_SESSION["senha"]);
	unset($_SESSION["email"]);
	echo "<meta http-equiv=\"refresh\" content=\"2;URL=".'index.php'."\">";
}

function seleciona($AFid){	
	$RFid = db_mysql("select MAX(RFid) as RFid from Registro_Faltas where AFid = $AFid");	
	$OFid = db_mysql("select MAX(OFid) as OFid from Ocorrencia_Faltas where RFid = $RFid");
	echo "funcao($RFid, $OFid)";
}
?>
