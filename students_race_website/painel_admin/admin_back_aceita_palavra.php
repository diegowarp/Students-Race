<?php
session_start();
include_once("conexao.php");

$admin = $_SESSION['admin'];
$id_admin = $_SESSION['id_admin'];

if(isset($_SESSION['idpalavra'])){
    $idpalavra = $_SESSION['idpalavra'];
}else{
    $idpalavra = false;
}

if(isset($_POST['adicionar'])){
    
   $nome_audio = $_FILES['audio']['name'];
   $diretorio = "audios/"; 
   move_uploaded_file($_FILES['audio']['tmp_name'], $diretorio.$nome_audio);
    
    $palavra    =   $_POST['palavra'];
    $traducao   =   $_POST['traducao'];
    $classe     =   $_POST['classe'];
    $definicao  =   $_POST['definicao'];
    $exemplo    =   $_POST['exemplo'];
        
        $pre_comando = "SELECT palavra FROM dicionario WHERE palavra = '$palavra'";
        
        $roda = mysqli_query($link, $pre_comando);
        $check = mysqli_num_rows($roda);
    
        if($check == 0){
            $comando2 = "INSERT INTO `dicionario` (`id`, `palavra`,`traducao`, `classe`, `definicao`, `exemplo`, `audio`) VALUES (NULL, '$palavra', '$traducao', '$classe', '$definicao', '$exemplo', '$nome_audio')";
       
        if($idpalavra != false){
            $comando1 = "UPDATE sugestoes SET visto = 1, acao = 'aceito', admin = '$id_admin' WHERE ID = '$idpalavra'";

                if(mysqli_query($link, $comando1) === TRUE){
                    $i = 0;   
                }
        }
    
        if(mysqli_query($link, $comando2) === TRUE ){
            header('Location: admin_home.php');
            $_SESSION['mensagem'] = "<div class=\"alert alert-success alert-dismissible\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Successo!</strong> A palavra \"$palavra\" foi adicionada ao banco de dados.</div>";
        } 
            
           
        }else{
            header('Location: admin_aceita_palavra.php');
            $_SESSION['mensagem'] = "<div class=\"alert alert-danger alert-dismissible fade show\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Erro!</strong> A palavra \"$palavra\" já existe no banco de dados.</div>";
    }
   }


if(isset($_POST['salvar'])){
    if(isset($_SESSION['id_dicionario'])){
        $id_palavradb = $_SESSION['id_dicionario'];
    }
    
    $palavra    =   $_POST['palavra'];
    $traducao   =   $_POST['traducao'];
    $classe     =   $_POST['classe'];
    $definicao  =   $_POST['definicao'];
    $exemplo    =   $_POST['exemplo'];
    
    
    $comando4 = "UPDATE dicionario SET palavra = '$palavra', traducao = '$traducao', classe = '$classe', definicao = '$definicao', exemplo = '$exemplo' WHERE id = '$id_palavradb'";
    
    if(mysqli_query($link, $comando4) === TRUE){
        header('Location: admin_home.php');
        $_SESSION['mensagem'] = "Palavra $palavra alterada com sucesso!";
    }
    
}
   
?>