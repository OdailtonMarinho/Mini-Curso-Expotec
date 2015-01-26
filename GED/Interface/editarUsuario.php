<!DOCTYPE html>

<?php 
   
   @include("db_conect.inc");
   @include("..\DAO\DAO.php");
   @include("..\DAO\DB.php"); 

   session_start();
   if(!isset($_SESSION['cpf'])) { header("Location: login.php"); }

?>

<html>
<head>
	<title>Editar Usuário</title>
	<meta charset="UTF-8"/>
	<link rel="stylesheet" type="text/css" href="stylesheet.css"/>
	<link rel="shortcut icon" href="imagens/favicon.png" type="image/x-icon">
	<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
        <script src="script.js"></script>
</head>
<body>
	<div id="corpo3">
		<div id="cabecalho">

			<div class="welcome"><h3>Olá, <?php echo $_SESSION['nome'] ?>.</h3></div>
			<a <?php if($_SESSION['nivel'] == 1) { echo "href='./administrador.php'"; }  else { echo  "href='./usuario.php'"; } ?> ><div class="tools" id="lix"><img src="imagens/voltar.png" title="Voltar" height="60px" width="60px"/></div></a>
		</div>
		<h2>Editar Usuário</h2>
		</br>
		  <form action='editarUsuario.php' method='POST'>
             <table>
                 <tr>
                   <td colspan="2"><label for="listarUsuarios">Usuário: </label>
                   <input type="text" name="listarUsuarios" id="listarUsuarios">


                   <input type="submit" value="Listar" id="entrar"/></td>
                 </tr>

                 <tr>
                   <td colspan="2"><label for="listarNivel"> Nivel: </label>
                   <select id='listarNivel' name="listarNivel">
                   	  <option value='nulo'> --- </option>
                   	  <?php 

                   	      	  $n = new NivelDAO();
                   	          $q = $n->listarTudo();
                   	          while ($linha = mysql_fetch_assoc($q)) 
                   	          {
                   	      	      echo "<option value=".$linha['Id'].">".$linha['Nome']."</option>";
                   	          }

                   	   ?>
                   
                   </td></td>
                   </form>
                 </tr>

		    <?php if(isset($_GET['selUsu']))
		    {
		    	
		    	$usu = new UsuarioDAO();
		    	$q = $usu->listarUsuario($_GET['selUsu']);
		    	while ($linha = mysql_fetch_assoc($q)) 
		    	{
		    		$nome = $linha['nome'];
		    		$email = $linha['email'];
		    	}

		    	echo "

			<form action='alterarViaAdm.php' method='POST'>
			<tr><td><h3>Alterar Nome: </td><td><input name='nome' value=".$nome." type='text'></h3></br></td></tr>
			<tr><td><h3>Alterar Email: </td><td><input name='email' value=".$email." type='text'></h3></br></td></tr>
			<tr><td><h3>Nova Senha: </td><td><input name='senha' value='' type='password'></h3></br></td></tr>
			<tr><td><h3>Repetir Senha: </td><td><input name='repetirSenha' value='' type='password'></h3></td></tr>
			<tr><td><center><input type='submit' value='Confirmar' id='entrar'/></center></td>
			    <td><center><a href='editarUsuario.php?excluir='".$_GET['selUsu']."'> Excluir Usuário</a></center></td>
			</tr>";

		    }

		    else 
		    {
		    	echo "

			<tr><td><h3>Alterar Nome: </td><td><input name='nome' type='text'></h3></br></td></tr>
			<tr><td><h3>Alterar Email: </td><td><input name='email' type='text'></h3></br></td></tr>
			<tr><td><h3>Nova Senha: </td><td><input name='senha' value='' type='password'></h3></br></td></tr>
			<tr><td><h3>Repetir Senha: </td><td><input name='repetirSenha' value='' type='password'></h3></td></tr>
			</tr>";
		    }

			?>

			</table>



                   <tr>
                   <td colspan="2" align="center"><label for="jogarNoNivel"> Colocar Usuário no Nivel</label>
                   <select id='jogarNoNivel' name="jogarNoNivel">
                   	  <option value=''> --- </option>
                   	  <?php 

                   	      $niveis = new NivelDAO();
                   	      $q = $niveis->listarTudo();
                   	      while ($linha = mysql_fetch_assoc($q)) 
                   	      {
                   	      	  echo "<option value=".$linha['Id']."> ".$linha['Nome']." </option>";
                   	      }

                   	   ?>
                   </select></td>
                   </tr>
                  </form>



		<div id="lista_docs" class="lista">
		       <?php 

                   	   if(!isset($_GET['verDocs']) && !isset($_GET['selUsu']) && !isset($_GET['excUsu']) && !isset($_GET['excluir']))
                   	   {
                   	       echo "<table>
		                          <tr>
		      	                    <th> Nome </th>
		      	                    <th> CPF </th>
		      	                    <th> Email </th>
		      						<th> Nivel </th>
		      						<th> Documentos </th>
		      						<th> Selecionar </th>
		      						<th> Excluir </th>
		      					  </tr>";

                   	       $usu = new UsuarioDAO();
                   	       $q = $usu->listarPorNome($_POST['listarUsuarios'], $_POST['listarNivel']);
                   	       while ($linha = mysql_fetch_assoc($q))
                   	       {
                   	       	   echo "<tr>
                   	      	            <td>".$linha['nome']."</td>
                   	      	            <td>".$linha['cpf']."</td>
                   	      	            <td>".$linha['email']."</td>
                   	      	            <td>".$linha['Nnome']."</td>
                   	      	            <td><a href='./editarUsuario.php?verDocs=".$linha['cpf']."'>Ver Documentos</a></td>
                   	      	            <td><a href='./editarUsuario.php?selUsu=".$linha['cpf']."'>Selecionar Usuário</a></td>
                   	      	            <td><a href='./editarUsuario.php?excUsu=".$linha['cpf']."'>Excluir Usuário</a></td>
                   	      	         </tr>";
                   	       }
                   	   }

                   	   elseif(isset($_GET['verDocs'])) 
                   	   {
                   	   	   echo"<table>
                   	   	         <tr>
                   	   	           <th> Nome </th>
                   	   	           <th> Excluir </th>
                   	   	         </tr>";
                   	   	   $doc = new DocumentoDAO();
                   	       $q = $doc->listarPorAutor($_GET['verDocs']);
                   	       while ($linha = mysql_fetch_assoc($q))
                   	       {
                   	       	   echo "<tr>
                   	      	            <td>".$linha['nome']."</td>
                   	      	            <td><a href='./editarUsuario.php?excluir=".$linha['cod']."'>Excluir Documento</a></td>
                   	      	         </tr>";
                   	       }
                   	       unset($_GET['verDocs']);
                   	   }

                   	   elseif(isset($_GET['excUsu']))
                   	   {
                   	   	   $usu = new UsuarioDAO();
                   	       $usu->excluir($_GET['excUsu']);
                   	       unset($_GET['excUsu']);
                   	   }

                   	   elseif(isset($_GET['excluir']))
                   	   {
                   	   	   $doc = new DocumentoDAO();
                   	   	   $doc->excluirDeVez($_GET['excluir']);
                   	   	   unset($_GET['excluir']);
                   	   }


                ?>
           </table>
		</div>
	</div>
</body>
</html>