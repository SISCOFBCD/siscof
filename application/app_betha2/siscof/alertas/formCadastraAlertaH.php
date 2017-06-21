<?php 

include("./check_sessao.php");
 ?>

 <h3 align="center">Cadastra Novo Alerta de Horário</h3>
<br>
	
	
	<form method="post" action="alertas/cadastraAlertaH.php" class="form-horizontal">
	

			<div class="form-group">
				<div class="input-group">
					<table><tr>
						<td><input type="radio" name="gender1" value="matricula" style="margin-left:10px;" checked> Matricula<br></td>
						<td><input type="radio" name="gender1" value="turma" style="margin-left:10px;"> Turma<br></td>
						<td><input type="radio" name="gender1" value="curso" style="margin-left:10px;"> Curso<br></td>
					</tr></table>
				</div>
			</div>
			
			<div class="form-group">
				<label for="curso">Código:</label>
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-font"></i></div>
					<input id="valor" type="text" required="required" name="valor" class="form-control">
				</div>   
			</div>
			
			<div class="form-group">
				<label for="dias">Número de dias:</label>
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-font"></i></div>
					<input name="quantidade_dias" id="quantidade_dias" type="text" required="required" class="form-control">
				</div>   
			</div>
			
			
			<div class="form-group">
				<label for="dias">Limiar Tempo:</label>
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
					<input name="limiar_tempo" id="limiar_tempo" type="text" required="required" class="form-control" placeholder="minutos">
				</div>   
			</div>
			
			<div class="form-group">
				<label for="dias_i">Inicio do Alerta: </label>
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
						<table><tr>
							<td><input type="data" name="dia_i" id="dia_i" placeholder="DD" required="required" class="form-control"></td>
							<td><input type="data" name="mes_i" id="mes_i" placeholder="MM" required="required" class="form-control"></td>
							<td><input type="data_ano" name="ano_i" id="ano_i" placeholder="AAAA" required="required" class="form-control"></td>
						</tr></table>
				</div>   
			</div>
			
			
			<div class="form-group">
				<label for="dias">Fim do Alerta: </label>
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-calendar"></i></div>
					<table><tr>
						<td><input type="data" name="dia_f" id="dia_f" placeholder="DD" required="required" class="form-control"></td>
						<td><input type="data" name="mes_f" id="mes_f" placeholder="MM" required="required" class="form-control"></td>
						<td><input type="data_ano" name="ano_f" id="ano_f" placeholder="AAAA" required="required" class="form-control"></td>
					</tr></table>
				</div>   
			</div>
			
			
			<div class="form-group">
				<div class="input-group">
					<input type="checkbox" name="dias_consecutivos" value="dias_consecutivos" id="dias_consecutivos"> Monitorar faltas por dias consecutivos<br>
				</div>   
			</div>
			
			<div class="form-group">
				<div class="input-group">
					<table><tr>
						<td><input type="radio" name="gender" value="chegada" checked> Chegada Tardia<br></td>
						<td><input type="radio" name="gender" value="saida" style="margin-left:10px;"> Saída Antecipada<br></td>
					</tr></table>
				</div>   
			</div>
			
			<button class="btn btn-success" type="submit" name="cadastrar" style="float: right">Cadastrar </button> 
			<!--<input type="submit" value="Enviar" />-->

	</form>