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
		$script = "delete from likes where idPublicacion=" . $publicacion . " and idUsuarioLike=" . (int)$usuario . ";";
		$objeto = new dataBase();
		$result = $objeto->insertar($script);
		header("Location: ../inicio");
	}
?>
