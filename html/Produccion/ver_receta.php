<?php
include('../dbconnection.php');
session_start();

if (!isset($_SESSION["user_role"]) || !isset($_SESSION["produccion_login"])) {
    header("Location: ../login.php"); // Redirigir si no hay inicio de sesión
}

if ($_SESSION["user_role"] !== "produccion") {
    header("Location: ../login.php"); // Redirigir si el rol no es admin
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
                <div class="container">
                    <table class="table my-4 table-borderless m-0">
                        <thead>
                            <tr>
                                <th>Datos de la receta</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $vid = $_GET['viewid'];
                            $ret = mysqli_query($con, "select * from datos_receta where Codigo =$vid");
                            while ($row = mysqli_fetch_array($ret)) {

                                ?>
                                <tr>
                                    <th>Nombre Receta</th>
                                    <td>
                                        <?php echo $row['NombreReceta']; ?>
                                    </td>
                                    <th>Precio Receta</th>
                                    <td>
                                        <?php echo $row['PrecioReceta']; ?> $
                                    </td>
                                </tr>
                                <tr>
                                    <th>Fecha de creacion</th>
                                    <td>
                                        <?php echo $row['FechaCreacion']; ?>
                                    </td>
                                    <th>Codigo</th>
                                    <td>
                                        <?php echo $row['Codigo']; ?>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Estado</th>
                                    <td>
                                        <?php
                                        if ($row['Active'] == 0) {
                                            echo 'Inactivo';
                                        } elseif ($row['Active'] == 1) {
                                            echo 'Activo';
                                        } else {
                                            echo 'Estado desconocido';
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            } ?>
                        </tbody>
                        
                    </table>
                    <table class="table my-4 table-borderless m-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nombre ingrediente</th>
                                        <th>Cantidad</th>
                                        <th>Costo unidad</th>
                                        <th>Costo cantidad/unidad</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    
                                    $ret2 = mysqli_query($con, "select * from ingredientes_receta where Codigo='$vid'");
                                    $row2 = mysqli_num_rows($ret2);
                                    if ($row2 > 0) {
                                        while ($row2 = mysqli_fetch_array($ret2)) {
                                            ?>
                                                <td>
                                                    <?php echo $row2['Codigo']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row2['Nombre']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row2['Cantidad']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row2['PrecioUnidad']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row2['PrecioTotal']; ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                    } else { ?>
                                        <tr>
                                            <th style="text-align:center; color:red;" colspan="6"></th>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                    <a href="index.php" class="boton perz">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>