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
public function URLS_img($data){
 //var_dump('entramos');
	//if(isset($_POST['sign_up'])){ 
		$handle = fopen("media/".$_SESSION['username']."/urls_img.txt", "a");
		$numbytes = fwrite($handle, str_pad($_POST['nombre'].'&'.$_POST['autor'].'&'.$_POST['fecha'].'&'.$_POST['size'].'&'.$_POST['descripcion'].'&'.$_POST['clasificacion'].'&'.$data, 200)); fclose($handle);
		@header("location:checklogin.php");
		//}

	
	//$_SERVER['REQUEST_METHOD'] = null;

	}


	public function carga_img(){

	$fp = fopen("media/".$_SESSION['username']."/urls_img.txt", 'r');
	$cont =0;
	while(!feof($fp)){
		fseek($fp, $cont*200);
		$datos = fread($fp, 200);
		$datos = trim($datos);
		$datos_extraidos = explode("&", $datos);

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