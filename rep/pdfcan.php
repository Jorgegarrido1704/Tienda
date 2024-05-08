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
$select = "SELECT * FROM cancelaciones ORDER BY id desc";
$query = mysqli_query($con, $select) or die(mysqli_error($con));

// Set the page format
$pdf->setPrintHeader(false);
$pdf->setPrintFooter(false);
$pdf->SetMargins(10, 10, 10);


$pdf->SetAutoPageBreak(true, 10);

$pdf->AddPage();

// Add content to the PDF
$pdf->SetFont('Times', '', 20);
$pdf->Cell(0, 10, 'Cancelaciones ', 0, 1, 'C');
$pdf->Ln(10);
$pdf->SetFont('Times', '', 10);
$tableWidth = $pdf->GetPageWidth() - $pdf->getMargins()['left'] - $pdf->getMargins()['right'];

// Adjust the percentage values for each column based on your preference
$percentageWidths = [
    0.1, // Adjust the percentage as needed
    0.4, // Adjust the percentage as needed
    0.1, // Adjust the percentage as needed
    0.4  // Adjust the percentage as needed
];

// Calculate the actual width for each column
$cellWidths = array_map(function ($percentage) use ($tableWidth) {
    return $percentage * $tableWidth;
}, $percentageWidths);

// Add the table header with adjusted column widths
$pdf->Cell($cellWidths[0], 10, 'Fecha', 1);
$pdf->Cell($cellWidths[1], 10, 'Articulo', 1);
$pdf->Cell($cellWidths[2], 10, 'Cuenta', 1);
$pdf->Cell($cellWidths[3], 10, 'Motivo', 1);
$pdf->Ln();

$pdf->Ln();

if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
      
        $tipo=$row['fecha'];
        $pn=$row['cuenta'];
        $rev1=$row['articulo'];
        $rev2 = $row['motivo'];
      
      
        // Add data to the table
       
        $pdf->Cell($cellWidths[0], 10, $tipo, 1);
        $pdf->Cell($cellWidths[1], 10, $rev1, 1);
        $pdf->Cell($cellWidths[2], 10, $pn, 1);
        $pdf->Cell($cellWidths[3], 10, $rev2, 1);
       
        $pdf->Ln();
    }
}


else {
    $pdf->Cell(80, 10, 'No data found', 1);
}
// Save the PDF to a file
$pdf->Output('Reporte de cancelacion .pdf', 'D');
header('location:../Reportes.php');
?>
