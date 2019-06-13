<?php
session_start();
// include 'lib/config.php';

if(!isset($_SESSION['usuario']))
{
  header("Location: ../");
}
$busqueda = $_GET['var'];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Añadir Usuario</title>
		<script type="text/javascript" src="var.js"></script>
        <link rel="stylesheet" type="text/css" href="../css/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
		  <!-- Font Awesome -->
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
		  <!-- Ionicons -->
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
		  <!-- Theme style -->
		  <link rel="stylesheet" href="../dist/css/AdminLTE.min.css">
		  <!-- iCheck -->
		  <link rel="stylesheet" href="../plugins/iCheck/square/blue.css">
        <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	</head>
	<body class="hold-transition login-page">

		<div class="row pt-5" >
		</div>
		<div class="row">
			<div class="col-2"></div>
			<!-- <div class="col-8"> -->
			
		


			<!-- Historias -->
			<div  class="col-8 " class="login-box" >

				<form action="../php/cerrarSesion.php" method="post" class="width:100%;" >
					<div class="form-group row">
						<!-- <label for="flname" class="col-sm-12 col-form-label labels">Usuario</label> -->
						<input type="submit" name="boton" value="Cerrar Sesion" class="btn btn-primary btn-block btn-flat">
					</div>
				</form>
				<?php
					// echo $_SESSION['imagen'];
					echo '<img src="' . $_SESSION['imagen'] . '" alt="" width="8%">';
					echo '<br/>';
				?>
				<br>
				<br>
				<br>
				<br>

				<?php
					$todo = '';
					include("../php/dataBase.php");
					// $usuario = $_POST['usuario'];
					// $contrasenna = $_POST['contrasenna'];
					// echo $usuario . " - " . $contrasenna;
					$objeto = new dataBase();
					$usuarioLogueado = (int)$_SESSION['id'];
					$consulta = "SELECT * FROM `publicacion` WHERE descripcion like '$busqueda%' or descripcion like '%$busqueda%' or descripcion like 
					'%$busqueda' or titulo like '$busqueda%' or titulo like '%$busqueda%' or titulo like '%$busqueda' and
					publicacion.idUsuarioPublicacion in (SELECT amigos.idAmigo2 as amigo FROM `amigos` INNER JOIN usuario on amigos.idAmigo2 = usuario.idUsuario 
					where idAmigo1 = $usuarioLogueado UNION SELECT amigos.idAmigo1 as amigo FROM `amigos` INNER JOIN usuario on amigos.idAmigo1 = usuario.idUsuario 
					where idAmigo2 = $usuarioLogueado) 
					
					UNION SELECT * FROM `publicacion` WHERE descripcion like '$busqueda%' or descripcion like '%$busqueda%' or descripcion 
					like '%$busqueda' or titulo like '$busqueda%' or titulo like '%$busqueda%' or titulo like '%$busqueda' and publicacion.visibilidad = 0";

					echo '<p>'.$consulta.'</p>';
					//echo $consulta;
					$result = $objeto->consultar($consulta);
					// $todo = "";
					// $objeto = 0;
					$flag = True;
					$anterior = 0;
					while (($fila = mysqli_fetch_array($result)) and $flag )
					{
						if (($anterior != $fila['idUsuario']) or ($anterior==0))
						{

							$todo = $todo . '<div class="my-2 mx-auto p-relative bg-white shadow-1" style="width: 100%; overflow: hidden; border-radius: 1px;">';
							// $idAnnadir = 4;

							// if(!((int)$fila['idAmigo1'] == $usuarioLogueado))
							// {
							// 	$usuarioLogueado = (int)$fila['idAmigo1'];
							// }
							
							$todo = $todo . $fila['nombreUsuario'] . " " . $fila['apellidoUsuario'] . " - " . $fila['fecha'] . " Visibilidad: " . $fila['visibilidad'];// . " ID: " . $usuarioLogueado;
							$todo = $todo . '<h4 class="card-title">' . $fila['titulo'] . '</h4>';
							//$todo = $todo . $fila['direccionImagen'] ;
							$todo = $todo . '<img src="' . $fila['direccionImagen'] . '" alt="' . $fila['titulo'] . '" height="50%" width="50%">';

							$todo = $todo . '<p class="card-description">' . $fila['descripcion'] . '</p>';
							if ((int)$fila['amigo'] == 0 and (int)$fila['idUsuarioPublicacion'] != $usuarioLogueado)
							{
								$todo = $todo . "<a href='../php/annadirAmigo.php?identificadorAmigo=" . $fila['idUsuarioPublicacion'] . "' style='color:blue;'><i class='fas fa-user-plus'></i></i></a>";//No like
							}

							$script = "select * from likes where idPublicacion=" . (int)$fila['idPublicacion'] . " and idUsuarioLike=" . (int)$_SESSION['id'] . ";";
							//echo $script . "</br>";
							$resultado = $objeto->consultar($script);
							$contadorVer = 0;
							while ($fila2 = mysqli_fetch_array($resultado))
							{
								$contadorVer = 1;
							}
							if($contadorVer == 0)
							{
								$todo = $todo . "<a href='../php/meGusta.php?idPublicacion=" . (int)$fila['idPublicacion'] . "' style='color:blue;'><i class='far fa-thumbs-up'></i></a>";
							}
							else
							{
								$todo = $todo . "<a href='../php/noMeGusta.php?idPublicacion=" . (int)$fila['idPublicacion'] . "' style='color:blue;'><i class='far fa-thumbs-down'></i></a>"; 
							}
							
							
							$todo = $todo . "</br><a href='verGusta.php?idPublicacion=" . (int)$fila['idPublicacion'] .  "' style='color:blue;'>Ver me gusta</a>";//Like
							$todo = $todo . "</br><a href='verComentarios.php?idPublicacion=" . (int)$fila['idPublicacion'] .  "' style='color:blue;'>Comentarios</a>";
							$todo = $todo . "";
							$todo = $todo . '</div>';
							$anterior = (int)$fila['idUsuario'];
						}

					// 	if ($fila['direccionUsuario'] == $usuario)
					// 	{
					// 		// $objeto = $fila;
					// 		$flag = False;
					// 	}
					// }
					}
						
					
					echo $todo;
				?>
			</div>





			<!-- </div> -->
			<div class="col-2"></div>
		</div>
		<?php
			// session_start();
			
		?>
	</body>
</html>