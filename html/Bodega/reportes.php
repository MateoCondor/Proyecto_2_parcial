<?php
session_start();
include('../dbconnection.php');

if (!isset($_SESSION["user_role"]) || !isset($_SESSION["bodega_login"])) {
    header("Location: ../login.php"); // Redirigir si no hay inicio de sesión
}

if ($_SESSION["user_role"] !== "bodega") {
    header("Location: ../login.php"); // Redirigir si el rol no es admin
}

if ($con->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
$sql = "SELECT ID, Descripcion, Cantidad, Unidad, Precio, FechaIngreso, Active FROM tblingredientes";
$result = $con->query($sql);



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
                            <a href="reportes.php">Reporte de inventario</a>
                        </li>
                        <li class="nav-item">
                            <a href="../cerrar_sesion.php">Salir</a>
                        </li>

                    </ul>
                </nav>
            </div>
            <div class="col col-sm-12 col-md-12 col-lg-8 col-xl-8 m-0">
                <a href="ingredientesPDF.php" class="boton perz">Generar PDF</a>
                <a href="ingredientesEXCEL.php" class="boton perz">Generar Excel</a>
                <a href="ingredientesXML.php" class="boton perz">Generar XML</a>
                <h3>Rerporte de inventario</h3>

                <div id="reportesContainer">

                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Descripción</th>
                                <th>Cantidad</th>
                                <th>Unidad</th>
                                <th>Precio</th>
                                <th>Fecha de ingreso</th>
                                <th>Activo</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php



                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $row["ID"] . "</td>";
                                    echo "<td>" . $row["Descripcion"] . "</td>";
                                    echo "<td>" . $row["Cantidad"] . "</td>";
                                    echo "<td>" . $row["Unidad"] . "</td>";
                                    echo "<td>" . $row["Precio"] . "</td>";
                                    echo "<td>" . $row["FechaIngreso"] . "</td>";
                                    echo "<td>" . $row["Active"] . "</td>";
                                    echo "</tr>";
                                }
                            } else {
                                echo "<tr><td colspan='5'>No se encontraron ingredientes en la base de datos.</td></tr>";
                            }

                            $con->close();
                            ?>

                        </tbody>
                    </table>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>