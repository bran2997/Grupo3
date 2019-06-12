<?php
session_start();
// include 'lib/config.php';

if(!isset($_SESSION['usuario']))
{
  header("Location: ../");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Añadir Usuario</title>
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
	<body class="hold-transition login-page" >

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
				<input type="submit" name="boton" onClick="document.location.href='../inicio/editarPerfil.php'" value="Editar perfil">
				<!-- Crear Publicacion -->
				<form action="../php/crearPublicacion.php" method="post" class="width:100%;" enctype="multipart/form-data">
					
					<div class="form-group row">
						
						<p class="login-box-msg">Titulo</p>
						<input type="text" name="titulo" value="" class="form-control" placeholder="Título...">
					</div>

					<div class="form-group row">
						<p class="login-box-msg">Descripción</p>
						<textarea type="text" name="descripcion" value="" class="form-control" placeholder="Descripcion..."></textarea>
					</div>

					<div class="form-group row">
						<p class="login-box-msg">Subir Imagen</p>
						<br>
						<input type="file" name="archivo" id="archivo" class="btn btn-primary btn-block btn-flat"></input>
					</div>

					<select name="visibilidad" class="">
						<option value="1">Privada</option>
						<option value="0">Pública</option>
					</select>

					<div class="form-group row">
						<!-- <label for="flname" class="col-sm-12 col-form-label labels">Usuario</label> -->
						<input type="submit" name="boton" value="Crear" class="btn btn-primary btn-block btn-flat">

					</div>

				</form>

				<?php
					$todo = '';
					include("../php/dataBase.php");
					// $usuario = $_POST['usuario'];
					// $contrasenna = $_POST['contrasenna'];
					// echo $usuario . " - " . $contrasenna;
					$objeto = new dataBase();
					$usuarioLogueado = (int)$_SESSION['id'];
					$consulta = "SELECT * FROM publicacion as p inner join amigos as a on a.idAmigo1=p.idUsuario or a.idAmigo2=p.idUsuario inner join usuario as u on p.idUsuario = u.idUsuario where a.idAmigo1=". $usuarioLogueado . " or a.idAmigo2=". $usuarioLogueado ." or p.visibilidad=0  order by p.idPublicacion desc;";
					
					$consulta = "  SELECT idPublicacion, idUsuarioPublicacion, titulo,
					 visibilidad, descripcion, fecha, direccionImagen, idUsuario, nombreUsuario, apellidoUsuario, 1 as amigo
					 FROM publicacion as p
					 inner join amigos as a on a.idAmigo1=p.idUsuarioPublicacion or a.idAmigo2=p.idUsuarioPublicacion
					 inner join usuario as u on p.idUsuarioPublicacion = u.idUsuario 
					 where (a.idAmigo1=" . $usuarioLogueado . " or a.idAmigo2=" . $usuarioLogueado . ") and idUsuarioPublicacion <>" . $usuarioLogueado . "
					 
					 union
					 
					 select idPublicacion, idUsuarioPublicacion, titulo,
					 visibilidad, descripcion, fecha, direccionImagen, idUsuario, nombreUsuario, apellidoUsuario, 0 as amigo
					 from publicacion as p
					  inner join usuario as u on p.idUsuarioPublicacion = u.idUsuario
					 where visibilidad = 0 or idUsuarioPublicacion= " . $usuarioLogueado . "
					 order by idPublicacion desc, visibilidad asc;";

					//echo $consulta;
					//$consulta = "SELECT * FROM publicacion as p inner join usuario as u on p.idUsuario = u.idUsuario order by p.idPublicacion desc";
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
    	<script src="../js/script.js"/>
	</body>
</html>