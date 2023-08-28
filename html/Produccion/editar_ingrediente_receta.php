<?php
//Database Connection
include('../dbconnection.php');

if (isset($_POST['submit_cantidad'])) {


    $eid = $_GET['editid'];

    $cantidad = $_POST['cantidad'];
    $query = mysqli_query($con, "update ingredientes_receta set Cantidad='$cantidad' where Codigo='$eid'");

    $ret5 = mysqli_query($con, "select * from ingredientes_receta where Codigo='$eid'");
    while ($row5 = mysqli_fetch_array($ret5)) {
        $costoPizza += $row5['PrecioTotal'];
    }
    $query3 = mysqli_query($con, "update datos_receta set PrecioReceta='$costoPizza' where Codigo='$eid'");

    if ($query || $query3) {
        echo "<script>alert('You have successfully update the data');</script>";
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


                <form action="" method="POST">
                    <?php
                    $eid = $_GET['editid'];
                    $ret = mysqli_query($con, "select * from ingredientes_receta where Codigo='$eid'");
                    while ($row = mysqli_fetch_array($ret)) {
                        ?>
                        <div class="form-group">
                            <label for="cantidad">Ingrediente:
                                <?php echo $row['Nombre']; ?>
                            </label><br>
                            <label for="cantidad">Cantidad:</label>
                            <input type="number" id="cantidad" name="cantidad" step="0.01" value="<?php echo $row['Cantidad']; ?>"
                                required><br><br>

                            <?php
                    } ?>
                        <div class="form-group">
                            <button type="submit" class="boton perz" name="submit_cantidad">Actualizar datos</button>
                            <a href="index.php" class="boton perz">Regresar</a>
                        </div>
                </form>
                
            </div>
        </div>
    </div>
</body>

</html>