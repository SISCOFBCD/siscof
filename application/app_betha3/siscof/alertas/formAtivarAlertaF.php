<?php
include "check_sessao.php";
include_once ("./gerenciaAlertas.php");


if(isset($_GET["id"])){
    $AFid = $_GET["id"];
	
	$alerta = buscaAFporID($AFid);
}

?>

	<h3 align="center">Reativar Alerta de Falta</h3>
	<br>
	
	
	<form method="post" action="alertas/cadastraAlertaF.php" class="form-horizontal">
	
			<div class="form-group">
				<div class="input-group">
					<table><tr>
						<td><input type="radio" name="gender1" value="matricula" style="margin-left:10px;" <?php if($alerta["matricula"] != null){ $codigo = $alerta["matricula"]; ?> checked <?php } ?> > Matricula<br></td>
						<td><input type="radio" name="gender1" value="turma" style="margin-left:10px;" <?php if($alerta["turma"] != null){ $codigo = $alerta["turma"]; ?> checked <?php } ?> > Turma<br></td>
						<td><input type="radio" name="gender1" value="curso" style="margin-left:10px;" <?php if($alerta["curso"] != null) { $codigo = $alerta["curso"]; ?> checked <?php } ?> > Curso<br></td>
					</tr></table>
				</div>
			</div>
		
			<div class="form-group">
				<label for="curso">Código:</label>
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-font"></i></div>
					<input id="valor" type="text" required="required" name="valor" class="form-control" value=<?php echo $codigo;?> >
				</div>   
			</div>
			
		
			<div class="form-group">
				<label for="dias">Número de dias:</label>
				<div class="input-group">
					<div class="input-group-addon"><i class="fa fa-font"></i></div>
					<input name="quantidade_dias" id="quantidade_dias" type="text" required="required" class="form-control" value=<?php echo utf8_encode($alerta["quantidade_dias"]); ?> >
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
					<input type="checkbox" name="dias_consecutivos" value="dias_consecutivos" id="dias_consecutivos" <?php if($alerta["dias_consecutivos"]>0){ ?> checked <?php } ?> > Monitorar faltas por dias consecutivos<br>
				</div>   
			</div>
			

			<button class="btn btn-success" type="submit" name="cadastrar" style="float: right">Cadastrar </button> 

	</form>