<?php

class Usuario
{
	// Atributos da classe USUÁRIO (Basicamente as colunas da tabela do usuário)
    private $id;
	private $adm;
	private $local;
	private $login;
    private $senha;
    private $email;
	private $ativo;

    // FUNÇÕES GET
	// Como os atributos são privados por segurança, se utiliza esse métodos para poder retornar o valor da variavel
	
	function getId() {
        return $this->id;
    }
	
	function getAdm() {
        return $this->adm;
    }
	
	function getLocal() {
        return $this->local;
    }
	
	function getLogin() {
        return $this->login;
    }
	
	function getSenha() {
         return $this->senha;
    }
	
	function getEmail() {
        return $this->email;
    }
	
	function getAtivo() {
        return $this->ativo;
    }
		
	// FUNÇÕES SET
	// Usadas para não manipular diretamente os atributos da classe

    function setId($id) {
        $this->id = $id;
    }
	
	function setAdm($adm) {
        $this->adm = $adm;
    }
	
	function setLocal($local) {
        $this->local = $local;
    }
	
	function setLogin($login) {
        $this->login = $login;
    }
	
	function setSenha($senha) {
        $this->senha = $senha;
    }
	
	function setEmail($email) {
        $this->email = $email;
    }
	
    function setAtivo($ativo) {
        $this->ativo = $ativo;
    }
    
}
