<?php

$host = "localhost:3306";
$user = "root";
$senha = "";
mysql_connect($host, $user, $senha) or die ("Conexão recusada!!");
mysql_select_db("ged");

/*$host = "mysql.hostinger.com.br";
$user = "u674181720_oda";
$senha = "192168064";
mysql_connect($host, $user, $senha) or die ("Conexão recusada!!");
mysql_select_db("u674181720_001");*/
mysql_query("SET NAMES 'utf8'");
mysql_query('SET character_set_connection=utf8');
mysql_query('SET character_set_client=utf8');
mysql_query('SET character_set_results=utf8');


?>