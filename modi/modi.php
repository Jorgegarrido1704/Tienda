<?php 

require "../app/conection.php";

$id=isset($_POST['id'])?$_POST['id']:"";
if($id==""){
    header("location:../principal.php");
}else{
$Buscar = mysqli_query($con, "SELECT * FROM historico WHERE id = '$id' ");
while($row = mysqli_fetch_array($Buscar)){
    $cuenta=$row['cuenta'];
    $cliente=$row['cliente'];
    $total=$row['precio'];
    $enganche=$row['enganche'];
    $saldo=$row['saldo'];

}
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>modificar cuenta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
  <form class="row g-3" action="modif.php" method="GET">
  <div class="col-md-1">
    <label for="cuenta" class="form-label">Cuenta</label>
    <input type="text" class="form-control" id="cuenta" name="cuenta" value="<?php echo $cuenta; ?>" required>
  </div>
  <fieldset disabled>
  <div class="col-md-3">
    <label for="cliente" class="form-label">Cliente</label>
    <input type="text" class="form-control" id="cliente"  name="cliente" value="<?php echo $cliente; ?>" required>
  </div>
  </fieldset>
  <div class="col-md-1">
    <label for="total" class="form-label">Total compra</label>
    <input type="number" class="form-control" id="total" name="total" min="0" value="<?php echo $total; ?>" required >
  </div>
  <div class="col-md-1">
    <label for="engnache" class="form-label">Enganche</label>
    <input type="number" class="form-control" id="enganche" name="enganche" min="0" value="<?php echo $enganche; ?>" required>
  </div>
  
<div>
  <input type="hidden" name="ids" id="ids" value="<?php echo $id; ?>">
</div>
  <div class="col-12">
    <button type="submit" class="btn btn-primary">Guardar</button>
  </div>
</form>

</body>
</html>

