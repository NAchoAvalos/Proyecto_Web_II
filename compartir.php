<?php 
session_start();
var_dump($_POST['como']);
include 'Archivos_class.php';
$archivo = new Archivos();
$data = $archivo->extraer_datos_completos($_POST['id1'],$_POST['id2']);
//var_dump($data);
foreach ($_POST['como'] as $key => $value) {
	# code...
	$archivo->compartir_img($data,$value);
}


$path1=$archivo->extraer_datos($_GET['id'],$_GET['id_fin']);
$path2="media/copias/nuevo.jpg";
copy($path1,$path2); 
header('location:principal.php');
?>