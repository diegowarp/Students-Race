<?php session_start();
$id_admin = $_SESSION['id_admin'];
include_once("conexao.php");
    $nome = ucfirst($_POST['nome']);
    $user = $_POST['usuario'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $senha = hash('sha512', $senha, false); 

    date_default_timezone_set('America/Sao_Paulo');
    $date = date('Y-m-d H:i');

    $pre_comando = "SELECT * FROM administradores WHERE email = '$email' OR nome_user = '$user'";

    $roda = mysqli_query($link, $pre_comando);
    
    $check = mysqli_num_rows($roda);
    
    if($check == 0){
       $comando = "INSERT INTO `administradores` (`ID`, `nome`, `nome_user`, `email`, `senha`, `dataHora`) VALUES (NULL, '$nome', '$user', '$email', '$senha', '$date')";
        
        if(mysqli_query($link, $comando) === TRUE){
            header('Location: admin_home.php');
            $_SESSION['mensagem'] = "<div class=\"alert alert-success alert-dismissible\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Successo!</strong> O administrador $user foi cadastrado no sistema.</div>";
        }
    }else{
        header('Location: admin_cadastra_admin.php');
        $_SESSION['mensagem'] = "<div class=\"alert alert-danger alert-dismissible fade show\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Erro!</strong> O email \"$email\" já está cadastrado no sistema.</div>";
    }
?>