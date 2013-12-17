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
	protected $losDatos;
	
    function __construct($inServidor, $inBaseDatos, $inUsuario, $inContrasenia) 
   
    {
   
		$this->servidor = $inServidor;
		$this->baseDatos = $inBaseDatos;
		$this->usuario = $inUsuario;
		$this->contrasenia = $inContrasenia;
       
    }	

	public function BaseDatos()
	
	{
	
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
	
	public function ConsultarTodo($id)
	
	{
	
		if($this->exitoso === true)
		
		{
		
			$querty = "SELECT T.fecha, R.descripcion, D.detalle, D.monto, R.libro, T.idTransaccion, T.Rubros_idRubros".
						" FROM Transaccion T INNER JOIN Rubros R ON R.idRubros = T.Rubros_idRubros INNER JOIN".
						" DetalleTransaccion D ON D.Transaccion_idTransaccion = T.idTransaccion WHERE T.Usuario_idUsuario".
						" =".$id." AND R.Usuario_idUsuario =".$id;
			
			$this->resultado = mysql_query($querty, $this->descriptor) or die(mysql_error());
			
			$this->Distribucion();	
		
		}
	
	}
	
	public function ConsultarFecha($id, $rubId, $laFecha)
	
	{

		if($this->exitoso === true)
		
		{
		
			$querty = "SELECT T.fecha, R.descripcion, D.detalle, D.monto, R.libro, T.idTransaccion, T.Rubros_idRubros".
						" FROM Transaccion T INNER JOIN Rubros R ON R.idRubros = T.Rubros_idRubros INNER JOIN".
						" DetalleTransaccion D ON D.Transaccion_idTransaccion = T.idTransaccion WHERE T.Usuario_idUsuario".
						" =".$id." AND R.Usuario_idUsuario =".$id." AND T.fecha =".$laFecha;
						
			$this->resultado = mysql_query($querty, $this->descriptor) or die(mysql_error());
			
			$this->Distribucion();						
		
		}
	
	}
	
	public function ConsultarRubro($id, $rubId)
	
	{
	
		if($this->exitoso === true)
		
		{
		
			$querty = "SELECT T.fecha, R.descripcion, D.detalle, D.monto, R.libro, T.idTransaccion, T.Rubros_idRubros".
						" FROM Transaccion T INNER JOIN Rubros R ON R.idRubros = T.Rubros_idRubros INNER JOIN".
						" DetalleTransaccion D ON D.Transaccion_idTransaccion = T.idTransaccion WHERE T.Usuario_idUsuario".
						" =".$id." AND R.Usuario_idUsuario =".$id." AND T.Rubros_idRubros =".$rubId;			
			
			$this->resultado = mysql_query($querty, $this->descriptor) or die(mysql_error());
			
			$this->Distribucion();						
		
		}
	
	}
	
	public function ConsultarSoloRubro($id)
	
	{
	
		if($this->exitoso === true)
		
		{
		
			$querty = "SELECT descripcion, idRubros FROM Rubros WHERE Usuario_idUsuario =".$id;		
			
			$this->resultado = mysql_query($querty, $this->descriptor) or die(mysql_error());
			
			$this->Distribucion();						
		
		}	
	
	}
	
	public function InsertarDetalles($detalle, $monto, $idTrans)
	
	{
		
		$querty = "INSERT INTO DetalleTransaccion (detalle, monto, Transaccion_idTransaccion) VALUES ('".$detalle."','".$monto."','".$idTrans."')";

		mysqli_query($querty, $this->descriptor) or die (mysql_error());
	
	}
	
	public function InsertarRubro($descriptor, $libro, $idUsuario)
	
	{
		
		$querty = "INSERT INTO Rubros (descripcion, libro, Usuario_idUsuario) VALUES ('".$descriptor."','".$libro."','".$idUsuario."')";

		mysqli_query($querty, $this->descriptor) or die (mysql_error());
			
	}
	
	public function InsertarTransaccion($fecha, $idRubros, $idUsuario)
	
	{
		
		$querty = "INSERT INTO Transaccion (fecha, Rubros_idRubros, Usuario_idUsuario) VALUES ('".$fecha."','".$idRubros."','".$idUsuario."')";

		mysqli_query($querty, $this->descriptor) or die (mysql_error());
	
	}		
	
	protected function Distribucion()
	
	{
	
		$length = mysql_num_rows($this->resultado);
   	
	   	for($a = 0; $a < $length; $a++)
   	
	   	{
   	
   			$row = mysql_fetch_assoc($this->resultado);
   	
	   		$b = 0;
   	
			foreach($row as $value)
   		
	   		{
	   		
	 			$this->losDatos[$a][$b] = $value;
	   				
				$b++;
	   		
   			}
	
		}			
	
	}	
	
	public function TodosDatos()
	
	{
	
		return $this->losDatos;
	
	}			

}

?>