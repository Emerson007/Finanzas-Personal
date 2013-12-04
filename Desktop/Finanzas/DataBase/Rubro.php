<?php

class Rubro extends Conexion

{

	protected $tabla = "Rubros";
	
	public function Distribucion()
	
	{
	
		
	
	}
	
	public function TodosRubros()
	
	{
	
		
	
	}
	
	public function InsertarRubro($descriptor, $libro, $id)
	
	{
	
		if($libro === "yes")
		
		{
		
			$querty = "INSERT INTO Rubros (descripcion, libro, Usuario_idUsuario) VALUES ('".$descriptor."','1','".$id."')";

			mysqli_query($querty, $this->descriptor) or die (mysql_error());//?
		
		}
		
		else
		
		{
		
			if($libro === "no")
			
			{
			
				$querty = "INSERT INTO Rubros (descripcion, libro, Usuario_idUsuario) VALUES ('".$descriptor."','0','".$id."')";			
				
				mysqli_query($querty, $this->descriptor) or die (mysql_error());//?				
			
			}
			
			else
			
			{
			
			
			
			}
		
		}
	
	}
	
}

?>