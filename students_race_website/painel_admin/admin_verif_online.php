<?php
session_start();
include_once("conexao.php");

if(isset($_POST['contar'])){
    $data['atual'] = date('Y-m-d H:i:s');
	//Diminuir 20 segundos 
	$data['online'] = strtotime($data['atual'] . " - 20 seconds");
	$data['online'] = date("Y-m-d H:i:s",$data['online']);
	$result_qnt_visitas = "SELECT count(id) as online FROM online WHERE data_leave >= '" . $data['online'] . "'";
	
	$resultado_qnt_visitas = mysqli_query($link, $result_qnt_visitas);
	$row_qnt_visitas = mysqli_fetch_assoc($resultado_qnt_visitas);
	
	echo $row_qnt_visitas['online'];
}
?>