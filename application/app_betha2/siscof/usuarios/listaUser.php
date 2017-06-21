<script> //funÁ„o para manter serviÁos aberto no menu
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
<!-- Monta tabela dos users -->
	<table id="tabela" class="table table-hover table-striped">
        <thead>
            <tr>
                <td><b>Login</b></td>
                <td><b>Email</b></td>
				<td><b>Super Usu√°rio</b></td>
                <td><b>Local</b></td>
                <td><b>Ativo</b></td>
            </tr>       
        </thead>
        <?php foreach ($usuarios as $usuario) : // percorre todos os usuarios?>
        <tr>            
            <td><a href="?pagina=usuarios/visualizaUser&id=<?php echo $usuario["UPid"]; ?>"><?php echo utf8_encode($usuario["login"]); ?></a></td>            
            <td><?php echo utf8_encode($usuario["email"]); ?></td>   
            <td><?php echo utf8_encode($usuario["super_usuario"]); ?></td> 
			<td><?php echo utf8_encode($usuario["local"]); ?></td> 
			<td><?php echo utf8_encode($usuario["ativo"]); ?></td> 
         </tr>         
         <?php endforeach; ?>             
    </table> 
   
        <script type="text/javascript">
            $(document).ready(function(){
               $("#tabela").dataTable({    
              "oLanguage": {
                    "sLengthMenu": "Mostrar _MENU_ registros por p√°gina",
                    "sZeroRecords": "Nenhum registro encontrado",
                    "sInfo": "Mostrando _START_ / _END_ de _TOTAL_ registro(s)",
                    "sInfoEmpty": "Mostrando 0 / 0 de 0 registros",
                    "sInfoFiltered": "(filtrado de _MAX_ registros)",
                    "sSearch": "Pesquisar: ",
              "oPaginate": {
                "sFirst": "In√≠cio",
                "sPrevious": "Anterior",
                "sNext": "Pr√≥ximo",
                "sLast": "√öltimo"
            }
        },
         "aaSorting": [[0, 'asc']],
    });    
});//fim jquery
        </script>