<?php
include_once("config/conexion.php");
$data = array();
$filtro= '';
if(isset($_GET['term'])){
	$filtro = $_GET['term'];
}
	$sql = "SELECT * FROM servicio as ser INNER JOIN stock as st on ser.idservicio = st.idservicio
WHERE descripcion like '%".$filtro."%' AND tipo_servicio = 'COMIDA' ORDER BY st.cantidad_stock DESC  ";
	$resultset = mysqli_query($conn, $sql) or die("database error:". mysqli_error($conn));

	while( $rows = mysqli_fetch_assoc($resultset) ) {
		$data[] =$rows;

		/*
		$data[] = array (
			'idservicio' => $rows['idservicio'],
			'descripcion' => utf8_decode($rows['descripcion']),
			'precio' =>$rows['precio'],
			'idstock' => $rows['idstock'],
			'cantidad_stock' =>$rows['cantidad_stock'],
		 );*/
	}
	print_r(json_encode($data));
?>