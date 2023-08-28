<?php

require('fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        // Encabezado
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(190, 10, 'Reporte de Ingredientes', 0, 1, 'C');
        $this->Ln(10);

        // Encabezados de la tabla
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(20, 10, 'ID', 1);
        $this->Cell(50, 10, 'NombreIngrediente', 1);
        $this->Cell(30, 10, 'Cantidad', 1);
        $this->Cell(40, 10, 'Unidad_Medida', 1);
        $this->Cell(40, 10, 'Costo', 1);
        $this->Ln();
    }

    function Footer()
    {
        // Pie de página
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}
// Crear PDF
$pdf = new PDF();
$pdf->AddPage();

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

// Rellenar tabla con los datos de la base de datos
$pdf->SetFont('Arial', '', 12);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(20, 10, $row["ID_INGREDIENTE"], 1);
        $pdf->Cell(50, 10, $row["NOMBRE_INGREDIENTE"], 1);
        $pdf->Cell(30, 10, $row["CANTIDAD"], 1);
        $pdf->Cell(40, 10, $row["UNIDAD_MEDIDA"], 1);
        $pdf->Cell(40, 10, $row["COSTO"], 1);
        $pdf->Ln();
    }
} else {
    echo "No se encontraron ingredientes en la base de datos.";
}

// Cerrar la conexión a la base de datos
$conn->close();

// Generar el PDF
$pdf->Output();


?>
