<?php
include('../dbconnection.php');

session_start();

if (!isset($_SESSION["user_role"]) || !isset($_SESSION["produccion_login"])) {
    header("Location: ../login.php"); // Redirigir si no hay inicio de sesión
}

if ($_SESSION["user_role"] !== "produccion") {
    header("Location: ../login.php"); // Redirigir si el rol no es admin
}

if (isset($_POST['submit'])) {

    $nombrePizza = $_POST['nombrePizza'];

    $ret3 = mysqli_query($con, "select * from datos_receta where NombreReceta='$nombrePizza'");
    $row3 = mysqli_fetch_array($ret3);
    $codigo = $row3['NumeroOrden'];
    $precioReceta = $row3['PrecioReceta'];
    $cantidad =$_POST['cantidad'];
    $totalOrden = $cantidad * $precioReceta;
    $_SESSION['codigo'] = $codigo;

    $query2 = mysqli_query($con, "insert into orden_prod  (NombrePizza,Cantidad_Pizza, Total_Pizza, Precio_Orden) VALUE ('$nombrePizza','$cantidad','$precioReceta',' $totalOrden')");

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
                    <div class="container-xl">
                        <h3>Creacion de Orden de Produccion</h3>


                        <form action="" method="POST" id="productForm">

                            <label for="nombrePizza">Nombre de la pizza: </label>
                            <select id="nombrePizza" name="nombrePizza">
                                <option value="" <?php if (empty($_POST['nombrep']))
                                    echo 'selected'; ?>>SELECCIONAR PIZZA
                                </option>
                                <?php
                                $query = $con->query("SELECT * FROM datos_receta");
                                while ($valores = mysqli_fetch_array($query)) {
                                    if ($valores['Active'] != 0) {
                                        echo '<option value="' . $valores['NombreReceta'] . '" ';
                                        if (isset($_POST['nombrep']) && $_POST['nombrep'] == $valores['NombreReceta'])
                                            echo 'selected';
                                        echo '>' . $valores['NombreReceta'] . '</option>';
                                    }
                                }
                                ?>
                            </select>

                            <label for="cantidad">Cantidad: </label>
                            <input type="number" id="cantidad" name="cantidad" required>
                            <br><br>
                            <div class="form-group">
                                <button type="submit" class="boton perz" name="submit">Añadir ingrediente</button>
                                <a href="index.php" class="boton perz">Cancelar</a>
                            </div>
                    </div>
                    </form>
                    <div class="container">
                        <table class="table my-4 table-borderless m-0">
                            <thead>
                                <tr>
                                    <th>Numero de Orden</th>
                                    <th>Nombre de Pizza</th>
                                    <th>Cantidad</th>
                                    <th>Precio pizza </th>
                                    <th>Precio total</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                
                                $ordenp = mysqli_query($con, "select * from orden_prod");
                                $fila = mysqli_num_rows($ordenp);
                                if ($fila > 0) {
                                    while ($fila = mysqli_fetch_array($ordenp)) {
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $fila['NumeroOrden']; ?>
                                            </td>
                                            <td>
                                                <?php echo $fila['NombrePizza']; ?>
                                            </td>
                                            <td>
                                                <?php echo $fila['Cantidad_Pizza']; ?>
                                            </td>
                                            <td>
                                                <?php echo $fila['Total_Pizza']; ?> $
                                            </td>
                                            <td>
                                                <?php echo $fila['Precio_Orden']; ?> $
                                            </td>

                                        </tr>
                                        <?php
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



            </div>
        </div>
    </div>
    </div>
</body>

</html>