<!DOCTYPE html>

<?php 
   
   @include("db_conect.inc");
   @include("..\DAO\DAO.php");
   @include("..\DAO\DB.php");

   session_start();
   if(!isset($_SESSION['cpf'])) { header("Location: login.php"); } 

   if(isset($_GET['excluir']))
   {
   	   echo "entrou";
   	   $del = new DocumentoDAO();
   	   $del->excluir($_GET['excluir'], $_SESSION['cpf']);
   	   unset($_GET['excluir']);
   	   header("Location: ./usuario.php");
   }

?>

<html>
<head>
	<title>Bem-Vindo!</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="stylesheet.css"/>
	<link rel="shortcut icon" href="imagens/favicon.png" type="image/x-icon">
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script src="script.js"></script>
</head>
<body>
	<div id="corpo2">
		<div id="cabecalho">
			<div class="welcome"><h3>Olá, <?php echo $_SESSION['nome']; ?>.</h3></div>
			<div class="panel">
				<h4>Alterar</h4>
				<a class="link" href="alteracao.php"><p> Alterar dados</p></a>
				<a class="link" href="./logout.php"><p>Sair</p></a>

			</div>
			<div class="tools" id="config"><img src="imagens/configuraçoes.png" height="60px" width="60px" title="Opções"/></div>	
			<a href="lixeira.php"><div class="tools" id="lix"><img src="imagens/lixeira.png" title="Lixeira" height="60px" width="60px"/></div></a>
		</div>
			
		<h2>Seus documentos</h2>

			<div class="panel3">
					<h2>Enviar documento</h2>
					<form enctype="multipart/form-data" action="./mandarPoDB.php" method="POST">
					<table  id="tabela3" style="text-align: right"  CELLPADDING="10" align="center">
					<tr>
						<td colspan="2">
							<input type="file" name="documento" value="Adicionar" id="file"/>
						</td>
					</tr>
					<tr>
						<td><input type="submit" value="Enviar documento" id="entrar"/></td>
						<td><input type="reset" value="Limpar" id="entrar"/><br></td>
					</tr>
					</table>
					</form>
				</div>

		<div class="botoeslixeira">
			<form id="buttondoc">
				<input id="entrar" type="submit" value="Marcar todos"/>
				<input id="entrar" type="reset" value="Enviar pra lixeira"/>
			</form>
		</div>
		<form enctype="multipart/form-data">
		<div id="lista" class="lista">
		   <table>
		      <tr>
		        <th> </th></pre>
		      	<th>  Nome  </th>
		      	<th>  Tipo  </th>
		      	<th>  Excluir  </th>
		      	<th>  Data  </th>
		      </tr>

            <?php 
			     $obj = new DocumentoDAO();
                 $lista = $obj->listarPorAutor($_SESSION['cpf']);
                 while($linha = mysql_fetch_assoc($lista))
                 {
                 	 $tipo = explode(".", $linha['nome']);
                 	 if(count($tipo) == 1) { $tipo[count($tipo) - 1] = "-"; }
                 	 echo "<tr>
                 	           <td><input type='checkbox' name='".$linha['nome']."' value='".$lista['cod']."'/></td>
                 	           <td><a href='..\DAO\Docs\\".$linha['cod']."' target='_blank'>".$linha['nome']."</a></td>
                 	           <td>".$tipo[count($tipo) - 1]."</td>
                 	           <td><a href='./usuario.php?excluir=".$linha['cod']."'>Excluir Documento</a></td>
                 	           <td>'$linha[datinha]'</td>
                 	       </tr>";

                 }
			 ?>
			 </table>
		</div>
		</form>
			<div id="menuuser">
			<div class="menuuser"><img src="imagens/adddoc.png" title="Adicionar documentos" width="65px" height="65px" id="adddoc"/></div>
			<a href="pesquisa.php"><div class="menuuser"><img src="imagens/pesquisar.png" title="Pesquisar" width="65px" height="65px"/></div></a>
		</div>
</body>
</html>