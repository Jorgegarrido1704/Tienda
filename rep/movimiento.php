<?php
// Include the Composer autoloader
require 'vendor/autoload.php';
require '../app/conection.php';
// Check the connection
if (mysqli_connect_errno()) {
    die("Failed to connect to MySQL: " . mysqli_connect_error());
}

// Create a new TCPDF instance
$pdf = new TCPDF('L', 'mm', 'A4');
$select = "SELECT * FROM ensal ORDER BY id DESC";
$query = mysqli_query($con, $select) or die(mysqli_error($con));

// Set the page format
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(10, 10, 10);


$pdf->SetAutoPageBreak(true, 10);

$pdf->AddPage();

// Add content to the PDF
$pdf->SetFont('Times', '', 20);
$pdf->Cell(0, 10, 'Inventario de existencias', 0, 1, 'C');
$pdf->Ln(10);
$pdf->SetFont('Times', '', 11);
$pdf->Cell(35, 10, 'Fecha', 1);
$pdf->Cell(150, 10, 'Producto', 1);
$pdf->Cell(20, 10, 'Cantidad', 1);
$pdf->Cell(80, 10, 'Concepto', 1);

$pdf->Ln();

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $prod=$row['producto'];
        $qty=$row['cantidad'];
        $fecha=$row['fecha'];
        $cons=$row['concepto'];
        
        $pdf->Cell(35, 10, $fecha, 1);
        $pdf->Cell(150, 10, $prod, 1);
        $pdf->Cell(20, 10, $qty, 1);
        $pdf->Cell(80, 10, $cons, 1);
        $pdf->Ln();
    }
}


else {
    $pdf->Cell(80, 10, 'No data found', 1);
}
// Save the PDF to a file
$pdf->Output('Reporte de movimientos .pdf', 'D');
header('location:../Reportes.php');
