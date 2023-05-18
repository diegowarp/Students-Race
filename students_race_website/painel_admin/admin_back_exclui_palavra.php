<?php
session_start();
$admin = $_SESSION['admin'];
$id_admin = $_SESSION['id_admin'];
include_once("conexao.php");



if(isset($_GET['idpalavra'])){
    $id = $_GET['idpalavra'];
    $palavra = $_GET['palavra'];
    $comando1 = "DELETE FROM dicionario WHERE id ='$id'";
    
    if(mysqli_query($link, $comando1) === TRUE){
    header('Location: admin_home.php');
     $_SESSION['mensagem'] = "<div class=\"alert alert-success alert-dismissible\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Successo!</strong> A palavra \"$palavra\" foi excluída.</div>";
}
}


if(isset($_GET['id'])){
$idpalavra = $_GET['id'];
$palavra = $_GET['palavra'];


$comando = "UPDATE sugestoes SET visto = 1, acao = 'ignorado', admin = '$id_admin' WHERE ID = '$idpalavra'";

if(mysqli_query($link, $comando) === TRUE){
    header('Location: admin_home.php');
     $_SESSION['mensagem'] = "<div class=\"alert alert-success alert-dismissible\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Successo!</strong> A palavra \"$palavra\" foi excluída.</div>";
}
}
?>