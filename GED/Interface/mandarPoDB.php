<?php 

   include("db_conect.inc.php");
   include("..\DAO\DAO.php");
   include("..\DAO\DB.php");

  session_start();
  $nome = $_FILES["documento"]["name"];
  $tmpNome = $_FILES["documento"]["tmp_name"];
  $data = date("y/m/d");
  $cod = "";
  for($i = 0; $i < 8; $i++)
  {
	  $c = rand(32, 126);
	  if(($c > 57 && $c < 64) || $c == 92 || $c == 42 || $c == 34 || $c == 124 || $c == 47){ continue; }
	  else { $cod .= chr($c); }
  }
  $autor = $_SESSION['cpf'];
  $inserir = new DocumentoDAO();
  $inserir->inserir($nome, $tmpNome, $data, $cod, false, $autor);

  $perm = new PermissaoDAO();
  $perm->inserir($cod, $autor, "escrever");

  if($_SESSION['nivel'] != 2)
  {
      $usu = new UsuarioDAO();
      $lista = $usu->listarOsDoNivel($autor, $_SESSION["nivel"]);
      while($linha = mysql_fetch_assoc($lista))
      {
  	      $perm->inserir($cod, $linha['cpf'], "ler");
      }
  }

  if($_SESSION['nivel'] == 1) { header("Location: ./administrador.php"); }
  else header("Location: ./usuario.php");

?>