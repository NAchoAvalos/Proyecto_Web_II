<?php
	session_start();
	if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
	 	$carpeta = 'media/'.$_SESSION['usuario'];
	if (!file_exists($carpeta)) {
    	mkdir($carpeta, 0777, true);
		}

	$archivo = "media/".$_SESSION['usuario']."/informacion_img.txt";
	if (!file_exists($archivo)) {
    if($fpa = fopen($archivo, "a"))
    {
        if(fwrite($fpa, '')) //revisar
        {
            echo "Se ha ejecutado correctamente";
        }
        else
        {
            echo "Ha habido un problema al crear el archivo informacion";
        }
 
        fclose($fpa);
    }
}

	$nombres = "media/".$_SESSION['usuario']."/indice_img.txt";
	if (!file_exists($nombres)) {
    if($fpa = fopen($nombres, "a"))
    {
        if(fwrite($fpa, '')) //revisar
        {
            echo "Se ha ejecutado correctamente";
        }
        else
        {
            echo "Ha habido un problema al crear el Archivos indice";
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

	 include 'Archivos_class.php';
      $archivo = new Archivos();
     
	if($_SERVER['REQUEST_METHOD'] == 'POST'){
if ($_FILES['archivo']["error"] > 0)
	  {
	  echo "Error: " . $_FILES['archivo']['error'] . " No es un archivo valido<br>";
	  }
	else
	  {
	/*  echo "Nombre: " . $_FILES['archivo']['name'] . "<br>";
	  echo "Tipo: " . $_FILES['archivo']['type'] . "<br>";
	  echo "Tamaño: " . ($_FILES["archivo"]["size"] / 1024) . " kB<br>";
	  echo "Carpeta temporal: " . $_FILES['archivo']['tmp_name'];*/
	 
	  /*ahora co la funcion move_uploaded_file lo guardaremos en el destino que queramos*/
	move_uploaded_file($_FILES['archivo']['tmp_name'],
	"media/" . $_SESSION['usuario'].'/'. $_FILES['archivo']['name']);
	$archivo->informacion_img("media/" . $_SESSION['usuario'].'/'. $_FILES['archivo']['name']);

	//<em id="__mceDel"> </em>
}
//$_SERVER['REQUEST_METHOD'] = null;
}

	?>

	 <!DOCTYPE html>
	<html>
	    <head>
	    	<link href="css/styles.css" rel="stylesheet" media="screen">
	    </head>
	    <body>
	    	<a href=panel-control.php>Panel de Control</a>
	        <form action="#" method="post" enctype="multipart/form-data">
	        	<table class="table1">
	        	<tr>
	        	<td>
	        	<label>Nombre archivo</label>
	        	</td>
	        	<td>
	        	<input type="text" name="nombre" required>
	        	</td>
	        	</tr>
	        	<tr>
	        		<td>
	        	<label>Autor</label>
	        	</td>
	        	<td>
	        	<input type="text" name="autor" required>
	        	</td>
	        	</tr>
	        	<tr>
	        		<td>
	        	<label>Fecha</label>
	        	</td>
	        	<td>
	        	<input type="text" name="fecha" required>
	        	</td>
	        	</tr>
	        	<tr>
	        		<td>
	        	<label>Size</label>
	        	</td>
	        	<td>
	        	<input type="text" name="size" required>
	        	</td>
	        	</tr>
	        	<tr>
	        		<td>
	        	<label>Descripcion</label>
	        	</td>
	        	<td>
	        	<input type="text" name="descripcion" required>
	        	</td>
	        	</tr>
	        	<tr>
	        	<td>
	        	<label>Clasificacion</label>
	        	</td>
	        	<td>
	        	<input type="text" name="clasificacion" required>
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

  <div id="mensajes" class="overflowTest"> 
  	<table class="table2">
  	  	<?php $archivo->carga_nombres(); 
  	//$archivo->validacion_usuario();
  	?>
  	</table>

</div>
	    </body>
	</html>