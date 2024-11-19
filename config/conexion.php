<?php
  class Conexion{
    public static function conectar(){
      $link = new PDO("mysql:host=localhost;dbname=carrito_basico","root","");
      return ($link);
      // var_dump ($link);
    }
  }
  // $a = new Conexion();
  // $a->conectar();s
?>

<?php
/* Iniciamos la conexion con MySQL */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "carrito_basico";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Conexion fallida: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("La conexion ha fallado: %s\n", mysqli_connect_error());
    exit();
}
?>

<?php
$servername = "localhost";
$database = "carrito_basico";
$username = "root";
$password = "";
?>

