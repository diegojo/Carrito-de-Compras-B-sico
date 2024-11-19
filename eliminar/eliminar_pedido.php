<?php 
include "../config/conexion.php";
$conexion = mysqli_connect($servername,$username,$password,$database);

$idpreventa = $_GET['idpreventa'];

$stmt = Conexion::conectar()->prepare("SELECT cantidad, idservicio FROM preventa WHERE idpreventa= '$idpreventa' ");
$stmt->execute();
  $va=1;
    foreach ($stmt->fetchAll() as $r) {
      $sql = "UPDATE stock SET cantidad_stock = cantidad_stock + ".$r['cantidad']." where idservicio = ".$r["idservicio"];
      $udpate = Conexion::conectar()->prepare($sql);
      $udpate->execute();
    }


$sql="DELETE FROM preventa WHERE idpreventa ='".$_GET['idpreventa']."'  ";
$query = mysqli_query($conexion, $sql);


?>