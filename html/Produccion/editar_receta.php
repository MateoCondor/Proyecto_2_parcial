<?php
session_start();

if (!isset($_SESSION["user_role"]) || !isset($_SESSION["produccion_login"])) {
    header("Location: ../login.php"); // Redirigir si no hay inicio de sesión
}

if ($_SESSION["user_role"] !== "produccion") {
    header("Location: ../login.php"); // Redirigir si el rol no es admin
}

include('../dbconnection.php');
if (isset($_POST['submit'])) {
    $eid = $_GET['editid'];
    $nombre = $_POST['nombre'];
    $query = mysqli_query($con, "update datos_receta set  NombreReceta='$nombre' where Codigo='$eid'");

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
                        $ret = mysqli_query($con, "select * from datos_receta where Codigo='$eid'");
                        while ($row = mysqli_fetch_array($ret)) {
                            ?>
                            <div class="form-group">

                                <label for="nombre">Nombre de la receta: </label>
                                <input type="text" id="nombre" name="nombre" value="<?php echo $row['NombreReceta']; ?>"
                                    required><br><br>

                                <?php
                        } ?>
                            <div class="form-group">
                                <button type="submit" class="boton perz" name="submit">Actualizar datos</button>
                            </div>
                    </form>
                    <table class="table my-4 table-borderless m-0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nombre ingrediente</th>
                                <th>Cantidad</th>
                                <th>Costo unidad</th>
                                <th>Costo cantidad/unidad</th>
                                <?php
                                $ret = mysqli_query($con, "select * from ingredientes_receta where Codigo='$eid'");
                                $row = mysqli_num_rows($ret);
                                if ($row > 0) {
                                    while ($row = mysqli_fetch_array($ret)) {
                                        ?>
                                        <th>
                                        
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr <?php echo $rowClass; ?>>
                                        <td>
                                            <?php echo $row['Codigo']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Nombre']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['Cantidad']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['PrecioUnidad']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['PrecioTotal']; ?>
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
                    <a href="editar_ingrediente_receta.php?editid=<?php echo htmlentities($eid); ?>" class="boton perz"> Editar ingredientes  </a>
                    <a href="index.php" class="boton perz">Cancelar</a>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>