<?php
	
// Inclui as classes e a conexão com o banco de dados.
include ("./gerenciaUsuarios.php");
include ("classes/Usuario.php");
include ("banco_mysql.php");

// Cria um objeto para os usuários
//$repositorioUser = new RepositorioUsuarios($mysqli);

// Cria um objeto para um novo usuário
$user = new Usuario();

// Chama a função que busca os usuários e armazena em uma variável
$usuariosJaCadastrados = buscarUsuarios();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SISCOF - Cadastro</title>
    <link rel="shortcut icon" href="img/icone.png" />
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link href="assets/estilo.css" rel="stylesheet" />
</head>
<body style="background-color:#F8F8FF;">     
    <center>
        <br>
        <?php 
		// Quando o usuário clicar no botão cadastrar, executa esse 'if'
		if(isset($_POST["cadastrar"])){
            $erro = 0;
			
			// Faz o tratamento das variáveis que são capturadas pelo formulário
            
            $login = utf8_decode(str_replace("'"," ",strip_tags($_POST['login'])));
            //$senha = utf8_decode(str_replace("'"," ",strip_tags($_POST['senha'])));
            $email = utf8_decode(str_replace("'"," ",strip_tags($_POST['email'])));
			
			
            $adm = 0;
			$ativo = 1;
			$local = 0;
			
            $msgErro = "";
			
			// Percorre o vetor 
            foreach($usuariosJaCadastrados as $usuarioAntigo){
				// Verifica se já tem algum usuário com esse login
                if($login === $usuarioAntigo["login"]){
                    $erro = 1;
                    $msgErro .= "O login já esta em uso.<br>";
                }
				// Verifica se já tem algum usuário com esse email
                if($email === $usuarioAntigo["email"]){
                    $erro = 1;
                    $msgErro .= "O email já esta em uso.<br>";
                }
            }
			
			// Verifica se deu algum erro e exibe o alerta			
            if($erro != 0){
                echo "<div class='alert alert-danger' style='max-width: 600px; padding-top: 12px'>".
                    utf8_encode($msgErro).
                    "</div>";
            }else{
				// Caso não tenha erro ele seta os dados que vieram do formulário
                $user->setEmail($email);
                $user->setLogin($login);
                //$user->setSenha($senha);
                $user->setAdm($adm);
				$user->setAtivo($ativo);
				$user->setLocal($local);
				// Insere o usuário
                addUser($user);
            }
        }
        ?>
		
		<!-- Formulário de cadastro -->
		
        <form action="" method="post" class="form-horizontal" style="max-width: 600px; padding-top: 12px" data-toggle="validator">        
        
        <div class="form-group has-feedback">
            <label for="contato-login">Login:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input id="contato-login" type="text" placeholder="Login" required="required" name="login" class="form-control" data-minlength="3">
            </div>            
        </div> 
        <div class="form-group has-feedback">
            <label for="contato-email">Email:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                <input id="contato-email" type="email" placeholder="exemplo@domain.com" required="required" name="email" class="form-control" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$">
            </div>
        </div>
        <div class="form-group has-feedback">
            <label for="contato-reemail">Confirme o Email:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                <input id="contato-reemail" type="email" placeholder="exemplo@domain.com" required="required" class="form-control" data-match="#contato-email">
            </div>
        </div>    
        
        <!--<div class="form-group has-feedback">
            <label for="nova-senha">Senha:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                <input id="nova-senha" type="password" placeholder="******" required="required" name="senha" class="form-control" data-minlength="6">
            </div>
        </div>
        <div class="form-group has-feedback">
            <label for="nova-senha2">Confirme a Senha:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                <input id="nova-senha2" type="password" placeholder="******" required="required" class="form-control" data-match="#nova-senha">                
            </div>            
        </div> -->
		
            <button class="btn btn-success" type="submit" name="cadastrar" style="float: right">Cadastrar <i class="fa fa-check"></i></button> 
    </form>       
	<!-- Fim do formulário de cadastro -->
    </section>
    </center>
     
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>	
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.5/validator.min.js"></script>

</body>
</html>