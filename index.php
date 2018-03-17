<?php
	//require('conexion.php');
	
	include 'Archivos_class.php';
	$archivo = new Archivos();
	session_start();
	
	if(isset($_SESSION["usuario"])){
		header("Location: principal.php");
	}
	
	if(!empty($_POST))
	{  

	  if($archivo->validacion_usuario($_POST['usuario'],$_POST['password'])){
		$username = $_POST['usuario'];
		$password = $_POST['password'];
		$_SESSION['usuario'] =  $_POST['usuario'];
	    $_SESSION['loggedin'] = true;
	    $_SESSION['start'] = time();
	    $_SESSION['expire'] = $_SESSION['start'] + (5 * 60);
	    header("Location: principal.php");
}
	}

?>
<html>
	<head>
		<title>Login</title>
	</head>
	
	<body>
		<form action="#" method="POST" > 
			<div><label>Usuario:</label><input id="usuario" name="usuario" type="text" required></div>
			<br />
			<div><label>Password:</label><input id="password" name="password" type="password" required></div>
			<br />
			<div><input name="login" type="submit" value="login"></div> 
		</form> 
		
		<br />
		
		<div style = "font-size:16px; color:#cc0000;"><?php echo isset($error) ? utf8_decode($error) : '' ; ?></div>
	</body>
</html>