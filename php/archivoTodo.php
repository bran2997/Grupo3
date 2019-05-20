<?php
	class archivoTodo
	{
		public function annadirAmigo()
		{
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
		}
		public function cerrarSesion()
		{
			session_start();

			unset($_SESSION['usuario']);
			unset($_SESSION['id']);

			session_destroy();

			header("Location: ../");
		}
		public function crearComentario()
		{
			include("dataBase.php");
			$objeto = new dataBase();
			session_start();
			// $titulo = $_POST['titulo'];
			$visibilidad = 1;
			$descripcion = $_POST['descripcion'];
			// $visibilidad = (int)$_POST['visibilidad']; 
			// $direccionImagen = "../images/publicaciones/" . $nombre;
			$identificador = (int)$_SESSION['id'];
			$identificadorPublicacion = (int)$_SESSION['idPublicacion'];
			unset($_SESSION['idPublicacion']);
			// $result = $objeto->consultar("SELECT * FROM usuario");
			if ($titulo!="" or $descripcion!="" or $direccionImagen!="")
			{
				$result = $objeto->insertar("insert into comentarios (idUsuarioComentario, idPublicacionComentario,descripcion)
	 values(". $identificador . ", " . $identificadorPublicacion . ", '" . $descripcion . "')");
				if ($result)
				{
					echo "LISTO";
					header("Location: ../inicio/verComentarios.php?idPublicacion=" . $identificadorPublicacion);
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
		}

		public function crearComentarioComentario()
		{
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
		}

		public function crearPublicacion()
		{
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
		}

		public function crearUsuario()
		{
			if(isset($_POST['boton']))
			{
				// echo "LISTO";
				// session_start();
				include("dataBase.php");
				$nombre = $_POST['nombre'];
				$apellido = $_POST['apellido'];
				$nacimiento = $_POST['nacimiento'];
				$usuario = $_POST['usuario'];
				$contrasenna = $_POST['contrasenna'];
				$contrasenna2 = $_POST['contrasenna2'];
				// echo $usuario . " - " . $contrasenna;
				$datos = explode(".",$_FILES['imagen']['name']);//[0]-> name, [1]->extension

				$nombreA = $datos[0] . time() . "." . $datos[1];
				$nombreA = '../images/profile_Pictures/' . $nombreA;
				$movido = move_uploaded_file($_FILES['imagen']['tmp_name'], $nombreA);
				if($contrasenna == $contrasenna2)
				{
					$objeto = new dataBase();
					$obje = $objeto;
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
						if($nombre!="" and $apellido!="" and $usuario!="" and $contrasenna!="" and $nacimiento!="")
						{
							if (!$movido)
							{
								echo "FINNN";
								$nombreA = "../images/profile_Pictures/empty.jpg";
							}
							$consulta = "insert into usuario (nombreUsuario, apellidoUsuario, direccionUsuario, contrasennaUsuario, fechaNacimiento, imagen)
								values ('" . $nombre . "', '" . $apellido . "', '" . $usuario . "', '" . $contrasenna . "', '" . $nacimiento . "', '" . $nombreA . "');";

								$resultado = $obje->insertar($consulta);
								if ($resultado)
								{
									$consulta = "select * from usuario order by idUsuario desc limit 1;";
									$result = $obje->consultar($consulta);
									$id = 0;
									while (($fila = mysqli_fetch_array($result)))
									{
										$id = (int)$fila['idUsuario'];
									}
									session_start();
									$_SESSION['usuario'] = $usuario;
							 		$_SESSION['id'] = $id;
							 		$_SESSION['imagen'] = $nombreA;
							 		$_SESSION['nombre'] = $nombre;
									$_SESSION['apellido'] = $apellido;
							 		echo "LISTO</br>";
									header('Location: ../');
								}
								else
								{
									echo $consulta . "</br>";
									echo $obje->link->error;;
								}
							//No encuentra, por lo que si se puede
							// if ($objeto['contrasennaUsuario'] == $contrasenna)
							// {
							// 	$_SESSION['usuario'] = $objeto['nombreUsuario'];
							// 	$_SESSION['id'] = $objeto['idUsuario'];
								
							
							// }
							// else
							// {
							// 	echo "Contraseña incorrecta";
							// }

							}
							else
						{
							echo "<p style='color:red;'>Información incompleta</p>";
						}
					}
					else
					{
						echo "<p style='color:red;'>Usuario Ya existe</p>";
					}
				}
				else
				{
					echo "<p style='color:red;'>Contraseñas no son iguales</p>";
				}
			}
		}

		public function meGusta()
		{
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
		}

		public function meGustaComentario()
		{
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
				$idPub = $_SESSION['idPublicacion'];
				unset($_SESSION['idPublicacion']);
				$comentario = $_GET['idComentario'];
				$script = "insert into likeComentario (idComentario,idUsuarioLike) values (" . (int)$comentario . "," . (int)$usuario . ");";
				$objeto = new dataBase();
				$result = $objeto->insertar($script);
				header("Location: ../inicio/verComentarios.php?idPublicacion=" . $idPub);
			}
		}

		public function noMeGusta()
		{
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
		}
	}

?>