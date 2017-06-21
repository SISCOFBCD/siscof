<?php

//require('./inicia.php');

include("logica-usuario.php"); 
include("conexao/banco_mysql.php");
include ("gerenciaUsuarios.php");

// Faz a verificação do usuário
verificaUsuario();

$usuario = buscaUsuario(usuarioLogado());

// Se não tiver um GET pagina ele redireciona para o inicio
if(empty($_GET["pagina"])) {
    $_GET["pagina"] = "inicio";
}
if(isset($_GET["pagina"])){
    $secao = explode("/", $_GET["pagina"]);   
}else{
    $secao = "";
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <title> SISCOF - Painel <?php echo ucfirst($secao[0]) ?></title>
    <link rel="shortcut icon" href="img/icone.png" />    
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/tudo.css" rel="stylesheet" /> 
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">  
</head>
<body onload="abreServicos();">        
    <script src="assets/js/jquery-1.10.2.js"></script>    
    <script src="assets/js/bootstrap.min.js"></script>        
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>    
    <script src="assets/js/morris/morris.js"></script>  
    <script src="assets/js/custom.js"></script>   
    <script src="assets/js/jquery.metisMenu.js"></script> 
    <script src="assets/js/dataTables/jquery-1.12.3.js"></script>
    <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script>   
    <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script> 
    <div id="pagina-container">
        <div id="wrapper">
            

            <?php 
			// Verifica seu o usuário é administrador e seleciona o menu de acordo com a permissão
			
            if(verificaAdmin($usuario)){
                require_once 'menu-adm.php';
            }else{
                require_once 'menu-comum.php';
            }
			
            ?>

            <div id="page-wrapper">
				<a href="index.php"><img class="imgTop" src="img/logo.png" alt="logo siscof"></a>
                <span style="float: right; padding-top: 20px"> <a href="logout.php" class="btn btn-danger">Sair <i class="fa fa-power-off"></i></a></span> 
                
                <div class="row" style="padding-top: 15px">
					<!-- Mostra nome do user -->
                    <i class="fa fa-thumbs-up"></i> <b>Bem vindo <?php echo utf8_encode($usuario["login"]); ?></b> <br>
				
				</div>
				
				
                <?php        
				// Faz a verificação se a página existe
                if(file_exists($_GET["pagina"].".php")) {
                    require_once($_GET["pagina"].".php");
                }else{            
                    require_once("erro.php");
                }
                ?>  


            </div>
        </div>
    </div> 
    
</body>
</html>

