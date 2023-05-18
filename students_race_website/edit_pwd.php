<?php 
ob_start();
session_start();
include_once("painel_admin/conexao.php"); 

if(isset($_SESSION['nome_user'])){
   $id_user = $_SESSION['id_user'];
   $nome_user = $_SESSION['nome_user']; 
}else{
    header('Location: index.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <title>Students Race - Change Password</title>


    <!-- Bootstrap -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">


    <!-- ANIMATE -->
    <link rel="stylesheet" href="css/animate.min.css">

    <!-- HOVER -->
    <link href="css/hover-min.css" rel="stylesheet" media="all">

    <!-- CSS -->
    <link rel="stylesheet" href="css/geral.css" media="screen">
    <link rel="stylesheet" href="css/modal.css" media="screen">
    <link rel="stylesheet" href="css/home.css" media="screen">
    <link rel="stylesheet" href="css/profile.css" media="screen">

    
        <!-- DATE PICKER -->
    <link href="css/bootstrap-datepicker.css" rel="stylesheet"/>
    <script src="js/bootstrap-datepicker.min.js"></script> 
    <script src="js/bootstrap-datepicker.pt-BR.min.js" charset="UTF-8"></script>
    <!--[if IE]> <link rel="stylesheet" href="css/ie.css" media="screen"> <![endif]-->

    <!-- Material Icons - Google -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <link rel="shortcut icon" type="image/png" href="css/img/favicon.ico"/>
</head>

<body>
    <?php  
    $comando = "SELECT pontos, foto, nome, sobrenome, nomeuser, datanasc, estado FROM usuarios WHERE ID = '$id_user'";
    
    if($stmt = mysqli_prepare($link, $comando)){
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $pontos, $foto, $nome, $sobrenome, $nomeuser, $datanasc, $estado);
            if(mysqli_stmt_fetch($stmt)){
                $datanasc = strtotime($datanasc);
            }
    }
    mysqli_stmt_close($stmt);
    
    ?>
    <!-- Small Menu -->
    <navbar id="menu_small" class="container-fluid animated bounce">


        <div class="dropdown">
            <div id="logo" data-toggle="dropdown">
                <img src="painel_admin/css/img/logo.png" id="logo">
            </div>
            <div class="dropdown-menu" id="drop-menu">
                <a class="dropdown-item" href="home.php">Unidades</a>
                <a class="dropdown-item" href="profile.php" style="padding-right: 0px; background: rgba(255,255,255,0.75); color: rgb(0,0,0); cursor: default">Meu perfil</a>
                <!--
                <a class="dropdown-item" href="#">Meu desempenho</a>
                <a class="dropdown-item" href="#">Meus amigos</a>
                -->
                <div id="itens_menu" class="dropdown-item" data-toggle="modal" data-target="#modal-dictionary" style="margin-bottom: 0px">
                    Dicionário
                </div>
            </div>
        </div>

        <a href="sair.php">
            <div id="icon_menu_logout">
                <i id="icon_logout" class="material-icons md-42">power_settings_new</i>
            </div>
        </a>
    </navbar>

    <!-- Large Menu -->
    <navbar id="menu_large" class="container-fluid">
      
       <!-- LOGOOOOOOOOOOOOOOO -->
        <a href="home.php">
            <div id="logo">
                <img src="painel_admin/css/img/logo.png" id="logo">
            </div>
            <div id="icons_home" class="hvr-grow icons_menu">
                <i class="material-icons md-42" style="padding-left: 10px">book</i>
            </div>
        </a>

        <a href="profile.php">
            <div id="icons_perfil" class="hvr-grow icons_menu" style="color: rgba(255,255,255,1); cursor: default">
                <i class="material-icons md-42">face</i>
            </div>
        </a>
        <!--
        <a href="#">
            <div id="icons_performance" class="hvr-grow icons_menu">
                <i class="material-icons md-42">show_chart</i>
            </div>
        </a>

        <a href="#">
            <div id="icons_friends" class="hvr-grow icons_menu">
                <i class="material-icons md-42">group</i>
            </div>
        </a>
        -->
        <div id="icons_search" class="hvr-grow icons_menu">
            <i class="material-icons md-42" data-toggle="modal" data-target="#modal-dictionary">search</i>
        </div>


        <!-- Nome dos ícones -->
        <div id="text_menu">Meu perfil</div>

        <!-- Finalizar sessão -->
        <a href="sair.php">
            <div id="icon_menu_logout">
                <i id="icon_logout" class="material-icons md-42">power_settings_new</i>
            </div>
        </a>
        <!-- Sair -->
        <div id="text_logout" style="opacity:0">Sair</div>
    </navbar>

    <div id="content" class="container-fluid row">

        <!-- Corpinho -->
        <div id="box_body" class="container col-12 col-lg-10" style="padding-left: 0px">
             
            <form action="edit_pwd.php" method="POST" enctype="multipart/form-data" id="body" class="animated zoomInDown profile" style="padding:0;overflow-x:hidden;">
                <div id="modal-header" class="container-fluid profile" style="position:sticky;top:0;z-index:3">
                    <p id="text-header" class="profile">
                        My password
                    </p>
                </div>
                
                <div id="modal-body" class="container-fluid" style="padding-top: 0px">
                    <?php
                     if(isset($_SESSION['alert-pwd'])){
                            echo $_SESSION['alert-pwd'];
                            unset($_SESSION['alert-pwd']);
                     }
                    
                    ?>
                    <center>
                        <div class="col-lg-6 col-md-8 col-sm-10 col-12" style="padding: 0px">
                            <div class="form-group" style="margin-bottom: 15px">
                                <label for="senha">Senha atual</label>
                                <input class="form-control" id="senha" name="senhaatual" style="margin-bottom: 5px" placeholder="Digite sua nova senha" type="password" required>
                            </div>
                            <div class="form-group" style="margin-bottom: 15px">
                                <label for="csenha">Nova senha</label>
                                <input class="form-control" id="csenha" name="novasenha" style="margin-bottom: 5px" placeholder="Digite sua nova senha" type="password" required>
                                <input class="form-control" id="csenha" name="confsenha" aria-describedby="senhahelp" placeholder="Confirme a senha" type="password" required>
                                <small id="senhahelp" class="form-text">* A senha deve ter no mínimo 6 caracteres</small>
                            </div>
                        </div>
                    </center>
                </div>
                
                
                <div id="modal-footer" class="container-fluid" style="background-color: white; padding-top: 0px">
                    <center>
                        <div class="col-12" style="padding: 0px">
                            <div id="button-edit" class="container-fluid col-lg-5 col-md-6 col-sm-8 col-12" style="padding:0px">
                                <input id="btn-edit" type="submit" value="Change" name="adicionar" class="col-12 hvr-shrink" onclick="return validar()" style="border-color: rgb(0,0,0); background-color: white; color: black; font-size:1.4em">
                            </div>
                        </div>
                        <div class="col-12" style="padding: 0px; margin-top:5px">
                            <div id="button-cancel" class="container-fluid col-lg-5 col-md-6 col-sm-8 col-12" style="padding:0px">
                                <a href="profile.php">
                                    <input id="btn-cancel" type="button" value="Cancel" class="col-12 hvr-shrink" style="border-color: rgb(0,0,0); background-color: white; color: black; font-size:1.4em">
                                </a>
                            </div>
                        </div>
                    </center>
                </div>
                
            </form>
        </div>
        
        <?php
      if(isset($_POST['adicionar'])){
            $senhaatual = $_POST['senhaatual'];
            $senha_atual = hash('sha512', $senhaatual, false);

            $novasenha = $_POST['novasenha'];
            $nova_senha = hash('sha512', $novasenha, false);

            $comando1 = "SELECT senha FROM usuarios WHERE ID = '$id_user' AND senha = '$senha_atual'";
            $comando2 = "UPDATE `usuarios` SET `senha` = '$nova_senha' WHERE `usuarios`.`ID` = $id_user";

            $query = mysqli_query($link, $comando1);

            $passe = mysqli_num_rows($query);

            if($passe == 0){

                $_SESSION['alert-pwd'] = "<div class=\"alert alert-danger alert-dismissible fade show\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Erro!</strong> Digite sua senha atual corretamente.</div>";
                 header('Location: edit_pwd.php');
                

            }else{
                   if(mysqli_query($link, $comando2) === TRUE){
                           header('Location: profile.php');
                            $_SESSION['alert'] = "<div class=\"alert alert-success alert-dismissible\" style=\"margin-right:15px; margin-left:15px\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Successo!</strong> Sua senha foi alterada.</div>";
                        }
            }
      }
        
        
        ?>

        <!-- Menu Direito -->
        <nav id="menu-right" class="col-2 d-none d-lg-block animated bounceInRight">


        </nav>
    </div>

    <!-- Modal do dicionário -->
    <div class="modal fade container-fluid col-12" id="modal-dictionary" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered container-fluid" role="document">
            <div id="dictionary" class="modal-content col-12">
                <div id="modal-header" class="container-fluid">
                    <p id="text-header">
                        Students Race Dictionary
                    </p>
                    <i id="close-modal" class="material-icons md-30" data-dismiss="modal">close</i>
                </div>
                <div id="modal-body" class="container-fluid">

                    <div id="input-search" class="input-group" style="margin-bottom: 15px">
                        <input type="text" class="form-control input-lg" id="word" placeholder="Type a word you want to know" autocomplete="off" name="word" required>
                        <!-- COLOCAR O TYPE="SUBMIT"-->
                        <button id="search" class="input-group-prepend">
                            <i id="search" class="material-icons md-28">search</i>
                        </button>

                    </div>

                    <div id="search" class="input-group" style="margin-bottom: 15px">
                        <div id="result">

                        </div>
                    </div>

                </div>
                <div id="modal-footer-dictionary" class="container-fluid">
                    <center>
                        <div class="row col-12" style="padding: 0px">
                            <div id="button-dictionary" class="container-fluid col-12">
                                Pesquisar outra palavra
                            </div>
                        </div>
                    </center>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="audio.js"></script>
    <script src="js/engine_dicionario.js"></script>
    <script src="js/profile.js"></script>
    <script src="js/completa_cadastro.js"></script>
    <script src="js/dicionario.js"></script>
    <script src="painel_admin/js/admin_altera_senha.js"></script>
</body>

</html>
<script>
	//Executar a cada 10 segundos, para atualizar a qunatidade de usuários online
	setInterval(function(){
		//Incluir e enviar o POST para o arquivo responsável em fazer contagem
		$.post("back_users_online.php", {contar: '',});
	}, 10000);
</script>

<script>
    $(document).ready(function() {

        $('#word').typeahead({
            source: function(comando, resultado) {
                $.ajax({
                    url: "engine_completa.php",
                    method: "POST",
                    data: {
                        comando: comando
                    },
                    dataType: "json",
                    success: function(data) {
                        resultado($.map(data, function(item) {
                            return item;
                        }));
                    }
                })
            }
        });

    });

</script>