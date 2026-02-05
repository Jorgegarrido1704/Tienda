<?php 

require "../app/conection.php";

    $cuentas= mysqli_query($con,"SELECT cuenta,precio,enganche,saldo FROM historico WHERE saldo>0 AND nulo ='' AND precio>0 ORDER BY cliente ASC");
    
    while($row=mysqli_fetch_array($cuentas)){
       $cuenta=$row['cuenta'];
       $precio=$row['precio'];
       $enganche=$row['enganche'];
         $saldo=$row['saldo'];
         $abonosEnCuentas=mysqli_query($con,"SELECT SUM(abono) as abonos FROM abonos WHERE cuenta='$cuenta'");
         $rowAbonos=mysqli_fetch_array($abonosEnCuentas);
         $abonos=$rowAbonos['abonos'];
         $resto=$precio-$enganche-$abonos;
         if($resto != $saldo){
         print("Cuenta: ".$cuenta." Precio: ".$precio." Enganche: ".$enganche." Abonos: ".$abonos." Saldo: ".$saldo." Resto: ".$resto."<br>");
             mysqli_query($con,"UPDATE historico SET saldo='$resto' WHERE cuenta='$cuenta'");
         }
         
    }

header("location:../app/respbd.php");

