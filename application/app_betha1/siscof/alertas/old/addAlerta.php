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
$cidades = $repositorioCidades->listaCidades();

// criar uma classe RepositorioAlertas.php e incluí-la:
// include ("classes/RepositorioAlertas.php");
// pegar dados do BD de Repositório de Alertas:
// $repositorioAlertas = new RepositorioAlertas($mysqli);

// criar uma classe RepositorioCursos.php e incluí-la:
// include ("classes/RepositorioCursos.php");
// pegar dados do BD ISAAC dos cursos:
// $cursos = $repositorioCursos->listaCursos();

// criar uma classe RepositorioTurmas.php e incluí-la:
// include ("classes/RepositorioTurmas.php");
// pegar dados do BD ISAAC dos cursos:
// $turmas = $repositorioTurmas->listaTurmas();


?>


<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<h3 align="center">Adicionar Alerta</h3>
    <form action="" method="post" class="form-horizontal">  

		<!-- Campo do filtro Nome -->	
        <div class="form-group">
            <label for="nome">Nome:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-font"></i></div>
                <input id="nome" type="text" required="required" name="nome" class="form-control">
            </div>   
        </div> 
		
		<!-- Campo do filtro Matrícula -->	
        <div class="form-group">
            <label for="matric">Matrícula:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-font"></i></div>
                <input id="matric" type="text" required="required" name="matric" class="form-control" type="number">
            </div>   
        </div> 
		
		<!-- Campo do filtro Curso -->
		<!--
		<div class="form-group">
            <label for="curso">Curso:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                <select id="curso" name="curso" class="form-control">
                <?php
                    foreach ($cursos as $curso){
                        echo utf8_encode("<option value='{$curso["curso_id"]}'>{$curso["curso_desc"]}</option>");                           
                    }                               
                ?>
                </select>
            </div>           
        </div>
		-->
		
		<!-- Campo do filtro Turma -->
		<!--
		<div class="form-group">
            <label for="turma">Turma:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-map-marker"></i></div>
                <select id="turma" name="turma" class="form-control">
                <?php
                    foreach ($turmas as $turma){
                        echo utf8_encode("<option value='{$turma["turma_id"]}'>{$turma["turma_desc"]}</option>");                           
                    }                               
                ?>
                </select>
            </div>           
        </div>
		-->
		
		<!-- Campo do filtro Período -->
        <div class="form-group">
            <label for="periodo">Período:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                <input id="periodo" type="number" required="required" name="periodo" class="form-control">
            </div>   
        </div>
		
		<!-- Campo do filtro Data -->
        <div class="form-group">
            <label for="contato-data">Data:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                <input id="contato-data"  required="required" name="data" class="form-control">
            </div>           
        </div>
		
		<!-- Campo do filtro Limite de dias -->		
        <div class="form-group">
            <label for="lim_dias">Limite de Dias:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-sort-numeric-desc"></i></div>
                <input id="lim_dias"  required="required" name="lim_dias" class="form-control" type="number">
            </div>           
        </div> 
        
       <button class="btn btn-primary" type="submit" name="adicionar" style="float: right">Adicionar <i class="fa fa-plus-circle"></i></button> 
    </form>

<?php 
if(isset($_POST["adicionar"])){
    $repositorioEventos->addEvento($_POST["nome"], $_POST["carga"], $_POST["data"], $_POST["cidade"], $_POST["local"], $_POST["maps"], $_POST["palestrante"], $_POST["participantes"], $_POST["descricao"], $usuario["id"]);
    echo "<meta http-equiv='refresh' content=0;url='http://localhost/siscof/intranet/painel.php?pagina=eventos/eventosAbertos'>";  
}
