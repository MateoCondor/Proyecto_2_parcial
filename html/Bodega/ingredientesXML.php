<?php
include('../dbconnection.php');

if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}

$sql = "SELECT ID, Descripcion, Cantidad, Unidad, Precio, FechaIngreso FROM tblingredientes";
$result = $con->query($sql);

// Encabezado y salida del archivo XML
header('Content-Type: text/xml');
header('Content-Disposition: attachment; filename="reporte_ingredientes.xml"');

echo '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
echo '<ingredientes>' . PHP_EOL;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "\t<ingrediente>" . PHP_EOL;
        echo "\t\t<ID>" . $row["ID"] . "</ID>" . PHP_EOL;
        echo "\t\t<Descripcion>" . $row["Descripcion"] . "</Descripcion>" . PHP_EOL;
        echo "\t\t<Cantidad>" . $row["Cantidad"] . "</Cantidad>" . PHP_EOL;
        echo "\t\t<Unidad>" . $row["Unidad"] . "</Unidad>" . PHP_EOL;
        echo "\t\t<Precio>" . $row["Precio"] . "</Precio>" . PHP_EOL;
        echo "\t\t<FechaIngreso>" . $row["FechaIngreso"] . "</FechaIngreso>" . PHP_EOL;
        echo "\t</ingrediente>" . PHP_EOL;
    }
}

echo '</ingredientes>';

$con->close();
?>
