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
<style>
#myInput {
  background-image: url('/css/searchicon.png'); /* Add a search icon to input */
  background-position: 10px 12px; /* Position the search icon */
  background-repeat: no-repeat; /* Do not repeat the icon image */
  width: 100%; /* Full-width */
  font-size: 16px; /* Increase font-size */
  padding: 12px 20px 12px 40px; /* Add some padding */
  border: 1px solid #ddd; /* Add a grey border */
  margin-bottom: 12px; /* Add some space below the input */
}

#myTable {
  border-collapse: collapse; /* Collapse borders */
  width: 100%; /* Full-width */
  border: 1px solid #ddd; /* Add a grey border */
  font-size: 18px; /* Increase font-size */
}

#myTable th, #myTable td {
  text-align: left; /* Left-align text */
  padding: 12px; /* Add padding */
}

#myTable tr {
  /* Add a bottom border to all table rows */
  border-bottom: 1px solid #ddd; 
}

#myTable tr.header, #myTable tr:hover {
  /* Add a grey background color to the table header and on hover */
  background-color: #f1f1f1;
}
</style>
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
					
				?>
				<br>
				<br>
				<br>
				<input type="text" id="myInput" onkeyup="myFunction()" placeholder="Buscar por nombre...">

				<table id="myTable">
				<tr class="header">
					<th style="width:20%;">ID</th>
					<th style="width:60%;">Amigo</th>
					<th style="width:20%;">Estado</th>
				</tr>
				<?php
					$todo = '';
					include("../php/dataBase.php");
					// $usuario = $_POST['usuario'];
					// $contrasenna = $_POST['contrasenna'];
					// echo $usuario . " - " . $contrasenna;
					$objeto = new dataBase();
					$usuarioLogueado = (int)$_SESSION['id'];

					/*SELECT * FROM `usuario` WHERE nombreUsuario like 'br%' or apellidoUsuario like'br%' UNION SELECT * FROM `usuario` WHERE nombreUsuario like '%br%' or apellidoUsuario like'%br%' UNION SELECT * FROM `usuario` WHERE nombreUsuario like '%br' or apellidoUsuario like'%br'*/
					
					$consulta = "SELECT usuario.idUsuario, CONCAT(usuario.nombreUsuario, ' ', usuario.apellidoUsuario) 
					as amigo FROM `usuario` where usuario.idUsuario != $usuarioLogueado and usuario.idUsuario not in (SELECT amigos.idAmigo2 FROM `amigos` 
					INNER JOIN usuario on amigos.idAmigo2 = usuario.idUsuario where idAmigo1 = $usuarioLogueado UNION SELECT amigos.idAmigo1 as amigo 
					FROM `amigos` INNER JOIN usuario on amigos.idAmigo1 = usuario.idUsuario where idAmigo2 = $usuarioLogueado)";
					$result = $objeto->consultar($consulta);					
					while ($fila = mysqli_fetch_array($result))
					{
						if($fila['idUsuario']!=$usuarioLogueado)
						{
							$todo = $todo .  "<tr>";
							$todo = $todo . "<td>";
							$todo = $todo . '<p>';
							$todo = $todo . $fila['idUsuario'];// . " ID: " . $usuarioLogueado;
							$todo = $todo . '</p>';
							$todo = $todo . '</td>';
							$todo = $todo . "<td>";
							$todo = $todo . '<p>';
							$todo = $todo . $fila['amigo'];// . " ID: " . $usuarioLogueado;
							$todo = $todo . '</p>';
							$todo = $todo . '</td>';
							$todo = $todo . '<td>';
							$todo = $todo . "<a href='../php/annadirAmigo.php?identificadorAmigo=" . $fila['idUsuario'] . "' style='color:blue;'><i class='fas fa-user-plus'></i></i></a>";//No like
							$todo = $todo . '</td>';
							$todo = $todo . "</tr>";
						}
						
					}
					echo $todo;
				?>
				</table>


				

				<!-- Crear Publicacion -->
		
			</div>

			<!-- </div> -->
			<div class="col-2"></div>
		</div>
		<?php
			// session_start();
			
		?>
		<script>
				function myFunction() {
				// Declare variables 
				var input, filter, table, tr, td, i, txtValue;
				input = document.getElementById("myInput");
				filter = input.value.toUpperCase();
				table = document.getElementById("myTable");
				tr = table.getElementsByTagName("tr");

				// Loop through all table rows, and hide those who don't match the search query
				for (i = 0; i < tr.length; i++) {
					td = tr[i].getElementsByTagName("td")[0];
					if (td) {
					txtValue = td.textContent || td.innerText;
					if (txtValue.toUpperCase().indexOf(filter) > -1) {
						tr[i].style.display = "";
					} else {
						tr[i].style.display = "none";
					}
					} 
				}
				}
				</script>
	</body>
</html>