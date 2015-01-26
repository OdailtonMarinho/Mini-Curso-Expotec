<?php

$doc = new DocumentoDAO();
$q = $doc->listarPorAutor($_SESSION['cpf']);
while($linha = mysql_fetch_assoc($q))
{
	$tipo = explode(".", $linha['nome']);
	$tipos[$i] = $tipo[count($tipo) - 1];
	$i++;
	}

$t = array_unique($tipos);

foreach($t as $i)
{
	echo "<option value=".$i.">".$i."</option>";
}

 ?>