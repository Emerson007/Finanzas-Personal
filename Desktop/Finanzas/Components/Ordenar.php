<?php

class Ordenar

{

	public function FechaF($a, $b)
	
	{
	
		echo "Entro I";
		
		echo $a;
	
    	return strtotime($b[0]) - strtotime($a[0]);
    	
	}	
	
	public function FechaP($a, $b)
	
	{
	
		echo "Entro II";
		
		echo $a;		
	
    	return strtotime($a[0]) - strtotime($b[0]);
    	
	}
	
	public function MontoMa($tConexion, $filasC)
	
	{
	
		for($a = 1; $a < $filasC; $a++)
		
		{
		
			for($b = 0; $b < $filasC; $b++)
		
			{
		
				if($tConexion[$a][4] === '1')
				
				{
				
					if(is_numeric($tConexion[$a][3]))
					
					{
					
						if($tConexion[$a][3] > $tConexion[$b][3])
						
						{
						
							$temp = $tConexion[$a];
							$tConexion[$a] = $tConexion[$b];
							$tConexion[$b] = $temp;
						
						}
					
					}
				
				}
		
			}
		
		}
		
		for($a = 1; $a < $filasC; $a++)
		
		{
		
			for($b = 0; $b < $filasC; $b++)
		
			{
		
				if(($tConexion[$a][4] === '0')&&($tConexion[$b][4] === '0'))
				
				{
				
					if(is_numeric($tConexion[$a][3]))
					
					{
					
					//echo "Entro";
					
						if($tConexion[$a][3] < $tConexion[$b][3])
						
						{
						
							$temp = $tConexion[$a];
							$tConexion[$a] = $tConexion[$b];
							$tConexion[$b] = $temp;
						
						}
					
					}
				
				}
		
			}
		
		}		
		
		return $tConexion;
	
	}

	public function MontoMe($tConexion, $filasC)
	
	{
	
		for($a = 1; $a < $filasC; $a++)
		
		{
		
			for($b = 0; $b < $filasC; $b++)
		
			{
		
				if($tConexion[$a][4] === '1')
				
				{
				
					if(is_numeric($tConexion[$a][3]))
					
					{
					
						if($tConexion[$a][3] > $tConexion[$b][3])
						
						{
						
							$temp = $tConexion[$a];
							$tConexion[$a] = $tConexion[$b];
							$tConexion[$b] = $temp;
						
						}
					
					}
				
				}
		
			}
		
		}
		
		for($a = 1; $a < $filasC; $a++)
		
		{
		
			for($b = 0; $b < $filasC; $b++)
		
			{
		
				if(($tConexion[$a][4] === '0')&&($tConexion[$b][4] === '0'))
				
				{
				
					if(is_numeric($tConexion[$a][3]))
					
					{
					
					//echo "Entro";
					
						if($tConexion[$a][3] < $tConexion[$b][3])
						
						{
						
							$temp = $tConexion[$a];
							$tConexion[$a] = $tConexion[$b];
							$tConexion[$b] = $temp;
						
						}
					
					}
				
				}
		
			}
		
		}		
		
		return array_reverse($tConexion);
	
	}

}

?>