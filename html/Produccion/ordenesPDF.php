<?php
require('../../fpdf/fpdf.php'); // Incluir la librería FPDF

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(190, 10, utf8_decode('Reporte de Órdenes de Producción'), 0, 1, 'C');
        $this->Ln(10);

        $this->SetFont('Arial', 'B', 12);
        $this->Cell(20, 10, 'Orden', 1);
        $this->Cell(45, 10, utf8_decode('Fecha de Generación'), 1);
        $this->Cell(40, 10, 'Nombre de la Pizza', 1);
        $this->Cell(30, 10, 'Cantidad', 1);
        $this->Cell(30, 10, 'Total Pizza', 1);
        $this->Cell(30, 10, 'Precio Orden', 1);
        $this->Ln();
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();

include('../dbconnection.php');

if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}

$sql = "SELECT NumeroOrden, FechaGeneracion, NombrePizza, Cantidad_Pizza, Total_Pizza, Precio_Orden FROM orden_prod";
$result = $con->query($sql);

$pdf->SetFont('Arial', '', 12);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(20, 10, $row["NumeroOrden"], 1);
        $pdf->Cell(45, 10, $row["FechaGeneracion"], 1);
        $pdf->Cell(40, 10, utf8_decode($row["NombrePizza"]), 1); // Agregar utf8_decode para caracteres especiales
        $pdf->Cell(30, 10, $row["Cantidad_Pizza"], 1);
        $pdf->Cell(30, 10, $row["Total_Pizza"], 1);
        $pdf->Cell(30, 10, $row["Precio_Orden"], 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(250, 10, "No se encontraron órdenes en la base de datos.", 1, 1, 'C');
}

$pdf->Output();
?>
