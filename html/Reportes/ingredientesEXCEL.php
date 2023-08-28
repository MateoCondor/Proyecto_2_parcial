<?php

// Conexión a la base de datos (ajusta los parámetros según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyecto";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Conexión a la base de datos (ajusta los parámetros según tu configuración)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "proyecto";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Consulta a la base de datos
$sql = "SELECT ID_INGREDIENTE, NOMBRE_INGREDIENTE, CANTIDAD, UNIDAD_MEDIDA, COSTO FROM INGREDIENTE";
$result = $conn->query($sql);

// Crear el contenido del archivo XLS
$file_content = "ID\tNombreIngrediente\tCantidad\tUnidad_Medida\tCosto\n";
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $file_content .= $row["ID_INGREDIENTE"] . "\t";
        $file_content .= $row["NOMBRE_INGREDIENTE"] . "\t";
        $file_content .= $row["CANTIDAD"] . "\t";
        $file_content .= $row["UNIDAD_MEDIDA"] . "\t";
        $file_content .= $row["COSTO"] . "\n";
    }
} else {
    echo "No se encontraron ingredientes en la base de datos.";
}

// Cerrar la conexión a la base de datos
$conn->close();

// Encabezados y salida del archivo XLS
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment; filename="reporte_ingredientes.xls"');
echo $file_content;


?>