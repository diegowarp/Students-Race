<?php
session_start();
include_once("conexao.php");
$admin = $_SESSION['admin'];
$id_admin = $_SESSION['id_admin'];

date_default_timezone_set('America/Sao_Paulo');
$date = date('Y-m-d H:i');

//enviar resposta
if(isset($_POST['enviar'])){
    
$idmensagem = $_POST['idmensagem'];
$resposta = $_POST['resposta'];

$comando = "UPDATE `mensagens` SET `resposta` = '$resposta', `datahoraresposta` = '$date', `visto` = '1', `acao` = 'respondido', `admin` = '$id_admin' WHERE `mensagens`.`ID` = $idmensagem";

    if(mysqli_query($link, $comando) === TRUE){
        header('Location: admin_listar_mensagens.php');
        unset($_SESSION['id']);
 }
    
//ignorar mensagem
}else if( (isset($_GET['idmensagem']))){
    
$idmensagem = $_GET['idmensagem'];
    
$comando2 = "UPDATE `mensagens` SET `resposta` = 'NULL', `datahoraresposta` = '$date', `visto` = '1', `acao` = 'ignorado', `admin` = '$id_admin' WHERE `mensagens`.`ID` = $idmensagem";
    
    if(mysqli_query($link, $comando2) === TRUE){
        header('Location: admin_listar_mensagens.php');
        unset($_SESSION['id']);
 } 
}
?>