<?php /*
$host="localhost";
$user="root";
$password="";
$bd="tienda";
$con=mysqli_connect($host,$user,$password,$bd);
*/

$host="localhost";
$user="root";
$password="";
$bd="tienda";
$con=mysqli_connect($host,$user,$password,$bd);
function select($from,$where){    $select="SELECT * FROM $from WHERE $where";}
function update($from,$set,$where){ $update="UPDATE FROM $from SET $set WHERE $where";}
function delete($from, $where){$delete="DELETE FROM  $from WHERE $where";}


date_default_timezone_set("America/Mexico_City");
$today=date("d-m-Y "); 
$month=date("m-Y");
$year=date("Y");


