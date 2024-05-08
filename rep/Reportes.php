

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reportes</title>
    <style>
    body{
        width: 100%;
        background-color: blanchedalmond;
    }
.title{
    font-size: xx-large;
    align-items: center;
    text-align: center;
}
.links{
    align-items: center;
    align-self: center;
    text-align: center;
    padding-top: 50px;
}
#btn{
    
    padding-right: 20px;
}

.reportes {
    display: flex;
    justify-content: space-around; /* Adjust as needed */
    align-items: center;
    
    padding: 10px;
}

.reportes div {
    text-align: center;
    margin: 0 10px; /* Adjust as needed */
}

.reportes img {
    width: 100px; /* Adjust as needed */
    height: auto;
}
</style>
</head>
<body>
    <div><small><a href="../principal.php"><button>Atras</button></a></small></div>
    <div class="reportes">
    <div>
        <h1>Reportes de ventas</h1>
        <a href="pdf.php"><img src="pdf.jpg" alt="reporte pdf"></a>
    </div>
    <div>
        <h1>Reportes de abonos</h1>
        <a href="pdfabono.php"><img src="pdf.jpg" alt="reporte abono"></a>
    </div>
    <div>
        <h1>Lista de precios</h1>
        <a href="pdfinv.php"><img src="pdf.jpg" alt="reporte invertarios"></a>
    </div>
    <div>
        <h1>Reportes de bonificacion</h1>
        <a href="pdfboni.php"><img src="pdf.jpg" alt="reporte pdf"></a>
    </div>
    <div>
        <h1>Reportes de Cancelaciones</h1>
        <a href="pdfcan.php"><img src="pdf.jpg" alt="reporte pdf"></a>
    </div>
</div>
<br>
<div class="reportes">
<div>
        <h1>Reporte de existencias</h1>
        <a href="existencia.php"><img src="pdf.jpg" alt="reporte existencia"></a>
    </div>
    <div>
        <h1>Reporte de Movimientos</h1>
        <a href="movimiento.php"><img src="pdf.jpg" alt="reporte movimientos"></a>
    </div>
    <div>
        <h1>Reporte de pagadas</h1>
        <a href="pagadas.php"><img src="pdf.jpg" alt="reporte pagadas"></a>
    </div>
    <div>
        <h1>Reporte de enganche</h1>
        <a href="enganche.php"><img src="pdf.jpg" alt="reporte enganche"></a>
    </div>
    <div>
        <h1>Reporte general Excel</h1>
        <a href="requerimientos.php"><img src="excel.jpg" alt="reporte enganche"></a>
    </div>
</div>
</body>
</html>