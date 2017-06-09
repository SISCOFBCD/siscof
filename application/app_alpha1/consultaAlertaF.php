<?php 
//cria uma sessao para segurança
include "check_sessao.php";
?>
<!DOCTYPE HTML>
<html lang="br" class="no-js">
<head>
<meta charset="utf-8">
<title>SISCOF</title>
<link href="style.css" rel="stylesheet" />
</head>
<body>
<div id="conteudo">
<h1>SISCOF</h1>
<div class="borda"></div>

<?php	

include "conexao.php";
include "funcoes.php";
	//recebe os dados do index.php, faz verificações de integridade
	//para realizar as consultas nos bancos	
	
	$recebeValor = $_SESSION["login"];			
	$query="select * from Alertas_Faltas where UPid= (select UPid from Usuarios_Permitidos where login = '$recebeValor')";
	$result=db_mysql($query);	
	//se existir no mysql
	if(mysqli_num_rows($result) > 0) {
		echo "<form method='post' action='gera()'>";
		echo "<table style='width:100%'>";
		echo "<tr>";
		echo "<td><b>Matricula </b></td>";
		echo "<td><b>Turma </b></td>";
		echo "<td><b>Curso </b></td>";
		echo "<td><b>Data Inicio </b></td>";
		echo "<td><b>Data Fim </b></td>";		
		echo "<td><b>Dias Consecutivos</b></td>";
		echo "<td><b>Relatório </b></td>";
		echo "</tr>";
		while($row = mysqli_fetch_assoc($result)){
			$Cid = $row['FAid'];
			echo "<tr>";
			echo "<td>".$row['matricula']."</td>";
			echo "<td>".$row['turma']."</td>";
			echo "<td>".$row['curso']."</td>";
			echo "<td>".$row['dataInicio']."</td>";
			echo "<td>".$row['dataFim']."</td>";
			echo "<td>".$row['quantidade_dias']."</td>";
			echo "<td><input type='radio' name='gender' value='[$Cid]' </td>";
			echo "</tr>";
		}
		echo "</table>";
		echo "<td><input type='submit' value='Gerar Relatório'</td>";
		echo "</form>";
	}else{
		echo "<p><b>Não possui alertas cadastrados com este requisito</b></p>";
		echo "<meta http-equiv=\"refresh\" content=\"3;URL=".'principal.php'."\">";
	}
?>

</div>
</body>
</html>
