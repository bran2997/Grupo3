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
		<title>Editar Perfil</title>
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
					echo '<br>';
					echo '<label>'.$_SESSION['nombre'].'</label>';
					echo '<br>';
					echo '<label>'.$_SESSION['apellido'].'</label>';
					echo '<br>';
					echo '<label>'.$_SESSION['id'].'</label>';
					echo '<br>';
					echo '<label>'.$_SESSION['fechaNacimiento'].'</label>';
				?>
				<!-- Crear Publicacion -->
				<form action="../php/editarUsuario.php" method="post" class="width:100%;" enctype="multipart/form-data">
					
					<div class="form-group row">
						
						<p class="login-box-msg">Nombre</p>
						<input type="text" name="nombre" value="<?php echo $_SESSION['nombre']; ?>" class="form-control">
					</div>
					<div class="form-group row">
						
						<p class="login-box-msg">Apellido</p>
						<input type="text" name="apellido" value="<?php echo $_SESSION['apellido']; ?>" class="form-control">
					</div>
					<div class="form-group row">
						
						<p class="login-box-msg">id</p>
						<input type="text" name="idUsuario" value="<?php echo $_SESSION['id']; ?>" class="form-control">
					</div>
					<div class="form-group row">
						
						<p class="login-box-msg">Usuario</p>
						<input type="text" name="usuario" value="<?php echo $_SESSION['usuario']; ?>" class="form-control">
					</div>
					<div class="form-group row">
						
						<p class="login-box-msg">Fecha Nacimiento</p>
						<input type="text" name="nacimiento" value="<?php echo $_SESSION['fechaNacimiento']; ?>" class="form-control">
					</div>
					<div class="form-group row">
						
						<p class="login-box-msg">Usuario viejo</p>
						<input type="text" name="usuarioViejo" value="<?php echo $_SESSION['usuario']; ?>" class="form-control">
					</div>
					<div class="form-group row">
						
						<p class="login-box-msg">Contraseña</p>
						<input type="text" name="contrasenna" value="" class="form-control">
					</div>
					<div class="form-group row">
						
						<p class="login-box-msg">Confirme contraseña</p>
						<input type="text" name="contrasenna2" value="" class="form-control">
					</div>
					<div class="form-group row">
					<!-- <p class="login-box-msg">Subir Imagen</p> -->
					<!-- <br> -->
					<input type="file" name="imagen" id="imagen" class="btn btn-primary btn-block btn-flat"></input>
				</div>

					<div class="form-group row">
						<!-- <label for="flname" class="col-sm-12 col-form-label labels">Usuario</label> -->
						<input type="submit" name="boton" value="Guardar" class="btn btn-primary btn-block btn-flat">

					</div>

				</form>
		
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