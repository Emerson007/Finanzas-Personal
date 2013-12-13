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
	
	public function Consultar($id)
	
	{
	
		if($this->exitoso === true)
		
		{
		
			$querty = "SELECT * FROM ".$this->tabla." WHERE Usuario_idUsuario =".$id;
			
			$this->resultado = mysql_query($querty, $this->descriptor) or die(mysql_error());
			
			$this->Distribucion();			
		
		}
		
		else
		
		{
		
			echo "fallido";
		
		}
	
	}
	
	
	public function ConsultarTodo($id)
	
	{
	
		if($this->exitoso === true)
		
		{
		
			$querty = "SELECT T.fecha, R.descripcion, D.detalle, D.monto, R.libro, T.idTransaccion, T.Rubros_idRubros".
						" FROM Transaccion T INNER JOIN Rubros R ON R.idRubros = T.Rubros_idRubros INNER JOIN".
						" DetalleTransaccion D ON D.Transaccion_idTransaccion = T.idTransaccion WHERE T.Usuario_idUsuario".
						" =".$id." AND R.Usuario_idUsuario =".$id." AND D.Usuario_idUsuario=".$id;
			
			$this->resultado = mysql_query($querty, $this->descriptor) or die(mysql_error());
			
			$this->Distribucion();			
		
		}
		
		else
		
		{
		
			echo "fallido";
		
		}
	
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