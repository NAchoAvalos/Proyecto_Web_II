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
            //echo "Ha habido un problema al crear el archivo informacion";
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
           // echo "Ha habido un problema al crear el Archivos indice";
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
if(isset($_POST['actualizar'])){

#actualizamos
	$archivo -> actualizacion_img($_POST['id1_actualizar'],$_POST['id2_actualizar'],$_POST['cont'],$_POST['nombre']);

}
else{

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
}//cierre request
$datos =null;
if($_SERVER['REQUEST_METHOD'] == 'GET'){
	if (isset($_GET['id_principal']) && isset($_GET['id_fin_principal']) ) {
		# code...
		$datos = $archivo->extraer_datos_completos($_GET['id_principal'],$_GET['id_fin_principal']);
	}


}



	?>

	 <!DOCTYPE html>
	<html>
	    <head>
	    	<link href="css/styles.css" rel="stylesheet" media="screen">
	    </head>
	    <body>
	    	<nav>
	    		<ul id="menu-bar">
 <li class="active"><a href="principal.php">Principal</a></li>
 <li><a href="#">Compartidos</a>
  <ul>
   <li><a href="#">Products Sub Menu 1</a></li>
   <li><a href="#">Products Sub Menu 2</a></li>
   <li><a href="#">Products Sub Menu 3</a></li>
   <li><a href="#">Products Sub Menu 4</a></li>
  </ul>
 </li>
 
 </li>
 <li><a href="#">About</a></li>
 <li><a href="#">Ayuda</a></li>
 <li><a href="#">Configuraciones</a>
  <ul>
   <li><a href="#">Services Sub Menu 1</a></li>
   <li><a href="#">Services Sub Menu 2</a></li>
   <li><a href="#">Services Sub Menu 3</a></li>
   <li><a href="#">Services Sub Menu 4</a></li>
  </ul>
</ul>
	    	</nav>
	    	<a href=panel-control.php>Panel de Control</a>
	        <form action="#" method="post" enctype="multipart/form-data">
	        	<table class="table1">
	        	<tr>
	        	<td>
	        	<label>Nombre archivo</label>
	        	</td>
	        	<td>
	        	<input type="text" class="campos" name="nombre" placeholder="Nombre" value="<?php echo $datos[0]?>" required>
	        	</td>
	        	</tr>
	        	<tr>
	        		<td>
	        	<label>Autor</label>
	        	</td>
	        	<td>
	        	<input type="text" class="campos" name="autor" placeholder="Autor" value="<?php echo $datos[1]?>" required>
	        	</td>
	        	</tr>
	        	<tr>
	        		<td>
	        	<label>Fecha</label>
	        	</td>
	        	<td>
	        	<input type="text" class="campos" name="fecha" placeholder="Fecha" value="<?php echo $datos[2]?>" required>
	        	</td>
	        	</tr>
	        	<tr>
	        		<td>
	        	<label>Size</label>
	        	</td>
	        	<td>
	        	<input type="text" class="campos" name="size" placeholder="Size" value="<?php echo $datos[3]?>" required>
	        	</td>
	        	</tr>
	        	<tr>
	        		<td>
	        	<label>Descripcion</label>
	        	</td>
	        	<td>
	        	<input type="text" class="campos" name="descripcion" placeholder="Descripcion" value="<?php echo $datos[4]?>" required>
	        	</td>
	        	</tr>
	        	<tr>
	        	<td>
	        	<label>Clasificacion</label>
	        	</td>
	        	<td>
	        	<input type="text" class="campos" name="clasificacion" placeholder="Clasificacion"  value="<?php echo $datos[5]?>"required>
	        	</td>
	        	</tr>
	        	<tr>
	        	<td colspan="2">
	        		<?php 
	        			if($_SERVER['REQUEST_METHOD'] == 'GET' &&$datos != null){

	        				echo '<input type="submit" class = "boton" name="actualizar" id="actualizar"  value="Actualizar"></input>
	           				 <input type="submit" class = "boton" name="ver" id="ver" value="Ver Imagen"></input>
	           				 <input type="submit" class = "boton" name="borrar" id="borrar" value="Borrar"></input>

					 		<input type="hidden" name="id1_actualizar" id="id1_actualizar" value= '.$_GET['id_principal'].' /> 
					 		<input type="hidden" name="id2_actualizar" id="id2_actualizar" value= '.$_GET['id_fin_principal'].' /> 
					 		<input type="hidden" name="cont" id="cont" value= '.$_GET['cont'].' /> 
						           				 ';
	        			}
	        			else{
	        				echo '<input type="file" class="campos"  name="archivo" id="archivo"></input>
	           				 <input type="submit" class = "boton" value="Subir archivo"></input>';
	        			}

	        		?>
	        			

	            
	            </td>
	            </tr>
	            
	            </table>
	        </form>

  <div id="mensajes" class="overflowTest"> 
  	<table class="blueTable">
  		<thead>
<tr>
<th>Nombre</th>
<th>Descargar</th>
<th>Compartir</th>

</tr>
</thead>
  	  	<?php $archivo->carga_nombres(); 
  	//$archivo->validacion_usuario();
  	?>
  	</table>

</div>

      <?php 
if($_SERVER['REQUEST_METHOD'] == 'GET'){
	if (isset($_GET['id']) && isset($_GET['id_fin']) ) {
		# code...

echo '<div class="modal-wrapper" id="popup">
   <div class="popup-contenedor">
      <h3>Usuarios para compartir</h3>';
		$archivo->listado_usuarios($_GET['id'],$_GET['id_fin']);
		echo '<a class="popup-cerrar" href="principal.php">X</a>
   </div>
</div>';
	}


}

?>

	    </body>
	</html>