<?php
	echo $_POST['titulo'];
	if ($_FILES['archivo']["error"] > 0)

	  {

	  echo "Error: " . $_FILES['archivo']['error'] . "<br>";

	  }

	else

	  {

	  echo "Nombre: " . $_FILES['archivo']['name'] . "<br>";

	  echo "Tipo: " . $_FILES['archivo']['type'] . "<br>";

	  echo "Tamaño: " . ($_FILES["archivo"]["size"] / 1024) . " kB<br>";

	  echo "Carpeta temporal: " . $_FILES['archivo']['tmp_name'];

	  $datos = explode(".",$_FILES['archivo']['name']);//[0]-> name, [1]->extension

	  $nombre = $datos[0] . time() . "." . $datos[1];


		move_uploaded_file($_FILES['archivo']['tmp_name'],"../images/publicaciones/" . $nombre);//<em id="__mceDel"> </em>;

		include("dataBase.php");
		$objeto = new dataBase();
		session_start();
		$titulo = $_POST['titulo'];
		$visibilidad = 1;
		$descripcion = $_POST['descripcion'];
		$visibilidad = (int)$_POST['visibilidad']; 
		$direccionImagen = "../images/publicaciones/" . $nombre;
		$identificador = (int)$_SESSION['id'];
		// $result = $objeto->consultar("SELECT * FROM usuario");
		if ($titulo!="" or $descripcion!="" or $direccionImagen!="")
		{
			$result = $objeto->insertar("insert into publicacion (idUsuarioPublicacion,titulo,visibilidad,descripcion,fecha,direccionImagen) values 
				(". $identificador . ", '" . $titulo . "', " . $visibilidad . ", '" . $descripcion . "', sysdate(), '" . $direccionImagen . "')");
			if ($result)
			{
				echo "LISTO";
				header("Location: ../inicio");
			}
			else
			{
				echo $objeto->link->error;
			}
		}
		else
		{
			echo "Error, la información no es correcta";
		}
	 }

  ?>