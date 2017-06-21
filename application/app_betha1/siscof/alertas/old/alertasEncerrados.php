<script> //função para manter serviços aberto no menu
function abreServicos() {
    document.getElementById("alertas").click();
}
</script>
<?php
include("./logica-usuario.php"); 
verificaUsuario();
include ("classes/RepositorioCidades.php");
include ("classes/RepositorioEventos.php");
$repositorioEventos = new RepositorioEventos($mysqli);
$repositorioCidades = new RepositorioCidades($mysqli);
$eventos = $repositorioEventos->eventosEncerrados();
?>
<?php if(sizeof($eventos) == 0) : ?>
<div class="mensagem">
    <p class="alert alert-info">
        Nenhuma evento encerrado. <i class="fa fa-smile-o"></i>
    </p>
</div>
<?php else : ?>  
<table class="table table-hover table-striped">
    <thead>
        <tr>
            <td><b>Nome</b></td>
            <td><b>Data</b></td>
            <td><b>Cidade</b></td>
            <td><b>Palestrante</b></td>
            <td><b>Confirmar PresenÃ§a</b></td>
        </tr>       
    </thead>
    <?php foreach ($eventos as $evento) : ?>        
        <tr>            
            <td>                
                <a href="?pagina=eventos/visualizaEvento&id=<?php echo $evento["id_evento"]; ?>"><?php echo $evento["nome_evento"]; ?></a>                
            </td>            
            <td>
                <?php echo $evento["data"]; ?>
            </td>               
            <td>
                <?php echo utf8_encode($evento["cid_desc"]); ?>
            </td>   
            <td>
                <?php echo $evento["palestrante"]; ?>
            </td>
            <td>                
                <a href="?pagina=eventos/presenca&id=<?php echo $evento["id_evento"]; ?>">PresenÃ§a</a>                
            </td> 
        </tr>
    <?php endforeach; ?>    
</table>
<?php endif; ?> 
