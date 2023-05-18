<?php
session_start();
include_once("painel_admin/conexao.php");

if(isset($_POST['contar'])){
	$data['atual'] = date('Y-m-d H:i:s');
	
	//Diminuir 1 minuto, contar usuário no site no último minuto
	//$data['online'] = strtotime($data['atual'] . " - 1 minutes");
	
	//Diminuir 20 segundos 
	$data['online'] = strtotime($data['atual'] . " - 20 seconds");
	$data['online'] = date("Y-m-d H:i:s",$data['online']);
	//echo $_SESSION['visitante'];
	if ((isset($_SESSION['visitante'])) AND (!empty($_SESSION['visitante']))) {
		
		$result_up_visita = "UPDATE online SET
		data_leave = '" . $data['atual'] . "'
		WHERE ID = '" . $_SESSION['visitante'] . "'";
		
		$resultado_up_visitas = mysqli_query($link, $result_up_visita);
		
	}else{
		//Salvar no banco de dados
		$result_visitas = "INSERT INTO online (data_enter, data_leave)VALUES ('".$data['atual']."', '".$data['atual']."')";
		
		$resultado_visitas = mysqli_query($link, $result_visitas);
		
		$_SESSION['visitante'] = mysqli_insert_id($link);
	}
}