<?php
//Database Connection
session_start();
if (!isset($_SESSION["user_role"]) || !isset($_SESSION["admin_login"])) {
    header("Location: ../login.php"); // Redirigir si no hay inicio de sesión
}

if ($_SESSION["user_role"] !== "admin") {
    header("Location: ../login.php"); // Redirigir si el rol no es admin
}
include('../dbconnection.php');
if (isset($_POST['submit'])) {
	$eid = $_GET['editid'];
	//Getting Post Values
	$usernameu = $_POST['username'];
	$passwordu = $_POST['password'];
	$emailu = $_POST['email'];
	$rolu = $_POST['rol'];

	//Query for data updation
	$query = mysqli_query($con, "update mainlogin set username='$usernameu', password='$passwordu', email='$emailu', role='$rolu' where id='$eid'");

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
			$ret = mysqli_query($con, "select * from mainlogin where id='$eid'");
			while ($row = mysqli_fetch_array($ret)) {
				?>
				<h2>Actualizar </h2>
				<p class="hint-text">Actualizar informacion</p>
				<div class="form-group">

					<label for="">Nombre de usuario:</label>
					<input type="text" id="username" name="username" value="<?php echo $row['username']; ?>"
						required><br><br>
					<label for="">Email: </label>
					<input type="email" id="email" name="email" value="<?php echo $row['email']; ?>"
						required><br><br>
					<label for="">Contraseña:</label>
					<input type="password" id="password" name="password" value="<?php echo $row['password']; ?>"
						required><br><br>

					<label for="">Roles:</label>
					<select id="rol" name="rol">
						<option value="">SELECCIONE UN ROL</option>
						<option value="bodega">Bodega</option>
						<option value="produccion">Produccion</option>
						<option value="ventas">Ventas</option>
						<option value="reportes">Reportes</option>
					</select><br><br>
					<?php
			} ?>
				<div class="form-group">
					<button type="submit" class="boton perz" name="submit">Actualizar datos</button>
				</div>
		</form>

	</div>
</body>

</html>