<?php
if (!function_exists("GetSQLValueString")) 

{

	$alerta = false;

	function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 

	{

		if (PHP_VERSION < 6)
		
		{
		
		    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
		    
		}

		$theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

		switch ($theType) 
		
		{
		
			case "text":
			
			{
			
				if($theValue != "")
				
				{
				
					$onlyAlpha = str_replace(' ', 'a', $theValue);
			
					if (ctype_alpha($onlyAlpha)) 
				
					{
				
						$theValue = "'".$theValue."'";						
        				
    				}
    				
    				else
    				
    				{
    				
    					$theValue = "INVALID";    				
    				
    				}
    			
    			}
    			
    			else
    			
    			{
    			
    				$theValue = "NULL";
    			
    			}
      			
      		}break;
      		
			case "date":
			
			{
			
				if($theValue != "")
				
				{
					
					$theValue = "'".$theValue."'";
				
				}
				
				else
				
				{
				
					$theValue = "NULL";			
				
				}
				
			}break;
			
			case "mail":
			
			{
			
				if($theValue != "")
				
				{
				
					if(filter_var($theValue, FILTER_VALIDATE_EMAIL))
		
					{
		
						$theValue = "'".$theValue."'";
		
					}
					
					else
					
					{
					
    					$theValue = "INVALID";
					
					}
				
				}
				
				else
				
				{
				
					$theValue = "NULL";
				
				}
			
			}break;
			
			case "cell":
			
			{
				if($theValue != "")
				
				{

					$test_arr = explode('-', $theValue);
					
					if ((strlen($test_arr[0]) === 4)&&(strlen($test_arr[1]) === 4))
					
					{
					
						$theValue = "'".$theValue."'";	
					
					}
					
					else
					
					{
					
						$theValue = "INVALID";
					
					}		
				
				}
				
				else
				
				{
				
					$theValue = "NULL";			
				
				}
				
			}break;						
      		
      		case "long":{}break;
      		
			case "int":
			
			{
			
				if($theValue != "")
				
				{
					
					if (is_numeric($theValue))
					
					{
					
						$theValue = intval($theValue);	
					
					}
					
					else
					
					{
					
						$theValue = "INVALID";
					
					}		
				
				}
				
				else
				
				{
				
					$theValue = "NULL";			
				
				}				
				
			}break;
			
			case "double":
			
			{
			
				if($theValue != "")
				
				{
					
					if (is_numeric($theValue))
					
					{
						
						$theValue = doubleval($theValue);
					
					}
					
					else
					
					{
					
						$theValue = "INVALID";
					
					}		
				
				}
				
				else
				
				{
				
					$theValue = "NULL";			
				
				}
      			
      		}break;
			
			case "defined":
			
			{
			
				$theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
				
			}break;
			
		}
		
  		return $theValue;
  		
	}
	
}

?>
<?php

	$id = 1;

	require_once("DataBase/Conexion.php");
	require_once("Components/Ordenar.php");
	require_once("DataBase/Direccion.php");
	
	$dir = new Direccion();	
	
	$orden = new Ordenar();	
	$conexion = new Conexion($dir->getServidor(),$dir->getBaseDatos(),$dir->getUsuario(),$dir->getContrasenia());
	
	$conexion->BaseDatos();
	
	$conexion->ConsultarSoloRubro($id);
	
	$tConexion = $conexion->TodosDatos();

	$hoy = $orden->Hoy(date("Y-m-d"));
	
	$data = "";
	
	$errorN = -1;
	
	$errorI = -1;
	
	if(isset($_POST["masRubros"]))
    
    {
    
    	$data[0] = GetSQLValueString($_POST['descrito'], "text");
    	
    	$data[1] = GetSQLValueString($_POST['rub'], "int");
    	
    	for($a = 0; $a < count($data); $a++)
    	
    	{
    	
    		if($data[$a] === "NULL")
    		
    		{
    			
    			$errorN = $a;
    			
    			break;
    		
    		}
    		
    		if($data[$a] === "INVALID")
    			
    		{ 			
    			
				$errorI = $a;
    			
    			break;    			
    			
    		}
    	
    	}   
    	
		if(($errorN === -1)&&($errorI === -1))
    	
    	{
    		
			$conexion->InsertarRubro($data[0],$data[1],$id);
    		
    	}    	 	  	  	
    
    }	

	else
	
	{
	
		if(isset($_POST["ingreso"]))
    
    	{
    	
    		$data[0] = GetSQLValueString($_POST['montar'], "double");
    		$data[1] = GetSQLValueString($_POST['describir'], "text");
    		$data[2] = GetSQLValueString($_POST['losRubros'], "int");	    		
    		
    		for($a = 0; $a < count($data); $a++)
    	
    		{
    	
    			if($data[$a] === "NULL")
    		
    			{
    			
    				$errorN = $a;
    			
    				break;
    		
    			}
    		
    			if($data[$a] === "INVALID")
    			
    			{
    			
					$errorI = $a;
    			
    				break;    			
    			
    			}
    	
    		}
    		
			if(($errorN === -1)&&($errorI === -1))
    	
    		{
    		
    			$conexion->InsertarTransaccion(date("Y-m-d"), $data[2], $id);
    			
				$conexion->ConsultarSoloTransaccion($id);
				$tempo = $conexion->TodosDatos();
				
				$conexion->InsertarDetalles($data[1], $data[0], $tempo[count($tempo)-1][0]);
    		
    		}
    	    
	    }
	
	}

?>
<html>
<head xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
	<meta charset="UTF-8">
    <link href="Style/estilos.css" rel="stylesheet" type="text/css"/>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body id="todo">
	<div id="cabeza">
		<div id="tag1"><a href="index.php" class="disenio">Principal</a></div>	
		<div id="tag2"><a href="Nuevos.php" class="disenio">Insertar Transacción</a></div>
	</div>
	<div id="cuerpo">
		<div id="registros">
		<div class="caja0"><p class="parrafoDiv">Registrar Transacción</p></div>
		<div class="caja1"><p class="parrafoDiv"><?php echo $hoy?></p></div>		
            <form method="POST" name="forma" action="Nuevos.php">
            	<div class="caja2">
            		<p class="parrafoDiv">Ingresar Monto: <input type="text" name="montar" maxlength="10" id="montos"></p>
            	</div>
            	<div class="caja3">
            		<p class="parrafoDiv">Agregar Descripción: <input type="text" name="describir" maxlength="19" id="ingreso"></p>
            	</div>
            	<div class="caja4">
            		<div class="flotadorI"><p class="parrafoDiv">Seleccionar Rubro: </p></div>         	
                    <div class="flotadorD">
                    	<select name="losRubros" class="formas">
                        	<option value="seleccionar">-- Seleccione --</option>
                    		<?php
                    		for($a = 0; $a < count($tConexion); $a++)
                    	
                    		{
                    	
                    			echo '<option value="'.$tConexion[$a][1].'">'.$tConexion[$a][0].'</option>';
                    	
                    		}
                    		?>
            			</select>                    		            	
                    </div>     		
            	</div>
				<button type="submit" class="subir2" name="ingreso">Ingresar</button>
            </form>
		</div>
		<div id="rubros">
			<div class="caja0"><p class="parrafoDiv">Ingreso de Rubros:</p></div>
			<form method="POST" name="forma2" action="Nuevos.php">
            	<div class="caja2">
            		<p class="parrafoDiv">Agregar Rubro: <input type="text" name="descrito" maxlength="19" id="ingreso"></p>
            	</div>
            	<div id="elMismo">
            	<div id="debeDiv">
            	    <p class="parrafoDiv"><input type="radio" name="rub" value="0" id="debe"/>Deudor</p>
            	</div>
            	<div id="haberDiv">            	
            	    <p class="parrafoDiv"><input type="radio" name="rub" value="1" id="haber"/>Acreedor</p>
				</div>            	    
					<div class="clear"></div>            	    
            	</div>
				<button type="submit" class="subir3" name="masRubros">Ingresar</button>            	
			</form>
		</div>		
		<div class="clear"></div>
	</div>
    <script>
    
	    $('textarea').keyup(function ()
    
	    {
    
	        var len = this.value.length;
        
    	    if (len >= 19)
        
	        {
        
    	        this.value = this.value.substring(0, 18);
            
	        }
        
        	$('#charLeft').text(20 - len);
        	
		}); 
	
    </script>
    <script>
    
	    $('input').keyup(function ()
    
	    {
    
	        var len = this.value.length;
        
    	    if (len >= 19)
        
	        {
        
    	        this.value = this.value.substring(0, 18);
            
	        }
        
        	$('#charLeft').text(18 - len);
        	
		}); 
	
    </script>        
</body>
</html>