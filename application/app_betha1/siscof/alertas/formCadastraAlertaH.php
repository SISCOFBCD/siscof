<?php 

include("./check_sessao.php");
 ?>
<br>
<form method="post" action="alertas/cadastraAlertaH.php">
		<fieldset>
			<legend>Cadastro de Alertas de Hórarios</legend>
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