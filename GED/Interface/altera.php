<?php

session_start()
$usu = new UsuarioDAO();
$usu->editar($_POST['nome'], $_POST['email'], $_SESSION['cpf']);

if($_POST['senha'] != "" && $_POST['repetirSenha'] != "")
{
	$usu->editarSenha($_POST['senha'], $_SESSION['cpf']);
}

if($_SESSION['nivel'] == 1) { header("Location: ./administrador.php"); }
else header("Location: ./usuario.php");

?>