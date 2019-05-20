<?php
session_start();


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
        <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	</head>
	<body>
		<div class="row pt-5">
		</div>
		<div class="row">
			<div class="col-2"></div>
			<!-- <div class="col-8"> -->
			
			


			<!-- Historias -->
			<div class="col-8">

			<!-- <div class="my-2 mx-auto p-relative bg-white shadow-1" style="width: 100%; overflow: hidden; border-radius: 10px;">' -->
				<form action="../php/crearComentario.php" method="post" class="width:100%;" enctype="multipart/form-data">


					<div class="form-group row">
						<p class="login-box-msg">Descripción</p>
						<textarea type="text" name="descripcion" value="" class="form-control" placeholder="Descripcion..."></textarea>
					</div>

					<div class="form-group row">
						<p class="login-box-msg">Subir Imagen</p>
						<br>
						<input type="file" name="archivo" id="archivo" class="btn btn-primary btn-block btn-flat"></input>
					</div>

					

					<div class="form-group row">
						<!-- <label for="flname" class="col-sm-12 col-form-label labels">Usuario</label> -->
						<input type="submit" name="boton" value="Crear" class="btn btn-primary btn-block btn-flat">

					</div>

				</form>
			<!-- </div> -->
				
				
			<!-- <a href="#">Comentar</a> -->

				<?php
					$idPublicacion = (int)$_GET['idPublicacion'];
					$_SESSION['idPublicacion'] = $_GET['idPublicacion'];
					$todo = '';
					// echo "idPublicacion: " . $idPublicacion . "</br>";
					include("../php/dataBase.php");
					// $usuario = $_POST['usuario'];
					// $contrasenna = $_POST['contrasenna'];
					// echo $usuario . " - " . $contrasenna;
					$objeto = new dataBase();
					$usuarioLogueado = (int)$_SESSION['id'];
					$consulta = "select * from comentarios inner join usuario on idUsuario=idUsuarioComentario where idPublicacionComentario=" . $idPublicacion . " order by idComentario desc;";
					// echo "con: " . $consulta;
					$result = $objeto->consultar($consulta);

					$flag = True;
					$contador = 0;
					// $todo = "";
					while (($fila = mysqli_fetch_array($result)) and $flag )
					{
						$todo = $todo . '<div class="my-2 mx-auto p-relative bg-white shadow-1" style="width: 100%; overflow: hidden; border-radius: 10px;">';
						$contador = $contador+1;
						$todo = $todo . '<h4>' . $fila['nombreUsuario'] . " " . $fila['apellidoUsuario'] . '</h4></br>';
						$todo = $todo . '<p>' . $fila['descripcion'] . '</p></br>';
						// $todo = $todo . '<p>idComentario = ' . $fila['idComentario'] . '</p></br>';

						$todo = $todo . '<a href="../php/meGustaComentario.php?idComentario='. $fila['idComentario'] . '" class="pr-2"><i class="far fa-thumbs-up"></i></a>';
						$todo = $todo . '<a href="verComentariosComentarios.php?idComentario=' . $fila['idComentario'] . '" class="pr-2">Comentar</a>';
						$todo = $todo . '<a href="verGustaComentarios.php?idComentario=' .  $fila['idComentario'] .  '">Ver likes</a>';
						// $todo = $todo . '<a href="#">Comentar</a>';
						$todo = $todo . '</div>';
					}
					if($contador==0)
					{
						$todo = $todo . '<p>No hay comentarios</p>';
					}

					else
					{
						if($contador==1)
						{
							$todo ='<p>Una persona comentó esta publicacion</p>' . $todo;
						}
						else
						{
							$todo ='<p>' . $contador . ' personas comentaron esta publicacion</p>' .  $todo;
						}
					}
						
					
					echo $todo;
					
					
				?>
				<a href="./">Regresar</a>
			</div>






			<div class="col-2"></div>
		</div>
		<?php


		?>
    	<script src="../js/script.js"/>
	</body>
</html>