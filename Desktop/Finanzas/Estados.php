<?php

	$id = 1;

	require_once("DataBase/Conexion.php");
	require_once("DataBase/Rubro.php");	
	require_once("DataBase/Transacciones.php");
	require_once("DataBase/DetalleTransaccion.php");
	require_once("Components/Ordenar.php");

	//echo "A";

	$orden = new Ordenar();
	
	//echo "B";	

	$rubro = new Rubro("localhost","FinanzaPersonal","root","root");
	$transacciones = new Transacciones("localhost","FinanzaPersonal","root","root");
	$detalle = new DetalleTransaccion("localhost","FinanzaPersonal","root","root");
	$conexion = new Conexion("localhost","FinanzaPersonal","root","root");
	
	$rubro->BaseDatos();
	$transacciones->BaseDatos();
	$detalle->BaseDatos();
	$conexion->BaseDatos();
	
	$conexion->ConsultarTodo($id);
	$rubro->Consultar($id);
	//$transacciones->ConsultarFecha($id);
	$detalle->ConsultarMontos($id);
	
	$tConexion = $conexion->TodosDatos();
	$tRubro = $rubro->TodosDatos();
	//$tTrans = $transacciones->TodosDatos();
	$tDetalle = $detalle->TodosDatos();
	
	$filasC = count($tConexion);
	$columnasC = count($tConexion[0]);
	
	if(isset($_POST["orden"]))
    
    {
    
    	if(isset($_POST["rangoF"]))
    
    	{
    	
    		if($_POST["rangoF"] === "upF")
    		
    		{
    		
				usort($tConexion, 'FechaF');  		
    		
    		}
    		
    		else
    		
    		{
    		
    			if($_POST["rangoF"] === "downF")
    			
    			{
    			
    				usort($tConexion, 'FechaP');
    			
    			}        		
    		
    		}		
    	
    	}
    	
    	if(isset($_POST["rangoM"]))
    
    	{
    	
    		if($_POST["rangoM"] === "upM")
    		
    		{
    		
				$tConexion = $orden->MontoMa($tConexion, $filasC);    		
    		
    		}
    		
    		else
    		
    		{
    		
    			if($_POST["rangoM"] === "downM")
    			
    			{
    			
					$tConexion = $orden->MontoMe($tConexion, $filasC);    			
    			
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
	<meta charset="UTF-8">
    <link href="Style/estilos.css" rel="stylesheet" type="text/css"/>
</head>
<body id="todo">
	<div id="cuerpo">
		<div id="entorno">
		<?php
			
			//echo '<div class="datos"></div>';
			
			for($a = 0; $a < $filasC; $a++)
				
			{
				
				echo '<div class="transacciones">';
					
				for($b = 0; $b < $columnasC; $b++)
				
				{
					
					switch ($b)

					{
					
    					case 0:
    					
						{
    						
    						echo '<div class="fecha">';
    							
    						echo '<p class="parrafo"><b class="parrafo">Fecha de Transacción: </b>'.$tConexion[$a][$b].'</p>';
    							
    						echo '</div>';    							
    						
    					}break;
    						
    					case 1:
    						
    					{
    											
    						echo '<div class="descripcion">';
    							
    						echo '<p class="parrafo"><b class="parrafo">Rubro:</b></br>'.$tConexion[$a][$b].'</p>';
    							
    						echo '</div>';    	    						
    						
    					}break;
    						
    					case 2:
    						
    					{
    												
    						echo '<div class="detalle">';
    							
    						echo '<p class="parrafo"><b class="parrafo">Detalles:</b></br>'.$tConexion[$a][$b].'</p>';
    							
    						echo '</div>';    	    						
    						
    					}break;
    						
    					case 4:
    						
    					{
    						
							if($tConexion[$a][$b] === '0')
    							
    						{
    							
    							echo '<div class="monto">';
    							
    							echo '<p class="parrafo"><b class="parrafo">Monto:</b></br>('.$tConexion[$a][$b-1].')</p>';
    							
	    						echo '</div>';       								
    							
    						}
    							
    						else
    							
    						{
    							
								echo '<div class="monto">';
    							
    							echo '<p class="parrafo"><b class="parrafo">Monto:</b></br>'.$tConexion[$a][$b-1].'</p>';
    							
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
            <form method="POST" name="forma" action="Estados.php">
            	<div id="sinMargen1">
            	    <input type="radio" onclick="disableFecha()" name="orden" value="fecha"/> Ordenar por Fecha
            	</div>
            	<div class="conMargen1">
            	    <input type="radio" name="rangoF" value="upF" id="fec1" disabled/>Al Más Reciente    	
            	</div>
            	<div class="conMargen1">
            	    <input type="radio" name="rangoF" value="downF" id="fec2" disabled/>Al Más Antigua            	
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
                <input type="submit" value="Reordenar" name="electiva" id="subir">
            </form>
		<script type="text/javascript">

		function disableFecha()
		{
		
			document.getElementById("fec1").disabled=false;
			document.getElementById("fec2").disabled=false;			
			document.getElementById("mon1").disabled=true;
			document.getElementById("mon2").disabled=true;
									
		}

		function disableMonto()
		{
		
			document.getElementById("mon1").disabled=false;
			document.getElementById("mon2").disabled=false;		
			document.getElementById("fec1").disabled=true;
			document.getElementById("fec2").disabled=true;			
									
		}

		</script>                    		
		</div>
		<div class="clear"></div>
	</div>
</body>
</html>