<?php

class Transacciones extends Conexion

{

	protected $tabla = "Transaccion";
	
	public function ConsultarFecha($id, $rubId, $laFecha)
	
	{

		if($this->exitoso === true)
		
		{
		
			$querty = "SELECT * FROM ".$this->tabla." WHERE Usuario_idUsuario =".$id." AND Rubros_idRubros =".$rubId." AND fecha =".$laFecha;
			
			$this->resultado = mysql_query($querty, $this->descriptor) or die(mysql_error());
			
			$this->Distribucion();						
		
		}
		
		else
		
		{
		
			echo "fallido";
		
		}
	
	}
	
	public function ConsultarRubro($id, $rubId)
	
	{
	
		if($this->exitoso === true)
		
		{
		
			$querty = "SELECT * FROM ".$this->tabla." WHERE Usuario_idUsuario =".$id." AND Rubros_idRubros =".$rubId;
			
			$this->resultado = mysql_query($querty, $this->descriptor) or die(mysql_error());
			
			$this->Distribucion();						
		
		}
		
		else
		
		{
		
			echo "fallido";
		
		}	
	
	}
	
	public function InsertarTransaccion($fecha, $idRubros, $idUsuario)
	
	{
		
		$querty = "INSERT INTO Transaccion (fecha, Rubros_idRubros, Usuario_idUsuario) VALUES ('".$fecha."','".$idRubros."','".$idUsuario."')";

		mysqli_query($querty, $this->descriptor) or die (mysql_error());//?
	
	}

}

?>