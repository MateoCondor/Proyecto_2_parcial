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
    } else {
        echo "<script>alert('Something Went Wrong. Please try again');</script>";
    }
}


if (isset($_GET['delid'])) {
    $rid = intval($_GET['delid']);
    $sql = mysqli_query($con, "UPDATE `tblingredientes` SET `Active`= '0' where ID=$rid");
    echo "<script>alert('Data deleted');</script>";
    echo "<script>window.location.href = 'index.php'</script>";
}

if (isset($_GET['activacionid'])) {
    $rid = intval($_GET['activacionid']);
    $sql = mysqli_query($con, "UPDATE `tblingredientes` SET `Active`= '1' where ID=$rid");
    echo "<script>alert('Data deleted');</script>";
    echo "<script>window.location.href = 'index.php'</script>";
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
                <h2>Sistema bodega</h2>
                <h3>Bienvenido,
                    <?php echo $_SESSION["username"]; ?>
                </h3>

                <div id="container">

                    <div class="container-xl">
                        <div class="table-title">
                            <div class="row">
                                <div class="col-sm-5 mt-4">
                                    <h2>Inventario de ingredientes</h2>
                                </div>
                            </div>
                        </div>
                        <table class="table my-4 table-borderless m-0">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Ingrediente</th>
                                    <th>Cantidad</th>
                                    <th>Unidad</th>
                                    <th>Precio/U </th>
                                    <th>Activo</th>
                                    <th>Accion</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $ret = mysqli_query($con, "select * from tblingredientes");
                                $cnt = 1;
                                $row = mysqli_num_rows($ret);
                                if ($row > 0) {
                                    while ($row = mysqli_fetch_array($ret)) {
                                        if ($row['Active'] == 1) {
                                            $activeMessage = 'Activo';
                                        } elseif ($row['Active'] == 0) {
                                            $activeMessage = 'Inactivo';
                                        }
                                        ?>
                                        <!--Fetch the Records -->
                                        <tr>
                                            <td>
                                                <?php echo $row['ID']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Descripcion']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Cantidad']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Unidad']; ?>
                                            </td>
                                            <td>
                                                <?php echo $row['Precio']; ?> $
                                            </td>
                                            <td>
                                                <?php echo $activeMessage; ?>
                                            </td>
                                            <td>
                                                <?php if ($row['Active'] == 1): ?>
                                                    <a href="edit3.php?editid=<?php echo htmlentities($row['ID']); ?>" class="edit"
                                                        title="Editar" data-toggle="tooltip"><i
                                                            class="material-icons">&#xE254;</i></a>
                                                    <a href="index.php?delid=<?php echo ($row['ID']); ?>" class="delete"
                                                        title="Delete" data-toggle="tooltip"><i
                                                            class="material-icons">&#xE872;</i></a>
                                                <?php else: ?>

                                                    <a href="index.php?activacionid=<?php echo ($row['ID']); ?>" class="delete"
                                                        title="Activate" data-toggle="tooltip"><i
                                                            class="material-icons">&#xE876;</i></a>
                                                <?php endif; ?>

                                            </td>
                                        </tr>
                                        <?php
                                        $cnt = $cnt + 1;
                                    }
                                } else { ?>
                                    <tr>
                                        <th style="text-align:center; color:red;" colspan="6">Base de datos vacia</th>
                                    </tr>
                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>