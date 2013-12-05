<?php
	require_once("DataBase/Conexion.php");
	require_once("DataBase/Rubro.php");	
	$indexion = new Rubro("localhost","FinanzaPersonal","root","root");
	$indexion->BaseDatos();
	//$indexion->Inicializar();
	$indexion->Consultar(1);
	//$indexion->Distribucion();
	$hola = $indexion->TodosRubros();

	for($a = 0; $a < 2; $a++)
   	
	{
	
		for($b = 0; $b < 5; $b++)
   	
		{
	
			echo $hola[$a][$b]." , ";
		   	
		}	
		
			echo "</br>";		
		   	
	}
	
?>