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

    $nombreReceta = $_POST['nombrePizza'];
    $descripcionIngrediente = $_POST['nombreIngrediente'];

    $dbnombre = null;
    $ret2 = mysqli_query($con, "select * from datos_receta");
    while ($row2 = mysqli_fetch_array($ret2)) {
        if ($row2['NombreReceta'] == $nombreReceta) {
            $dbnombre = $nombreReceta;
            break;
        }
    }
    if ($dbnombre == null) {
        $query = mysqli_query($con, "insert into datos_receta (NombreReceta) VALUE ('$nombreReceta')");
        $ret3 = mysqli_query($con, "select * from datos_receta where NombreReceta='$nombreReceta'");
        $row3 = mysqli_fetch_array($ret3);
        $codigo = $row3['Codigo'];
        $_SESSION['codigo'] = $codigo;


        $ret4 = mysqli_query($con, "select * from tblingredientes where Descripcion='$descripcionIngrediente'");
        $row4 = mysqli_fetch_array($ret4);
        $nombreIngredientengrediente = $row4['Descripcion'];
        $cantidad = $_POST['cantidad'];
        $precioU = $row4['Precio'];
        $precioT = $cantidad * $precioU;

        $query2 = mysqli_query($con, "insert into ingredientes_receta (Codigo, Nombre, Cantidad, PrecioUnidad, PrecioTotal) VALUE ('$codigo','$nombreIngredientengrediente','$cantidad','$precioU','$precioT')");
    } else {
        $ret3 = mysqli_query($con, "select * from datos_receta where NombreReceta='$nombreReceta'");
        $row3 = mysqli_fetch_array($ret3);
        $codigo = $row3['Codigo'];
        $_SESSION['codigo'] = $codigo;

        $ret4 = mysqli_query($con, "select * from tblingredientes where Descripcion='$descripcionIngrediente'");
        $row4 = mysqli_fetch_array($ret4);
        $nombreIngredientengrediente = $row4['Descripcion'];
        $cantidad = $_POST['cantidad'];
        $precioU = $row4['Precio'];
        $precioT = $cantidad * $precioU;


        $existingIngredientQuery = mysqli_query($con, "select * from ingredientes_receta where Codigo='$codigo' and Nombre='$nombreIngredientengrediente'");
        if (mysqli_num_rows($existingIngredientQuery) > 0) {
            $updateQuantityQuery = mysqli_query($con, "update ingredientes_receta set Cantidad=Cantidad+'$cantidad', PrecioTotal=PrecioTotal+'$precioT' where Codigo='$codigo' and Nombre='$nombreIngredientengrediente'");
        } else {
            $query2 = mysqli_query($con, "insert into ingredientes_receta (Codigo, Nombre, Cantidad, PrecioUnidad, PrecioTotal) VALUE ('$codigo','$nombreIngredientengrediente','$cantidad','$precioU','$precioT')");
        }

        $ret5 = mysqli_query($con, "select * from ingredientes_receta where Codigo='$codigo'");
        while ($row5 = mysqli_fetch_array($ret5)) {
            $costoPizza += $row5['PrecioTotal'];
        }
        $query3 = mysqli_query($con, "update datos_receta set PrecioReceta='$costoPizza' where Codigo='$codigo'");
    }

    unset($_SESSION['nombrePizza']);
    unset($_SESSION['nombreIngrediente']);

    if ($query || $query2 || $query3) {


    } else {
        echo "<script>alert('Algo salio mal');</script>";
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
    <script src="../../js/myscript.js"></script>
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
                <div id="container">
                    <div class="container-xl">
                        <h3>Creacion de receta</h3>
                        <br>
                        <form action="" method="POST" id="productForm">
                            <div class="form-group">
                                <label for="nombrePizza">Nombre de la pizza:</label>
                                <input type="text" id="nombrePizza" name="nombrePizza" required
                                    value="<?php echo isset($_POST['nombrePizza']) ? htmlspecialchars($_POST['nombrePizza']) : ''; ?>">
                                <br>
                                <br>

                                <label for="nombreIngrediente">Nombre del Ingrediente:</label>
                                <select id="nombreIngrediente" name="nombreIngrediente" required>
                                    <option value="" <?php if (empty($_POST['nombreIngrediente']))
                                        echo 'selected'; ?>>SELECCIONAR INGREDIENTE
                                    </option>
                                    <?php
                                    $query = mysqli_query($con, "select * from tblingredientes");
                                    while ($valores = mysqli_fetch_array($query)) {
                                        if ($valores['Active'] != 0) {
                                            echo '<option value="' . $valores['Descripcion'] . '">' . $valores['Descripcion'] . '</option>';
                                        }
                                    }
                                    ?>
                                </select>

                                <label for="cantidad">Cantidad: </label>
                                <input type="number" id="cantidad" name="cantidad" required step="0.01">
                                <br><br>
                                <div class="form-group">
                                    <?php

                                    ?>
                                    <button type="submit" class="boton perz" name="submit">Añadir ingrediente</button>
                                    <?php

                                    ?>
                                    <a href="index.php" class="boton perz">Cancelar</a>
                                </div>
                            </div>
                        </form>
                        <div class="container">
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
                                    $cod = $_SESSION['codigo'];
                                    $ret = mysqli_query($con, "select * from ingredientes_receta where Codigo='$cod'");
                                    $row = mysqli_num_rows($ret);
                                    if ($row > 0) {
                                        while ($row = mysqli_fetch_array($ret)) {
                                            ?>
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
                                            unset($_SESSION['codigo']);
                                            unset($_SESSION['nombreIngrediente']);
                                        }
                                    } else { ?>
                                        <tr>
                                            <th style="text-align:center; color:red;" colspan="6"></th>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>