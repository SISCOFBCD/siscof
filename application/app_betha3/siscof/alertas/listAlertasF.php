<script> //função para manter serviços aberto no menu
function abreServicos() {
    document.getElementById("usuarios").click();
}
</script>

<?php

//require('../inicia.php');

include("./logica-usuario.php");
include("./funcoes.php");
include_once ("./gerenciaAlertas.php");

verificaUsuario();

// busca os usuarios
$user_id = $_SESSION["siscof"];

if(isset($_GET["cat"])){
    
    if($_GET["cat"] == 1){
        $categoria = "Finalizados";
		$alertas = buscarAlertasFConcluidos($user_id);
    }else if($_GET["cat"] == 2){
        $categoria = "Ativos";
		$alertas = buscarAlertasFAbertos($user_id);
    }else{
        $categoria = "Todos";
		$alertas = buscarAlertasF($user_id);
    }
}else{
    $alertas = buscarAlertasF($user_id);
}

?>

<br>
<ul class="nav nav-pills nav-justified">
    <li><a href="painel.php?pagina=alertas/listAlertasF&cat=1"><strong>Finalizados</strong></a></li>
    <li><a href="painel.php?pagina=alertas/listAlertasF&cat=2"><strong>Ativos</strong></a></li>
	<li><a href="painel.php?pagina=alertas/listAlertasF&cat=3"><strong>Todos</strong></a></li>
	
</ul>


<h3 align="center">Alertas por Faltas<?php if(isset($categoria)) echo " - {$categoria}"; ?></h3>
<br>

<!-- Monta tabela dos users -->
	<table id="tabela" class="table table-hover table-striped">
        <thead>
            <tr>
				<td><b>ID</b></td>
                <td><b>Matrícula</b></td>
                <td><b>Turma</b></td>
				<td><b>Curso</b></td>
                <td><b>Data Início</b></td>
				<td><b>Data Fim</b></td>
                <td><b>Dias</b></td>
				<td><b>Tipo de Dia</b></td>
				<td><b>Relatório</b></td>
				<td><b>Status</b></td>
            </tr>       
        </thead>
		<?php foreach ($alertas as $alerta) : // percorre todos os usuarios ?>
        <tr>
			<td><?php echo utf8_encode($alerta["AFid"]); ?></td>
            <td><?php echo utf8_encode($alerta["matricula"]); ?></td>
			<td><?php echo utf8_encode($alerta["turma"]); ?></td>            
            <td><?php echo utf8_encode($alerta["curso"]); ?></td>   
            <td><?php echo utf8_encode(dataInicioF( $alerta["AFid"]) ); ?></td> 
			<td><?php echo utf8_encode(dataFimF( $alerta["AFid"]) ); ?></td> 
			<td><?php echo utf8_encode($alerta["quantidade_dias"]); ?></td>
			<td><?php if($alerta["dias_consecutivos"] == 0) echo "Intermitentes"; else echo "Consecutivos"; ?></td>
			
			<td>
                <a href="relatorio_pdf/relatorioAlertaF.php?id=<?php echo $alerta["AFid"]; ?>" ><?php if(verificaOcorrenciasF($alerta["AFid"])) {?><center><i class="fa fa-file-pdf-o" ></i><?php } ?></center></a>
            </td>
			
			<td>
				<?php if(verificaStatusAF($alerta["AFid"])){ ?>
				<a href="painel.php?pagina=alertas/desativarAlertaF&id=<?php echo $alerta["AFid"];?>"> <button class="btn btn-danger" name="status_desativar" style="float: center">Desativar</button> </a>
				<?php } else{ ?>
				<a href="painel.php?pagina=alertas/formAtivarAlertaF&id=<?php echo $alerta["AFid"]; ?>"> <button class="btn btn-success" name="status_ativar" style="float: center">Ativar</button> </a>
				<?php } ?>
			</td>
			
        </tr>
 
        <?php endforeach; ?>
		
    </table> 
   
	<script type="text/javascript">
		$(document).ready(function(){
		   $("#tabela").dataTable({    
				"oLanguage": {
					"sLengthMenu": "Mostrar _MENU_ registros por página",
					"sZeroRecords": "Nenhum registro encontrado",
					"sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
					"sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
					"sInfoFiltered": "(filtrado de _MAX_ registros)",
					"sSearch": "Pesquisar: ",
					"oPaginate": {
						"sFirst": "Início",
						"sPrevious": "Anterior",
						"sNext": "Próximo",
						"sLast": "Último"
					}
				},
				"aaSorting": [[0, 'asc']],
			});    
		});//fim jquery
		
	</script>
