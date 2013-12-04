<?php

class Conexion

{

	protected $servidor;
	protected $baseDatos;
	protected $usuario;
	protected $contrasenia;
	
	protected $descriptor;	
	protected $exitoso;
	protected $resultado;
	
	protected $tabla = ".";

    function __construct($inServidor, $inBaseDatos, $inUsuario, $inContrasenia) 
   
    {
   
		$this->servidor = $inServidor;
		$this->baseDatos = $inBaseDatos;
		$this->usuario = $inUsuario;
		$this->contrasenia = $inContrasenia;
       
    }

	public function BaseDatos()
	
	{
	
		echo "I";
	
		$this->descriptor = mysql_connect($this->servidor, $this->usuario, $this->contrasenia);
		
		if (mysqli_connect_errno($this->descriptor))
	
		{
		
			$this->exitoso = false;
		
		}
		
		else
		
		{
		
			$this->exitoso = true;
			
			mysql_select_db($this->baseDatos, $this->descriptor);			
		
		}		
	
	}
	
	public function Consultar($id)
	
	{
	
		if($this->exitoso === true)
		
		{
		
			$querty = "SELECT * FROM ".$this->tabla." WHERE Usuarios_idUsuarios = ".$id;
			
			echo $querty;
			
			$this->resultado = mysql_query($querty, $this->descriptor) or die(mysql_error());			
		
		}
		
		else
		
		{
		
			echo "fallido";
		
		}
	
	}

}

?>