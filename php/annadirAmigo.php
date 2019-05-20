<?php
	session_start();

	$amigo = (int)$_GET['identificadorAmigo'];
	
	$usuario = (int)$_SESSION['id'];

	echo "Amigo: " . $amigo . ", Usuario: " . $usuario; 

	$sql = "insert into amigos (idAmigo1, idAmigo2) values (" . $usuario . "," . $amigo . ")";

	include("dataBase.php");
	$objeto = new dataBase();
	// session_start();
	// $titulo = $_POST['titulo'];
	// $visibilidad = 1;
	// $descripcion = $_POST['descripcion'];
	// $direccionImagen = "../publicaciones/images/" . $nombre;
	// $identificador = (int)$_SESSION['id'];
	// $result = $objeto->consultar("SELECT * FROM usuario");

	$result = $objeto->insertar($sql);
	header("Location: ../inicio");



	
?>