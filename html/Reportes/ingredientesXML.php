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

// Consulta a la base de datos
$sql = "SELECT ID_INGREDIENTE, NOMBRE_INGREDIENTE, CANTIDAD, UNIDAD_MEDIDA, COSTO FROM INGREDIENTE";
$result = $conn->query($sql);

// Crear un nuevo objeto SimpleXMLElement
$xml = new SimpleXMLElement('<ingredientes/>');

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $ingrediente = $xml->addChild('ingrediente');
        $ingrediente->addChild('ID_INGREDIENTE', $row["ID_INGREDIENTE"]);
        $ingrediente->addChild('NOMBRE_INGREDIENTE', $row["NOMBRE_INGREDIENTE"]);
        $ingrediente->addChild('CANTIDAD', $row["CANTIDAD"]);
        $ingrediente->addChild('UNIDAD_MEDIDA', $row["UNIDAD_MEDIDA"]);
        $ingrediente->addChild('COSTO', $row["COSTO"]);
    }
} else {
    echo "No se encontraron ingredientes en la base de datos.";
}

// Cerrar la conexión a la base de datos
$conn->close();

// Encabezado y salida del archivo XML
Header('Content-type: text/xml');
echo $xml->asXML();


?>