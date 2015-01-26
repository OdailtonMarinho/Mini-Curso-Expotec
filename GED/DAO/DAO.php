<?php

include("DB.php");
include("db_conect.inc.php");

class UsuarioDAO {
	public function erro($q) {
		if($querry) {
			echo "Usuário inserido com sucesso!";
		}

		else {
			echo "Erro ao cadastrar usuário";
		}
	}

	function cadastrar($nome, $cpf, $email, $senha, $fk_nivel) {
		$querry = mysql_query("insert into usuario(nome, cpf, email, senha, nivel) values('$nome', '$cpf', '$email', '$senha', '$fk_nivel');");
		echo "insert into usuario(nome, cpf, email, senha, fk_nivel) values('$nome', '$cpf', '$email', '$senha', '$fk_nivel');";
		erro($querry);

	}

	function editar($nome, $email, $cpf) {
		$querry = mysql_query("update usuario set nome = '$nome', email = '$email' where cpf = '$cpf';");
		erro($querry);
	}

	function editarSenha($senha, $cpf)
	{
		$query = mysql_query("update usuario set senha = '$senha' where cpf = '$cpf';");
		erro($query);
	}

	function excluir($cpf) {
		$querry = mysql_query("delete from usuario where cpf = '$cpf'");
		erro($querry);
	}

	function listarUsuario($cpf)
	{
		$query = mysql_query("select * from usuario usuario where cpf = '$cpf';");
		//echo "select * from usuario usuario where cpf = '$cpf'";
		if($query) { return $query; }
		erro($query);
	}

	function listarTudo()
	{
		$query = mysql_query("select * from usuario usuario;");
		//echo "select * from usuario usuario where cpf = '$cpf'";
		if($query) { return $query; }
		erro($query);
	}

	function listarPorNome($nome, $nivel) {
		$filtro = "";
		if($nome != "") 
		{
			$filtro .= " and usuario.nome like '%$nome%'";
		}

		if($nivel != "nulo") { $filtro .= " and usuario.nivel = '$nivel'"; }
		$querry = mysql_query("select *, nivel.nome as 'Nnome' from usuario, nivel where nivel.Id = usuario.nivel $filtro;");
		//echo "select *, nivel.nome as 'Nnome' from usuario, nivel where nivel.Id = usuario.nivel $filtro;";
		erro($querry);
		if($querry) { return $querry; }
	}

	function listarOsDoNivel($cpf, $nomeNivel)
	{
		$q = mysql_query("select cpf from usuario where nivel = '$nomeNivel' and cpf != '$cpf';");
		echo "select cpf from usuario where nivel = '$nomeNivel' and cpf != '$cpf';";
		return $q;
	}

}

class DocumentoDAO {
	function inserir($nome, $tmpNome, $data, $cod, $excluido, $autor) {
		if ($excluido)
			$excluido = "true";
		else 
			$excluido = "false";
		$caminho = "C:\\xampp\\htdocs\\GED\\DAO\\Docs\\" . $cod;

		if (file_exists($nome))
			echo 	"1";
		if (is_dir("C:\\xampp\\htdocs\\GED\\DAO\\Docs"))
			echo "2";

		move_uploaded_file($tmpNome, $caminho);
		$query = mysql_query("insert into documento(cod, nome, dat, excluido, autor) values('$cod', '$nome', '$data', $excluido, '$autor');");
		erro($query);
		echo "insert into documento(cod, nome, dat, caminho, excluido, autor) values('$cod', '$nome', '$data', '$caminho', $excluido, '$autor');";
	}

	function editar($novo_valor, $cod) {
	     foreach($novo_valor as $nv) {
	     	$querry = mysql_query("update documento set '$novo_valor' = '$novo_valor' where cod = '$cod';");
	     	mysql_error();
	     }

	     
    }

    function excluir($cod, $cpf) {
    	$querry = mysql_query("update documento set excluido = true where cod = '$cod' and autor = '$cpf';");
    	echo "update documento set excluido = true where cod = '$cod' and autor = '$cpf';";
    	erro($querry);
    }

    function excluirDeVez($cod) {
    	$querry = mysql_query("delete from documento where cod = '$cod';");
    	//echo "delete from documento where excluido = true and cod = '$cod';";
    	erro($querry);
    	unlink("C:\\xampp\\htdocs\\GED\\DAO\\Docs\\" . $cod);
    }

    function recuperar($cod, $cpf) {
    	$querry = mysql_query("update documento set excluido = false where cod = '$cod' and autor = '$cpf';");
    	erro($querry);
    }

    function listarTudo($cpf, $nome="", $data="", $autor="") {
    	$filtro = "";
    	if($data != "") { $filtro .= " and DATE_FORMAT(dat, '%d/%m/%Y') = '$data'"; }
    	if($nome != "") { $filtro .= " and documento.nome LIKE '%$nome%'"; } 
    	if($autor != "" && $autor != 'nulo') { $filtro .= " and documento.autor = '$autor'"; }

    	$querry = mysql_query("select permissao.cod as 'cod', documento.nome as 'nome', documento.autor as 'autor', DATE_FORMAT(dat, '%d/%m/%Y') as datinha, permissao.nome as 'perNome' from permissao, documento, usuario where permissao.cpf = '$cpf' and (permissao.nome = 'ler' or permissao.nome = 'escrever') and permissao.cod = documento.cod and usuario.cpf = permissao.cpf and excluido = 0 $filtro;");
		//echo "select permissao.cod as 'cod', documento.nome as 'nome', documento.autor as 'autor', DATE_FORMAT(dat, '%d/%m/%Y') as datinha, permissao.nome as 'perNome' from permissao, documento, usuario where permissao.cpf = '$cpf' and (permissao.nome = 'ler' or permissao.nome = 'escrever') and permissao.cod = documento.cod and usuario.cpf = permissao.cpf and excluido = 0 $filtro;";
		erro($querry);
		if($querry) { return $querry; }
    }

    function listarPorAutor($cpf) {
    	$querry = mysql_query("select *, DATE_FORMAT(dat, '%d/%m/%Y') as datinha from documento where autor = '$cpf' and excluido = false;");
		erro($querry);
		if($querry) { return $querry; }
    }

    function listarExcluidosAutor($cpf) {
    	$querry = mysql_query("select *, DATE_FORMAT(dat, '%d/%m/%Y') as datinha from documento where autor = '$cpf' and excluido = true;");
		erro($querry);
		if($querry) { return $querry; }
    }

    function listarComum($cpf, $nome, $tipo, $data)
    {
    	$filtro = "";
    	if($data != "") { $filtro .= " and DATE_FORMAT(dat, '%d/%m/%Y') = '$data'"; }
    	if($nome != "") { $filtro .= " and nome LIKE '%$nome%'"; } 
    	$querry = mysql_query("select *, DATE_FORMAT(dat, '%d/%m/%Y') as datinha from documento where autor = '$cpf' $filtro;");
    	//echo "select *, DATE_FORMAT(dat, '%d/%m/%Y') as datinha from documento where autor = '$cpf' $filtro;";
		erro($querry);
		if($querry) { return $querry; }
    }

    function buscarDono($cpf)
    {
    	$q = mysql_query("select nome, cpf from usuario where cpf = '$cpf';");
    	erro($q);
		if($q) { return $q; }
    }

}

class PermissaoDAO {
	function inserir($Fk_Doc, $Fk_Usu, $nome) {
		$query = mysql_query("insert into permissao(nome, cpf, cod) values('$nome','$Fk_Usu', '$Fk_Doc');");
		echo "insert into permissao(nome, cpf, cod) values('$nome','$Fk_Usu', '$Fk_Doc');";
		erro($query);
	}

	function editar($id, $nome) {
		$query = mysql_query("update permissao set nome = '$nome' where id = '$id';");
		erro($query);
	}

}

class NivelDAO {
	function inserirNivel($n) {
		$query = mysql_query("insert into nivel(nome) values ('$n');");
		erro($query);
		if($query) return true;
		else return false;
	}

	function editarNivel(NivelDB $n) {
		$query = mysql_query("update nivel set nome = '$n->getNome' where id = '$n->getId';");
		erro($query);
	}

	function deletarNivel(NivelDB $n) {
		$query = mysql_query("delete from nivel where id = '$n->getId';");
	}

	function listarTudo() {
		$query = mysql_query("select * from nivel;");
		return $query;
	}

	function listarPorId($id)
	{
		$query = mysql_query("select * from nivel where Id = '$id';");
		return $query;
	}
}

?>