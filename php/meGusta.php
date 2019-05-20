<?php
	session_start();
	// include 'lib/config.php';

	if(!isset($_SESSION['usuario']))
	{
	  header("Location: ../");
	}
	else
	{
		include("dataBase.php");
		$usuario = $_SESSION['id'];
		$publicacion = $_GET['idPublicacion'];
		$script = "insert into likes (idPublicacion, idUsuarioLike) values (" . (int)$publicacion . "," . (int)$usuario . ");";
		$objeto = new dataBase();
		$result = $objeto->insertar($script);
		header("Location: ../inicio");
	}
?>
