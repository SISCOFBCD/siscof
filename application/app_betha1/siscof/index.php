<?php

//include('./inicia.php');

include("logica-usuario.php"); 
include("mostra-alerta.php"); 

// Se o usuário estiver logado ele é redirecionado para o painel.php
if(usuarioLogado()){
    header("Location: painel.php");
}
?>
<!DOCTYPE html>
<html lang="br">
<head>

    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <title>SISCOF | Login</title>
    <link rel="shortcut icon" href="img/icone.png" />
    <link rel="stylesheet" href="assets/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/login.css">
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/estilo.css" rel="stylesheet" />
	<link rel="stylesheet" type="text/css" href="assets/style.css">
</head>
<!-- TELA DE LOGIN -->
<body>
<table align="center" style="width:auto;margin-left:auto;margin-right:auto;margin-top:100px;">
    <tr>
        <td>
            <div class="main">
                <div class="center-block" id="tabContent" style="width:500px;">
                    <div id="contentHolder1">
                        <div>
                            <center>
                                <img src="img/logo.png" class="imgTop">
                            </center>
                            <br>
                        </div>

			
                        <form method="post" class="form-horizontal" action="login.php">

                        <table align="center" border=0 style="width:450px">
                            <tr>
                                <td>
                                    	
                                        <div class="form-group" style="margin-left: 75px; margin-right: 75px">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                                                <input type="text" name="login" class="form-control" placeholder="Nome de Usuário">
                                            </div>           
                                        </div>    
                                        <div class="form-group" style="margin-left: 75px; margin-right: 75px">
                                            <div class="input-group">
                                                <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                                                <input type="password" name="senha" class="form-control" placeholder="Senha" >
                                            </div>           
                                        </div>                                       
                                    
                                </td>
                            </tr>
                            <tr>
                                <td>

				
							<p style="margin-left: 75px; color: black;" onmouseover="alertText()" onmouseout="normalText()" onclick="changeText()" id="esqueceu_senha"> Esqueceu a senha?</p>       

				
                                </td>
                            </tr>
                            <tr>
                                <td><br>
                                    <button class="btn btn-success" type="submit" name="enviar" style="float: right; margin-right: 75px">Acessar <i class="fa fa-arrow-right"></i></button>
                                </td>
                            </tr>                            
                        </table>
                        </form>
					
						
					

                    </div>
                </div>
            </div>
        </td>
    </tr>
</table>

	
	<div class="container">
  		<div id="red_alert">
			<!--<div style='max-width: 350px; padding-top: 15px; margin-left: 400px; margin-top: 50px;' class='alert alert-danger alert-dismissable fade in'> <a href='index.php' class='close' data-dismiss='alert' aria-label='close'>&times;</a>Texto de Alerta!</div>-->
		</div>
	</div>
    
	<script>

	function changeText() {
		document.getElementById("esqueceu_senha").style.color = "black";
		document.getElementById("esqueceu_senha").innerHTML = "Para recuperar a senha contate o administrador.";
	}

	function normalText() {
		document.getElementById("esqueceu_senha").style.color = "black";
		document.getElementById("esqueceu_senha").innerHTML = "Esqueceu a senha?";
	}

	function alertText() {
		document.getElementById("esqueceu_senha").style.color = "#D2691E";

	}
	
	
	</script>
	
</body>
</html>

