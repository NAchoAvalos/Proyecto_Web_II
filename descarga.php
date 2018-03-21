<?php
//var_dump($HTTP_GET_VARS["id"]);
/*header("Content-disposition: attachment; filename=media/joseAvalos26/Gepard.jpg");
header("Content-type: image/jpeg");
readfile("Gepard.jpg");*/
 include 'Archivos_class.php';
      $archivo = new Archivos();
     

      $linea = $archivo->extraer_datos(0,55);

//var_dump($linea);

$enlace = 'media/joseAvalos26/guepardo09.jpg';
header ("Content-Disposition: attachment; filename=imafgen.jpg");
header ("Content-Type: application/octet-stream");
header ("Content-Length: ".filesize($enlace));
readfile($enlace);
?>