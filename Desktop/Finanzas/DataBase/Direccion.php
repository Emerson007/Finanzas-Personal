<?php

class Direccion

{

	//private $servidor = "localhost";
	private $servidor = "sql4.freemysqlhosting.net";
	//private $baseDatos = "FinanzaPersonal";
	private $baseDatos = "sql425084";
	//private $usuario = "root";
	private $usuario = "sql425084";
	//private $contrasenia = "root";	
	private $contrasenia = "tJ8!zD2!";
	
	public function getServidor()
	
	{
	
		return $this->servidor;
	
	}

	public function getBaseDatos()
	
	{
	
		return $this->baseDatos;
	
	}
	
	public function getUsuario()
	
	{
	
		return $this->usuario;
	
	}

	public function getContrasenia()
	
	{
	
		return $this->contrasenia;
	
	}	

}

?>