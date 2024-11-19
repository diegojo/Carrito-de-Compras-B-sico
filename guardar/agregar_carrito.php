<?php
include "../config/conexion.php";
// Create connection
$conn = mysqli_connect($servername, $username, $password, $database);
// Check connection
if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
}
echo "";
$idservicio=$_POST['idservicio'];
$descripcion=$_POST['descripcion'];
if($guardicion=$_POST['guardicion'] == null){
    $guardicion= "";
}else if($guardicion=$_POST['guardicion'] == $guardicion=$_POST['guardicion']){
    $guardicion=$_POST['guardicion'];
}
$precio=$_POST['precio'];
$cantidad=$_POST['cantidad'];
$totalcobrar=$_POST['totalcobrar'];
$total_stock=$_POST['total_stock'];
foreach ($_POST['descripcion'] as $key => $f) {
$stmt = Conexion::conectar()->prepare("SELECT cantidad_stock, idservicio FROM stock WHERE idservicio = '".$_POST["idservicio"][$key]."'");
  $stmt->execute();
    foreach ($stmt->fetchAll() as  $r) {
     $stockActual[]= $r["cantidad_stock"]  ;
    }
     $totaldescontar2 = $_POST["total_stock"][$key] - $_POST['cantidad'][$key];
  }
if($totaldescontar2 < 0){
  echo ": ". $r["cantidad_stock"];
}else{

foreach ($_POST['descripcion'] as $key => $f) {
    $sql4 = "INSERT INTO preventa (
       
        idservicio,
        descripcion,
        guardicion,
        precio, 
        cantidad,
        totalcobrar) 
        VALUES (
        
        '".$_POST['idservicio'][$key]."',
        '".$_POST['descripcion'][$key]."',
        '".$_POST['guardicion'][$key]."',
        '".$_POST['precio'][$key]."',
        '".$_POST['cantidad'][$key]."',
        '".$_POST['totalcobrar'][$key]."')";
    if (mysqli_query($conn, $sql4)) {
          echo "";
    } else {
          echo "Error: " . $sql4 . "<br>" . mysqli_error($conn);
        }
      }

/*  FIN REGISTRO DE PREVENTA */ 


/* ACTUALIZAR STOCK */

foreach ($_POST['descripcion'] as $key => $f) {
    $stmt = Conexion::conectar()->prepare("SELECT cantidad_stock  FROM stock WHERE idservicio= '".$_POST["idservicio"][$key]."' ");
    $stmt->execute();
      $va=1;
        foreach ($stmt->fetchAll() as $r) {
    
          $stockActual[]= $r["cantidad_stock"]  ;
    
        }
       
        $totaldescontar = $_POST["total_stock"][$key] - $_POST['cantidad'][$key];
    
      }
       
      
      foreach ($_POST['idservicio'] as $key => $f) {
    
    $sql7 = ("UPDATE stock SET cantidad_stock= '".$stockActual[$key]."' - '".$_POST['cantidad'][$key]."'  WHERE idservicio='" .$_POST['idservicio'][$key]."' ");
    
    if (mysqli_query($conn, $sql7)) {
    
    echo "";
    
    } else {
    
    echo "Error: " . $sql7 . "<br>" . mysqli_error($conn);
    
    }
      }
  
  
  /* ACTUALIZAR STOCK */

    }
mysqli_close($conn);


?>




