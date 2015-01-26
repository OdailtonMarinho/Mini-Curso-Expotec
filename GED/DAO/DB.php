<?php

 function erro($q) {
	if($q){ /*echo "Operação realizada com exito.";*/ }
	else { echo "Erro ao realizar operação."; }
}

class UsuarioDB {
	private $fk_nivel;
	private $nome;
	private $senha;
	private $cpf;
	private $email;

	function getFk_nivel() { return $this->fk_nivel; }
	function setFk_nivel($nivel) { $this->fk_nivel = $nivel; }

	function getNome() { return $this->nome; }
	function setNome($nome) { $this->nome = $nome; }

	function getSenha() { return $this->senha; }
	function setSenha($senha) { $this->senha = $senha; }

	function getCpf() { return $this->cpf; }
	function setCpf($cpf) { $this->cpf = $cpf; }

	function getEmail() { return $this->email; }
	function setEmail($e) { $this->email = $e; }
}

class DocumentoDB {
	private $cod;
	//private $tipo;
	private $data;
	private $caminho;
	private $excluido;
	private $nome;
	private $autor;

	function getCod() { return $this->cod; }
	function setCod($c) { $this->cod = $c; }

	function getNome() { return $this->nome; }
	function setNome($nome) { $this->nome = $nome; }

	//function getTipo() { return $this->tipo; }
	//function setTipo($t) { $this->tipo = $t; }
	
	function getData() { return $this->$data; }
	function setData($d) { $this->data = $d; }

	function getCaminho() { return $this->caminho; }
	function setCaminho($c) { $this->caminho = $c; }

	function getExcluido() { return $this->excluido; }
	function setExcluido($ex) { $this->excluido = $ex; }

	function getAutor() { return $this->autor; }
	function setAutor($a) { $this->autor = $a; }
}

class NivelDB {
	private $id;
	private $nome;

	function getId() { return $this->id; }
	function setId($id) { $this->$id = $id; }

	function getNome() { return $this->nome; }
	function setNome($nome) { $this->nome = $nome; }
}

class PermissaoDB {
	private $fk_usu;
	private $fk_doc;
	private $nome;
	private $id;

    function getFk_usu() { return $this->fk_usu; }
	function setFk_usu($usu) { $this->fk_usu = $usu; }

	function getFk_doc() { return $this->fk_doc; }
	function setFk_doc($doc) { $this->fk_doc = $doc; }

	function getNome() { return $this->nome; }
	function setNome($nome) { $this->nome = $nome; }

	function getId() { return $this->id; }
	function setId($nome) { $this->id = $id; }



}

?>
