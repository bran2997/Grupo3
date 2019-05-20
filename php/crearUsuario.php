<?php
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
?>