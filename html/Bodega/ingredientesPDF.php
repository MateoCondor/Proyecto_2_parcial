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
        $this->Cell(10, 10, 'ID', 1);
        $this->Cell(40, 10, 'Descripcion', 1);
        $this->Cell(20, 10, 'Cantidad', 1);
        $this->Cell(30, 10, 'Unidad', 1);
        $this->Cell(30, 10, 'Precio', 1);
        $this->Cell(45, 10, 'Fecha Ingreso', 1); // Agregada columna "Fecha Ingreso"
        $this->Cell(15, 10, 'Active', 1); // Agregada columna "Active"
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

$pdf = new PDF();
$pdf->AddPage();

include('../dbconnection.php');

if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}
$sql = "SELECT ID, Descripcion, Cantidad, Unidad, Precio, FechaIngreso, Active FROM tblingredientes";
$result = $con->query($sql);

$pdf->SetFont('Arial', '', 12);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(10, 10, $row["ID"], 1);
        $pdf->Cell(40, 10, $row["Descripcion"], 1);
        $pdf->Cell(20, 10, $row["Cantidad"], 1);
        $pdf->Cell(30, 10, $row["Unidad"], 1);
        $pdf->Cell(30, 10, $row["Precio"], 1);
        $pdf->Cell(45, 10, $row["FechaIngreso"], 1); // Agregada columna "Fecha Ingreso"
        $pdf->Cell(15, 10, $row["Active"], 1); // Agregada columna "Active"
        $pdf->Ln();
    }
} else {
    $pdf->Cell(250, 10, "No se encontraron ingredientes en la base de datos.", 1, 1, 'C');
}

$pdf->Output();



?>
