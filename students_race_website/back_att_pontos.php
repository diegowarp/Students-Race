<?php
session_start();
include_once("painel_admin/conexao.php"); 
$id_user = $_SESSION['id_user'];


if(isset($_POST['contar'])){
    $comando = "SELECT pontos FROM usuarios WHERE ID = '$id_user'";
    
    if($stmt = mysqli_prepare($link, $comando)){
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $pontos);
            if(mysqli_stmt_fetch($stmt)){
                echo $pontos;
            }
    }
    mysqli_stmt_close($stmt);
}
?>