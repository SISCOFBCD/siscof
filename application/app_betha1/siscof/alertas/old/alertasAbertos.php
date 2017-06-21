<script> //função para manter serviços aberto no menu
function abreServicos() {
    document.getElementById("alertas").click();
}
</script>
<?php
include("./logica-usuario.php"); 
include("./gerenciaAlertas.php"); 
verificaUsuario();
//include ("classes/RepositorioCidades.php");
//include ("classes/RepositorioEventos.php");


//$repositorioEventos = new RepositorioEventos($mysqli);
//$repositorioCidades = new RepositorioCidades($mysqli);
$alertas = eventosAbertos();
?>
<?php if(sizeof($alertas) == 0) : ?>
<div class="mensagem">
    <p class="alert alert-info">
        Nenhum alerta aberto. <i class="fa fa-smile-o"></i>
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
            <td><b>Lista Inscritos</b></td>
            <td><b>Editar</b></td>
        </tr>       
    </thead>
    <?php foreach ($eventos as $evento) : ?>  
        <?php $inscritos = $repositorioEventos->verificaInscritos($evento["id_evento"]); ?>
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
                <a href="requisicoes/gerarpdf/listaInscritos.php?id=<?php echo $evento["id_evento"]; ?>" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
                &emsp;<?php echo sizeof($inscritos)."/{$evento["limite_participantes"]}"; ?>
            </td>  
            <td>                
                <a href="?pagina=eventos/editEvento&id=<?php echo $evento["id_evento"]; ?>"><span class="btn btn-info btn-sm">Editar</span></a>                
            </td> 
        </tr>
    <?php endforeach; ?>    
</table>
<?php endif; ?> 
