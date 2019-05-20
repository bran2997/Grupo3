<?php
session_start();


if(isset($_SESSION['usuario']))
{
  header("Location: inicio/");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		  <meta http-equiv="X-UA-Compatible" content="IE=edge">
		  <title>Iniciar seccion </title>
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
	<div class="login-box">
  <div class="login-logo">
    <a href=""><b>Compu</b>Mundo <b>Hiper</b>Mega<b>Red</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Bienvenido</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Usuario" name="usuario" pattern="[A-Za-z_-0-9]{1,20}">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Contraseña" name="contrasenna" pattern="[A-Za-z_-0-9]{1,20}">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <!-- /.col -->
        <div class="col-xs-12">
          <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Iniciar Sesión</button>
          <a href="crearCuenta.php" class="btn btn-primary btn-block btn-flat">Crear cuenta</a>
        </div>
        <!-- /.col -->
      </div>
    </form>
    			<?php
				if(isset($_POST['login']))
				{
					// echo "LISTO";
					// session_start();
					include("php/dataBase.php");
					$usuario = $_POST['usuario'];
					$contrasenna = $_POST['contrasenna'];
					// echo $usuario . " - " . $contrasenna;
					$objeto = new dataBase();
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
						echo "Usuario Incorrecto";
					}
					else
					{
						if ($objeto['contrasennaUsuario'] == $contrasenna)
						{
							$_SESSION['usuario'] = $objeto['nombreUsuario'];
							$_SESSION['id'] = $objeto['idUsuario'];
							$_SESSION['imagen'] = $objeto['imagen'];
							$_SESSION['nombre'] = $objeto['nombreUsuario'];
							$_SESSION['apellido'] = $objeto['apellidoUsuario'];
							// echo $objeto['nombreUsuario'] . "," . $objeto['apellidoUsuario'] . "," .  $objeto['direccionUsuario'] . "," .  $objeto['contrasennaUsuario'];
							header('Location: inicio/');
						}
						else
						{
							echo "Contraseña incorrecta";
						}
					}
				}
			?>
	</body>
</html>