<?php

	$id = 1;

	require_once("DataBase/Conexion.php");
	require_once("Components/Ordenar.php");
	
	$orden = new Ordenar();	
	$conexion = new Conexion("localhost","FinanzaPersonal","root","root");
	
	$conexion->BaseDatos();
	
	$conexion->ConsultarSoloRubro($id);
	
	$tConexion = $conexion->TodosDatos();

	$hoy = $orden->Hoy(date("Y-m-d"));

?>
<html>
<head xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
	<meta charset="UTF-8">
    <link href="Style/estilos.css" rel="stylesheet" type="text/css"/>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body id="todo">
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
                    	
                    			echo '<option value="'.$tConexion[$a][0].'">'.$tConexion[$a][0].'</option>';
                    	
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
            		<p class="parrafoDiv">Agregar Rubro: <input type="text" name="describir" maxlength="19" id="ingreso"></p>
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