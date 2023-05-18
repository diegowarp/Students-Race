<?php
include_once("conexao.php");
$comando = "SELECT * FROM licoes WHERE CODunidade = '".$_POST['unidadeID']."' ORDER BY Licao ";
$resultado = mysqli_query($link, $comando);

$retorno = "<option value=\"\">Selecione uma lição...</option>";

while($res = mysqli_fetch_array($resultado)){
    $retorno .= "<option value='".$res['ID']."'>".$res['Licao']."</option>";
}

echo $retorno;

?>