<?php

	session_start();

	 

	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {

	 $carpeta = 'media/'.$_SESSION['usuario'];
if (!file_exists($carpeta)) {
    mkdir($carpeta, 0777, true);
}
$archivo = "media/".$_SESSION['usuario']."/urls_img.txt";
if (!file_exists($archivo)) {
    

    if($fpa = fopen($archivo, "a"))
    {
        if(fwrite($fpa, ''))
        {
            echo "Se ha ejecutado correctamente";
        }
        else
        {
            echo "Ha habido un problema al crear el archivo";
        }
 
        fclose($fpa);
    }
}

	} else {

	  header('location:index.php');
	 

	exit;

	}

	 

	$now = time();

	 

	if($now > $_SESSION['expire']) {

	session_destroy();

	 

	echo "Su sesion a terminado,

	<a href='index.php'>Necesita Hacer Login</a>";

	exit;

	}

	?>

	 <!DOCTYPE html>
	<html>
	    <head>
	    	<link href="css/index.css" rel="stylesheet" media="screen">
	    </head>
	    <body>
	    	<a href=panel-control.php>Panel de Control</a>
	        <form action="#" method="post" enctype="multipart/form-data">
	        	<table>
	        	<tr>
	        	<td>
	        	<label>Nombre archivo</label>
	        	</td>
	        	<td>
	        	<input type="text" name="nombre">
	        	</td>
	        	</tr>
	        	<tr>
	        		<td>
	        	<label>Autor</label>
	        	</td>
	        	<td>
	        	<input type="text" name="autor">
	        	</td>
	        	</tr>
	        	<tr>
	        		<td>
	        	<label>Fecha</label>
	        	</td>
	        	<td>
	        	<input type="text" name="fecha">
	        	</td>
	        	</tr>
	        	<tr>
	        		<td>
	        	<label>Size</label>
	        	</td>
	        	<td>
	        	<input type="text" name="size">
	        	</td>
	        	</tr>
	        	<tr>
	        		<td>
	        	<label>Descripcion</label>
	        	</td>
	        	<td>
	        	<input type="text" name="descripcion">
	        	</td>
	        	</tr>
	        	<tr>
	        	<td>
	        	<label>Clasificacion</label>
	        	</td>
	        	<td>
	        	<input type="text" name="clasificacion">
	        	</td>
	        	</tr>
	        	<tr>
	        	<td colspan="2">
	            <input type="file"  name="archivo" id="archivo"></input>
	            <input type="submit" class = "submit" value="Subir archivo"></input>
	            </td>
	            </tr>
	            
	            </table>
	        </form>

	        <div id="global">
  <div id="mensajes"> 
  	<table>
  	  	<?php //$archivo->carga_img(); 
  	//$archivo->validacion_usuario();
  	?>
  	</table>

  </div>
</div>
	    </body>
	</html>