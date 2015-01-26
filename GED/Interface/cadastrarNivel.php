<?php
      
   @include("db_conect.inc");
   @include("..\DAO\DAO.php");
   @include("..\DAO\DB.php");
   session_start(); 

   if(isset($_POST['cadastrarNivel']) && $_POST['cadastrarNivel'] != "")
   {
   	   $nivel = new NivelDAO();
   	   $nivel->inserirNivel($_POST['cadastrarNivel']);
   	   unset($_POST['cadastrarNivel']);
   	   $_SESSION['cadastrado'] = 1;
   	   header("Location: ./administrador.php");
   }

   else 
   { 
   	  $_SESSION['cadastrado'] = 3;
   	  header("Location: ./administrador.php"); 
   }
?>