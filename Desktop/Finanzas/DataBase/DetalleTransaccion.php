<?php

class DetalleTransaccion extends Conexion

{

	protected $tabla = "DetalleTransaccion";
	
	public function ConsultarTransaccion($id, $transId)
	
	{
	
		if($this->exitoso === true)
		
		{
		
			$querty = "SELECT * FROM ".$this->tabla." WHERE Transaccion_idTransaccion =".$transId;
			
			$this->resultado = mysql_query($querty, $this->descriptor) or die(mysql_error());
			
			$this->Distribucion();					
		
		}
		
		else
		
		{
		
			echo "fallido";
		
		}	
	
	}
	
	public function Consultar($id)
	
	{
	
		if($this->exitoso === true)
		
		{
		
			$querty = "SELECT * FROM ".$this->tabla;
			
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
		
		$querty = "INSERT INTO DetalleTransaccion (detalle, monto, Transaccion_idTransaccion) VALUES ('".$detalle."','".$monto."','".$idTrans."')";

		mysqli_query($querty, $this->descriptor) or die (mysql_error());
	
	}

}

?>