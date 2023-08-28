<?php
session_start();
include('../dbconnection.php'); // Asegúrate de incluir el archivo de conexión a la base de datos

// if (!isset($_SESSION["user_role"]) || !isset($_SESSION["ventas_login"])) {
//     header("Location: ../login.php"); // Redirigir si no hay inicio de sesión
// }

// if ($_SESSION["user_role"] !== "ventas") {
//     header("Location: ../login.php"); // Redirigir si el rol no es admin
// }
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
                            <a href="">seccion pagina</a>
                        </li>
                        <!--aqui se ponen las secciones que tendra cada pagina inicial de cada perfil-->
                        <li class="nav-item">
                            <a href="../cerrar_sesion.php">Salir</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="col col-sm-12 col-md-12 col-lg-8 col-xl-8 m-0">
                <h2>Sistema ventas </h2>
                <h3>Bienvenido
                </h3>
                <div class="container">
                    <form action="procesar_factura.php" method="post">
                        <div class="row">
                            <div class="col-md-6">
                                <label for="cedula">Cédula:</label>
                                <input type="text" name="cedula" id="cedula" class="form-control" required><br><br>

                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control" required><br><br>

                                <label for="apellido">Apellido:</label>
                                <input type="text" name="apellido" id="apellido" class="form-control" required><br><br>

                                <label for="celular">Celular:</label>
                                <input type="text" name="celular" id="celular" class="form-control" required><br><br>
                            </div>
                            <div class="col-md-6">
                                <label for="direccion">Dirección:</label>
                                <input type="text" name="direccion" id="direccion" class="form-control"
                                    required><br><br>

                                <label for="correo">Correo:</label>
                                <input type="email" name="correo" id="correo" class="form-control" required><br><br>

                                <label for="receta">Selecciona una receta:</label>
                                <select name="receta" id="receta" class="form-select">
                                    <?php
                                    $query = "SELECT Codigo, NombreReceta FROM datos_receta WHERE Active = 1";
                                    $result = $con->query($query);

                                    if ($result->num_rows > 0) {
                                        while ($row = $result->fetch_assoc()) {
                                            $codigo = $row["Codigo"];
                                            $nombreReceta = $row["NombreReceta"];
                                            echo "<option value='$codigo'>$nombreReceta</option>";
                                        }
                                    } else {
                                        echo "<option value=''>No hay recetas disponibles</option>";
                                    }
                                    ?>
                                </select><br><br>

                                <label for="cantidad">Cantidad:</label>
                                <input type="number" name="cantidad" id="cantidad" min="1" class="form-control"
                                    required><br><br>
                            </div>
                        </div>

                        <input type="submit" value="Generar Factura">
                    </form>
                    

                </div>
            </div>
        </div>
    </div>
</body>

</html>