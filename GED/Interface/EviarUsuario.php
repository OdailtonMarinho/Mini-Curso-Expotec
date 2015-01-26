<?php 

@include("db_conect.inc");
@include("..\DAO\DAO.php");
@include("..\DAO\DB.php"); 

session_start();
if(!isset($_SESSION['cpf'])) { header("Location: login.php"); }
if($_SESSION['nivel'] != 1) { header("Location: usuario.php"); }


$usu = new UsuarioDAO();
$usu->cadastrar($_POST['nome'], $_POST['cpf'], $_POST['email'], $_POST['senha'], $_POST['nivel']);

if ($_POST['nivel'] != 2)
{
	$usu = new UsuarioDAO();
	$doc = new DocumentoDAO();
	$per = new PermissaoDAO();
	$q = $usu->listarOsDoNivel($_POST['cpf'], $_POST['nivel']);

	while ($linha = mysql_fetch_assoc($q)) 
	{
		$r = $doc->listarPorAutor($linha['cpf']);
		while ($l = mysql_fetch_assoc($r)) 
		{
			$per->inserir($l['cod'], $_POST['cpf'], "ler");
		}
	}

}

if(isset($_POST['auto']))
{
	$_SESSION['cpf'] = $_POST['cpf'];
	$_SESSION['nome'] = $_POST['nome'];
	$_SESSION['nivel'] = $_POST['nivel'];
}

else { header("Location: administrador.php"); }

?>