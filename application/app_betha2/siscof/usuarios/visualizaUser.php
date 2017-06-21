<script> //fun��o para manter servi�os aberto no menu
function abreServicos() {
    document.getElementById("usuarios").click();
}
</script>
<?php 
include("./logica-usuario.php"); 
verificaUsuario();
include ("classes/Usuario.php");
include("mostra-alerta.php"); 
mostraAlerta("success");

// Busca o usuário especifico para visualização
$user = buscaUsuario($_GET["id"]);
?>
<br>
<div>
    <h3 align="center">Editar Usuário</h3>
    <form action="" method="post" class="form-horizontal">        
        
        <div class="form-group">
            <label for="contato-login">Login:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user"></i></div>
                <input id="contato-login" type="text" placeholder="Login" required="required" name="login" class="form-control" value="<?php echo utf8_encode($user["login"]); ?>">
            </div>            
        </div> 
        <div class="form-group">
            <label for="contato-email">Email:</label>
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-envelope"></i></div>
                <input id="contato-email" type="email" placeholder="Email" required="required" name="email" class="form-control" value="<?php echo utf8_encode($user["email"]); ?>">
            </div>
        </div>
        
        <div class="form-group">
		
            <?php 
				if($usuario["super_usuario"] == 1): // caso o usuário seja adm
			?>
            <label class="btn btn-success">Super Usuário <input type="checkbox" name="adm" <?php if($user["super_usuario"] == 1) echo "checked"; ?>></label><br>  <br>
            <?php endif; ?>
			
			<!-- Faz as verificações se o usuário é local e/ou está ativo, se sim o checkbox fica marcado-->
            <label class="btn btn-info">Ativo <input type="checkbox" name="ativo" <?php if($user["ativo"] == 1) echo "checked"; ?>></label>
			<label class="btn btn-info">Local <input type="checkbox" name="local" <?php if($user["local"] == 1) echo "checked"; ?>></label>

        </div>
        <button class="btn btn-primary" type="submit" name="atualizar" style="float: right">Atualizar</button> 
    </form>
</div>

<?php 
// Quando é clicado no botão atualizar
if(isset($_POST["atualizar"])){
	// verifica os checkbox marcados e faz as alterações devidas
			
        $userEdit = new Usuario();
        if(isset($_POST["adm"])){
            $userEdit->setAdm(1);	
        }else{
            $userEdit->setAdm(0);
        }
		
		if(isset($_POST["ativo"])){
            $userEdit->setAtivo(1);	
        }else{
            $userEdit->setAtivo(0);
        }
		
		if(isset($_POST["local"])){
            $userEdit->setLocal(1);	
        }else{
            $userEdit->setLocal(0);
        }
        
		
		// seta o resto dos dados
        $userEdit->setId($_GET["id"]);
        $userEdit->setLogin($_POST["login"]);
        $userEdit->setEmail($_POST["email"]);
		
		// atualiza o usuário
        atualizaUsuario($userEdit);
		
		// refresh
        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        echo "<meta HTTP-EQUIV='refresh' CONTENT='0;URL='{$actual_link}'>";
    
    
}
?>