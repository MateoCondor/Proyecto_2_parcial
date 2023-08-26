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



    $descu = $_POST['nombre'];

    $ret2 = mysqli_query($con, "select * from tblingredientes where Descripcion='$descu'");
    while ($row2 = mysqli_fetch_array($ret2)) {
        $cantidad = $_POST['cantidad'] + $row2['Cantidad'];
        $cod = $row2['ID'];
        $unidad = $row2['Unidad'];
    }

    //Query for data updation
    $query = mysqli_query($con, "update  tblingredientes set  Cantidad='$cantidad' where Descripcion='$descu'");
    $query2 = mysqli_query($con, "insert into tblingreso (ID, CantIngresada, UnidadIng) value('$cod','$cantidad','$unidad')");

    if ($query || $query2) {
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:400,700">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/estiloEdit.css">


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
                <h3>Aumentar en inventario</h3><br>
                <div id="container">
                    <form action="" method="POST" id="miFormulario">
                        <label for="desc">Nombre del Ingrediente:</label>
                        <select id="desc" name="desc">
                            <option value="" <?php if (empty($_POST['desc']))
                                echo 'selected'; ?>>SELECCIONAR INGREDIENTE
                            </option>
                            <?php
                            $query = $con->query("SELECT * FROM tblingredientes");
                            while ($valores = mysqli_fetch_array($query)) {
                                if ($valores['Active'] != 0) {
                                    echo '<option value="' . $valores['Descripcion'] . '" ';
                                    if (isset($_POST['desc']) && $_POST['desc'] == $valores['Descripcion'])
                                        echo 'selected';
                                    echo '>' . $valores['Descripcion'] . '</option>';
                                }

                            }
                            ?>
                        </select><br><br>
                    </form>

                    <script>
                        document.getElementById("desc").addEventListener("change", function () {
                            document.getElementById("miFormulario").submit();
                        });
                    </script>


                    <form action="" method="POST">

                        <div class="form-group">
                            <?php
                            $desc = $_POST['desc'];
                            $ret = mysqli_query($con, "select * from tblingredientes where Descripcion='$desc'");
                            while ($row = mysqli_fetch_array($ret)) {
                                ?>

                                <label for="nombre">Nombre:</label>
                                <input type="text" id="nombre" name="nombre" value="<?php echo $row['Descripcion']; ?>"
                                    required><br><br>

                                <label for="cantidad">Cantidad:</label>
                                <input type="number" id="cantidad" name="cantidad" required>
                                <?php echo $row['Unidad']; ?><br><br>
                                <?php
                            } ?>
                            <div class="form-group">
                                <button type="submit" class="boton perz" name="submit">Aumentar datos</button>
                                <a href="index.php" class="boton perz">Cancelar</a>
                            </div>
                        </div>
                    </form>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>