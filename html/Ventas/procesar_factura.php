<?php
session_start();
include('../dbconnection.php'); // Asegúrate de incluir el archivo de conexión a la base de datos

 if (!isset($_SESSION["user_role"]) || !isset($_SESSION["ventas_login"])) {
     header("Location: ../login.php"); // Redirigir si no hay inicio de sesión
 }

 if ($_SESSION["user_role"] !== "ventas") {
     header("Location: ../login.php"); // Redirigir si el rol no es admin
}


require('../../fpdf/fpdf.php');


header('Content-Type: text/html; charset=utf-8');

class PDF extends FPDF
{
    function Header()
    {
        $this->SetFont('Arial', 'B', 16);
        $this->Cell(190, 10, 'Factura', 0, 1, 'C');
        $this->Ln(10);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los valores del formulario
    $recetaCodigo = $_POST["receta"];
    $cantidad = $_POST["cantidad"];
    $cedula = $_POST["cedula"];
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $celular = $_POST["celular"];
    $direccion = $_POST["direccion"];
    $correo = $_POST["correo"];

    // Conectar a la base de datos y obtener los detalles de la receta
    include('../dbconnection.php');

    $query = "SELECT NombreReceta, PrecioReceta FROM datos_receta WHERE Codigo = ?";
    $stmt = $con->prepare($query);
    $stmt->bind_param("i", $recetaCodigo);
    $stmt->execute();
    $stmt->bind_result($nombreReceta, $precioReceta);
    $stmt->fetch();
    $stmt->close();

    // Calcular el precio total
    $precioTotal = $precioReceta * $cantidad;

    // Crear un nuevo PDF
    $pdf = new PDF();
    $pdf->AddPage();

    // Encabezado de la factura
    $pdf->SetFont('Arial', 'B', 14);
    $pdf->Cell(0, 10, 'Factura de Compra', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, 'Fecha: ' . date('d/m/Y'), 0, 1, 'R');

    // Datos del cliente
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(40, 10, 'Cliente:', 0);
    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(0, 10, utf8_decode($nombre . ' ' . $apellido), 0, 1);
    $pdf->Cell(40, 10, 'Cedula:', 0);
    $pdf->Cell(0, 10, utf8_decode($cedula), 0, 1);
    $pdf->Cell(40, 10, utf8_decode('Dirección:'), 0);
    $pdf->Cell(0, 10, utf8_decode($direccion), 0, 1);
    $pdf->Cell(40, 10, 'Celular:', 0);
    $pdf->Cell(0, 10, utf8_decode($celular), 0, 1);
    $pdf->Cell(40, 10, 'Correo:', 0);
    $pdf->Cell(0, 10, utf8_decode($correo), 0, 1);

    // ...

    // Detalles de la compra (en forma de tabla)
    $pdf->Ln(10);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(60, 10, 'Receta', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Cantidad', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Precio Unitario', 1, 0, 'C');
    $pdf->Cell(40, 10, 'Precio Total', 1, 1, 'C');

    $pdf->SetFont('Arial', '', 12);
    $pdf->Cell(60, 10, utf8_decode($nombreReceta), 1);
    $pdf->Cell(40, 10, utf8_decode($cantidad), 1);
    $pdf->Cell(40, 10, utf8_decode('$' . $precioReceta), 1);
    $pdf->Cell(40, 10, utf8_decode('$' . $precioTotal), 1);

    // Generar el PDF
    $pdf->Output();
} else {
    echo "Acceso inválido.";
}
?>
