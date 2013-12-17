<?php

	require_once("DataBase/Conexion.php");
	require_once("Components/Ordenar.php");

	$id = 1;
	$tipo = -1;
	$elemento = false;

	$orden = new Ordenar();
	$conexion = new Conexion("localhost","FinanzaPersonal","root","root");
	
	$conexion->BaseDatos();
	
	$conexion->ConsultarTodo($id);
	
	$tConexion = $conexion->TodosDatos();
	
	$filasC = count($tConexion);
	$columnasC = count($tConexion[0]);
	
	if(isset($_POST["orden"]))
    
    {
    
    	if(isset($_POST["rangoF"]))
    
    	{
    	
    		if($_POST["rangoF"] === "upF")
    		
    		{
    		
				usort($tConexion, 'FechaF');
				
				$tipo = 0;
    		
    		}
    		
    		else
    		
    		{
    		
    			if($_POST["rangoF"] === "downF")
    			
    			{
    			
    				usort($tConexion, 'FechaP');
    				
	 	 	  		$tipo = 0;    				
    			
    			}        		
    		
    		}
    		
    		if(isset($_POST["anio"]))
    		
    		{
    		
    			$elemento = true;
    		
    		}
    		
    		else
    		
    		{
    		
    			$elemento = false;    		
    		
    		}
    	
    	}
    	
    	if(isset($_POST["rangoM"]))
    
    	{
    	
    		if($_POST["rangoM"] === "upM")
    		
    		{
    		
				$tConexion = $orden->MontoMa($tConexion);
				
	 	 	  	$tipo = 3;
    		
    		}
    		
    		else
    		
    		{
    		
    			if($_POST["rangoM"] === "downM")
    			
    			{
    			
					$tConexion = $orden->MontoMe($tConexion); 			
					
	 	 	  		$tipo = 3;					
    			
    			}        		
    		
    		}	    	
    	
    	}
    	
    	if(isset($_POST["rangoR"]))
    
    	{
    	
    		if($_POST["rangoR"] === "upR")
    		
    		{
    		
				$tConexion = $orden->RubroA($tConexion);
				
	 	 	  		$tipo = 1;				
    		
    		}
    		
    		else
    		
    		{
    		
    			if($_POST["rangoR"] === "downR")
    			
    			{
    			
					$tConexion = $orden->RubroZ($tConexion);
					
	 	 	  		$tipo = 1;					
    			
    			}        		
    		
    		}		
    	
    	}    	
    
    }
    
	function FechaF($a, $b)
	
	{
	
    	return strtotime($b[0]) - strtotime($a[0]);
    	
	}	
	
	function FechaP($a, $b)
	
	{		
	
    	return strtotime($a[0]) - strtotime($b[0]);
    	
	}
				
?>
<html>
<head xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
	<meta charset="UTF-8"/>
    <link href="Style/estilos.css" rel="stylesheet" type="text/css"/>
</head>
<body id="todo">
	<div id="cuerpo">
		<div id="entorno">
		<?php
			
			$orden->Elemento($elemento);
			
			if($tipo === -1)
			
			{
			
				echo '<div class="datos"></div>';			
			
			}
			
			for($a = 0; $a < $filasC; $a++)
				
			{
				
				if($tipo !== -1)
			
				{
				
					$orden->DeudaAcrede($tConexion[$a][4]);				
				
					if(($tempo = $orden->Identificador($tConexion[$a][$tipo], $tipo)) !== false)
				
					{
				
						echo '<div class="datos"><p class="parrafoDiv">'.$tempo.'</b></div>';
				
					}				
				
				}

				echo '<div class="transacciones">';				
					
				for($b = 0; $b < $columnasC; $b++)
				
				{
					
					switch ($b)

					{
					
    					case 0:
    					
						{
    						
    						echo '<div class="fecha">';
    							
    						echo '<p class="parrafoB"><b class="parrafoN">Fecha de Transacción: </b>'.$tConexion[$a][$b].'</p>';
    							
    						echo '</div>';    							
    						
    					}break;
    						
    					case 1:
    						
    					{
    											
    						echo '<div class="descripcion">';
    							
    						echo '<p class="parrafoB"><b class="parrafoN">Rubro:</b></br>'.$tConexion[$a][$b].'</p>';
    							
    						echo '</div>';    	    						
    						
    					}break;
    						
    					case 2:
    						
    					{
    												
    						echo '<div class="detalle">';
    							
    						echo '<p class="parrafoB"><b class="parrafoN">Detalles:</b></br>'.$tConexion[$a][$b].'</p>';
    							
    						echo '</div>';    	    						
    						
    					}break;
    						
    					case 4:
    						
    					{
    						
							if($tConexion[$a][$b] === '0')
    							
    						{
    							
    							echo '<div class="monto">';
    							
    							echo '<p class="parrafoB"><b class="parrafoN">Monto:</b></br>('.$tConexion[$a][$b-1].')</p>';
    							
	    						echo '</div>';       								
    							
    						}
    							
    						else
    							
    						{
    							
								echo '<div class="monto">';
    							
    							echo '<p class="parrafoB"><b class="parrafoN">Monto:</b></br>'.$tConexion[$a][$b-1].'</p>';
    							
	    						echo '</div>';         								
    							
    						}
    						
    					}break;
    						
    				}    						
					
				}
					
				echo "</div>";
				
			}	
		?>
		</div>
		<div id="seleccion">
            <form method="POST" name="forma" action="index.php">
            	<div id="sinMargen1">
            	    <input type="radio" onclick="disableFecha()" name="orden" value="fecha"/> Ordenar por Fecha
            	</div>
            	<div class="conMargen1">
            	    <input type="radio" name="rangoF" value="upF" id="fec1" disabled/>Al Más Reciente    	
            	</div>
            	<div class="conMargen1">
            	    <input type="radio" name="rangoF" value="downF" id="fec2" disabled/>Al Más Antigua            	
            	</div>
            	<div class="conMargenE">
	            	<input type="checkbox" name="anio" value="confirm" id="year" disabled/>Ordenar por Año
            	</div>
            	<div id="sinMargen2">
            		<input type="radio" onclick="disableMonto()" name="orden" value="monto"/> Ordenar por Monto            	
            	</div>
    			<div class="conMargen2">
            	    <input type="radio" name="rangoM" value="upM" id="mon1" disabled/>Al Más Grande    	
            	</div>
            	<div class="conMargen2">
            	    <input type="radio" name="rangoM" value="downM" id="mon2" disabled/>Al Más Pequeño            	
            	</div>            	
            	<div id="sinMargen3">            	
            		<input type="radio" onclick="disableRubro()" name="orden" value="rubro"/> Ordenar por Rubro         	
            	</div>
    			<div class="conMargen3">
            	    <input type="radio" name="rangoR" value="upR" id="rub1" disabled/>De A a la Z   	
            	</div>
            	<div class="conMargen3">
            	    <input type="radio" name="rangoR" value="downR" id="rub2" disabled/>De Z a la A
            	</div>            	            	
                <input type="submit" value="Reordenar" name="electiva" id="subir">
            </form>
		<script type="text/javascript">

		function disableFecha()
		{
		
			document.getElementById("fec1").disabled=false;
			document.getElementById("fec2").disabled=false;
			document.getElementById("year").disabled=false;
			document.getElementById("mon1").disabled=true;
			document.getElementById("mon2").disabled=true;
			document.getElementById("rub1").disabled=true;
			document.getElementById("rub2").disabled=true;			
									
		}

		function disableMonto()
		{
		
			document.getElementById("mon1").disabled=false;
			document.getElementById("mon2").disabled=false;		
			document.getElementById("fec1").disabled=true;
			document.getElementById("fec2").disabled=true;
			document.getElementById("year").disabled=true;			
			document.getElementById("rub1").disabled=true;
			document.getElementById("rub2").disabled=true;					
									
		}
		
		function disableRubro()
		{
		
			document.getElementById("rub1").disabled=false;
			document.getElementById("rub2").disabled=false;			
			document.getElementById("fec1").disabled=true;
			document.getElementById("fec2").disabled=true;
			document.getElementById("year").disabled=true;						
			document.getElementById("mon1").disabled=true;
			document.getElementById("mon2").disabled=true;
									
		}		

		</script>                    		
		</div>
		<div class="clear"></div>
	</div>
</body>
</html>