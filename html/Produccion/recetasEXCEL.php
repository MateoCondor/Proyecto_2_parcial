<?php
include('../dbconnection.php');

if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}

$sql = "SELECT Codigo, NombreReceta, PrecioReceta, FechaCreacion FROM datos_receta";
$result = $con->query($sql);

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="reporte_recetas.xls"');

echo "Codigo\tNombreReceta\tPrecioReceta\tFechaCreacion\n";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo $row["Codigo"] . "\t";
        echo utf8_decode($row["NombreReceta"]) . "\t"; // Agregar utf8_decode para caracteres especiales
        echo $row["PrecioReceta"] . "\t";
        echo $row["FechaCreacion"] . "\n";
    }
} else {
    echo "No se encontraron recetas en la base de datos.";
}

$con->close();
?>
