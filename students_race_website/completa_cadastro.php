<?php 
ob_start();
session_start();
include_once("painel_admin/conexao.php"); 

$id_user = $_SESSION['id_user'];
?>
<!DOCTYPE html>

<!-- IS-VALID / IS-INVALID -->
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <title>Cadastro-TCC</title>


    <!-- Bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- ANIMATE -->
    <link rel="stylesheet" href="css/animate.min.css">

    <!-- HOVER -->
    <link href="css/hover-min.css" rel="stylesheet" media="all">
    
    <!-- CSS -->
    <link rel="stylesheet" href="css/geral.css" media="screen">
    <link rel="stylesheet" href="css/modal.css" media="screen">
    <link rel="stylesheet" href="css/completa_cadastro.css" media="screen">

    <!-- DATE PICKER -->
    <link href="css/bootstrap-datepicker.css" rel="stylesheet"/>
    <script src="js/bootstrap-datepicker.min.js"></script> 
    <script src="js/bootstrap-datepicker.pt-BR.min.js" charset="UTF-8"></script>

    <!-- Material Icons - Google -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <link rel="shortcut icon" type="image/png" href="css/img/favicon.ico"/>
</head>
<body class="modal-open">
    
    <!-- Modal de cadastro -->
    <div class="modal container-fluid col-12 animated zoomInDown" id="modal-register" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered container-fluid" role="document">
            <form id="register" action="completa_cadastro.php" method="POST" enctype="multipart/form-data" class="modal-content col-12">
                <div id="modal-header" class="container-fluid">
                    <p id="text-header">
                        Complete seu cadastro
                    </p>
                    <!--<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>-->
                </div>
                <div id="modal-body" class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-sm-7 col-md-8 col-lg-9">
                            <div class="form-group" id="div_name" style="margin-bottom: 15px">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" id="name" placeholder="Nome" name="nome" style="margin-bottom: 5px" required>
                                <input type="text" class="form-control" id="last_name" placeholder="Sobrenome" name="sobrenome" required>
                            </div>

                            <div class="form-group" id="div_username" style="margin-bottom: 15px">
                                <label for="username">Nome de usuário</label>
                                <input type="text" class="form-control" id="username" placeholder="Nome de usuário" name="nomeuser" required>
                            </div>
                        </div>

                        <div id="user_image_lg" class="col-sm-5 col-md-4 col-lg-3 d-none d-sm-block row">
                            <div class="form-group" style="margin-bottom: 0px">
                                <label for="user_image">Foto de perfil</label>
                                <input id="user_image" name="user_image" type="file" class="inputfile" onchange="preview();">
                                <img id="user" name="user" class="img-thumbnail" src="css/img/user.png" alt="...">
                            </div>
                        </div>
                    </div>
                    
                    
                    <div id="birth_state" class="row">
                        <div id="birth" class="col-12 col-sm-6">
                            <div class="form-group" style="margin-bottom: 0px">
                                <label for="birth">Data de nascimento</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control" id="date_birth" placeholder="Data de nascimento" name="datanasc" required>
                                </div>
                            </div>
                        </div>

                        <div id="state" class="col-12 col-sm-6">
                            <div class="form-group" style="margin-bottom: 0px">
                                <label for="state">Estado</label>
                                <select id="state" class="form-control" name="estado" required>
                                    <option selected>Estado</option>
                                    <option value="">Selecione</option>
                                    <option value="AC">Acre</option>
                                    <option value="AL">Alagoas</option>
                                    <option value="AP">Amapá</option>
                                    <option value="AM">Amazonas</option>
                                    <option value="BA">Bahia</option>
                                    <option value="CE">Ceará</option>
                                    <option value="DF">Distrito Federal</option>
                                    <option value="ES">Espirito Santo</option>
                                    <option value="GO">Goiás</option>
                                    <option value="MA">Maranhão</option>
                                    <option value="MS">Mato Grosso do Sul</option>
                                    <option value="MT">Mato Grosso</option>
                                    <option value="MG">Minas Gerais</option>
                                    <option value="PA">Pará</option>
                                    <option value="PB">Paraíba</option>
                                    <option value="PR">Paraná</option>
                                    <option value="PE">Pernambuco</option>
                                    <option value="PI">Piauí</option>
                                    <option value="RJ">Rio de Janeiro</option>
                                    <option value="RN">Rio Grande do Norte</option>
                                    <option value="RS">Rio Grande do Sul</option>
                                    <option value="RO">Rondônia</option>
                                    <option value="RR">Roraima</option>
                                    <option value="SC">Santa Catarina</option>
                                    <option value="SP">São Paulo</option>
                                    <option value="SE">Sergipe</option>
                                    <option value="TO">Tocantins</option>
                                </select>

                            </div>
                        </div>
                    </div>
                          
                    <div id="user_image_sm" class="col-12 d-block d-sm-none">
                            <div class="form-group" style="margin-bottom: 0px">
                                <label for="user_image_sm">Foto de perfil</label>
                                <input id="user_image_sm" name="user_image_sm" type="file" class="inputfile" onchange="preview_sm();" >
                                <img id="user_sm" name="user_sm" class="img-thumbnail" src="css/img/user.png" alt="...">
                            </div>
                    </div>
                </div>
                
                
                <div id="modal-footer" class="container-fluid">
                    <center>
                        <div class="row col-12" style="padding: 0px">
                            <div id="button-register" class="container-fluid col-12">
                                <input id="register" type="submit" value="Completar cadastro" name="completa_cadastro" class="col-12 hvr-shrink">
                            </div>
                        </div>
                    </center>
                </div>
            </form>
        </div>
    </div>
    <?php
    if(isset($_POST['completa_cadastro'])){
        
        $nome      = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        
        $nomeuser  = $_POST['nomeuser'];
        
        $dataNascimento = $_POST['datanasc'];
        $data = explode('/', $dataNascimento);
            $dia = $data[0];
            $mes = $data[1];
            $ano = $data[2];


        $dataNascimento = $ano."/".$mes."/".$dia;
        
        $estado = $_POST['estado'];
        
    if(!empty($_FILES['user_image']['name'])){
        
            $extensao = strtolower(substr($_FILES['user_image']['name'], -4));
            $novo_nome = md5(time()) . $extensao;
            $diretorio = "usuarios/";

            move_uploaded_file($_FILES['user_image']['tmp_name'], $diretorio.$novo_nome);

            $comando = "UPDATE `usuarios` SET `nome` = '$nome', `sobrenome` = '$sobrenome', `nomeuser` = '$nomeuser', `datanasc` = '$dataNascimento', `estado` = '$estado', `foto` = '$novo_nome' WHERE ID = '$id_user'";
            
            if(mysqli_query($link, $comando) === TRUE){
               $_SESSION['nome_user'] = $nome;
               $_SESSION['sobrenome_user'] = $sobrenome;
                
               header('Location: home.php');
            } 
        
    }else if(empty($_FILES['user_image']['name'])){
         
         $comando = "UPDATE `usuarios` SET `nome` = '$nome', `sobrenome` = '$sobrenome', `nomeuser` = '$nomeuser', `datanasc` = '$dataNascimento', `estado` = '$estado', `foto` = 'user.png' WHERE ID = '$id_user'";
            
            if(mysqli_query($link, $comando) === TRUE){
               $_SESSION['nome_user'] = $nome;
               $_SESSION['sobrenome_user'] = $sobrenome;
                
               header('Location: home.php');
            } 
    }else if(!empty($_FILES['user_image']['name'])){
       
            $extensao = strtolower(substr($_FILES['user_image_sm']['name'], -4));
            $novo_nome = md5(time()) . $extensao;
            $diretorio = "usuarios/";

            move_uploaded_file($_FILES['user_image_sm']['tmp_name'], $diretorio.$novo_nome);

            $comando = "UPDATE `usuarios` SET `nome` = '$nome', `sobrenome` = '$sobrenome', `nomeuser` = '$nomeuser', `datanasc` = '$dataNascimento', `estado` = '$estado', `foto` = '$novo_nome' WHERE ID = '$id_user'";
            
            if(mysqli_query($link, $comando) === TRUE){
               $_SESSION['nome_user'] = $nome;
               $_SESSION['sobrenome_user'] = $sobrenome;
                
               header('Location: home.php');
            }
           
    }else{
         echo 'sm vazio';
        
        $comando = "UPDATE `usuarios` SET `nome` = '$nome', `sobrenome` = '$sobrenome', `nomeuser` = '$nomeuser', `datanasc` = '$dataNascimento', `estado` = '$estado', `foto` = 'user.png' WHERE ID = '$id_user'";
            
            if(mysqli_query($link, $comando) === TRUE){
               $_SESSION['nome_user'] = $nome;
               $_SESSION['sobrenome_user'] = $sobrenome;
                
               header('Location: home.php');
            }
       
    }
}
    
    ?>
    <script src="js/completa_cadastro.js"></script>
</body>
</html>