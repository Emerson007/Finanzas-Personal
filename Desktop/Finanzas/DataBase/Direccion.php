<?php

class Direccion

{

	private $servidor = "localhost";
	private $baseDatos = "FinanzaPersonal";
	private $usuario = "root";
	private $contrasenia = "root";	
	
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