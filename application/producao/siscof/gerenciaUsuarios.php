<?php
//include('./inicia.php');


include ("funcoes.php");
include("banco_mysql.php");
include("mostra-alerta.php");

	// Função para verificar se usuário é Local
	if(!function_exists("verificaLocal")) {
		// declare your function
		function verificaLocal($usuario){
			return ($usuario["local"] == 1);
		}
	}
	
	if(!function_exists("verificaAdmin")) {
		// Função para verificar se usuário é Admin
		function verificaAdmin($usuario){
			return ($usuario["super_usuario"] == 1);
		}
	}
	
	if(!function_exists("verificaAtivo")) {
		// Função para verificar se usuário está Ativo
		function verificaAtivo($usuario){
			return ($usuario["ativo"] == 1);
		}
	}
	
	if(!function_exists("loginLDAP")) {
		// Função para conectar e autenticar no LDAP
		function loginLDAP($login, $senha){
			
			$servidor='200.135.37.118';
			//$baseDN="ou=Usuarios,dc=cefetsc,dc=edu,dc=br";
			$baseDN="dc=cefetsc,dc=edu,dc=br";

			$conexao = @ldap_connect($servidor) or die ("erro ao conectar no servidor LDAP");

			//echo "<P> Conectado com sucesso no servidor LDAP";

			$filtro = "uid=".$login;

			$result = ldap_search($conexao, $baseDN, $filtro);

			$registros = ldap_get_entries($conexao, $result);
			$userDN = $registros[0]["dn"];

			if (isset($userDN)){
				//echo "<P>". $userDN;
				if (!($bind = @ldap_bind($conexao, $userDN, $senha))) {
					//echo "<P>UsuÃ¡rio e/ou senha invÃ¡lidos";
					return null;
				} else {
					//echo "<P>autenticado com sucesso";
					ldap_unbind($conexao);
					return $login;
				}
			}else{
				//echo "<P>UsuÃ¡rio e/ou senha invÃ¡lidos";
				return null;
			}
		}
	}
	

	if(!function_exists("login")) {
		// Função para validar o login de um usuário
		function login($login, $senha){
			$senhaMd5 = md5($senha);
					
			//recebe os dados do index.php, faz verificações de integridade para depois realizar as consultas nos bancos	
			if((empty($login))or(empty($senhaMd5))) return null;
			
			$query="select * from Usuarios_Permitidos where login ='{$login}'";
			$result=db_mysql($query);
			$row = mysqli_fetch_assoc($result);

			//verifica se é um usuário Ativo, senão nem pode acessar o sistema.
			if(verificaAtivo($row)) {
				//verifica se é um usuário Local
				//se não for, deve logar através do LDAP
				if(verificaLocal($row)) {
					if($senhaMd5 == $row["senha"]) {
						//$_SESSION["login"] = $login;
						//echo "<p><b>Login efetuado com sucesso!</b></p>";
						return $row;
					}
					else return null;
				} else { //usuário autentica com LDAP, não é local
					if (loginLDAP($login, $senha) == null) return null; // ele não existe no LDAP
					else return $row;
				}
			}
			return null;		
		}
	}
	
	if(!function_exists("buscaUsuario")) {
		// Busca usuários através do id
		function buscaUsuario($id){
			$query = "select * from Usuarios_Permitidos where UPid = {$id}";        
			$result=db_mysql($query);
			$usuario = mysqli_fetch_assoc($result);        
			return $usuario;
		}
	}
	
	if(!function_exists("buscarUsuarios")) {
		// Busca todos os usuários
		function buscarUsuarios(){
			
			$query = "SELECT * FROM Usuarios_Permitidos ORDER BY login ASC";
			$busca = db_mysql($query);
			
			$usuarios = [];        
			while ($usuario = mysqli_fetch_array($busca)) {            
				$usuarios[] = $usuario;
			}
			return $usuarios;
		}
	}
	
	
	if(!function_exists("atualizaUsuario")) {
		// Atualiza um usuário passando um objeto usuário por parametro
		function atualizaUsuario(Usuario $user){	     
			$id = $user->getId();
			$administrador = $user->getAdm();
			$local = $user->getLocal();
			
			$login = $user->getLogin();
			
			$email = $user->getEmail();
			
			$ativo = $user->getAtivo();
			
			
			$query = "
				UPDATE Usuarios_Permitidos SET
					UPid = '{$id}',
					super_usuario = '{$administrador}',
					local = '{$local}',   
					login = '{$login}',                
					email = '{$email}',
					ativo = '{$ativo}'
				WHERE UPid = {$id}
			";
			
			$result=db_mysql($query);
			
			$_SESSION["success"] = "Dados alterados com sucesso.";
			
		}
	}
	
	if(!function_exists("addUser")) {
		// Adiciona um novo usuário
		function addUser(Usuario $user){
			$login = $user->getLogin();
			$email = $user->getEmail();
			$administrador = $user->getAdm();
			//$senha = md5($user->getSenha()); //senha criptografada
			//$senha = $user->getSenha();
			$local = $user->getLocal(isset($local));
			$ativo = $user->getAtivo(isset($ativo));
			
			$query = "INSERT INTO Usuarios_Permitidos (super_usuario, local, login, email, ativo) VALUES "
					. "('{$administrador}','{$local}','{$login}', '{$email}', '{$ativo}')";
			
			$result=db_mysql($query);
			
			echo '<div class="alert alert-success" style="max-width: 600px; padding-top: 12px">
					Cadastro feito com sucesso.
				  </div>';
		}
	}

?>
