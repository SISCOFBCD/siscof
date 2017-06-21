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
		$alertas = buscarAlertasHConcluidos($user_id);
    }else if($_GET["cat"] == 2){
        $categoria = "Em Aberto";
		$alertas = buscarAlertasHAbertos($user_id);
    }else{
        $categoria = "Todos";
		$alertas = buscarAlertasH($user_id);
    }
}else{
    $alertas = buscarAlertasH($user_id);
}

?>

<br>
<ul class="nav nav-pills nav-justified">
    <li><a href="painel.php?pagina=alertas/listAlertasH&cat=1"><strong>Finalizados</strong></a></li>
    <li><a href="painel.php?pagina=alertas/listAlertasH&cat=2"><strong>Em Aberto</strong></a></li>
	<li><a href="painel.php?pagina=alertas/listAlertasH&cat=3"><strong>Todos</strong></a></li>
	
</ul>


<h3 align="center">Alertas por Horário<?php if(isset($categoria)) echo " - {$categoria}"; ?></h3>
<br>
<!--<form method='post' action='geraRelatorio.php'>-->

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
				<td><b>Limiar Tempo (min)</b></td>
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
			<td><?php echo utf8_encode($alerta["limiar_tempo"]); ?></td>
			
			
			<?php $Cid = $alerta['AHid']; ?>
			<!--<td><input type='radio' name='gender' value='<?php $alerta['AHid'] ?>'></td>-->
			
			<td>
				<!--<a id="relatorio" href="painel.php?pagina=alertas/listAlertasH&cat=3?id=<?php echo $alerta["AHid"]; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i></a>-->
                <a href="relatorio_pdf/relatorioAlertaH.php?id=<?php echo $alerta["AHid"]; ?>" ><i class="fa fa-file-pdf-o"></i></a>
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

	
	<!--<input type='submit' value='Gerar Relatório'></td>-->
<!--</form>-->