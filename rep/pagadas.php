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
$select = "SELECT * FROM historico WHERE nulo='' ORDER BY id desc";
$query = mysqli_query($con, $select) or die(mysqli_error($con));

// Set the page format
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(10, 10, 10);


$pdf->SetAutoPageBreak(true, 10);

$pdf->AddPage();

// Add content to the PDF
$pdf->SetFont('Times', '', 20);
$pdf->Cell(0, 10, 'Ventas pagadas ', 0, 1, 'C');
$pdf->Ln(10);
$pdf->SetFont('Times', '', 8);
$pdf->Cell(20, 10, 'Folio de venta', 1);
$pdf->Cell(20, 10, 'Fecha de venta', 1);
$pdf->Cell(80, 10, 'Cliente', 1);
$pdf->Cell(20, 10, 'Cuenta', 1);
$pdf->Cell(110, 10, 'Articulo', 1);
$pdf->Cell(20, 10, 'Precio', 1);

$pdf->Ln();
if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $id = $row['id'];
        $client = $row['cliente'];
        $tipo=$row['fecha'];
        $pn=$row['cuenta'];
        $rev1=$row['articulo'];
        $rev2 = $row['precio'];
        
        $nulo=$row['nulo'];
      
        // Add data to the table
        $pdf->Cell(20, 10, $id, 1);
        $pdf->Cell(20, 10, $tipo, 1);
        $pdf->Cell(80, 10, $client, 1);
        $pdf->Cell(20, 10, $pn, 1);
        $pdf->Cell(110, 10, $rev1, 1);
        $pdf->Cell(20, 10, $rev2, 1);
       
       
       
        $pdf->Ln();
    }
}


else {
    $pdf->Cell(80, 10, 'No data found', 1);
}
// Save the PDF to a file
$pdf->Output('Reporte de ventas pagadas.pdf', 'D');
header('location:../Reportes.php');
?>
