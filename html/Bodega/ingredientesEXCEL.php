<?php
include('../dbconnection.php');

if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}

$sql = "SELECT ID, Descripcion, Cantidad, Unidad, Precio, FechaIngreso FROM tblingredientes";
$result = $con->query($sql);


header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="reporte_ingredientes.xls"');

echo "ID\tDescripcion\tCantidad\tUnidad\tPrecio\tFechaIngreso\n";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo $row["ID"] . "\t";
        echo $row["Descripcion"] . "\t";
        echo $row["Cantidad"] . "\t";
        echo $row["Unidad"] . "\t";
        echo $row["Precio"] . "\t";
        echo $row["FechaIngreso"] . "\n";
    }
} else {
    echo "No se encontraron ingredientes en la base de datos.";
}

$con->close();
?>
