<?php
require "../app/conection.php";
require '../vendor/autoload.php';
date_default_timezone_set("America/Mexico_City");
$yesterday=strtotime(date('d-m-Y',strtotime('-1 week')));
$date=strtotime(date("d-m-Y"));
$last=$date-$yesterday;



//echo $lw.'--'.$date.'<br>';
   
$week=round($date);
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;





$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();

$sheet->setCellValue('A1','Fecha' );
$sheet->setCellValue('B1', 'Cliente');
$sheet->setCellValue('C1', 'Cuenta');
$sheet->setCellValue('D1', 'Total');
$sheet->setCellValue('E1', 'Enganche');
$sheet->setCellValue('F1', 'Saldo');


$t=2;

$buscarventa=mysqli_query($con,"SELECT * FROM  historico");
While($row=mysqli_fetch_array($buscarventa)){
    $fecha=$row['fecha'];
    $cliente=$row['cliente'];
    $cuenta=$row['cuenta'];
    $total=$row['precio'];
    $enganche=$row['enganche'];
    $saldo=$row['saldo'];
      
    $sheet->setCellValue('A'.$t, $fecha );
    $sheet->setCellValue('B'.$t, $cliente );
    $sheet->setCellValue('C'.$t, $cuenta );
    $sheet->setCellValue('D'.$t, $total );
    $sheet->setCellValue('E'.$t, $enganche );
    $sheet->setCellValue('F'.$t, $saldo );
   
    
  
    $t++;
    }

    $sheet2 = $spreadsheet->createSheet();
    $sheet2->setTitle('Ventas-Articulos');
    $sheet2->setCellValue('A1','Fecha' );
    $sheet2->setCellValue('B1', 'Cliente');
    $sheet2->setCellValue('C1', 'Cuenta');
    $sheet2->setCellValue('D1', 'Articulo');
    $sheet2->setCellValue('E1', 'precio');
    $sheet2->setCellValue('F1', 'Saldo');
    
    
    $t=2;
    
    $buscarventa=mysqli_query($con,"SELECT * FROM  venta");
    While($row=mysqli_fetch_array($buscarventa)){
        $fecha=$row['fecha'];
        $cliente=$row['cliente'];
        $cuenta=$row['cuenta'];
        $total=$row['articulo'];
        $enganche=$row['precio'];
        $saldo=$row['saldo'];
          
        $sheet2->setCellValue('A'.$t, $fecha );
        $sheet2->setCellValue('B'.$t, $cliente );
        $sheet2->setCellValue('C'.$t, $cuenta );
        $sheet2->setCellValue('D'.$t, $total );
        $sheet2->setCellValue('E'.$t, $enganche );
        $sheet2->setCellValue('F'.$t, $saldo );
        $t++;
    }
    $sheet3 = $spreadsheet->createSheet();
    $sheet3->setTitle('Existencias');
    $sheet3->setCellValue('A1','Categoria' );
    $sheet3->setCellValue('B1', 'Producto');
    $sheet3->setCellValue('C1', 'Cantidad');
   
    
    
    $t=2;
    
    $buscarventa=mysqli_query($con,"SELECT * FROM  inventario");
    While($row=mysqli_fetch_array($buscarventa)){
        $fecha=$row['category'];
        $cliente=$row['product'];
        $cuenta=$row['qty'];
      
          
        $sheet3->setCellValue('A'.$t, $fecha );
        $sheet3->setCellValue('B'.$t, $cliente );
        $sheet3->setCellValue('C'.$t, $cuenta );
      
        $t++;
    }
    $sheet4 = $spreadsheet->createSheet();
    $sheet4->setTitle('ENtradas - Salidad ');
    $sheet4->setCellValue('A1','Fecha' );
    $sheet4->setCellValue('B1', 'Producto');
    $sheet4->setCellValue('C1', 'Cantidad');
    $sheet4->setCellValue('D1', 'Concepto');  
     $t=2;
    $buscarventa=mysqli_query($con,"SELECT * FROM  ensal");
    While($row=mysqli_fetch_array($buscarventa)){
        $fecha=$row['fecha'];
        $cliente=$row['producto'];
        $cuenta=$row['cantidad'];
        $total=$row['concepto'];
        $sheet4->setCellValue('A'.$t, $fecha );
        $sheet4->setCellValue('B'.$t, $cliente );
        $sheet4->setCellValue('C'.$t, $cuenta );
        $sheet4->setCellValue('D'.$t, $total );
        $t++;
    }
    $sheet5 = $spreadsheet->createSheet();
    $sheet5->setTitle('Cancelaciones');
    $sheet5->setCellValue('A1','Fecha' );
    $sheet5->setCellValue('B1', 'cuenta');
    $sheet5->setCellValue('C1', 'articulo');
    $sheet5->setCellValue('D1', 'motivo');
    $t=2;
    $buscarventa=mysqli_query($con,"SELECT * FROM  cancelaciones");
    While($row=mysqli_fetch_array($buscarventa)){
        $fecha=$row['fecha'];
        $cliente=$row['cuenta'];
        $cuenta=$row['articulo'];
        $total=$row['motivo'];          
        $sheet5->setCellValue('A'.$t, $fecha );
        $sheet5->setCellValue('B'.$t, $cliente );
        $sheet5->setCellValue('C'.$t, $cuenta );
        $sheet5->setCellValue('D'.$t, $total );
        $t++;
    }
    $sheet6 = $spreadsheet->createSheet();
    $sheet6->setTitle('Bonificaciones');
    $sheet6->setCellValue('A1','Fecha' );
    $sheet6->setCellValue('B1', 'cuenta');
    $sheet6->setCellValue('C1', 'Articulo');
    $sheet6->setCellValue('D1', 'precio compra');
    $sheet6->setCellValue('E1', 'precio Bonificacion');
    $sheet6->setCellValue('F1', 'Bonificacion');
    $t=2;
    $buscarventa=mysqli_query($con,"SELECT * FROM  bonif");
    While($row=mysqli_fetch_array($buscarventa)){
        $fecha=$row['fecha'];
        $cliente=$row['cuenta'];
        $cuenta=$row['art'];
        $total=$row['precioAnt'];
        $enganche=$row['PrecioBon'];
        $saldo=$row['ahorro'];
        $sheet6->setCellValue('A'.$t, $fecha );
        $sheet6->setCellValue('B'.$t, $cliente );
        $sheet6->setCellValue('C'.$t, $cuenta );
        $sheet6->setCellValue('D'.$t, $total );
        $sheet6->setCellValue('E'.$t, $enganche );
        $sheet6->setCellValue('F'.$t, $saldo );
        $t++;
    }
    $sheet7 = $spreadsheet->createSheet();
    $sheet7->setTitle('Abonos');
    $sheet7->setCellValue('A1','Fecha' );
    $sheet7->setCellValue('B1', 'Cliente');
    $sheet7->setCellValue('C1', 'Cuenta');
    $sheet7->setCellValue('D1', 'Abono');
    $sheet7->setCellValue('E1', 'No. Recibo');
    $t=2;
    $buscarventa=mysqli_query($con,"SELECT * FROM  abonos");
    While($row=mysqli_fetch_array($buscarventa)){
        $fecha=$row['fechab'];
        $cliente=$row['client'];
        $cuenta=$row['cuenta'];
        $total=$row['abono'];
        $enganche=$row['NoRec'];          
        $sheet7->setCellValue('A'.$t, $fecha );
        $sheet7->setCellValue('B'.$t, $cliente );
        $sheet7->setCellValue('C'.$t, $cuenta );
        $sheet7->setCellValue('D'.$t, $total );
        $sheet7->setCellValue('E'.$t, $enganche );
        
        $t++;
    }


$week = date('W');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte General  WEEK: ' . $week . '.xlsx"');
header('Cache-Control: max-age=0');
$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit();

