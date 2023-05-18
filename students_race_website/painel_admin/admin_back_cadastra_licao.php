<?php
session_start();
include_once("conexao.php");
$admin = $_SESSION['admin'];
$id_admin = $_SESSION['id_admin'];

date_default_timezone_set('America/Sao_Paulo');
$date = date('Y-m-d H:i');

$id_unidade = $_POST['unidade'];
$licao = ucfirst($_POST['licao']);

if(isset($_FILES['imagem'])){
    $extensao = strtolower(substr($_FILES['imagem']['name'], -4));
    $novo_nome = md5(time()) . $extensao;
    $diretorio = "licoes/";
    
    move_uploaded_file($_FILES['imagem']['tmp_name'], $diretorio.$novo_nome);
    
    $pre_comando = "SELECT Licao FROM licoes WHERE Licao = '$licao'";
    
    $roda = mysqli_query($link, $pre_comando);
    
    $check = mysqli_num_rows($roda);
    
    if($check == 0){
    $comando = "INSERT INTO `licoes` (`ID`, `Licao`, `imagem`, `CODunidade`, `dataHora`, `admin`) VALUES (NULL, '$licao', '$novo_nome', '$id_unidade', '$date', '$id_admin');";
    
        if(mysqli_query($link, $comando) === TRUE){
            header('Location: admin_home.php');
            $_SESSION['mensagem'] = "<div class=\"alert alert-success alert-dismissible\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Successo!</strong> A lição \"$licao\" foi adicionada e está pronta para receber novas perguntas.</div>";
        }
    }else{
        header('Location: admin_cadastra_licao.php');
        $_SESSION['mensagem'] = "<div class=\"alert alert-danger alert-dismissible fade show\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Erro!</strong> A lição \"$licao\" já está cadastrada no sistema.</div>";
    }
}
?>