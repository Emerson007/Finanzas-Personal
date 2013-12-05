<?php

class DetalleTransaccion extends Conexion

{

	protected $tabla = "DetalleTransaccion";
	
	public function ConsultarTransaccion($id, $transId)
	
	{
	
		if($this->exitoso === true)
		
		{
		
			$querty = "SELECT * FROM ".$this->tabla." WHERE Usuario_idUsuario =".$id." AND Transaccion_idTransaccion =".$transId;
			
			$this->resultado = mysql_query($querty, $this->descriptor) or die(mysql_error());
			
			$this->Distribucion();					
		
		}
		
		else
		
		{
		
			echo "fallido";
		
		}	
	
	}
	
	public function ConsultarMontos($id, $rango)
	
	{
	
		if($this->exitoso === true)
		
		{
		
			$querty = "SELECT * FROM ".$this->tabla." WHERE Usuario_idUsuario =".$id." AND monto ".$rango;
			
			$this->resultado = mysql_query($querty, $this->descriptor) or die(mysql_error());
			
			$this->Distribucion();			
		
		}
		
		else
		
		{
		
			echo "fallido";
		
		}	
	
	}		
	
	public function InsertarDetalles($detalle, $monto, $idTrans, $idUsuario)
	
	{
		
		$querty = "INSERT INTO DetalleTransaccion (detalle, monto, Transaccion_idTransaccion, Usuario_idUsuario) VALUES ('".$detalle."','".$monto."','".$idTrans."','".$idUsuario."')";

		mysqli_query($querty, $this->descriptor) or die (mysql_error());//?
	
	}

}

?>