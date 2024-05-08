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
$select = "SELECT * FROM abonos ORDER BY id desc";
$query = mysqli_query($con, $select) or die(mysqli_error($con));

// Set the page format
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(10, 10, 10);


$pdf->SetAutoPageBreak(true, 10);

$pdf->AddPage();

// Add content to the PDF
$pdf->SetFont('Times', '', 20);
$pdf->Cell(0, 10, 'Lista de abonos ', 0, 1, 'C');
$pdf->Ln(10);
$pdf->SetFont('Times', '', 10);
$tableWidth = $pdf->GetPageWidth() - $pdf->getMargins()['left'] - $pdf->getMargins()['right'];

// Adjust the column widths based on the available width
$cellWidths = [
    0.15 * $tableWidth, // Adjust the percentage as needed
    0.40 * $tableWidth, // Adjust the percentage as needed
    0.15 * $tableWidth,  // Adjust the percentage as needed
    0.1 * $tableWidth,  // Adjust the percentage as needed
    0.2 * $tableWidth   // Adjust the percentage as needed
];

// Add the table header with adjusted column widths
$pdf->Cell($cellWidths[0], 10, 'Cuenta', 1);
$pdf->Cell($cellWidths[1], 10, 'Cliente', 1);
$pdf->Cell($cellWidths[2], 10, 'Fecha', 1);
$pdf->Cell($cellWidths[3], 10, 'Abono', 1);
$pdf->Cell($cellWidths[4], 10, 'Num Recibo', 1);

$pdf->Ln();

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $cuenta = $row['cuenta'];
        $client = $row['client'];
        $fecha=$row['fechab'];
        $abono=$row['abono'];
        $numre=$row['NoRec'];
        // Add data to the table
        $pdf->Cell($cellWidths[0], 10, $cuenta, 1);
        $pdf->Cell($cellWidths[1], 10, $client, 1);
        $pdf->Cell($cellWidths[2], 10, $fecha, 1);
        $pdf->Cell($cellWidths[3], 10, $abono, 1);
        $pdf->Cell($cellWidths[4], 10, $numre, 1);

               
        $pdf->Ln();
    }
}


else {
    $pdf->Cell(80, 10, 'No data found', 1);
}
// Save the PDF to a file
$pdf->Output('Reporte de abonos .pdf', 'D');
header('location:../Reportes.php');

