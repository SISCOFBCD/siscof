<script> //fun��o para manter servi�os aberto no menu
function abreServicos() {
    document.getElementById("usuarios").click();
}
</script>
<?php
include("./logica-usuario.php");
include_once ("gerenciaUsuarios.php");
verificaUsuario();

// busca os usuarios
$usuarios = buscarUsuarios();
?>

<br>
<h3 align="center">Usuários do Sistema</h3>
<br>

<!-- Monta tabela dos users -->
	<table id="tabela" class="table table-hover table-striped">
        <thead>
            <tr>
                <td><b>Login</b></td>
                <td><b>Email</b></td>
				<td><b> Super Usuário </b></td>
                <td><b>Local</b></td>
                <td><b>Ativo</b></td>
            </tr>       
        </thead>
        <?php foreach ($usuarios as $usuario) : // percorre todos os usuarios?>
        <tr>            
            <td><a href="?pagina=usuarios/visualizaUser&id=<?php echo $usuario["UPid"]; ?>"><?php echo utf8_encode($usuario["login"]); ?></a></td>            
            <td><?php echo utf8_encode($usuario["email"]); ?></td>   
            <td><?php if ($usuario["super_usuario"]>0) { ?> <i class="fa fa-check"></i> <?php } ?></td> 
			<td><?php if ($usuario["local"]>0) { ?> <i class="fa fa-check"></i> <?php } ?></td> 
			<td><?php if ($usuario["ativo"]>0) { ?> <i class="fa fa-check"></i> <?php } ?></td> 
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