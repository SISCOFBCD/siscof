<script> //função para manter serviços aberto no menu
function abreServicos() {
    document.getElementById("alertas").click();
}
</script>

<?php
include ("classes/RepositorioSCM.php");
include ("classes/Manutencao.php");
$repositorioSCM = new RepositorioSCM($mysqli);
$manutencao = new Manutencao();
?>

<h3 align="center">Encerrar Chamado</h3>
    <form action="" method="post" class="form-horizontal">         
        <div class="form-group">
            <label for="contato-obs">Obs:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-comment"></i></div>
                <input id="contato-obs" type="text" name="obs" class="form-control">
            </div>           
        </div> 
        <div class="form-group">
            <label for="contato-tec">Técnico:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <select name="tec" class="form-control">
                    <option>Daniela</option>
                    <option>Estágiario</option>
                    <option>José Valdemar</option>
                    <option>Raul</option> 
                </select>
            </div>           
        </div>        
       <button class="btn btn-primary" type="submit" name="fechar" style="float: right">Encerrar </button> 
    </form>


<?php if(isset($_POST["fechar"])){
        $chamado = $repositorioSCM->buscarChamado($_GET["id"]);           
        $manutencao->setData($_POST["data"]);
        $manutencao->setObs(utf8_decode($_POST["obs"]));
        $manutencao->setChamado($chamado["id_chamado"]);
        $manutencao->setId_pc($chamado["pc"]);
        $manutencao->setTecnico(utf8_decode($_POST["tec"]));
        $data = date("d/m/Y");
        $repositorioSCM->fecharChamado($data, $_POST["tec"], $_GET["id"]);
        $repositorioSCM->addManutencao1($manutencao);   
        echo '<script>
            location.href="painel.php?pagina=scm/chamadosConcluidos"
            </script>';     
}
