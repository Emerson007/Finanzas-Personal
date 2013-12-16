<html>
<head xmlns="http://www.w3.org/1999/xhtml" lang="es" xml:lang="es">
	<meta charset="UTF-8">
    <link href="Style/estilos.css" rel="stylesheet" type="text/css"/>
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
</head>
<body id="todo">
	<div id="cuerpo">
		<div id="registros">
		<div id="caja0"><p class="parrafoDiv">Registrar Transacción</p></div>
            <form method="POST" name="forma" action="Estados.php">
            	<div id="caja1">
            		<p class="parrafoDiv">Ingresar Monto: <input type="text" name="FirstName" value="Monto" maxlength="18" id="montos"></p>
            	</div>
            	<div id="caja2">
            		<div id="flotadorI"><p class="parrafoDiv">Agregar Descripción: </p></div>
					<div id="flotadorD"><textarea rows="4" cols="50" maxlength="38" id="ingreso"></textarea></div>
					<div class="clear"></div>
            	</div>
            </form>
		</div>
		<div class="clear"></div>
	</div>
    <script>
    
	    $('textarea').keyup(function ()
    
	    {
    
	        var len = this.value.length;
        
    	    if (len >= 38)
        
	        {
        
    	        this.value = this.value.substring(0, 37);
            
	        }
        
        	$('#charLeft').text(20 - len);
        	
		}); 
	
    </script>
    <script>
    
	    $('input').keyup(function ()
    
	    {
    
	        var len = this.value.length;
        
    	    if (len >= 18)
        
	        {
        
    	        this.value = this.value.substring(0, 17);
            
	        }
        
        	$('#charLeft').text(20 - len);
        	
		}); 
	
    </script>        
</body>
</html>