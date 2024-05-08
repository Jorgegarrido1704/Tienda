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
$select = "SELECT * FROM inventario ORDER BY id ASC";
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
$pdf->SetFont('Times', '', 12);
$pdf->Cell(140, 10, 'Producto', 1);

$pdf->Cell(30, 10, 'Entradas', 1);
$pdf->Cell(30, 10, 'Salidas', 1);
$pdf->Cell(30, 10, 'Total', 1);

$pdf->Ln();

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $prod=$row['product'];
        $qty=$row['qty'];
        $tent=0;
$tsal=0;
       $buscare=mysqli_query($con,"SELECT * FROM ensal WHERE producto='$prod' and concepto LIKE 'Entrada%%'");
        while($rowent=mysqli_fetch_array($buscare)){
            $cantE=$rowent['cantidad'];
            $tent=$tent+$cantE;
        }
        $buscare=mysqli_query($con,"SELECT * FROM ensal WHERE producto='$prod' and concepto LIKE 'Salida%%'");
        while($rowsal=mysqli_fetch_array($buscare)){
            $cantE=$rowsal['cantidad'];
            $tsal=$tsal+$cantE;
        }
      
        // Add data to the table
        $pdf->Cell(140, 10, $prod, 1);
        
        $pdf->Cell(30, 10, $tent, 1);
        $pdf->Cell(30, 10, $tsal, 1);
        $pdf->Cell(30, 10, $qty, 1);
        $pdf->Ln();
    }
}


else {
    $pdf->Cell(80, 10, 'No data found', 1);
}
// Save the PDF to a file
$pdf->Output('Reporte de existencias .pdf', 'D');
header('location:../Reportes.php');
