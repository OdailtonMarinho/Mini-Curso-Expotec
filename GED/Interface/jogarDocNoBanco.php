<?php 

   @include("db_conect.inc");
   @include("..\DAO\DAO.php");
   @include("..\DAO\DB.php");
   session_start();
   
   $doc = new DocumentoDAO();
   $doc->setNome($_FILE)

 ?>