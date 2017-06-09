<?php
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
	<form method="post" action="cadastraUsuario.php">
		<fieldset>
			<legend>Cadastro de Usuario</legend>
			<label for="nome">Usuario:</label>
			<input type="text" name="login" id="login" />
			<div class="clear"></div>
			<label for="email">Email:</label>
			<input type="text" name="email" id="email" />
			<div class="clear"></div>
			<input type="checkbox" name="super" value="super" id="super"> Administrador<br>
			<div class="clear"></div>
			<input type="submit" value="Enviar" />
		</fieldset>
	</form>
<div class="borda"></div>	
	<form method="post" action="desativaUsuario.php">
		<fieldset>
			<legend>Desativar Usuario</legend>
			<label for="nome">Usuario:</label>
			<input type="text" name="login" id="login" />
			<div class="clear"></div>
			<input type="submit" value="Enviar" />
		</fieldset>
	</form>
<div class="borda"></div>
	<form method="post" action="ativarUsuario.php">
		<fieldset>
			<legend>Ativar Usuario</legend>
			<label for="nome">Usuario:</label>
			<input type="text" name="login" id="login" />
			<div class="clear"></div>
			<input type="submit" value="Enviar" />
		</fieldset>
	</form>
<div class="borda"></div>
	<form method="post" action="cadastraAlertaF.php">
		<fieldset>
			<legend>Cadastro de Alertas de Faltas</legend>
			<table><tr>
			<td><input type="radio" name="gender1" value="matricula" checked> Matricula<br></td>
			<td><input type="radio" name="gender1" value="turma"> Turma<br></td>
			<td><input type="radio" name="gender1" value="curso"> Curso<br></td>
			</tr></table>
			<label for="curso">Valor:</label>
			<input type="text" name="valor" id="valor" />
			<div class="clear"></div>
			<div class="clear"></div>
			<label for="dias">Número de dias:</label>
			<input type="text" name="quantidade_dias" id="quantidade_dias" />
			<div class="clear"></div>
			<table><tr>
			<td><label for="dias_i">Inicio do Alerta: </label></td>
			<td><input type="data" name="dia_i" id="dia_i" placeholder="DD"/></td>
			<td><input type="data" name="mes_i" id="mes_i" placeholder="MM"/></td>
			<td><input type="data_ano" name="ano_i" id="ano_i" placeholder="AAAA"/></td>
			</tr>
			<tr>
			<td><label for="dias">Fim do Alerta: </label></td>
			<td><input type="data" name="dia_f" id="dia_f" placeholder="DD"/></td>
			<td><input type="data" name="mes_f" id="mes_f" placeholder="MM"/></td>
			<td><input type="data_ano" name="ano_f" id="ano_f" placeholder="AAAA"/></td>
			</tr></table>
			<div class="clear"></div>
			<input type="checkbox" name="dias_consecutivos" value="dias_consecutivos" id="dias_consecutivos"> Monitorar faltas por dias consecutivos<br>
			<div class="clear"></div>
			<input type="submit" value="Enviar" />
		</fieldset>
	</form>
<div class="borda"></div>
	<form method="post" action="cadastraAlertaH.php">
		<fieldset>
			<legend>Cadastro de Alertas de Horarios</legend>
			<table><tr>
			<td><input type="radio" name="gender1" value="matricula" checked> Matricula<br></td>
			<td><input type="radio" name="gender1" value="turma"> Turma<br></td>
			<td><input type="radio" name="gender1" value="curso"> Curso<br></td>
			</tr></table>
			<label for="curso">Valor:</label>
			<input type="text" name="valor" id="valor" />
			<div class="clear"></div>
			<label for="dias">Número de dias:</label>
			<input type="text" name="quantidade_dias" id="quantidade_dias" />
			<div class="clear"></div>
			<label for="dias">Limiar Tempo:</label>
			<input type="text" name="limiar_tempo" id="limiar_tempo" />
			<div class="clear"></div>
			<table><tr>
			<td><label for="dias_i">Inicio do Alerta: </label></td>
			<td><input type="data" name="dia_i" id="dia_i" placeholder="DD"/></td>
			<td><input type="data" name="mes_i" id="mes_i" placeholder="MM"/></td>
			<td><input type="data_ano" name="ano_i" id="ano_i" placeholder="AAAA"/></td>
			</tr>
			<tr>
			<td><label for="dias">Fim do Alerta: </label></td>
			<td><input type="data" name="dia_f" id="dia_f" placeholder="DD"/></td>
			<td><input type="data" name="mes_f" id="mes_f" placeholder="MM"/></td>
			<td><input type="data_ano" name="ano_f" id="ano_f" placeholder="AAAA" /></td>
			</tr></table>
			<div class="clear"></div>
			<input type="checkbox" name="dias_consecutivos" value="dias_consecutivos" id="dias_consecutivos"> Monitorar faltas por dias consecutivos<br>
			<div class="clear"></div>
			<table><tr>
			<td><input type="radio" name="gender" value="chegada" checked> Chegada Tardia<br></td>
			<td><input type="radio" name="gender" value="saida"> Saida Antecipada<br></td>
			</tr></table>
			<div class="clear"></div>
			<input type="submit" value="Enviar" />
		</fieldset>
	</form>
<div class="borda"></div>
	<form method="post" action="consultaAlertaF.php">
		<fieldset>
			<legend>Listar Alertas</legend>			
			<input type="submit" value="Listar"/>
		</fieldset>
	</form>
<div class="borda"></div>
<div class="borda"></div>
</div>
</body>
</html>
