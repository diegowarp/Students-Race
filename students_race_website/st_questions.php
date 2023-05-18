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

//Variáveis da plataforma. São hiper importantes! Be careful!
$unidadeID = $_GET['unitID'];
$licaoID = $_GET['lessonID'];

$_SESSION['unidade'] = $unidadeID;
$_SESSION['licao'] = $licaoID;

$_SESSION['id_pergunta'] = array();
$_SESSION['resposta'] = array();

$_SESSION['pontos'] = 0;
?>

<!DOCTYPE html>
<html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <title>Students Race - Time to practice!</title>


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

    <!--[if IE]> <link rel="stylesheet" href="css/ie.css" media="screen"> <![endif]-->

    
    <!-- Material Icons - Google -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <link rel="shortcut icon" type="image/png" href="css/img/favicon.ico"/>
</head>

<body>
    <?php  
    $comando = "SELECT pontos, foto FROM usuarios WHERE ID = '$id_user'";
    
    if($stmt = mysqli_prepare($link, $comando)){
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $pontos, $foto);
            if(mysqli_stmt_fetch($stmt)){
            }
    }
    mysqli_stmt_close($stmt);
    
    ?>
    <!-- Small Menu -->
    <navbar id="menu_small" class="container-fluid">


        <div class="dropdown">
            <div id="logo" data-toggle="dropdown">
                <img src="painel_admin/css/img/logo.png" id="logo">
            </div>
            <div class="dropdown-menu" id="drop-menu">
                <a class="dropdown-item" href="home.php">Unidades</a>
                <a class="dropdown-item" href="profile.php">Meu perfil</a>
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
        <div id="logo">
            <img src="painel_admin/css/img/logo.png" id="logo">
        </div>
        <a href="home.php">
            <div id="icons_home" class="hvr-grow icons_menu">
                <i class="material-icons md-42" style="padding-left: 10px">book</i>
            </div>
        </a>

        <a href="profile.php">
            <div id="icons_perfil" class="hvr-grow icons_menu">
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
        <div id="text_menu">Perguntas</div>

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
        <!-- Menu Esquerdo -->
        <nav id="menu-left" class="col-2 d-none d-lg-block">
            <div id="img-perfil" style='background-image: url("usuarios/<?php echo $foto; ?>")'></div>
            <center id="side-profile">
                <p id="name">
                    <?php echo $nome_user; ?>
                </p>
                <div id="items-nav-profile">
                    <strong id="item">Pontos: </strong>
                    <?php echo $pontos; ?><br>
                </div>
            </center>

            <a href="profile.php">
                <div id="option-menu-perfil" class="col-xs-12">
                    Meu perfil
                </div>
            </a>

            <!--
            <div id="option-menu-friends" class="col-xs-12">
                Meus amigos
            </div>

            <div id="option-menu-performance" class="col-xs-12" style="margin-bottom: 0px">
                Meu desempenho
            </div>
            -->
            
        </nav>

        <!-- Corpinho -->
        <div id="box_body" class="container col-12 col-lg-8 animated zoomInDown">
            <?php
                $comando1 = "SELECT ID, pergunta, alternativa1, alternativa2, alternativa3, resposta FROM perguntas WHERE CODlicao = '$licaoID'";

                if($stmt = mysqli_prepare($link, $comando1)){
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id, $pergunta, $alternativa1, $alternativa2, $alternativa3, $resposta);
                    $i = 0;
                    while(mysqli_stmt_fetch($stmt)){
                        $_SESSION['id_pergunta'][$i] = $id;
                        $_SESSION['resposta'][$i] = $resposta;
                        $i++;
                    }
                }

                echo '<script>$answer = "'. $_SESSION['resposta'][0].'";</script>';
                $comando2 = "SELECT ID, pergunta, alternativa1, alternativa2, alternativa3, resposta FROM perguntas WHERE ID = '".$_SESSION['id_pergunta'][0]."'";
            
                $nome_licao_atual = "SELECT Licao FROM licoes WHERE ID = '$licaoID'";
            
                if($stmt = mysqli_prepare($link, $nome_licao_atual)){
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $nome_licao);
                    if((mysqli_stmt_fetch($stmt))){
                        $p = 0;
                    }
                     mysqli_stmt_close($stmt);
                }

                if($stmt = mysqli_prepare($link, $comando2)){
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_bind_result($stmt, $id, $pergunta, $alternativa1, $alternativa2, $alternativa3, $resposta);
                if((mysqli_stmt_fetch($stmt))){
                    
                    echo "<form id=\"question\" class=\"container-fluid\" style=\"padding:0px;\" action=\"questions.php\" name=\"perguntas\" method=\"POST\">";
                    echo "<div id=\"modal-header\" style=\"position: sticky; top: 0px; z-index: 10\" class=\"container-fluid\"><p id=\"text-header\">".ucfirst($nome_licao)."</p></div>";
                echo "<div id=\"modal-body\" class=\"container-fluid align-self-middle;\">";
                    echo "<p id=\"statement\">$pergunta</p>";
                    
                      
                      
                    $escolhas = array("<li><input id=\"atv1\" type=\"radio\" name=\"resposta\" value=\"$alternativa1\"><div class=\"check\"></div><label for=\"atv1\">$alternativa1</label></li>",
                                      
                    "<li><input id=\"atv2\" type=\"radio\" name=\"resposta\" value=\"$alternativa2\"><div class=\"check\"></div><label for=\"atv2\">$alternativa2</label></li>",
                                      
                    "<li><input id=\"atv3\" type=\"radio\" name=\"resposta\" value=\"$alternativa3\"><div class=\"check\"></div><label  for=\"atv3\">$alternativa3</label></li>",
                                      
                    "<li class=\"answer\"><input id=\"atv4\" type=\"radio\" name=\"resposta\" value=\"$resposta\"><div class=\"check\"></div><label for=\"atv4\">$resposta</label></li>");


                    shuffle($escolhas);
                      
                    echo "<div id=\"line\"></div><ul>";

                    echo $escolhas[0];
                    echo $escolhas[1];
                    echo $escolhas[2];
                    echo $escolhas[3];
                      
                    echo "</ul><div id=\"line\" style=\"margin-top:15px\"></div>";
                      
                    $_SESSION['progresso'] = 0;
                      
                    echo "<div class=\"progress\" style=\"margin-bottom: 15px\"><div class=\"progress-bar progress-bar-striped bg-dark\" role=\"progressbar\" style=\"width: {$_SESSION['progresso']}%\" aria-valuenow=\"100\" aria-valuemin=\"0\" aria-valuemax=\"100\"></div></div>";
                      
                    echo "<div id=\"line\"></div>";
                      
                    echo "<input type=\"submit\" value=\"Verificar\" id=\"btn_question\" class=\"col-12 hvr-forward\">";
                    echo "<div id=\"loader\" class=\"container\"></div>";
                      
                    echo "</div>";
                    echo "</form>";
                } 
            }

            $_SESSION['contador'] = 1;
            ?>
            
            
        </div>

        <!-- Menu Direito -->
        <nav id="menu-right" class="col-2 d-none d-lg-block">


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
    <script src="js/dicionario.js"></script>
    <script src="js/questions.js"></script>
</body>

</html>
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
    $('input#btn_question').click(function(){
        $resposta_user = $("input[name='resposta']:checked").val();
        $('div.check').hide(0250);
         if($resposta_user == "" || $resposta_user == null){
             event.preventDefault();
           alert("Escolha uma alternativa!");
        }else{
        if($answer == $resposta_user){
            $('li.answer').addClass('correct');
            $('div#loader').append("<div class=\"row text-center\"><div class=\"centered\"><div class=\"blob-1 correct\"></div><div class=\"blob-2 correct\"></div></div></div>");
        }else{
            $('li.answer').addClass('wrong');
            $('div#loader').append("<div class=\"row text-center\"><div class=\"centered\"><div class=\"blob-1 wrong\"></div><div class=\"blob-2 wrong\"></div></div></div>");
        }
        $('input#btn_question').addClass('animated fadeOut');
        }
        
    });

</script>
<!--<i class="material-icons">question_answer</i> ESCRITA-->
<!--<i class="material-icons">hearing</i> AUDIÇÃO-->
<!--<i class="material-icons">library_books</i> MATERIAL DE APOIO-->
<!--<i class="material-icons">play_circle_filled</i> VIDEOS-->
<!--<i class="material-icons">chat</i> chat-->
<!--<i class="material-icons">contacts</i> LISTA DE AMIGOS-->
