<?php
require "../app/conection.php";
require '../vendor/autoload.php';
date_default_timezone_set("America/Mexico_City");
$yesterday=strtotime(date('d-m-Y',strtotime('-1 week')));
$date=strtotime(date("d-m-Y"));
$last=$date-$yesterday;



$cuenta=isset($_GET['cuenta'])?$_GET['cuenta']:"";
   
$week=round($date);
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;





$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1','Fecha de compra' );
$sheet->setCellValue('B1', 'Cliente');
$sheet->setCellValue('C1', 'Numero de Cuenta');
$sheet->setCellValue('D1', 'Articulos');
$sheet->setCellValue('E1', 'Total');
$sheet->setCellValue('F1', 'Enganche');
$sheet->setCellValue('G1', 'Saldo');


$t=2;

$buscarventa=mysqli_query($con,"SELECT * FROM  historico WHERE cuenta='$cuenta'");
While($row=mysqli_fetch_array($buscarventa)){
    $fecha=$row['fecha'];
    $cliente=$row['cliente'];
    $cuenta=$row['cuenta'];
    $art=$row['articulo'];
    $total=$row['precio'];
    $enganche=$row['enganche'];
    $saldo=$row['saldo'];
      
    $sheet->setCellValue('A'.$t, $fecha );
    $sheet->setCellValue('B'.$t, $cliente );
    $sheet->setCellValue('C'.$t, $cuenta );
    $sheet->setCellValue('D'.$t, $art );
    $sheet->setCellValue('E'.$t, $total );
    $sheet->setCellValue('F'.$t, $enganche );
    $sheet->setCellValue('G'.$t, $saldo );
   
    $t++;
    }
   $t=$t+2;
    $sheet->setCellValue('A'.$t,'Fecha de abono' );
    $sheet->setCellValue('B'.$t, 'Cantidad de abono');
    $sheet->setCellValue('C'.$t, 'Numero de recibo');
$t++;

$i=0;
$fechas=[];
$buscarFecha=mysqli_query($con,"SELECT fechab FROM abonos WHERE cuenta='$cuenta' ");
while($rowfecha=mysqli_fetch_array($buscarFecha)){
    $fechas[$i]=strtotime($rowfecha['fechab']);
    $i++;
}    
sort($fechas);
for($i=0;$i<count($fechas);$i++){
    $datesab=date("d-m-Y",$fechas[$i]);
    $buscarventa=mysqli_query($con,"SELECT * FROM  abonos WHERE  cuenta='$cuenta' and fechab='$datesab'");
    While($row=mysqli_fetch_array($buscarventa)){
        $fecha=$row['fechab'];
        $cliente=$row['abono'];
        $cuenta=$row['NoRec'];
          
        $sheet->setCellValue('A'.$t, $fecha );
        $sheet->setCellValue('B'.$t, $cliente );
        $sheet->setCellValue('C'.$t, $cuenta );
        $t++;
    }}

$week = date('W');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte General  cuenta: ' . $cuenta . '.xlsx"');
header('Cache-Control: max-age=0');
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit();


