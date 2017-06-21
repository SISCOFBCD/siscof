<script> //função para manter serviços aberto no menu
function abreServicos() {
    document.getElementById("alertas").click();
}
</script>
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>tinymce.init({
    selector: "textarea",
    setup: function (editor) {
        editor.on('change', function () {
            editor.save();
        });
    }
});</script>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
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

<h3 align="center">Editar Evento</h3>
    <form action="" method="post" class="form-horizontal">        
        <div class="form-group">
            <label for="nome">Nome:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-font"></i></div>
                <input id="nome" type="text" required="required" name="nome" class="form-control" value="<?php echo $evento["nome_evento"]; ?>">
            </div>   
        </div> 
        <div class="form-group">
            <label for="carga">Carga HorÃ¡ria:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                <input id="carga" type="number" required="required" name="carga" class="form-control" value="<?php echo $evento["carga_horario"]; ?>">
            </div>   
        </div>
        <div class="form-group">
            <label for="contato-data">Data:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                <input id="contato-data"  required="required" name="data" class="form-control" value="<?php echo $evento["data"]; ?>">
            </div>           
        </div>    
        <div class="form-group">
            <label for="cidade">Cidade:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                <select id="cidade" name="cidade" class="form-control">
                <?php
                    foreach ($cidades as $cidade){
                        if ($cidade["cid_id"] == $evento["cidade"]) {
                            echo "<option value='{$cidade["cid_id"]}' selected>".utf8_encode($cidade["cid_desc"])."</option>";  
                        }else{
                            echo "<option value='{$cidade["cid_id"]}'>".utf8_encode($cidade["cid_desc"])."</option>"; 
                        }                                                  
                    }                               
                ?>
                </select>
            </div>           
        </div> 
        <div class="form-group">
            <label for="local">Local:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                <input id="local"  required="required" name="local" class="form-control" value="<?php echo $evento["local"]; ?>">
            </div>           
        </div> 
        <div class="form-group">
            <label for="maps">Link Google Maps:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-map-o"></i></div>
                <input id="maps"  required="required" name="maps" class="form-control" value="<?php echo $evento["link_maps"]; ?>">
            </div>           
        </div> 
        <div class="form-group">
            <label for="palestrante">Palestrante:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input id="palestrante"  required="required" name="palestrante" class="form-control" value="<?php echo $evento["palestrante"]; ?>">
            </div>           
        </div> 
        <div class="form-group">
            <label for="participantes">Limite de Participantes:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-sort-numeric-desc"></i></div>
                <input id="participantes"  required="required" name="participantes" class="form-control" type="number" value="<?php echo $evento["limite_participantes"]; ?>">
            </div>           
        </div> 
        <div class="form-group">        
           <label for="descricao">DescriÃ§Ã£o:</label>        
           <textarea required="required" name="descricao" id="descricao" class="form-control" rows="15"><?php echo $evento["descricao"]; ?></textarea>
       </div> 
       <div class="form-group">
           <label class="btn btn-danger">Remover <input type="checkbox" name="excluir"></label>    <br><br>
           <label class="btn btn-info">Encerrar <input type="checkbox" name="encerrar" <?php if($evento["status"] == 1){echo "checked";} ?>></label>
        </div>
       <button class="btn btn-primary" type="submit" name="atualizar" style="float: right">Atualizar</button> 
    </form>

<?php 
if(isset($_POST["atualizar"])){
    if(isset($_POST["excluir"])){
	$repositorioEventos->rmEvento($_GET["id"]);
        echo "<meta http-equiv='refresh' content=0;url='http://localhost/siscof/intranet/painel.php?pagina=eventos/eventosAbertos'>";
    }else{    
        if(isset($_POST["encerrar"])){
            $encerrado = 1;
            $repositorioEventos->editEvento($_GET["id"], $_POST["nome"], $_POST["carga"], $_POST["data"], $_POST["cidade"], $_POST["local"], $_POST["maps"], $_POST["palestrante"], $_POST["participantes"], $_POST["descricao"], $encerrado);
            echo "<meta http-equiv='refresh' content=0;url='http://localhost/siscof/intranet/painel.php?pagina=eventos/eventosEncerrados'>";
        }else{
            $encerrado = 0;
            $repositorioEventos->editEvento($_GET["id"], $_POST["nome"], $_POST["carga"], $_POST["data"], $_POST["cidade"], $_POST["local"], $_POST["maps"], $_POST["palestrante"], $_POST["participantes"], $_POST["descricao"], $encerrado);
            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL='{$actual_link}'>";
        }        
    }
}
