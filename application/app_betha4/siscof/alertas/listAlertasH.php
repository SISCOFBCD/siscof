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

$alertas = buscarAlertasH($user_id);


?>

<br>
<h3 align="center">Alertas por Horário - Todos </h3>
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
				<td><b>Limiar Tempo (min)</b></td>
				<td><b>Tipo</b></td>
				<td><b>Relatório</b></td>
				<td><b>Status</b></td>
            </tr>       
        </thead>
		<?php foreach ($alertas as $alerta) : // percorre todos os usuarios ?>
        <tr>
			<td><?php echo utf8_encode($alerta["AHid"]); ?></td>
            <td><?php echo utf8_encode($alerta["matricula"]); ?></td>
			<td><?php echo utf8_encode($alerta["turma"]); ?></td>            
            <td><?php echo utf8_encode($alerta["curso"]); ?></td>   
            <td><?php echo utf8_encode(dataInicioH( $alerta["AHid"]) ); ?></td> 
			<td><?php echo utf8_encode(dataFimH( $alerta["AHid"]) ); ?></td>  
			<td><?php echo utf8_encode($alerta["quantidade_dias"]); ?></td>
			<td><?php if($alerta["dias_consecutivos"] == 0) echo "Intermitentes"; else echo "Consecutivos"; ?></td>
			<td><?php echo utf8_encode($alerta["limiar_tempo"]); ?></td>
			<td><?php if($alerta["chegada"] == 0) echo "Saída Antecipada"; else echo "Chegada Tardia"; ?></td>
			
			<td>
				<a href="relatorio_pdf/relatorioAlertaH.php?id=<?php echo $alerta["AHid"]; ?>" ><?php if(verificaOcorrenciasH($alerta["AHid"])) {?><i class="fa fa-file-pdf-o"></i><?php } ?></a>
            </td>			
			
			<td>
				<?php if(verificaStatusAH($alerta["AHid"])){ ?>
				<a href="painel.php?pagina=alertas/desativarAlertaH&id=<?php echo $alerta["AHid"];?>"> <button class="btn btn-danger" name="status_desativar" style="float: center">Desativar</button> </a>
				<?php } else{ ?>
				<a href="painel.php?pagina=alertas/formAtivarAlertaH&id=<?php echo $alerta["AHid"]; ?>"> <button class="btn btn-success" name="status_ativar" style="float: center">Ativar</button> </a>
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
