<?php
	session_start();
	include("dataBase.php");
	$usuario = $_POST['usuario'];
	$contrasenna = $_POST['contrasenna'];
	// echo $usuario . " - " . $contrasenna;
	$objeto = new dataBase();
	$result = $objeto->consultar("SELECT * FROM usuario");
	$todo = "";
	$objeto = 0;
	$flag = True;
	while (($fila = mysqli_fetch_array($result)) and $flag )
	{
		$todo = $todo . ", " . $fila['nombreUsuario'];
		if ($fila['direccionUsuario'] == $usuario)
		{
			$objeto = $fila;
			$flag = False;
		}
	}
	
	if ($flag)
	{
		echo "Usuario Incorrecto";
	}
	else
	{
		if ($objeto['contrasennaUsuario'] == $contrasenna)
		{
			$_SESSION['usuario'] = $objeto['nombreUsuario'];
			$_SESSION['id'] = $objeto['idUsuario'];
			// echo $objeto['nombreUsuario'] . "," . $objeto['apellidoUsuario'] . "," .  $objeto['direccionUsuario'] . "," .  $objeto['contrasennaUsuario'];
			header('Location: ../inicio/');
		}
		else
		{
			echo "Contraseña incorrecta";
		}
	}

?>