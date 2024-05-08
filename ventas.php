<?php 
session_start();
require "app/conection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota de venta </title>
</head>
<body>
<style>
#btn-home { width: 50px; height: 40px; text-align: center; align-items: center;}
#dat,#form,#pla,#rut,#cuen{ padding-right: 20px; padding-left: 40px;}
#clie,#ava,#domc,#doma,#colonia,#re2,#esp,#dref,#trab,#vend,#r1,#sep,#r2,#ent,#art,#pag{ padding-right: 30px; padding-left: 50px;}
input[type="text"]{width: 200px;  max-width: 400px;}
input[type="number"]{ width: 70px;}
.prim,.segunda,.btn-sub,.tercero{ align-items: center; text-align: center;}
body{       width: 100%;        background-color: blanchedalmond;}
    </style>
    <div class="btn-home"><a href="principal.php"><button id="btn-hom">Atras</button></a></div>
    <form action="punto.php" method="POST" id="form">
    <div>
        <div align="center"> <h1>Nota de Venta</h1></div>
        
     <div class="prim"> <h2>  <label for="date" id="dat">Fecha</label><input type="date" name="date" id="date" required>
     <label for="forma" id="form">Forma de pago $</label><span name="forma" id="forma"></span>
     <label for="plazo" id="pla">Plazo a meses </label><select name="plazo" id="plazo" required>
        <option value=""></option>
        <option value="0">Contado</option>
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
     </select>
     <label for="ruta" id="rut">Ruta</label><input type="number" name="ruta" id="ruta"  min="0" required>
     <label for="cuenta" id="cuen">No° Cuenta</label><input type="number" name="cuenta" id="cuenta" min="0" value='0'></h2>
    </div>    
        <div class="segunda">
        <div class="seg-prim">
    <h1>        <label for="cliente" id="clie">Cliente</label><input type="text" name="cliente" id="cliente" required>
     <label for="aval" id="ava">Aval</label><input type="text" name="aval" id="aval"></h1>
        </div>
        <div class="seg-seg">
    <h1>        <label for="domcli" id="domc">Domicilio Cliente</label><input type="text" name="domcli" id="domcli" required >
    <label for="domav" id="doma">Domicilio Avala</label><input type="text" name="domav" id="domav" ></h1>
        </div>
        <div class="seg-terc">
    <h1>        <label for="col" id="colonia">Colonia</label><input type="text" name="col" id="col" required >
    <label for="espo" id="esp">Familiar</label><input type="text" name="espo" id="espo" > </h1>
        </div>
      
        <div class="seg-sex">
    <h1>   <label for="ref1" id="r1">Ref 1</label><input type="text" name="ref1" id="ref1" >
    <label for="domref1" id="r2">Domicilio Ref 1</label><input type="text" name="domref1" id="domref1" ></h1>
        </div>
        <div class="seg-cuart">
    <h1>     <label for="ref2" id="re2">Ref 2</label><input type="text" name="ref2" id="ref2">    
     <label for="domref" id="dref">Domicilio Ref 2</label><input type="text" name="domref" id="domref"></h1>
        </div>
        <div class="seg-quin">      
    <h1>        <label for="promotor" id="trab">PROMOTOR</label><select name="promotor" id="promotor" required>
        <option value=""></option>
        <?php 
        $cobrador=mysqli_query($con,"SELECT nombre FROM personal WHERE puesto='PROMOTOR'");
        while($row=mysqli_fetch_array($cobrador)){
            $cob=$row['nombre'];
        ?>
        <option value="<?php echo $cob;  ?>"><?php echo $cob;  ?></option>
        <?php } ?>
    </select>
     <label for="vendedor" id="vend">Vendedor</label><select type="text" name="vendedor" id="vendedor" required>
<option value=""></option>
<?php 
        $cobrador=mysqli_query($con,"SELECT nombre FROM personal WHERE puesto='VENDEDOR'");
        while($row=mysqli_fetch_array($cobrador)){
            $cob=$row['nombre'];
        ?>
        <option value="<?php echo $cob;  ?>"><?php echo $cob;  ?></option>
        <?php } ?>
</select>
     </h1>
        </div>
       
        <div class="seg-sep">
    <h2>   <label for="cobrador" id="sep">Cobrador</label><select type="text" name="cobrador" id="cobrador" required>
        <option value=""></option>
        <?php 
        $cobrador=mysqli_query($con,"SELECT nombre FROM personal WHERE puesto='COBRADOR'");
        while($row=mysqli_fetch_array($cobrador)){
            $cob=$row['nombre'];
        ?>
        <option value="<?php echo $cob;  ?>"><?php echo $cob;  ?></option>
        <?php } ?>
        </select>    
     <label for="cantart">Cantidad de articulos</label> <input type="number" name="cantart" id="cantart"  min="0" required onchange="return cantidad()">
    </h2>   </div>
  
<div class="container" id="dynamicContentContainer">
    <!-- Dynamic content will be inserted here -->
</div>
<div id="precContainer">
    <label for="prec" id="preci">SUBTOTAL $</label>
    <span name="prec" id="prec">0</span>
</div>

<!-- Additional div tag was missing here -->

<div class="tercero">
    <h1>
        <label for="eng" id="enga">ENGANCHE $</label> 
        <input type="number" name="eng" id="eng" value="0"  onchange="return enganche()">
        <label for="sald" id="sal">SALDO $</label> 
        <span name="sald" id="sald"></span>
    </h1>
</div>
<br>
<div class="btn-sub">
    <input type="hidden" name="pre" id="pre" value="">
    <input type="hidden" name="sa" id="sa" value="">
    <input type="hidden" name="fo" id="fo" value="">
    <input type="submit" name="enviar" id="enviar" value="Guardar"> 
</div>

    </div>
    </form>
</body>
</html>
<script>
     var dynamicContentCount = 0;

function generateDynamicContent(quantity) {
    var dynamicContentContainer = document.getElementById('dynamicContentContainer');

    // Clear existing content
    dynamicContentContainer.innerHTML = '';

    // Generate new content based on quantity
    for (var i = 0; i < quantity; i++) {
        var dynamicContent = document.createElement('div');
        dynamicContent.className = 'seg-oct';

        dynamicContent.innerHTML = `
            <h2>
                <label for="cantidpro" id="art">Cantidad</label>
                <input type="number" name="cantidpro[]" id="cantidpro${i}"  min="1" max="1" required>
                
                
                <label for="categoria" id="art">Categoria</label>
                <select name="categoria[]" id="categoria${i}" onchange="fetchProducts(${i});">
                    <option value=""></option>
                    <?php 
                        $qry=mysqli_query($con,"SELECT DISTINCT category FROM inventario");
                        while($rowcat=mysqli_fetch_array($qry)){
                            $category=$rowcat['category'];
                            echo "<option value='".$category."'>".$category."</option>";
                        }
                    ?>     
                </select>

                <label for="articulo" id="art">Articulo</label>
                <select name="articulo[] " id="articulo${i}" onchange="price(${i});"></select>
                
                <!-- Adding an input for the price -->
                <input type="hidden" id="precio${i}" value="0">
            </h2>
        `;

        dynamicContentContainer.appendChild(dynamicContent);
    }
    dynamicContentCount = quantity;
}

function cantidad() {
    var cant = document.getElementById("cantart").value;
    var plazo= document.getElementById("plazo").value;
   
    generateDynamicContent(cant);
    price(); // Calculate total price initially



}

function fetchProducts(index) {
    var categorySelect = document.getElementById('categoria' + index);
    var productSelect = document.getElementById('articulo' + index);

    // Clear existing options
    productSelect.innerHTML = '<option value=""></option>';

    // Fetch products based on the selected category
    if (categorySelect.value !== "") {
        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var response = JSON.parse(this.responseText);

                for (var i = 0; i < response.length; i++) {
                    var product = response[i];
                    var option = document.createElement("option");
                    option.value = product.product;
                    option.text = product.product;
                    productSelect.appendChild(option);
                }
            }
        };

        xhttp.open("GET", "get_products.php?category=" + categorySelect.value, true);
        xhttp.send();
    }
}


function price(index) {
    var total = 0;
    var totals=0;

    for (var i = 0; i < dynamicContentCount; i++) {
        // Fetch additional data based on selected options
        var plazo = document.getElementById("plazo").value;
        var cant = document.getElementById("cantidpro" + i).value;
        var articulo = document.getElementById('articulo' + i).value;

        console.log("plazo:", plazo);
        console.log("cant:", cant);
        console.log("articulo:", articulo);

        if (cant !== "" && articulo !== "") {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    var response = JSON.parse(this.responseText);
                    console.log(response);
                    // Actualiza el campo de precio con el valor devuelto por el servidor
                    if(response.precio>0){
                    var precioPorCantidad = response.precio * cant;
                    var semanales=response.semana *cant;}
                    else{
                        var precioPorCantidad = response.contado * cant;
                    var semanales=0;
                    }
                    document.getElementById("prec").innerText = precioPorCantidad;
                    

                    // Add the price to the total
                    total += precioPorCantidad;
                    totals += semanales;
                    // Update the total price after processing each article
                    document.getElementById('prec').innerText = total;
                    document.getElementById("forma").innerText = totals;
                    document.getElementById("sald").innerText = total;
                    
                    document.getElementById("pre").value = total;
                    document.getElementById("sa").value = total;
                    document.getElementById("fo").value = totals;
                }
            };

            // Ajusta la URL según tu estructura de URL
            xhttp.open("GET", "get_price.php?articulo=" + articulo + "&plazo=" + plazo, true);
            xhttp.send();
        }
    }

    // Log information to the console
    console.log("Total price:", total);
    console.log("Total sem:", totals);
}


function enganche() {
    var precio = document.getElementById("prec").innerText;
    var enganche = document.getElementById("eng").value;

    if (enganche < 0) {
        alert("El enganche no puede ser menor a 0 ");
        document.getElementById("eng").value = 0;
        document.getElementById("sald").innerText = precio;
    } else if (precio > 0 && enganche >= 0) {
        var resto = precio - enganche;
        
        document.getElementById("sa").value = resto;
        document.getElementById("fo").value = document.getElementById("forma").innerText;
        document.getElementById("sald").innerText = resto;
    }
}


</script>
