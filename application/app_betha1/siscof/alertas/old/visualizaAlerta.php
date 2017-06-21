<script> //fun��o para manter servi�os aberto no menu
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
$cidades = $repositorioCidades->listaCidades();
$evento = $repositorioEventos->buscarEvento($_GET["id"]);
?>
 
<h3 align="center">Detalhes do Evento</h3>
<table class="table" style="margin-top: 20px">
    <tr>
        <td class="tabela-pc"><b>Nome:</b></td>
        <td><b><?php echo $evento["nome_evento"]; ?></b></td>
    </tr>
    <tr>
        <td class="tabela-pc"><b>Carga Horária:</b></td>
        <td><b><?php echo $evento["carga_horario"]; ?></b></td>
    </tr>
    <tr>
        <td class="tabela-pc"><b>Data:</b></td>
        <td><b><?php echo $evento["data"]; ?></b></td>
    </tr>
    <tr>
        <td class="tabela-pc"><b>Cidade:</b></td>
        <td><b><?php echo utf8_encode($evento["cid_desc"]); ?></b></td>
    </tr>
    <tr>
        <td class="tabela-pc"><b>Local:</b></td>
        <td><b><?php echo $evento["local"]; ?></b></td>
    </tr>
    <tr>
        <td class="tabela-pc"><b>Google Maps:</b></td>
        <td><b><a href="<?php echo $evento["link_maps"]; ?>" target="_blank">Visualizar</a></b></td>
    </tr>
    <tr>
        <td class="tabela-pc"><b>Palestrante:</b></td>
        <td><b><?php echo $evento["palestrante"]; ?></b></td>
    </tr>
    <tr>
        <td class="tabela-pc"><b>Limite de Participantes:</b></td>
        <td><b><?php echo $evento["limite_participantes"]; ?></b></td>
    </tr>
    <tr>
        <td class="tabela-pc"><b>Descrição:</b></td>
        <td><b><?php echo $evento["descricao"]; ?></b></td>
    </tr>    
</table>

<br><br>
<a href="?pagina=eventos/editEvento&id=<?php echo $evento["id_evento"]; ?>" style="float: right"><span class="btn btn-info btn-sm">Editar</span></a> 