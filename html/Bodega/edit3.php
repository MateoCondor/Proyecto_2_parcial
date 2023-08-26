<?php
//Database Connection
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
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
	<title>PHP Crud Operation!!</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="css/estiloEdit.css">
</head>

<body>
	<div class="signup-form">
		<form action="" method="POST">
			<?php
			$eid = $_GET['editid'];
			$ret = mysqli_query($con, "select * from tblingredientes where ID='$eid'");
			while ($row = mysqli_fetch_array($ret)) {
				?>
				<h2>Update </h2>
				<p class="hint-text">Update your info.</p>
				<div class="form-group">

					<label for="nombre">Nombre del Ingrediente:</label>
					<input type="text" id="nombre" name="nombre" value="<?php echo $row['Descripcion']; ?>"
						required><br><br>

					<label for="cantidad">Cantidad:</label>
					<input type="number" id="cantidad" name="cantidad" value="<?php echo $row['Cantidad']; ?>"
						required><br><br>

					<label for="unidad">Unidad de Medida:</label>
					<select id="unidad" name="unidad">
						<option value="kg">Kilogramos (kg)</option>
						<option value="g">Gramos (g)</option>
						<option value="l">Litros (l)</option>
						<option value="ml">Mililitros (ml)</option>
						<option value="unidad">Unidad</option>
					</select><br><br>

					<label for="precio">Precio por Unidad de Medida:</label>
					<input type="number" step="0.01" id="precio" name="precio" value="<?php echo $row['Precio']; ?>"
						required><br><br>
					<?php
			} ?>
				<div class="form-group">
					<button type="submit" class="boton perz" name="submit">Actualizar datos</button>
				</div>
		</form>

	</div>
</body>

</html>