<?php

	$id = 1;

	require_once("DataBase/Conexion.php");
	require_once("DataBase/Rubro.php");	
	require_once("DataBase/Transacciones.php");
	require_once("DataBase/DetalleTransaccion.php");

	$rubro = new Rubro("localhost","FinanzaPersonal","root","root");
	$transacciones = new Transacciones("localhost","FinanzaPersonal","root","root");
	$detalle = new DetalleTransaccion("localhost","FinanzaPersonal","root","root");
	$conexion = new Conexion("localhost","FinanzaPersonal","root","root");	
	
	echo "I</br>";
	
	$rubro->BaseDatos();
	$transacciones->BaseDatos();
	$detalle->BaseDatos();
	$conexion->BaseDatos();	
	
	echo "II</br>";
	
	$conexion->ConsultarTodo($id);
	
	$hola = $conexion->TodosDatos();
	
	for($a = 0; $a < 7; $a++)
   	
	{
	
		for($b = 0; $b < 7; $b++)
   	
		{
	
			echo $hola[$a][$b]." , ";
		   	
		}	
		
		echo "</br>";		
		   	
	}
				
?>
