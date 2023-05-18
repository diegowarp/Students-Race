<?php
session_start();
include_once('painel_admin/conexao.php');
$id_user = $_SESSION['id_user'];

if($_POST){
    
    $word = $_POST['sugestao'];
    
    date_default_timezone_set('America/Sao_Paulo');
    $date = date('Y-m-d H:i:s');
    
    $comando = "INSERT INTO `sugestoes` (`ID`, `CODusuario`, `palavrasugerida`, `datahora`, `visto`, `acao`, `admin`) VALUES (NULL, '$id_user', '$word', '$date', '0', NULL, NULL)";
    
    if(mysqli_query($link, $comando) === TRUE){
        echo '<center><p id="word-example" style="font-size:1.1em">Palavra enviada! Thanks for helping us!</p></center>';
    }else{
        echo 'erro!';
    }
}


?>