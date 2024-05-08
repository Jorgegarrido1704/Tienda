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
$pdf->Cell(0, 10, 'Inventario', 0, 1, 'C');
$pdf->Ln(10);
$pdf->SetFont('Times', '', 9);
$pdf->Cell(110, 10, 'Producto', 1);
$pdf->Cell(14, 10, 'contado', 1);
$pdf->Cell(12, 10, 'mes1', 1);
$pdf->Cell(12, 10, 'mes2', 1);
$pdf->Cell(12, 10, 'mes3', 1);
$pdf->Cell(12, 10, 'mes4', 1);
$pdf->Cell(12, 10, 'mes5', 1);
$pdf->Cell(12, 10, 'mes6', 1);
$pdf->Cell(12, 10, 'mes7', 1);
$pdf->Cell(12, 10, 'mes8', 1);
$pdf->Cell(12, 10, 'mes9', 1);
$pdf->Cell(12, 10, 'mes10', 1);
$pdf->Cell(12, 10, 'mes11', 1);
$pdf->Cell(12, 10, 'mes12', 1);
/*
$pdf->Cell(80, 10, '-', 1);
$pdf->Cell(10, 10, '-', 1);
$pdf->Cell(12, 10, 'sem1', 1);
$pdf->Cell(12, 10, 'sem2', 1);
$pdf->Cell(12, 10, 'sem3', 1);
$pdf->Cell(12, 10, 'sem4', 1);
$pdf->Cell(12, 10, 'sem5', 1);
$pdf->Cell(12, 10, 'sem6', 1);
$pdf->Cell(12, 10, 'sem7', 1);
$pdf->Cell(12, 10, 'sem8', 1);
$pdf->Cell(12, 10, 'sem9', 1);
$pdf->Cell(12, 10, 'sem10', 1);
$pdf->Cell(12, 10, 'sem11', 1);
$pdf->Cell(12, 10, 'sem12', 1);
*/
$pdf->Ln();

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $prod=$row['product'];
        $qty=$row['qty'];
        $contado=$row['CONTADO'];
        $mes1=$row['precio1'];
        $mes2=$row['precio2'];
        $mes3=$row['precio3'];
        $mes4=$row['precio4'];
        $mes5=$row['precio5'];
        $mes6=$row['precio6'];
        $mes7=$row['precio7'];
        $mes8=$row['precio8'];
        $mes9=$row['precio9'];
        $mes10=$row['precio10'];
        $mes11=$row['precio11'];
        $mes12=$row['precio12'];
        $sem1=$row['semanal1'];
        $sem2=$row['semanal2'];
        $sem3=$row['semanal3'];
        $sem4=$row['semanal4'];
        $sem5=$row['semanal5'];
        $sem6=$row['semanal6'];
        $sem7=$row['semanal7'];
        $sem8=$row['semanal8'];
        $sem9=$row['semanal9'];
        $sem10=$row['semanal10'];
        $sem11=$row['semanal11'];
        $sem12=$row['semanal2'];

      
        // Add data to the table
        $pdf->Cell(110, 10, $prod, 1);
       // $pdf->Cell(10, 10, $qty, 1);
        $pdf->Cell(14, 10, $contado, 1);
        $pdf->Cell(12, 10, $mes1, 1);
        $pdf->Cell(12, 10, $mes2, 1);
        $pdf->Cell(12, 10, $mes3, 1);
        $pdf->Cell(12, 10, $mes4, 1);
        $pdf->Cell(12, 10, $mes5, 1);
        $pdf->Cell(12, 10, $mes6, 1);
        $pdf->Cell(12, 10, $mes7, 1);
        $pdf->Cell(12, 10, $mes8, 1);
        $pdf->Cell(12, 10, $mes9, 1);
        $pdf->Cell(12, 10, $mes10, 1);
        $pdf->Cell(12, 10, $mes11, 1);
        $pdf->Cell(12, 10, $mes12, 1);
        $pdf->Ln();
        $pdf->Cell(110, 10, '-', 1);
        $pdf->Cell(14, 10, '-', 1);
        $pdf->Cell(12, 10, $sem1, 1);
        $pdf->Cell(12, 10, $sem2, 1);
        $pdf->Cell(12, 10, $sem3, 1);
        $pdf->Cell(12, 10, $sem4, 1);
        $pdf->Cell(12, 10, $sem5, 1);
        $pdf->Cell(12, 10, $sem6, 1);
        $pdf->Cell(12, 10, $sem7, 1);
        $pdf->Cell(12, 10, $sem8, 1);
        $pdf->Cell(12, 10, $sem9, 1);
        $pdf->Cell(12, 10, $sem10, 1);
        $pdf->Cell(12, 10, $sem11, 1);
        $pdf->Cell(12, 10, $sem12, 1);
       
        $pdf->Ln();
        $pdf->Ln();
    }
}


else {
    $pdf->Cell(80, 10, 'No data found', 1);
}
// Save the PDF to a file
$pdf->Output('Reporte de Inventario .pdf', 'D');
header('location:../Reportes.php');
