<?php
session_start();
$idadmin = $_SESSION['id_admin'];
include_once("conexao.php");
    $senhaatual = $_POST['senhaatual'];
    $senha_atual = hash('sha512', $senhaatual, false);

    $novasenha = $_POST['novasenha'];
    $nova_senha = hash('sha512', $novasenha, false);

    $comando1 = "SELECT senha FROM administradores WHERE ID = '$idadmin' AND senha = '$senha_atual'";
    $comando2 = "UPDATE `administradores` SET `senha` = '$nova_senha' WHERE `administradores`.`ID` = $idadmin";

    $query = mysqli_query($link, $comando1);

    $passe = mysqli_num_rows($query);

    if($passe == 0){
        
        $_SESSION['mensagem'] = "<div class=\"alert alert-danger alert-dismissible fade show\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Erro!</strong> Digite sua senha atual corretamente.</div>";
        header('Location: admin_altera_senha.php');
     
    }else{
           if(mysqli_query($link, $comando2) === TRUE){
                    header('Location: admin_home.php');
                    $_SESSION['mensagem'] = "<div class=\"alert alert-success alert-dismissible\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Successo!</strong> Sua senha foi alterada.</div>";
                }
    }
?>