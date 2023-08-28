<?php
include('../dbconnection.php');

if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}

$sql = "SELECT NumeroOrden, FechaGeneracion, NombrePizza, Cantidad_Pizza, Total_Pizza, Precio_Orden FROM orden_prod";
$result = $con->query($sql);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="reporte_ordenes.xls"');

echo "Número de Orden\tFecha de Generación\tNombre de la Pizza\tCantidad\tTotal Pizza\tPrecio Orden\n";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo $row["NumeroOrden"] . "\t";
        echo $row["FechaGeneracion"] . "\t";
        echo utf8_decode($row["NombrePizza"]) . "\t"; // Agregar utf8_decode para caracteres especiales
        echo $row["Cantidad_Pizza"] . "\t";
        echo $row["Total_Pizza"] . "\t";
        echo $row["Precio_Orden"] . "\n";
    }
} else {
    echo "No se encontraron órdenes en la base de datos.";
}

$con->close();
?>
