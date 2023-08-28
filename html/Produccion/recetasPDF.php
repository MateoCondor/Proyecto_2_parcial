<?php 
require('../../fpdf/fpdf.php');

class PDF extends FPDF
{
    function Header()
    {
        // Encabezado
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(190, 10, 'Reporte de Recetas', 0, 1, 'C');
        $this->Ln(10);

        // Encabezados de la tabla
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(20, 10, 'Codigo', 1);
        $this->Cell(60, 10, 'Nombre de la Receta', 1);
        $this->Cell(30, 10, 'Precio', 1);
        $this->Cell(40, 10, utf8_decode('Fecha de Creación'), 1);
        $this->Cell(30, 10, 'Activo', 1);
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
$pdf->SetFont('Arial', '', 12);

include('../dbconnection.php');

if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}
$sql = "SELECT Codigo, NombreReceta, PrecioReceta, FechaCreacion, Active FROM datos_receta";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $pdf->Cell(20, 10, $row["Codigo"], 1);
        $pdf->Cell(60, 10, utf8_decode($row["NombreReceta"]), 1); // Agregar utf8_decode para los caracteres especiales
        $pdf->Cell(30, 10, $row["PrecioReceta"] . ' $', 1);
        $pdf->Cell(40, 10, $row["FechaCreacion"], 1);
        $pdf->Cell(30, 10, $row["Active"] == 1 ? 'Activo' : 'Inactivo', 1);
        $pdf->Ln();
    }
} else {
    $pdf->Cell(180, 10, "No hay recetas en la base de datos.", 1, 1, 'C');
}

$pdf->Output();
?>




