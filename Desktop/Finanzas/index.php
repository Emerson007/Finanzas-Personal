<?php
	require_once("DataBase/Conexion.php");
	require_once("DataBase/Rubro.php");	
	$indexion = new Rubro("localhost","FinanzaPersonal","root","root");
	$indexion->BaseDatos();
	//$indexion->Inicializar();
	$indexion->Consultar(2);	
	
?>