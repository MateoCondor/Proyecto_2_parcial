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
    //getting the post values
    $desc = $_POST['nombre'];
    $cantidad = $_POST['cantidad'];
    $umedida = $_POST['unidad'];
    $preciou = $_POST['precio'];

    // Query for data insertion
    $query = mysqli_query($con, "insert into tblingredientes ( Descripcion, Cantidad, Unidad, Precio, Active) value('$desc','$cantidad', '$umedida', '$preciou', '1' )");
    if ($query) {
        echo "<script>alert('You have successfully inserted the data');</script>";
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
                            <a href="ingreso.php">Ingresar nuevo ingrediente</a>
                        </li>
                        <li class="nav-item">
                            <a href="edit.php">Aumentar inventario de ingrediente</a>
                        </li>
                        <li class="nav-item">
                            <a href="../cerrar_sesion.php">Salir</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col col-sm-12 col-md-12 col-lg-8 col-xl-8 m-0">
                <h3>Ingreso de Ingredientes a inventario</h3>

                <div id="ingredientsContainer">
                    <form action="" method="POST">
                        <div class="row ">
                            <div class="col-sm-12 col-md-6 col-lg-5 col-xl-8 mt-3">
                                <label for="nombre">Nombre del Ingrediente:</label>
                                <input type="text" id="nombre" name="nombre" required>
                            </div>
                        </div>

                        <div class="row ">
                            <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 mt-4">
                                <label for="cantidad">Cantidad:</label>
                                <input type="number" id="cantidad" name="cantidad" required>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-3 col-xl-4 my-4">
                                <label for="unidad">Unidad de Medida:</label>
                                <select id="unidad" name="unidad">
                                    <option value="Kilogramo/s">Kilogramos (kg)</option>
                                    <option value="Gramos">Gramos (g)</option>
                                    <option value="Litro/s">Litros (l)</option>
                                    <option value="Mililitros">Mililitros (ml)</option>
                                    <option value="Unidad/es">Unidad/es</option>
                                </select>
                            </div>

                            <div class="col-sm-12 col-md-6 col-lg-5 col-xl-4 mt-4">
                                <label for="precio">Precio por Unidad de Medida:</label>
                                <input type="number" step="0.01" id="precio" name="precio" required>
                            </div>
                            
                        </div>
                        <br><br>
                        <button type="submit" class="boton perz" name="submit">Agregar ingrediente</button>
                        <a href="index.php" class="boton perz">Cancelar</a>

                    </form>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>