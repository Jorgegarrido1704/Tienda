<?php
require "../app/conection.php";
require "../vendor/autoload.php";

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Font;

date_default_timezone_set("America/Mexico_City");

// Helper function to execute queries safely
function fetchData($con, $query) {
    $result = mysqli_query($con, $query);
    if (!$result) {
        die("Error en la consulta: " . mysqli_error($con));
    }
    return $result;
}

// Helper function to set headers on each sheet
function setHeaders($sheet, $headers) {
    $col = 'A';
    foreach ($headers as $header) {
        $sheet->setCellValue($col . '1', $header);
        $sheet->getColumnDimension($col)->setAutoSize(true);
        $col++;
    }
    $sheet->getStyle('A1:' . chr(ord('A') + count($headers) - 1) . '1')->getFont()->setBold(true);
}

// Create main spreadsheet
$spreadsheet = new Spreadsheet();

// Sheet 1 - Historico
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Historico');
setHeaders($sheet, ['Fecha', 'Cliente', 'Cuenta', 'Total', 'Enganche', 'Saldo']);

$t = 2;
$data = fetchData($con, "SELECT * FROM historico");
while ($row = mysqli_fetch_assoc($data)) {
    $sheet->fromArray([
        $row['fecha'], $row['cliente'], $row['cuenta'], 
        $row['precio'], $row['enganche'], $row['saldo']
    ], NULL, 'A' . $t);
    $t++;
}

// Sheet 2 - Ventas Contado
$sheet1 = $spreadsheet->createSheet();
$sheet1->setTitle('Ventas Contado');
setHeaders($sheet1, ['Fecha', 'Cliente', 'Cuenta', 'Total', 'Enganche', 'Estatus']);

$t = 2;
$data = fetchData($con, "SELECT * FROM historico WHERE meses=0");
while ($row = mysqli_fetch_assoc($data)) {
    $sheet1->fromArray([
        $row['fecha'], $row['cliente'], $row['cuenta'], 
        $row['precio'], $row['enganche'], 'Contado'
    ], NULL, 'A' . $t);
    $t++;
}

// Sheet 3 - Ventas Articulos
$sheet2 = $spreadsheet->createSheet();
$sheet2->setTitle('Ventas Articulos');
setHeaders($sheet2, ['Fecha', 'Cliente', 'Cuenta', 'Articulo', 'Precio', 'Saldo']);

$t = 2;
$data = fetchData($con, "SELECT * FROM venta");
while ($row = mysqli_fetch_assoc($data)) {
    $sheet2->fromArray([
        $row['fecha'], $row['cliente'], $row['cuenta'], 
        $row['articulo'], $row['precio'], $row['saldo']
    ], NULL, 'A' . $t);
    $t++;
}

// Sheet 4 - Inventario
$sheet3 = $spreadsheet->createSheet();
$sheet3->setTitle('Existencias');
setHeaders($sheet3, ['Categoria', 'Producto', 'Cantidad']);

$t = 2;
$data = fetchData($con, "SELECT * FROM inventario");
while ($row = mysqli_fetch_assoc($data)) {
    $sheet3->fromArray([$row['category'], $row['product'], $row['qty']], NULL, 'A' . $t);
    $t++;
}

// Sheet 5 - Entradas y Salidas
$sheet4 = $spreadsheet->createSheet();
$sheet4->setTitle('Entradas y Salidas');
setHeaders($sheet4, ['Fecha', 'Producto', 'Cantidad', 'Concepto']);

$t = 2;
$data = fetchData($con, "SELECT * FROM ensal");
while ($row = mysqli_fetch_assoc($data)) {
    $sheet4->fromArray([
        $row['fecha'], $row['producto'], $row['cantidad'], $row['concepto']
    ], NULL, 'A' . $t);
    $t++;
}

// Sheet 6 - Cancelaciones
$sheet5 = $spreadsheet->createSheet();
$sheet5->setTitle('Cancelaciones');
setHeaders($sheet5, ['Fecha', 'Cuenta', 'Articulo', 'Motivo']);

$t = 2;
$data = fetchData($con, "SELECT * FROM cancelaciones");
while ($row = mysqli_fetch_assoc($data)) {
    $sheet5->fromArray([
        $row['fecha'], $row['cuenta'], $row['articulo'], $row['motivo']
    ], NULL, 'A' . $t);
    $t++;
}

// Sheet 7 - Bonificaciones
$sheet6 = $spreadsheet->createSheet();
$sheet6->setTitle('Bonificaciones');
setHeaders($sheet6, ['Fecha', 'Cuenta', 'Articulo', 'Precio Compra', 'Precio Bonif', 'Bonificación']);

$t = 2;
$data = fetchData($con, "SELECT * FROM bonif");
while ($row = mysqli_fetch_assoc($data)) {
    $sheet6->fromArray([
        $row['fecha'], $row['cuenta'], $row['art'], 
        $row['precioAnt'], $row['PrecioBon'], $row['ahorro']
    ], NULL, 'A' . $t);
    $t++;
}

// Sheet 8 - Abonos
$sheet7 = $spreadsheet->createSheet();
$sheet7->setTitle('Abonos');
setHeaders($sheet7, ['Fecha', 'Cliente', 'Cuenta', 'Abono', 'No. Recibo']);

$t = 2;
$data = fetchData($con, "SELECT * FROM abonos");
while ($row = mysqli_fetch_assoc($data)) {
    $sheet7->fromArray([
        $row['fechab'], $row['client'], $row['cuenta'], 
        $row['abono'], $row['NoRec']
    ], NULL, 'A' . $t);
    $t++;
}

// Sheet 9 - Clientes
$sheet8 = $spreadsheet->createSheet();
$sheet8->setTitle('Clientes');
setHeaders($sheet8, [
    'Cliente', 'Domicilio', 'Colonia', 'Pariente', 'Aval',
    'Domicilio Aval', 'Referencia 1', 'Dom. Ref 1', 'Referencia 2', 'Dom. Ref 2'
]);

$t = 2;
$data = fetchData($con, "SELECT DISTINCT * FROM historico");
while ($row = mysqli_fetch_assoc($data)) {
    $sheet8->fromArray([
        $row['cliente'], $row['domcli'], $row['col'], $row['espo'], 
        $row['aval'], $row['domaval'], $row['ref1'], 
        $row['domref1'], $row['ref2'], $row['domre2']
    ], NULL, 'A' . $t);
    $t++;
}

//  Dynamic Sheets for rutas, promotores, vendedores
function createDynamicSheets($spreadsheet, $con, $query, $titlePrefix, $filterField) {
    $routes = fetchData($con, $query);
    while ($row = mysqli_fetch_assoc($routes)) {
        $filter = $row[$filterField];
        if (empty($filter)) continue;

        $nameParts = explode(" ", $filter);
        $name = ucfirst($titlePrefix) . ' ' . $nameParts[0];

        $sheet = $spreadsheet->createSheet();
        $sheet->setTitle(substr($name, 0, 30)); // max Excel title length
        setHeaders($sheet, [
            'Cantidad', 'Articulo', 'Precio', 'Enganche', 'Mensualidades',
            'Pago semanal', 'Cliente', 'Cuenta', 'Fecha compra'
        ]);

        $t = 2;
        $sales = fetchData($con, "SELECT * FROM venta WHERE $filterField='$filter'");
        while ($data = mysqli_fetch_assoc($sales)) {
            $sheet->fromArray([
                1, $data['articulo'], $data['precio'], $data['enganche'], 
                $data['meses'], $data['semanal'], $data['cliente'], 
                $data['cuenta'], $data['fecha']
            ], NULL, 'A' . $t);
            $t++;
        }
    }
}

createDynamicSheets($spreadsheet, $con, "SELECT DISTINCT ruta FROM venta", "Ruta", "ruta");
createDynamicSheets($spreadsheet, $con, "SELECT DISTINCT promotor FROM venta WHERE promotor!=''", "Prom.", "promotor");
createDynamicSheets($spreadsheet, $con, "SELECT DISTINCT vendedor FROM venta WHERE vendedor!=''", "Vend.", "vendedor");

//  Output Excel
$week = date('W');
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="Reporte_General_Semana_' . $week . '.xlsx"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;
?>