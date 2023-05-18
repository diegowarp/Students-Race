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
        <title>Dicionário - Gerenciar palavras</title>


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
        <link rel="stylesheet" href="css/admin_dicionario.css" media="screen">


        <style>
    
            
        @media screen and (min-width: 800px) and (max-width: 825px) {
            .table-responsive {
                max-height: calc(100vh - 187px);
            }
        }
        @media screen and (max-width: 810px) {
            .table-responsive {
                max-height: calc(100vh - 240px);
            }
        }
        @media screen and (max-width: 800px) {
            .table-responsive {
                max-height: calc(100vh - 222px);
            }
        }
        @media screen and (max-width: 768px) {
            .table-responsive {
                max-height: calc(100vh - 183px);
            }
        }
        @media screen and (max-width: 576px) {
            .table-responsive {
                max-height: calc(100vh - 174px);
            }
        }@media screen and (max-width: 478px) {
            .table-responsive {
                max-height: calc(100vh - 201px);
            }
        }@media screen and (max-width: 300px) {
            .table-responsive {
                max-height: calc(100vh - 228px);
            }
        }
            
        </style>
        
        <!-- Material Icons - Google -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    </head>

    <body>
        <?php
        //para consulta específica: SELECT u.nome, s.palavrasugerida, s.mensagem, s.datahora FROM sugestoes s INNER JOIN usuarios u ON (s.CODusuario = u.ID)
        
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
                    
                    <!-- DICIONÁRIO -->
                    <li class="dropdown-submenu">
                        <div class="dropdown-item-submenu" tabindex="-1" style="padding-right: 0px; background: rgba(255,255,255,0.75); color: rgb(0,0,0); cursor: default">Dicionário
                            <div id="icon-right">
                                <i class="material-icons md-24">keyboard_arrow_right</i>
                            </div>
                        </div>
                        <ul class="dropdown-menu dropdown-item">
                            <li>
                                <a class="dropdown-item" href="admin_aceita_palavra.php">Adicionar palavra</a>
                            </li>
                            <li>
                                <div tabindex="-1" class="dropdown-item" style="padding-right: 0px; background: rgba(255,255,255,0.75); color: rgb(0,0,0); cursor: default">Gerenciar palavras</div>
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
                                <a tabindex="-1" href="admin_listar_admins.php" class="dropdown-item">Administradores</a>
                            </li>
                            <li>
                                <a tabindex="-1" href="admin_cadastra_admin.php" class="dropdown-item">Cadastrar<br>administrador</a>
                            </li>
                            <li>
                                <a tabindex="-1" href="admin_altera_senha.php" class="dropdown-item">Alterar senha</a>
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
            
            <!-- DICIONÁRIO -->
            <div class="dropdown large">
                <div id="icons_dictionary" data-toggle="dropdown" class="hvr-grow icons_menu" style="color: rgba(255,255,255,1); cursor: default">
                    <i class="material-icons md-42">import_contacts</i>
                </div>
                <ul class="dropdown-menu main" id="drop-dictionary" style="left: 203px; top: 61px">
                    <li>
                        <a class="dropdown-item hvr-grow" href="admin_aceita_palavra.php">Adicionar palavra</a>
                    </li>
                    <li>
                        <div tabindex="-1" class="dropdown-item hvr-grow" style="background: rgba(255,255,255,0.75); color: rgb(0,0,0); cursor: default">Gerenciar palavras</div>
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
                <ul class="dropdown-menu main" id="drop-content" style="left: 307px; top: 61px">
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
                <ul class="dropdown-menu main" id="drop-files" style="left: 359px; top: 61px">
                    <li>
                        <a class="dropdown-item hvr-grow" href="admin_arquivos_palavras.php">Palavras sugeridas</a>
                    </li>
                </ul>
            </div>

            <!-- ADMINISTRADOR -->
            <div class="dropdown large">
                <div id="icons_admin" data-toggle="dropdown" class="hvr-grow icons_menu">
                    <i class="material-icons md-42">person</i>
                </div>
                <ul class="dropdown-menu main" id="drop-admin" style="left: 411px; top: 61px">
                    <li>
                        <a class="dropdown-item hvr-grow" href="admin_listar_admins.php">Administradores</a>
                    </li>
                    <li>
                        <a class="dropdown-item hvr-grow" href="admin_cadastra_admin.php">Cadastrar administrador</a>
                    </li>
                    <li>
                        <a class="dropdown-item hvr-grow" href="admin_altera_senha.php">Alterar senha</a>
                    </li>
                </ul>
            </div>
            
            <!-- Nome dos ícones -->
            <div id="text_menu">Dicionário - Gerenciar palavras</div>

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
                                Conteúdo do <i>Students Race Dictionary</i>
                            </p>
                        </div>
                        <div id="modal-body" class="container-fluid">
                        <?php
		                if(isset($_SESSION['mensagem'])){
			                echo $_SESSION['mensagem'];
			                unset($_SESSION['mensagem']);
                        }
                        ?>
                        
                        <?php
                        
                        $comando3 = "SELECT id, palavra, traducao, classe, definicao, exemplo FROM dicionario";
                        
                        if($stmt = mysqli_prepare($link, $comando3)){
                            mysqli_stmt_execute($stmt);
                            mysqli_stmt_bind_result($stmt, $id_palavradb, $palavra, $traducao, $classe, $definicao, $exemplo);
                            
                            echo "<div class=\"table-responsive\">";
                            echo "<table class=\"table table-bordered\">";
                            echo "<thead>";
                            echo "<tr>";
                                echo "<th scope=\"col\" style=\"border-left: 0px\">Palavra</th>";            
                                echo "<th scope=\"col\">Tradução</th>";
                                echo "<th scope=\"col\">Classe</th>";
                                echo "<th scope=\"col\">Definição</th>";
                                echo "<th scope=\"col\">Exemplo</th>";
                                echo "<th scope=\"col\" style=\"padding-right: 39px; padding-left: 40px\">Ação</th>";
                            echo "</tr>";
                            echo "</thead>";
                            echo "<tbody>";
        
                            while (mysqli_stmt_fetch($stmt)) {
                             ?>
                            
                            <tr>
                                <td style="border-left: 0px"><?php echo utf8_encode(ucfirst($palavra));?></td>
                                <td><?php echo ucfirst($traducao);?></td>
                                <td><?php echo ucfirst($classe);?></td>
                                <td><?php echo utf8_encode(ucfirst($definicao));?></td>
                                <td><?php echo utf8_encode(ucfirst($exemplo));?></td>
                                    
            
                        <?php 
                            echo "<td>
                                    <div id=\"div-action\">
                                    
                                        <a style=\"display: inline-block\" href=\"admin_back_exclui_palavra.php?idpalavra=$id_palavradb&palavra=$palavra\" data-confirm=\"\">
                                            <div id=\"btn-delete\" style=\"display: inline-block; margin-right: 5px\" data-toggle=\"modal\" data-target=\"#modal-confirm\" class=\"hvr-grow\">
                                                <i id=\"delete\" class=\"material-icons md-30\" title=\"Excluir palavra\">delete_sweep</i>
                                            </div>
                                        </a>
                            
                                        <a style=\"display: inline-block\" href=\"admin_edita_dicionario.php?idpalavra=$id_palavradb\">
                                            <button id=\"btn-edit\" class=\"hvr-grow\">
                                                <i id=\"edit\" class=\"material-icons md-30\" title=\"Editar palavra\">edit</i>
                                            </button>
                                        </a>
                                        
                                    </div>
                                  </td>";
                            echo "</tr>";
    
                            }
                        }
                        mysqli_stmt_close($stmt);

                        echo "<tbody>";
                        echo "</table>";
                        echo "</div>";
                        ?>
                        </div>
                    </div>
                </div>
            </div>

        
        
        <script src="js/admin_geral.js"></script>
        <script src="js/admin_listar_dicionario.js"></script>
        <script src="js/modal_delete.js"></script>
    </body>

    </html>
<script>
    $(document).ready(function() {
        $('a[data-confirm]').click(function(ev) {
            var href = $(this).attr('href');

            if (!$('#confirm-delete').length) {
                $('body').append('<div class="modal container-fluid col-12" id="confirm-delete" role="dialog"><div class="modal-dialog modal-md modal-dialog-centered container-fluid" role="document"><div id="delete-modal" class="modal-content animated zoomInDown"><div id="modal-header" class="container-fluid"><p id="text-header" style="padding-right: 25px; padding-left: 25px">Confirmação de exclusão</p><i id="close-modal" class="material-icons md-30" data-dismiss="modal">close</i></div><div id="modal-body" class="container-fluid"><p id="alert">Tem certeza de que deseja excluir essa palavra? Essa ação não pode ser desfeita.</p></div><div id="modal-footer" class="container-fluid"><center><div class="row col-12" style="padding: 0px"><div id="button-cancel" class="container-fluid col-lg-6 col-12"><div id="btn-cancel" class="col-12 hvr-shrink" data-dismiss="modal">Cancelar</div></div><div id="button-edit" class="container-fluid col-lg-6 col-12"><a style="color: #FFFFFF;" class="btn col-12 hvr-shrink" id="data-confirmOk">Apagar</a></div></div></center></div></div></div></div>');
            }
            $('#data-confirmOk').attr('href', href);
            $('#confirm-delete').modal({
                shown: true
            });
            return false;
        });
    });
</script>
