<?php  
require "../app/conection.php";
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Modificaciones</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>

  <body>

  <div><small><a href="../principal.php"><button>Atras</button></a></small></div>
  <table class="table">
  <thead>
    <tr>
      <th scope="col">Cuenta</th>
      <th scope="col">Cliente</th>
      <th scope="col">Cambiar</th>
    </tr>
  </thead>
  <tbody>
    <?php 
    $selection=mysqli_query($con,"SELECT * FROM historico");
        while($row=mysqli_fetch_array($selection)){
        $cuenta=$row['cuenta'];
        $cliente=$row['cliente'];
        $id=$row['id'];
    ?>
    <tr>
      <th scope="row"><?php echo $cuenta; ?></th>
      <td><?php echo $cliente; ?></td>
      <td><form action="modi.php" method="POST"><input type="hidden" name="id" id="id" value="<?php echo $id; ?>"><input type="submit" name="enviar" id="enviar" value="modificar"></form></td>
      
    </tr>
    <?php } ?>
  </tbody>
</table>
   
</body>
</html>