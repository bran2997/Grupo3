<?php
	// echo $_POST['titulo'];
	// if ($_FILES['archivo']["error"] > 0)

	//   {

	//   echo "Error: " . $_FILES['archivo']['error'] . "<br>";

	//   }

	// else

	//   {

	//   echo "Nombre: " . $_FILES['archivo']['name'] . "<br>";

	//   echo "Tipo: " . $_FILES['archivo']['type'] . "<br>";

	//   echo "Tamaño: " . ($_FILES["archivo"]["size"] / 1024) . " kB<br>";

	//   echo "Carpeta temporal: " . $_FILES['archivo']['tmp_name'];

	//   $datos = explode(".",$_FILES['archivo']['name']);//[0]-> name, [1]->extension

	//   $nombre = $datos[0] . time() . "." . $datos[1];

	//   // echo "</br>".$rrr[0]. "" . time() . " . " . time() ."</br>";
	//   // echo "</br>".$rrr[1]. time() . "</br>";

	//   // move_uploaded_file($_FILES['archivo']['tmp_name'],"../publicaciones/images/" . $_FILES['archivo']['name']);//<em id="__mceDel"> </em>;



	// 	move_uploaded_file($_FILES['archivo']['tmp_name'],"../images/publicaciones/" . $nombre);//<em id="__mceDel"> </em>;

		include("dataBase.php");
		$objeto = new dataBase();
		session_start();
		// $titulo = $_POST['titulo'];
		$visibilidad = 1;
		$descripcion = $_POST['descripcion'];
		// $visibilidad = (int)$_POST['visibilidad']; 
		// $direccionImagen = "../images/publicaciones/" . $nombre;
		$identificador = (int)$_SESSION['id'];
		$identificadorComentario = (int)$_SESSION['idComentario'];
		unset($_SESSION['idPublicacion']);
		// $result = $objeto->consultar("SELECT * FROM usuario");
		if ($descripcion!="")
		{
			$result = $objeto->insertar("insert into comentarioComentario (idUsuarioComentario, idComentario,descripcionComentario)
 values(". $identificador . ", " . $identificadorComentario . ", '" . $descripcion . "')");
			if ($result)
			{
				echo "LISTO";
				header("Location: ../inicio/verComentariosComentarios.php?idComentario=" . $identificadorComentario);
				// href='verComentarios.php?idPublicacion=
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


		
		// $todo = "";
		// $objeto = 0;

	 // }

	  /*ahora co la funcion move_uploaded_file lo guardaremos en el destino que queramos*/

  ?>