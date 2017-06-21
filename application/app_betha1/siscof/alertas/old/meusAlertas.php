<script> //função para manter serviços aberto no menu
function abreServicos() {
    document.getElementById("alertas").click();
}
</script>

<?php
include ("classes/RepositorioSCM.php");
$repositorioSCM = new RepositorioSCM($mysqli);
$chamados = $repositorioSCM->buscarMinhasManutencoes($usuario["id"]);
?>

<h3 align="center">Meus Chamados</h3>
<table class="table table-hover table-striped" id="tabela">
    <thead>
        <tr>
            <td><b>Data</b></td>
            <td style="color: transparent;"><b>Id</b></td>
            <td><b>Tipo</b></td>
            <td><b>Prioridade</b></td>            
            <td><b>Status</b></td>
            <td><b>Descrição</b></td>
            <td><b>Editar</b></td>
        </tr>       
    </thead>
    <?php foreach ($chamados as $chamado) : ?>
        <?php if($chamado["prioridade"] == 1){
                    $prioridade = "Baixa";  
                }else if($chamado["prioridade"] == 2){
                    $prioridade = "Média";  
                }else{
                    $prioridade = "Alta";
                }
                if($chamado["status"] == 'a'){
                    $status = "Aberto";
                }else{
                    $status = "Fechado";
                }
                if($chamado["tipo"] == 1){
                    $tipo = "Manutenção";  
                }else if($chamado["tipo"] == 2){
                    $tipo = "Publicação";  
                }else if($chamado["tipo"] == 3){
                    $tipo = "Fale Conosco";
                }else if($chamado["tipo"] == 4){
                    $tipo = "Siscon";
                }
        ?>
        <tr>            
            <td>                
                <a href="?pagina=scm/visualizaChamado&id=<?php echo $chamado["id_chamado"]; ?>"><?php echo $chamado["inicio"]; ?></a>     
            </td>  
            <td style="color: transparent;">                
                <?php echo $chamado["id_chamado"]; ?>
            </td>
            <td>
                <?php echo $tipo; ?>
            </td>
            <td>
                <?php echo $prioridade; ?>
            </td>
            <td>
                <?php echo $status; ?>
            </td> 
            <td>
                <?php echo substr($chamado["descricao_problema"], 0, 60); ?>
            </td> 
            <td>
                <?php if($chamado["status"] == 'a'): ?>
                <a href="?pagina=scm/editChamado&id=<?php echo $chamado["id_chamado"]; ?>"><span class="btn btn-info btn-sm">Editar</span></a> 
                <?php endif; ?>
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
         "aaSorting": [[1, 'desc']],
    });    
});//fim jquery
        </script>
