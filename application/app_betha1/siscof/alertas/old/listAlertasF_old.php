<script> //função para manter serviços aberto no menu
function abreServicos() {
    document.getElementById("usuarios").click();
}
</script>
<?php
include("./logica-usuario.php");
include("./funcoes.php");
include_once ("./gerenciaAlertas.php");
verificaUsuario();


// busca os usuarios
$alertas = buscarAlertasF($_SESSION["siscof"]);
?>

<h3 align="center">Alertas por Faltas </h3>
<br>
<form method='post' action='geraRelatorio.php'>

<!-- Monta tabela dos users -->
	<table id="tabela" class="table table-hover table-striped">
        <thead>
            <tr>
                <td><b>Matrícula</b></td>
                <td><b>Turma</b></td>
				<td><b>Curso</b></td>
                <td><b>Data Início</b></td>
				<td><b>Data Fim</b></td>
                <td><b>Dias Consecutivos</b></td>
				<td><b>Relatório</b></td>
            </tr>       
        </thead>
		<?php foreach ($alertas as $alerta) : // percorre todos os usuarios ?>
        <tr>            
            <td><?php echo utf8_encode($alerta["matricula"]); ?></td>
			<td><?php echo utf8_encode($alerta["turma"]); ?></td>            
            <td><?php echo utf8_encode($alerta["curso"]); ?></td>   
            <td><?php echo utf8_encode($alerta["dataInicio"]); ?></td> 
			<td><?php echo utf8_encode($alerta["dataFim"]); ?></td> 
			<td><?php echo utf8_encode($alerta["quantidade_dias"]); ?></td>
			<?php $Cid = $alerta['AFid']; ?>
			<td><input type='radio' name='gender' value='<?php $alerta['AFid'] ?>'></td>
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

	
	<input type='submit' value='Gerar Relatório'></td>
</form>