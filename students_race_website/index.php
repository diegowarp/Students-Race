<?php 
ob_start();
session_start();
include_once("painel_admin/conexao.php");
if(isset($_SESSION['nome_user'])){
    header('Location: home.php');
}
?>
<!DOCTYPE html>
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <title>Students Race - A corrida do aprendizado em Inglês!</title>


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

    <link rel="stylesheet" href="css/geral.css" media="screen">
    <link rel="stylesheet" href="css/modal.css" media="screen">
    <link rel="stylesheet" href="css/pagina_inicial.css" media="screen">


    <!-- Material Icons - Google -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="shortcut icon" type="image/png" href="css/img/favicon.ico"/>
    <style>
        .alert.alert-danger.alert-dismissible {
            z-index: 1;
            position: fixed;
            top: 62px;
            margin: 15px;
            margin-top: 5px;
            width: calc(100% - 30px);
        }
        @media screen and (max-width: 576px) {
            .alert.alert-danger.alert-dismissible {
                top: 56px;
            }
        }
        
    </style>
</head>
<?php
    if(isset($_SESSION['alert-login'])){
        echo $_SESSION['alert-login'];
        unset($_SESSION['alert-login']);
    }
?>
<body>

<div id="top" style="position:absolute;top:0px"></div>
    <!-- Small Menu -->
    <navbar id="menu_small" class="container-fluid animated bounce">
        <div class="dropdown">
            <div id="logo" data-toggle="dropdown" class="animated pulse slow infinite">
                <img src="painel_admin/css/img/logo.png" id="logo">
            </div>
            <div class="dropdown-menu" id="drop-menu">
                <div class="dropdown-item" data-toggle="modal" data-target="#modal-register">
                    Criar conta
                </div>
                <div class="dropdown-item" data-toggle="modal" data-target="#modal-login">
                    Entrar
                </div>
            </div>
        </div>
    </navbar>
    
    
    <!-- Large Menu -->
    <navbar id="menu_large" class="container-fluid animated slideInDown">
        <div id="logo">
            <img src="painel_admin/css/img/logo.png" id="logo">
        </div>
        <div id="icons_register" class="hvr-grow icons_menu">
            <i class="material-icons md-42" data-toggle="modal" data-target="#modal-register" style="padding-left:10px">person_add</i>
        </div>

        <div id="icons_login" class="hvr-grow icons_menu">
            <i class="material-icons md-42" data-toggle="modal" data-target="#modal-login">person</i>
        </div>

        <!-- Nome dos ícones -->
        <div id="text_menu"></div>
    </navbar>

    <!-- Modal de cadastro -->
    <div class="modal fade container-fluid col-12 animated zoomInDown fast" id="modal-register" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered container-fluid" role="document">
            <form id="register" class="modal-content col-12" action="index.php" method="POST">
                <div id="modal-header" class="container-fluid">
                    <p id="text-header">
                        Torne-se um racer
                    </p>
                    <i id="close-modal" class="material-icons md-30" data-dismiss="modal">close</i>
                </div>
                <div id="modal-body" class="container-fluid">
                    <div class="form-group" style="margin-bottom: 15px">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Endereço de email" name="email" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px">
                        <label for="pwd">Senha</label>
                        <input type="password" class="form-control" id="pwd" placeholder="Senha" style="margin-bottom: 5px" name="senha" required>
                        <input type="password" class="form-control" id="pwd_confirm" placeholder="Confirme sua senha" required>
                    </div>
                </div>
                <div id="modal-footer" class="container-fluid">
                    <center>
                        <div class="row col-12 d-none d-sm-none d-md-none d-lg-flex d-xl-flex" style="padding: 0px" id="button-large">
                            <div id="button-register-login" class="container-fluid col-lg-6 col-12">
                                <div id="register-login" class="col-12 hvr-shrink" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#modal-login">Já tenho conta</div>
                            </div>
                            <div id="button-register-register" class="container-fluid col-lg-6 col-12">
                                <input id="register-register" type="submit" value="Criar conta" name="cadastrar" class="col-12 hvr-shrink">
                            </div>
                        </div>
                        
                        <div class="row col-12 d-block d-sm-block d-md-block d-lg-none d-xl-none" style="padding: 0px">
                            <div id="button-register-register" style="margin-bottom:5px" class="container-fluid col-lg-6 col-12">
                                <input id="register-register" type="submit" value="Criar conta" name="cadastrar" class="col-12 hvr-shrink">
                            </div>
                            <div id="button-register-login" style="margin-bottom:15px" class="container-fluid col-lg-6 col-12">
                                <div id="register-login" class="col-12 hvr-shrink" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#modal-login">Já tenho conta</div>
                            </div>
                        </div>
                    </center>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal de login -->
    <div class="modal fade container-fluid col-12 animated zoomInDown fast" id="modal-login" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered container-fluid" role="document">
            <form id="login" class="modal-content col-12" action="index.php" method="POST">
                <div id="modal-header" class="container-fluid">
                    <p id="text-header">
                        Continue a corrida
                    </p>
                    <i id="close-modal" class="material-icons md-30" data-dismiss="modal">close</i>
                </div>
                <div id="modal-body" class="container-fluid">
                    <div class="form-group" style="margin-bottom: 15px">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Endereço de email" name="email" required>
                    </div>
                    <div class="form-group" style="margin-bottom: 15px">
                        <label for="pwd">Senha</label>
                        <input type="password" class="form-control" id="pwd" placeholder="Senha" name="senha" required>
                    </div>
                </div>
                <div id="modal-footer" class="container-fluid">
                    <center>
                        <div class="row col-12 d-none d-sm-none d-md-none d-lg-flex d-xl-flex" style="padding: 0px">
                            <div id="button-login-register" class="container-fluid col-lg-6 col-12">
                                <div id="login-register" class="col-12 hvr-shrink" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#modal-register">Não tenho conta</div>
                            </div>
                            <div id="button-login-login" class="container-fluid col-lg-6 col-12">
                                <input id="login-login" type="submit" value="Entrar" name="entrar" class="col-12 hvr-shrink">
                            </div>
                        </div>
                        
                        <div class="row col-12 d-block d-sm-block d-md-block d-lg-none d-xl-none" style="padding: 0px">
                            <div id="button-login-login" style="margin-bottom:5px" class="container-fluid col-lg-6 col-12">
                                <input id="login-login" type="submit" value="Entrar" name="entrar" class="col-12 hvr-shrink">
                            </div>
                            <div id="button-login-register" style="margin-bottom:15px" class="container-fluid col-lg-6 col-12">
                                <div id="login-register" class="col-12 hvr-shrink" data-dismiss="modal" aria-label="Close" data-toggle="modal" data-target="#modal-register">Não tenho conta</div>
                            </div>
                        </div>
                    </center>
                </div>
            </form>
        </div>
    </div>

   <div class="container-fluid" id="box-logo">
       <center><img class="img" id="logo-index" src="css/img/logoborder.png"/></center>
       <p id="intro">Uma nova maneira de aprender inglês!<br>Junte-se à corrida!</p>
   </div>
   
    <img id="speedway" src="css/img/speedway.png" width="100%" height="40px" style="margin-top:15px">
    
    <div class="container-fluid" style="width:100%; padding:12px">
    

        <div class="responsive">
            <div class="gallery container" style="padding:0px">
                <img src="css/img/computer.png" width="600" height="400">
                <div class="desc" id="dc1">Aprenda Inglês gratuitamente online onde e quando quiser!</div>
                <div class="overlay" id="ov1">
                    <div class="text">Aprenda Inglês gratuitamente online onde e quando quiser!</div>
                </div>
            </div>
        </div>

        <div class="responsive">
            <div class="gallery container" style="padding:0px">
                <img src="css/img/dictionary.png" width="600" height="400">
                <div class="desc" id="dc2">Aumente seu vocabulário!<br>Com Students Race Dictionary você pode consultar a palavra, aprender sua pronúncia e saber como usá-la.</div>
                <div class="overlay" id="ov2">
                    <div class="text">Aumente seu vocabulário!<br>Com <i>Students Race Dictionary</i> você pode consultar a palavra, aprender sua pronúncia e saber como usá-la.</div>
                </div>
            </div>
        </div>
        
        <div class="responsive">
            <div class="gallery container" style="padding:0px">
                <img src="css/img/questions.png" width="600" height="400">
                <div class="desc" id="dc3">Pratique com perguntas!<br>Cada lição tráz um assunto específico com 10 questões.</div>
                <div class="overlay" id="ov3">
                    <div class="text">Pratique com perguntas!<br>Cada lição tráz um assunto específico com 10 questões.</div>
                </div>
            </div>
        </div>
        
        <div class="responsive">
            <div class="gallery container" style="padding:0px">
                <img src="css/img/responsive.png" width="600" height="400">
                <div class="desc" id="dc4">Acesse também no celular!<br>A plataforma foi desenvolvida para atender usuários desktop e mobile!</div>
                <div class="overlay" id="ov4">
                    <div class="text">Acesse também no celular!<br>A plataforma foi desenvolvida para atender usuários desktop e mobile!</div>
                </div>
            </div>
        </div>
        
        <div class="responsive">
            <div class="gallery container" style="padding:0px">
                <img src="css/img/friends.png" width="600" height="400">
                <div class="desc" id="dc5">Convide seus amigos!<br>O aprendizado é melhor quando há amigos por perto.</div>
                <div class="overlay" id="ov5">
                    <div class="text">Convide seus amigos!<br>O aprendizado é melhor quando há amigos por perto.</div>
                </div>
            </div>
        </div>
        
        <div class="responsive">
            <div class="gallery container" style="padding:0px">
                <img src="css/img/podium.png" width="600" height="400">
                <div class="desc" id="dc6">Ganhe pontos!<br>A cada lição concluída, você ganha pontos que te ajudarão a ultrapassar a linha de chegada!</div>
                <div class="overlay" id="ov6">
                    <div class="text">Ganhe pontos!<br>A cada lição concluída, você ganha pontos que te ajudarão a ultrapassar a linha de chegada!</div>
                </div>
            </div>
        </div>

        <div class="responsive">
            <div class="gallery container" style="padding:0px">
                <img src="css/img/performance.png" width="600" height="400">
                <div class="desc" id="dc7">Acompanhe seu progresso!<br>Fique de olho na sua evolução e aprendizado na plataforma.</div>
                <div class="overlay">
                    <div class="text" id="ov7">Acompanhe seu progresso!<br>Fique de olho na sua evolução e aprendizado na plataforma.</div>
                </div>
            </div>
        </div>
        
        <div class="responsive" style="margin-bottom:15px">
            <div class="gallery container" style="padding:0px">
                <img src="css/img/racers.png" width="600" height="400">
                <div class="desc" id="dc8">Está na hora de competir!<br>Cadastre-se, compartilhe, interaja com seus amigos e dê o seu melhor nessa corrida!<br>Let's go racers!</div>
                <div class="overlay" id="ov8">
                    <div class="text">Está na hora de competir!<br>Cadastre-se, compartilhe, interaja com seus amigos e dê o seu melhor nessa corrida!<br>Let's go racers!</div>
                </div>
            </div>
        </div>
        
    </div>
   
    <a href="#top" class="d-block d-lg-none">
        <div id="btn-top">
            <i id="icon-top" class="material-icons md-42">arrow_upward</i>
        </div>
    </a>
    <script src="js/pagina_inicial.js"></script>
    
    <?php
    if(isset($_POST['entrar'])){
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        
        $senha = hash('sha512', $senha, false); 
        $email = preg_replace('/[^[:alnum:]_.-@]/', '', $email);
        
        $comando = "SELECT id, nome FROM usuarios WHERE email = '$email' AND senha = '$senha'";
        
        if($stmt = mysqli_prepare($link, $comando)){
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $id, $nome_user);
            if(mysqli_stmt_fetch($stmt)){
                if($nome_user != ""){
                    
                    $_SESSION['id_user']   = $id;
                    $_SESSION['nome_user'] = $nome_user;

                    header('Location: home.php');
                    
                }else if($nome_user == ""){
                     $_SESSION['id_user']   = $id;
                    header('Location: completa_cadastro.php');
                    
             }
            }else{
                $_SESSION['alert-login'] = "<div class=\"alert alert-danger alert-dismissible fade show\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Erro!</strong> E-mail ou senha incorretos! Tente novamente.</div>";
                header('Location: index.php');
          }
         }
    }else if(isset($_POST['cadastrar'])){
        
        date_default_timezone_set('America/Sao_Paulo');
        $date = date('Y-m-d H:i:s');
        
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        
        $senha = hash('sha512', $senha, false); 
        $email = preg_replace('/[^[:alnum:]_.-@]/', '', $email);
        
        $pre_comando = "SELECT * FROM `usuarios` WHERE email = '$email'";
        $valida = mysqli_query($link, $pre_comando);
        
        if(mysqli_num_rows($valida) > 0){
            $_SESSION['alert-login'] = "<div class=\"alert alert-danger alert-dismissible fade show\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Erro!</strong> E-mail $email já cadastrado! Tente novamente.</div>";
            header('Location: index.php');
        }else{
            $comando = "INSERT INTO `usuarios` (`ID`, `nome`, `nomeuser`, `email`, `senha`, `estado`, `datanasc`, `foto`, `pontos`, `datahora`) VALUES (NULL, NULL, NULL, '$email', '$senha', NULL, NULL, NULL, 0, '$date')";
            
            
            if(mysqli_query($link, $comando) === TRUE){
             $id = mysqli_insert_id($link);
             $_SESSION['id_user'] = $id;
             header('Location: completa_cadastro.php');
            }
        }
    }
    ?>

</body>

</html>

<!--<i class="material-icons">question_answer</i> ESCRITA-->
<!--<i class="material-icons">hearing</i> AUDIÇÃO-->
<!--<i class="material-icons">library_books</i> MATERIAL DE APOIO-->
<!--<i class="material-icons">play_circle_filled</i> VIDEOS-->
<!--<i class="material-icons">chat</i> chat-->
<!--<i class="material-icons">contacts</i> LISTA DE AMIGOS-->
