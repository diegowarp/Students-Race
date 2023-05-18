<?php
session_start();
$admin = $_SESSION['admin'];
$id_admin = $_SESSION['id_admin'];
include_once("conexao.php");
?>

    <!DOCTYPE html>

    <html lang="pt-br" xmlns="http://www.w3.org/1999/xhtml">

    <head>
        <meta charset="utf-8" />
        <title>Mensagens</title>


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
        
        
        <link rel="stylesheet" href="css/admin_geral.css" media="screen">
        <link rel="stylesheet" href="css/admin_forms.css" media="screen">
        <link rel="stylesheet" href="css/admin_table.css" media="screen">


        <!-- Material Icons - Google -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    </head>

    <body>
        <?php
            $comando = "SELECT palavrasugerida FROM sugestoes WHERE visto = 0";
            $comando2 = "SELECT mensagem FROM mensagens WHERE resposta IS NULL AND visto = 0";

            $palavras = 0;
            $mensagens = 0;

            if($stmt = mysqli_prepare($link, $comando)){
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $palavrasugerida);

                 while(mysqli_stmt_fetch($stmt)){
                     if($palavrasugerida != null){
                         $palavras = $palavras + 1;
                     }
                 }
                 mysqli_stmt_close($stmt);
            }

             if($stmt = mysqli_prepare($link, $comando2)){
                mysqli_stmt_execute($stmt);
                mysqli_stmt_bind_result($stmt, $mensagem);

                 while(mysqli_stmt_fetch($stmt)){
                     if($mensagem != null){
                         $mensagens = $mensagens + 1;
                     }
                 }
                 mysqli_stmt_close($stmt);
            }
              
        ?>

        <!-- Small Menu -->
        <navbar id="menu_small" class="container-fluid">
            <div class="dropdown">
                <div id="logo" data-toggle="dropdown">
                    <img src="css/img/logo.png" id="logo">
                </div>
                <ul class="dropdown-menu main">
                    
                    <!-- HOME -->
                    <li>
                        <a tabindex="-1" href="admin_home.php" class="dropdown-item">Home</a>
                    </li>
                    
                    <!-- MENSAGENS -->
                    <li>
                        <div tabindex="-1" class="dropdown-item" style="padding-right: 0px; background: rgba(255,255,255,0.75); color: rgb(0,0,0); cursor: default">
                            Mensagens
                            <?php
                            if($mensagens > 0){
                                echo "<span id=\"ms\" class=\"badge badge-danger animated wobble infinite\">$mensagens</span>";
                            }?>
                        </div>
                    </li>
                    
                    <!-- DICIONÁRIO -->
                    <li class="dropdown-submenu">
                        <div class="dropdown-item-submenu" tabindex="-1">Dicionário
                            <div id="icon-right">
                                <i class="material-icons md-24">keyboard_arrow_right</i>
                            </div>
                        </div>
                        <ul class="dropdown-menu dropdown-item">
                            <li>
                                <a tabindex="-1" href="admin_aceita_palavra.php" class="dropdown-item">Adicionar palavra</a>
                            </li>
                            <li>
                                <a tabindex="-1" href="admin_listar_dicionario.php" class="dropdown-item">Gerenciar palavras</a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- PALAVRAS SUGERIDAS -->
                    <li>
                        <a tabindex="-1" href="admin_listar_palavras.php" class="dropdown-item">Palavras sugeridas
                            <?php
                            if($palavras > 0){
                                echo "<span id=\"ps\" class=\"badge badge-danger animated wobble infinite\">$palavras</span>";
                            }?>
                        </a>
                    </li>
                    
                    <!-- CONTEÚDO -->
                    <li class="dropdown-submenu">
                        <div class="dropdown-item-submenu" tabindex="-1">Conteúdo
                            <div id="icon-right">
                                <i class="material-icons md-24">keyboard_arrow_right</i>
                            </div>
                        </div>
                        <ul class="dropdown-menu dropdown-item">
                            <li>
                                <a tabindex="-1" href="admin_cadastra_unidade.php" class="dropdown-item">Adicionar unidade</a>
                            </li>
                            <li>
                                <a tabindex="-1" href="admin_cadastra_licao.php" class="dropdown-item">Adicionar lição</a>
                            </li>
                            <li>
                                <a tabindex="-1" href="admin_cadastra_pergunta.php" class="dropdown-item">Adicionar pergunta</a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- ARQUIVOS -->
                    <li class="dropdown-submenu">
                        <div class="dropdown-item-submenu" tabindex="-1">Arquivos
                            <div id="icon-right">
                                <i class="material-icons md-24">keyboard_arrow_right</i>
                            </div>
                        </div>
                        <ul class="dropdown-menu dropdown-item">
                            <li>
                                <a tabindex="-1" href="admin_arquivos_palavras.php" class="dropdown-item">Palavras sugeridas</a>
                            </li>
                            <li>
                                <a tabindex="-1" href="admin_arquivos_mensagens.php" class="dropdown-item">Mensagens</a>
                            </li>
                        </ul>
                    </li>
                    
                    <!-- ADMNISTRADOR -->
                    <li class="dropdown-submenu">
                        <div class="dropdown-item-submenu" tabindex="-1">Administrador
                            <div id="icon-right">
                                <i class="material-icons md-24">keyboard_arrow_right</i>
                            </div>
                        </div>
                        <ul class="dropdown-menu dropdown-item">
                            <li>
                                <a tabindex="-1" href="admin_altera_senha.php" class="dropdown-item">Alterar senha</a>
                            </li>
                            <li>
                                <a tabindex="-1" href="admin_cadastra_admin.php" class="dropdown-item">Cadastrar<br>administrador</a>
                            </li>
                        </ul>
                    </li>
                    
                </ul>
            </div>

            <a href="admin_finaliza_sessao.php">
                <div id="icon_menu_logout">
                    <i id="icon_logout" class="material-icons md-42">power_settings_new</i>
                </div>
            </a>
        </navbar>

        <!-- Large Menu -->
        <navbar id="menu_large" class="container-fluid">
            <div id="logo">
                <img src="css/img/logo.png" id="logo">
            </div>

            <!-- HOME -->
            <a href="admin_home.php">
                <div id="icons_home" class="hvr-grow icons_menu">
                    <i class="material-icons md-42" style="padding-left: 10px">home</i>
                </div>
            </a>

            <div id="icons_posts" class="hvr-grow icons_menu" style="color: rgba(255,255,255,1); cursor: default">
                <i class="material-icons md-42">chat</i>
                <?php
                if($mensagens > 0){
                    echo "<span id=\"m\" class=\"badge badge-danger animated wobble infinite\">$mensagens</span>";
                }
                ?>
            </div>
            
            <!-- DICIONÁRIO -->
            <div class="dropdown large">
                <div id="icons_dictionary" data-toggle="dropdown" class="hvr-grow icons_menu">
                    <i class="material-icons md-42">import_contacts</i>
                </div>
                <ul class="dropdown-menu main" id="drop-dictionary" style="left: 255px; top: 61px">
                    <li>
                        <a class="dropdown-item hvr-grow" href="admin_aceita_palavra.php">Adicionar palavra</a>
                    </li>
                    <li>
                        <a class="dropdown-item hvr-grow" href="admin_listar_dicionario.php">Gerenciar palavras</a>
                    </li>
                </ul>
            </div>
            
            <!-- PALAVRAS SUGERIDAS -->
            <a href="admin_listar_palavras.php">
                <div id="icons_words" class="hvr-grow icons_menu">
                    <i class="material-icons md-42">list</i>
                    <?php
                    if($palavras > 0){
                        echo "<span id=\"p\" class=\"badge badge-danger animated wobble infinite\">$palavras</span>";
                    }
                    ?>
                </div>
            </a>

            <!-- CONTEÚDO -->
            <div class="dropdown large">
                <div id="icons_content" data-toggle="dropdown" class="hvr-grow icons_menu">
                    <i class="material-icons md-42">class</i>
                </div>
                <ul class="dropdown-menu main" id="drop-content" style="left: 359px; top: 61px">
                    <li>
                        <a class="dropdown-item hvr-grow" href="admin_cadastra_unidade.php">Adicionar unidade</a>
                    </li>
                    <li>
                        <a class="dropdown-item hvr-grow" href="admin_cadastra_licao.php">Adicionar lição</a>
                    </li>
                    <li class="dropdown-submenu">
                        <a class="dropdown-item hvr-grow" href="admin_cadastra_pergunta.php">Adicionar pergunta</a>
                    </li>
                </ul>
            </div>
            
            <!-- ARQUIVOS -->
            <div class="dropdown large">
                <div id="icons_files" data-toggle="dropdown" class="hvr-grow icons_menu">
                    <i class="material-icons md-42">folder</i>
                </div>
                <ul class="dropdown-menu main" id="drop-files" style="left: 411px; top: 61px">
                    <li>
                        <a class="dropdown-item hvr-grow" href="admin_arquivos_palavras.php">Palavras sugeridas</a>
                    </li>
                    <li>
                        <a class="dropdown-item hvr-grow" href="admin_arquivos_mensagens.php">Mensagens</a>
                    </li>
                </ul>
            </div>

            <!-- ADMINISTRADOR -->
            <div class="dropdown large">
                <div id="icons_admin" data-toggle="dropdown" class="hvr-grow icons_menu">
                    <i class="material-icons md-42">person</i>
                </div>
                <ul class="dropdown-menu main" id="drop-admin" style="left: 463px; top: 61px">
                    <li>
                        <a class="dropdown-item hvr-grow" href="admin_altera_senha.php">Alterar senha</a>
                    </li>
                    <li>
                        <a class="dropdown-item hvr-grow" href="admin_cadastra_admin.php">Cadastrar administrador</a>
                    </li>
                </ul>
            </div>
            
            <!-- Nome dos ícones -->
            <div id="text_menu">Mensagens</div>

            <!-- Finalizar sessão -->
            <a id="logout" href="admin_finaliza_sessao.php">
                <div id="icon_menu_logout" role="button" style="display: inline-block; float: right">
                    <i id="icon_logout" class="material-icons md-42">power_settings_new</i>
                </div>
                <!-- Sair -->
                <div id="text_logout" style="opacity: 0; transition:0.25s">Sair</div>
            </a>
        </navbar>

        <div id="content" class="container-fluid row">

            <!-- Menu Esquerdo -->
            <nav id="menu-left" class="col-lg-2 col-md-3 d-none d-md-block">
                    <img id="img-perfil" src="css/img/admin.png" class="img-thumbnail" alt="Foto do perfil">
                    <center id="side-profile">
                        <p id="name">
                            <?php echo $admin; ?>
                        </p>
                        <div id="items-nav-profile">
                            <strong id="item">Administrador</strong>
                        </div>
                    </center>
                </nav>
            <!-- Corpinho -->
                <div id="box_body" class="container col-12 col-lg-10 col-md-9">
                    <div id="body" class="animated zoomInDown">
                        <div id="modal-header" class="container-fluid">
                            <p id="text-header">
                                Caixa de mensagens
                            </p>
                        </div>
                        <div id="modal-body" class="container-fluid">
                            <?php

                                $comando3 = "SELECT u.nomeuser, m.ID, m.mensagem, m.datahora FROM usuarios u INNER JOIN mensagens m ON (u.ID = m.CODusuario) WHERE resposta IS NULL AND visto = 0";



                                if($stmt = mysqli_prepare($link, $comando3)){
                                    mysqli_stmt_execute($stmt);
                                    mysqli_stmt_bind_result($stmt, $nomeuser, $idmensagem, $mensagem_user, $datahora);

                                    if($mensagens >= 1){
                                        echo "<div class=\"table-responsive\">";
                                        echo "<table class=\"table table-bordered\">";
                                        echo "<thead>";
                                            echo "<tr>";
                                                echo "<th scope=\"col\" style=\"border-left: 0px\">
                                                            Data de envio
                                                      </th>";            
                                                echo "<th scope=\"col\">
                                                            Usuário
                                                      </th>";
                                                echo "<th scope=\"col\" style=\"padding-right: 118px; padding-left: 118px\">
                                                            Mensagem
                                                      </th>";
                                                echo "<th scope=\"col\" style=\"padding-right: 111px; padding-left: 110px\">
                                                            Resposta
                                                      </th>";
                                                echo "<th scope=\"col\" style=\"padding-right: 39px; padding-left: 40px\">
                                                            Ação
                                                      </th>";
                                            echo "</tr>";
                                        echo "</thead>";
                                        echo "<tbody>";

                                    }else{
                                         echo "<p id=\"null\">Não há mensagens no momento.</p>";
                                    }

                                    while (mysqli_stmt_fetch($stmt)) {
                                        $novadata = strtotime($datahora);
                                    ?>

                                    <tr>
                                        <td style="border-left: 0px"><?php echo date('d/m/Y H:i:s', $novadata);?></td>
                                        <td><?php echo $nomeuser;?></td>
                                        <td><?php echo utf8_encode($mensagem_user);?></td>
                                        <form action="admin_back_envia_resposta.php" method="POST">
                                            <td><textarea class="form-control" name="resposta" rows="4"></textarea><input type="hidden" name="idmensagem" value="<?php echo $idmensagem;?>"></td>
                                            <td>
                                                <div id="div-action">
                                                    <a style="display: inline-block" href="admin_back_envia_resposta.php?idmensagem=<?php echo $idmensagem;?>" data-confirm="">
                                                        <div id="btn-clear" style="display: inline-block; margin-right: 5px" data-toggle="modal" data-target="#modal-confirm" class="hvr-grow">
                                                            <i id="clear" class="material-icons md-30" title="Ignorar mensagem">clear</i>
                                                        </div>
                                                    </a>
                                                    <button type="submit" id="btn-send" name="enviar" class="hvr-grow">
                                                        <i id="send" class="material-icons md-30" title="Enviar resposta">send</i>
                                                    </button>
                                                </div>
                                            </td>
                                        </form>
                                    </tr>
                                    <?php
                                    }

                                    mysqli_stmt_close($stmt);

                                    echo  "<tbody>";
                                    echo "</table>";
                                    echo "</div>";
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <script src="js/admin_geral.js"></script>
            <script src="js/admin_listar_mensagens.js"></script>
    </body>

    </html>
<script>
    $(document).ready(function() {
        $('a[data-confirm]').click(function(ev) {
            var href = $(this).attr('href');

            if (!$('#confirm-delete').length) {
                $('body').append('<div class="modal container-fluid col-12" id="confirm-delete" role="dialog"><div class="modal-dialog modal-md modal-dialog-centered container-fluid" role="document"><div id="delete-modal" class="modal-content animated zoomInDown"><div id="modal-header" class="container-fluid"><p id="text-header" style="padding-right: 25px; padding-left: 25px">Confirmação de exclusão</p><i id="close-modal" class="material-icons md-30" data-dismiss="modal">close</i></div><div id="modal-body" class="container-fluid"><p id="alert">Tem certeza de que deseja ignorar essa mensagem? Essa ação não pode ser desfeita.</p></div><div id="modal-footer" class="container-fluid"><center><div class="row col-12" style="padding: 0px"><div id="button-cancel" class="container-fluid col-lg-6 col-12"><div id="btn-cancel" class="col-12 hvr-shrink" data-dismiss="modal">Cancelar</div></div><div id="button-edit" class="container-fluid col-lg-6 col-12"><a style="color: #FFFFFF;" class="btn col-12 hvr-shrink" id="data-confirmOk" name="ignorar">Ignorar</a></div></div></center></div></div></div></div>');
            }
            $('#data-confirmOk').attr('href', href);
            $('#confirm-delete').modal({
                shown: true
            });
            return false;
        });
    });
</script>