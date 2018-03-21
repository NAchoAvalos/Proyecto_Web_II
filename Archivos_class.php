<?php
class Archivos{


// Guarda registro de usuarios
public function registro($data){
 //var_dump('entramos');
	//if(isset($_POST['sign_up'])){ 
		$nombre_fichero = 'users.txt';

if (file_exists($nombre_fichero) ) {
    //echo "El fichero $nombre_fichero existe";
    $handle = fopen('users.txt', "a");
		$numbytes = fwrite($handle, str_pad($data['full_name'].'/'.$data['email'].'/'.$data['username'].'/'.$data['password'].'/'.$data['password'], 100)); fclose($handle);
		//header("location:index.php");
		return true;
} else {
    //echo "El fichero $nombre_fichero no existe";
    return false;
}
		
		//}
	

}
public function informacion_img($data){
 //var_dump('entramos');
	//if(isset($_POST['submit'])){ 
	$ruta = "media/".$_SESSION['usuario']."/informacion_img.txt";
	$posicion = filesize($ruta);
		$handle = fopen("media/".$_SESSION['usuario']."/informacion_img.txt", "a");
		//$posicion = ftell($handle);
		$numbytes = fwrite($handle, $_POST['nombre'].'&'.$_POST['autor'].'&'.$_POST['fecha'].'&'.$_POST['size'].'&'.$_POST['descripcion'].'&'.$_POST['clasificacion'].'&'.$data); 
		$posicion_final = ftell($handle);

		fclose($handle);
				$nombres = fopen("media/".$_SESSION['usuario']."/indice_img.txt", "a");
		//$posicion = ftell($handle);
		$numbytes = fwrite($nombres, $_POST['nombre'].'&'.$posicion.'&'.$posicion_final."\r\n"); 
		fclose($nombres);
		//@header("location:checklogin.php");
		//}

	
	$_SERVER['REQUEST_METHOD'] = null;

	}


	public function compartir_img($data, $users){
 //var_dump('entramos');
	//if(isset($_POST['submit'])){ 
	$ruta = "media/".$users."/informacion_img.txt";
	$posicion = filesize($ruta);
		$handle = fopen("media/".$users."/informacion_img.txt", "a");
		//$posicion = ftell($handle);
		$url_vieja = explode('/', $data[6]);
		$url_nueva = 'media/'.$users.'/'.$url_vieja[2];

		$numbytes = fwrite($handle, $data[0].'&'.$data[1].'&'.$data[2].'&'.$data[3].'&'.$data[4].'&'.$data[5].'&'.$url_nueva); 
		$posicion_final = ftell($handle);

		fclose($handle);
				$nombres = fopen("media/".$users."/indice_img.txt", "a");
		//$posicion = ftell($handle);
		$numbytes = fwrite($nombres,$data[0].'&'.$posicion.'&'.$posicion_final."\r\n"); 
		fclose($nombres);
		//@header("location:checklogin.php");
		//}

	
	$_SERVER['REQUEST_METHOD'] = null;

	}

	public function carga_nombres(){
	$fp = fopen("media/".$_SESSION['usuario']."/indice_img.txt", 'r');
	while ($linea = fgets($fp)) {
		$datos_extraidos = explode("&", $linea);

    	echo '<tr>
		<td>
		<a href="principal.php?id_principal='.$datos_extraidos[1].'&id_fin_principal='.$datos_extraidos[2].'" >'.$datos_extraidos[0].'</a>
											<input type="hidden" name="id" id="id" value= '.$datos_extraidos[1].' /> 
		</td>

		<td class="'.$datos_extraidos[1].'">

		<a href="descarga.php?id='.$datos_extraidos[1].'&id_fin='.$datos_extraidos[2].'" >
											<img src="images/descargar.png" height="30" width="120" ></a>
										
		</td>
		<td>
		<a href="principal.php?id='.$datos_extraidos[1].'&id_fin='.$datos_extraidos[2].'" >
											<img src="images/share.png" height="30" width="120" ></a>
		</td>
		</tr>';
}

	}

	public function extraer_datos($id,$id_final){
		$fp = fopen("media/".$_SESSION['usuario']."/informacion_img.txt", 'r');
		fseek($fp, $id);
		$datos = fread($fp, $id_final);
		//$datos = trim($datos);
		$datos_extraidos = explode("&", $datos);
		return $datos_extraidos[6];
	}

	public function extraer_datos_completos($id,$id_final){
		$fp = fopen("media/".$_SESSION['usuario']."/informacion_img.txt", 'r');
		fseek($fp, $id);
		$datos = fread($fp, $id_final);
		//$datos = trim($datos);
		$datos_extraidos = explode("&", $datos);
		return $datos_extraidos;
	}


	public function carga_img(){

	$fp = fopen("media/".$_SESSION['usuario']."/indice_img.txt", 'r');
	$cont =0;
	while(!feof($fp)){

		/*fseek($fp, $cont*200);
		$datos = fread($fp, 200);
		$datos = trim($datos);
		$datos_extraidos = explode("&", $datos);*/

		if(!empty($datos_extraidos) && substr($datos_extraidos[6], -4)==='.jpg'){

		echo '<tr>
		<td>
		<p>Nombre: '.$datos_extraidos[0].'</p>
		<p>Autor: '.$datos_extraidos[1].'</p>
		<p>Fecha: '.$datos_extraidos[2].'</p>
		<p>Size: '.$datos_extraidos[3].'</p>
		<p>Descripcion: '.$datos_extraidos[4].'</p>
		<p>Clasificacion: '.$datos_extraidos[5].'</p>
		</td>

		<td>
		<img src='.$datos_extraidos[6].' alt="Smiley face" height="250" width="250">
		</td>

		<td>
		<a href='.$datos_extraidos[6].' download="imagen.jpg">
											<img src="images/descargar.jpg" height="50" width="200" ></a><br>
		<label>Compartir</label>
		</td>
		</tr>'; }
		//$datos = str_replace("/", " ", $datos);
		/*if($datos!=''){
			$this->agregar_registro($datos);
			$cont++;
			}*/
			$cont++;
}
	}


	public function usuarios(){

		$nombre_fichero = 'users.txt';

if (file_exists($nombre_fichero) ) {
    //echo "El fichero $nombre_fichero existe";
    $fp = fopen('users.txt', "r");

		$usuarios =array();
	$cont =0;
	while(!feof($fp)){
		fseek($fp, $cont*100);
		$datos = fread($fp, 100);
		$datos = trim($datos);
		$datos_extraidos = explode("/", $datos);
		if (isset($datos_extraidos[2])) {
			array_push ($usuarios , $datos_extraidos[2]);
		}
		
		$cont++;
	}
	fclose($fp);
}
return $usuarios;
}

public function listado_usuarios($val1,$val2){
	$lista = $this->usuarios();

 echo '<form action="compartir.php" method="post">';
 echo '<div class = "overflowTest2"> ';
$cont = 1;
 foreach ($lista as $key => $value) {
 	echo '<input type="checkbox" name="como[]" id="como'.$cont.'" value="'.$value.'">
	<label for="como'.$cont.'">'.$value.'</label><br>';
	$cont++;
 }
 		echo '<input type="hidden" name="id1" id="id1" value= '.$val1.' /> ';
 		echo '<input type="hidden" name="id2" id="id2" value= '.$val2.' /> ';
 		echo '</div>';
	echo '<button type="submit">Enviar</button></form>';



}



	public function validacion_usuario($usuario,$password){
		//var_dump($usuario);
		$nombre_fichero ='users.txt';
		//var_dump(filesize($nombre_fichero));
		if(filesize($nombre_fichero) > 0){
	$fp = fopen($nombre_fichero, 'r');
	$cont =0;
	while(!feof($fp)){
		fseek($fp, $cont*100);
		$datos = fread($fp, 100);
		$datos_extraidos = explode("/", $datos);
		//var_dump($datos_extraidos);
		if(!empty($datos)){
		if($datos_extraidos[2] === $usuario && $datos_extraidos[3] === $password ){
			var_dump("verdad");
			return true;
		}}
		//$datos = str_replace("/", " ", $datos);
		/*if($datos!=''){
			$this->agregar_registro($datos);
			$cont++;
			}*/
			$cont++;
}
//$_SERVER['REQUEST_METHOD'] = null;
//var_dump('no entramos');
//@header("location:login.php");

	}
	echo "Usurio/Contraseña erroneos";
return false;}



}
?>