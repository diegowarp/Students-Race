<?php session_start();
include_once("conexao.php");
$admin = $_SESSION['admin'];
$id_admin = $_SESSION['id_admin'];

$unidade      = $_POST['unidade'];
$licao        = $_POST['licao'];
$pergunta     = $_POST['pergunta'];
$resposta     = $_POST['resposta'];
$alternativa1 = $_POST['alternativa1'];
$alternativa2 = $_POST['alternativa2'];
$alternativa3 = $_POST['alternativa3'];

$pre_comando = "SELECT COUNT(CODlicao) FROM perguntas WHERE CODlicao = '$licao'";

 if($stmt = mysqli_prepare($link, $pre_comando)){
        mysqli_stmt_execute($stmt);
        mysqli_stmt_bind_result($stmt, $numP);
      if((mysqli_stmt_fetch($stmt))){
          $o = 0;
      }
     mysqli_stmt_close($stmt);
}

    if($numP == 10){
        header('Location: admin_cadastra_pergunta.php');
        
        $_SESSION['mensagem'] = "A lição $licao atingiu seu número limite de perguntas (10). Escolha outra ou crie uma nova!";
        
        
    }else if($numP < 10){
    $comando = "INSERT INTO `perguntas` (`ID`, `CODlicao`, `pergunta`, `alternativa1`, `alternativa2`, `alternativa3`, `resposta`, `admin`) VALUES (NULL, '$licao', '$pergunta', '$alternativa1', '$alternativa2', '$alternativa3', '$resposta', '$id_admin')";
    
        if(mysqli_query($link, $comando) === TRUE){
        header('Location: admin_home.php');
        $_SESSION['mensagem'] = "<div class=\"alert alert-success alert-dismissible\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Successo!</strong> A pergunta foi cadastrada.</div>";
        } 
    }else{
        header('Location: admin_cadastra_pergunta.php');
        $_SESSION['mensagem'] = "<div class=\"alert alert-danger alert-dismissible fade show\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Erro!</strong> A lição $licao atingiu seu número limite de perguntas (10). Escolha outra ou crie uma nova!</div>";
}
   
?>