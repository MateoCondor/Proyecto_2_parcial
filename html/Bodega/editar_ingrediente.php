<?php
session_start();

if (!isset($_SESSION["user_role"]) || !isset($_SESSION["bodega_login"])) {
    header("Location: ../login.php"); // Redirigir si no hay inicio de sesión
}

if ($_SESSION["user_role"] !== "bodega") {
    header("Location: ../login.php"); // Redirigir si el rol no es admin
}

include('../dbconnection.php');
if (isset($_POST['submit'])) {
	$eid = $_GET['editid'];
	//Getting Post Values
	$desc = $_POST['nombre'];
	$cantidad = $_POST['cantidad'];
	$umedida = $_POST['unidad'];
	$preciou = $_POST['precio'];

	//Query for data updation
	$query = mysqli_query($con, "update  tblingredientes set Descripcion='$desc', Cantidad='$cantidad', Unidad='$umedida', Precio='$preciou' where ID='$eid'");

	if ($query) {
		echo "<script>alert('You have successfully update the data');</script>";
		echo "<script type='text/javascript'> document.location ='index.php'; </script>";
	} else {
		echo "<script>alert('Something Went Wrong. Please try again');</script>";
	}
}
?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<title>Sistema - Pizza Mundo</title>

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="../../css/estiloIndex.css">


	<link href="../../css/estilo_inicio_administrador.css" rel="stylesheet" type="text/css">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
		integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
		integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
		crossorigin="anonymous"></script>
	<script src="../js/myscript.js"></script>
</head>

<body>
	<header>
		<nav class="navbar bg-body-tertiary mb-4">
			<div class="container-fluid">
				<a class="navbar-brand" href="inicio_administrador.html">
					<img src="../../img/logo-icon-both.png" alt="Logo" width="300px" height="130px"
						class="d-inline-block align-text-top">
				</a>
			</div>
		</nav>
	</header>
	<div class="container-fluid">

		<div class="row">
			<div class="col-sm-12 col-md-12 col-lg-3 col-xl-3 ">
				<nav>
					<ul class="nav flex-column">
						<li class="nav-item">
							<a href="index.php">Inicio</a>
						</li>
						<li class="nav-item">
							<a href="../cerrar_sesion.php">Salir</a>
						</li>
					</ul>
				</nav>
			</div>
			<div class="col col-sm-12 col-md-12 col-lg-8 col-xl-8 m-0">
				<h3>Editar ingrediente</h3>

				<div id="ingredientsContainer">
					<form action="" method="POST">
						<?php
						$eid = $_GET['editid'];
						$ret = mysqli_query($con, "select * from tblingredientes where ID='$eid'");
						while ($row = mysqli_fetch_array($ret)) {
							?>
							<div class="form-group">

								<label for="nombre">Nombre del Ingrediente:</label>
								<input type="text" id="nombre" name="nombre" value="<?php echo $row['Descripcion']; ?>"
									required><br><br>

								<label for="cantidad">Cantidad:</label>
								<input type="number" id="cantidad" name="cantidad" step="0.01" value="<?php echo $row['Cantidad']; ?>"
									required><br><br>

								<label for="unidad">Unidad de Medida:</label>
								<select id="unidad" name="unidad">
									<?php
									echo '<option value="' . $row['Unidad'] . '" selected >' . $row['Unidad'] . '</option>';
									?>
									<option value="Kilogramo/s">Kilogramos (kg)</option>
                                    <option value="Gramos">Gramos (g)</option>
                                    <option value="Litro/s">Litros (l)</option>
                                    <option value="Mililitros">Mililitros (ml)</option>
                                    <option value="Unidad/es">Unidad/es</option>
								</select><br><br>

								<label for="precio">Precio por Unidad de Medida:</label>
								<input type="number" step="0.01" id="precio" name="precio"
									value="<?php echo $row['Precio']; ?>" required><br><br>
								<?php
						} ?>
							<div class="form-group">
								<button type="submit" class="boton perz" name="submit">Actualizar datos</button>
							</div>
					</form>
				</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>