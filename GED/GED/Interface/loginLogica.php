<?php
	require("db_conect.inc.php");
	function isLogged ()
	{
		if ($_SESSION['nome']!='')
			return true;
		else
			return false;
	}

	//login($_POST['nome'],$_POST['senha']);

	    $email = $_POST['nome'];
	    $senha = $_POST['senha'];

		echo "entrou no login<br>";
		$query = mysql_query("select cpf, nivel.nome from usuario, nivel  where email = '$email' and senha = '$senha' and usuario.nivel = nivel.id;");
		while($linha = mysql_fetch_assoc($query)) {
			echo $linha["cpf"];
			$_SESSION['nivel'] = $linha["nivel.nome"];
		    $_SESSION['nome'] = $linha["cpf"];
		    if ($linha["nivel.nome"] == "adm") { header("Location: /Interface/administrador.php"); }
		    else { header("Location: /Interface/usuario.php"); }
	    }

	function logout ()
	{
		session_destroy();
	}

	if (isLogged())
	{
		include("login.php");
	}
	
	/*if (isset($_GET['logout']))
		logout ();*/

	 
?>
