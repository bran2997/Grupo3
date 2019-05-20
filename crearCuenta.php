<?php
session_start();
// include 'lib/config.php';

if(isset($_SESSION['usuario']))
{
  header("Location: inicio/");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<title>Añadir Usuario</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css">
        <link href="https://fonts.googleapis.com/css?family=Coiny" rel="stylesheet">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
        		  <!-- Tell the browser to be responsive to screen width -->
		  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		  <!-- Bootstrap 3.3.6 -->
		  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		  <!-- Font Awesome -->
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
		  <!-- Ionicons -->
		  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
		  <!-- Theme style -->
		  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
		  <!-- iCheck -->
		  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">
	</head>
	<body class="hold-transition login-page">
		<div class="row pt-5">
		</div>
		<div class="login-box">
			<div class="col-2"></div>
			<div class="col-8">
			<form action="php/crearUsuario.php" method="post" enctype="multipart/form-data">
			<div class="login-logo">
			<a href=""><b>Registro</b></a>
			</div>
				<div class="form-group row">
					<!-- <label for="flname" class="col-sm-12 col-form-label labels">Usuario</label> -->
					<input type="text" name="nombre" class="form-control" placeholder="Nombre...">
				</div>

				<div class="form-group row">
					<!-- <label for="flname" class="col-sm-12 col-form-label labels">Usuario</label> -->
					<input type="text" name="apellido" class="form-control" placeholder="Apellido...">
				</div>

				<div class="form-group row">
					 <label for="nacimiento" class="col-sm-12 col-form-label labels">Fecha de nacimiento</label>
					<input type="text" name="nacimiento" class="form-control" placeholder="YYYY-MM-DD">
				</div>

				<div class="form-group row">
					<!-- <label for="flname" class="col-sm-12 col-form-label labels">Usuario</label> -->
					<input type="text" name="usuario" class="form-control" placeholder="Usuario">
				</div>
				<div class="form-group row">
					<!-- <p class="login-box-msg">Subir Imagen</p> -->
					<!-- <br> -->
					<input type="file" name="imagen" id="imagen" class="btn btn-primary btn-block btn-flat"></input>
				</div>

				<div class="form-group row">
					<!-- <label for="flname" class="col-sm-12 col-form-label labels">Usuario</label> -->
					<input type="password" name="contrasenna" class="form-control" placeholder="Contraseña...">
				</div>
				<div class="form-group row">
					<!-- <label for="flname" class="col-sm-12 col-form-label labels">Usuario</label> -->
					<input type="password" name="contrasenna2" class="form-control" placeholder="Confirme Contraseña...">
				</div>
				<div class="form-group row">
					<!-- <label for="flname" class="col-sm-12 col-form-label labels">Usuario</label> -->
					<input type="submit" name="boton" value="Crear" class="btn btn-primary btn-block btn-flat">
					<a href="index.php" class="btn btn-primary btn-block btn-flat">Cancelar</a>
				</div>
			</form>
			<!-- <a href="crearCuenta.php">Crear cuenta</a> -->
			
			</div>
			<div class="col-2"></div>

		</div>
		
    	<script src="js/script.js"/>
	</body>
</html>