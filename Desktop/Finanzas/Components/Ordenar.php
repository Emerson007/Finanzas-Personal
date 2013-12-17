<?php

class Ordenar

{

	private $claves;
	
	private $losRubros;
	
	private $meses;
	
	private $elemento;
	
	private $deudorAcreedor;
	
	function __construct()
   
	{

		$this->meses[0] = "Mes";	
		$this->meses[1] = "Enero";
		$this->meses[2] = "Febrero";
		$this->meses[3] = "Marzo";
		$this->meses[4] = "Abril";
		$this->meses[5] = "Mayo";
		$this->meses[6] = "Junio";
		$this->meses[7] = "Julio";
		$this->meses[8] = "Agosto";
		$this->meses[9] = "Septiembre";
		$this->meses[10] = "Octubre";
		$this->meses[11] = "Noviembre";
		$this->meses[12] = "Diciembre";
	
	}
	
	public function Elemento($elemento)
	
	{
	
		$this->elemento = $elemento;
	
	}
	
	public function DeudaAcrede($deudorAcreedor)
	
	{
	
		$this->deudorAcreedor = $deudorAcreedor;
	
	}
	
	public function Hoy($hoy)
	
	{
	
		$hoy = date_parse_from_format("Y-m-d", $hoy);
		
		return $hoy["month"].' de '.$this->meses[$hoy["month"]].' de '.$hoy["year"];		
	
	}
	
	private function Mes($terminal)
	
	{
	
		$terminal = date_parse_from_format("Y-m-d", $terminal);
		
		return $this->meses[$terminal["month"]].' de '.$terminal["year"];
	
	}

	private function Anio($terminal)
	
	{
	
		$terminal = date_parse_from_format("Y-m-d", $terminal);
		
		return $terminal["year"];
	
	}

	public function Identificador($term, $tipo)
	
	{
	
		$termino = "";
	
		switch ($tipo)

		{
					
    		case 0:
    					
			{
			
				if($this->elemento)
				
				{
				
					$termino = $this->Anio($term);					
				
				}
				
				else
				
				{
				
					$termino = $this->Mes($term);
				
				}
			
			}break;
			
			case 1:
			
			{
			
				$termino = $term;
			
			}break;
			
			case 3:
			
			{
			
				if($this->deudorAcreedor)
				
				{

					$termino = "Acreedores";				
				
				}
				
				else
				
				{
				
					$termino = "Deudores";
				
				}
			
			}break;
			
		}
	
		$validar = true;
	
		if(empty($this->claves))
		
		{
		
			$this->claves[0] = $termino;
		
		}
		
		else
		
		{
		
			for($a = 0; $a < count($this->claves); $a++)
		
			{
		
				if($this->claves[$a] === $termino)
				
				{
				
					$validar = false;
				
					break;
				
				}
		
			}	
		
		}
		
		if($validar)
		
		{
		
			$this->claves[count($this->claves)] = $termino;
			
			return $termino;
		
		}
		
		else
		
		{
		
			return false;
		
		}
	
	}
	
	public function RubroA($tConexion)
	
	{
	
		for($a = 0; $a < count($tConexion); $a++)
		
		{
		
			$validar = true;	
		
			if(empty($this->losRubros))
		
			{
		
				$this->losRubros[0] = $tConexion[$a][1];
		
			}
			
			else
			
			{
			
				for($b = 0; $b < count($this->losRubros); $b++)
		
				{
		
					if($this->losRubros[$b] === $tConexion[$a][1])
					
					{
					
						$validar = false;
						
						break;
					
					}
		
				}
				
				if($validar === true)
				
				{
				
					$this->losRubros[count($this->losRubros)] = $tConexion[$a][1];				
				
				}
			
			}
		
		}

		sort($this->losRubros);
		
		$pasos = 0;
		
		for($b = 0; $b < count($this->losRubros); $b++)
		
		{
		
			for($a = 0; $a < count($tConexion); $a++)
		
			{
			
				if($tConexion[$a] === $this->losRubros[$b])
				
				{
				
					$tempo = $tConexion[$a];
					$tConexion[$a] = $tConexion[$pasos];
					$tConexion[$pasos] = $tempo;
				
					$pasos++;
				
				}
			
			}
		
		}
		
		return $tConexion;
		
	}
	
	public function RubroZ($tConexion)
	
	{
		
		return array_reverse($this->RubroA($tConexion));
		
	}
	
	public function MontoMa($tConexion)
	
	{
	
		for($a = 1; $a < count($tConexion); $a++)
		
		{
		
			for($b = 0; $b < count($tConexion); $b++)
		
			{
				
				switch ($tConexion[$a][4])

				{
					
    				case '1':
    					
					{
						
						switch ($tConexion[$b][4])

						{
					
    						case '1':
    					
							{
						
								if($tConexion[$a][3] > $tConexion[$b][3])
						
								{
						
									$temp = $tConexion[$a];
									$tConexion[$a] = $tConexion[$b];
									$tConexion[$b] = $temp;
						
								}						
						
							}break;
						
							case '0':
						
							{
						
								if($tConexion[$a][3] > (-1*$tConexion[$b][3]))
						
								{
						
									$temp = $tConexion[$a];
									$tConexion[$a] = $tConexion[$b];
									$tConexion[$b] = $temp;
						
								}						
						
							}break;
								
						}				
						
					}break;
						
					case '0':
    					
					{
						
						switch ($tConexion[$b][4])

						{
					
    						case '1':
    					
							{
						
								if((-1*$tConexion[$a][3]) > $tConexion[$b][3])
						
								{
						
									$temp = $tConexion[$a];
									$tConexion[$a] = $tConexion[$b];
									$tConexion[$b] = $temp;
						
								}									
						
							}break;
						
							case '0':
						
							{
						
								if((-1*$tConexion[$a][3]) > (-1*$tConexion[$b][3]))
						
								{
						
									$temp = $tConexion[$a];
									$tConexion[$a] = $tConexion[$b];
									$tConexion[$b] = $temp;
						
								}								
						
							}break;
								
						}				
						
					}break;
						
				}
		
			}
		
		}
				
		return $tConexion;
	
	}

	public function MontoMe($tConexion)
	
	{
				
		return array_reverse($this->MontoMa($tConexion));
	
	}

}

?>