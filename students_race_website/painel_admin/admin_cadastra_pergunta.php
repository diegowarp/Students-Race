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
        <title>Cadastrar pergunta</title>


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
        <link rel="stylesheet" href="css/admin_content.css" media="screen">


        <!-- Material Icons - Google -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <script type="text/javascript">
            function validar(){
				var unidade = formuser.unidade.value;
				var licao = formuser.licao.value;
                
                if(unidade == ""){
                    alert('Selicione uma unidade de aprendizado.');
                    formuser.unidade.focus();
                    return false;
                }
                
                if(licao == ""){
                    alert('Selecione uma lição.');
                    formuser.licao.focus();
                    return false;
                }
				
			}
        </script>
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
                    
                    <!-- DICIONÁRIO -->
                    <li class="dropdown-submenu">
                        <div class="dropdown-item-submenu" tabindex="-1">Dicionário
                            <div id="icon-right">
                                <i class="material-icons md-24">keyboard_arrow_right</i>
                            </div>
                        </div>
                        <ul class="dropdown-menu dropdown-item">
                            <li>
                                <a class="dropdown-item" href="admin_aceita_palavra.php">Adicionar palavra</a>
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
                        <div class="dropdown-item-submenu" tabindex="-1" style="padding-right: 0px; background: rgba(255,255,255,0.75); color: rgb(0,0,0); cursor: default">Conteúdo
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
                                <div tabindex="-1" style="padding-right: 0px; background: rgba(255,255,255,0.75); color: rgb(0,0,0); cursor: default" class="dropdown-item">Adicionar pergunta</div>
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
                <div id="icons_dictionary" data-toggle="dropdown" class="hvr-grow icons_menu">
                    <i class="material-icons md-42">import_contacts</i>
                </div>
                <ul class="dropdown-menu main" id="drop-dictionary" style="left: 203px; top: 61px">
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
                <div id="icons_content" data-toggle="dropdown" class="hvr-grow icons_menu" style="color: rgba(255,255,255,1); cursor: default">
                    <i class="material-icons md-42">class</i>
                </div>
                <ul class="dropdown-menu main" id="drop-content" style="left: 307px; top: 61px">
                    <li>
                        <a class="dropdown-item hvr-grow" href="admin_cadastra_unidade.php">Adicionar unidade</a>
                    </li>
                    <li>
                        <a class="dropdown-item hvr-grow" href="admin_cadastra_licao.php">Adicionar lição</a>
                    </li>
                    <li>
                        <div class="dropdown-item hvr-grow" style="background: rgba(255,255,255,0.75); color: rgb(0,0,0); cursor: default">Adicionar pergunta</div>
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
            <div id="text_menu">Conteúdo - Adicionar pergunta</div>

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
                <form id="body" name="formuser" action="admin_back_cadastra_pergunta.php" method="POST" enctype="multipart/form-data" class="animated zoomInDown">
                    <div id="modal-header" class="container-fluid">
                    <p id="text-header">
                        Adicionar pergunta
                    </p>
                </div>
                <div id="modal-body" class="container-fluid">
                    <?php
		            if(isset($_SESSION['mensagem'])){
			            echo $_SESSION['mensagem'];
			            unset($_SESSION['mensagem']);
                    }
                    ?>
                    <div class="form-group" style="margin-bottom: 15px">
                        <label for="unidade">Unidade</label>
                        <select class="form-control" id="unidade" name="unidade" onchange="carregar(this.id, 'sel2')" required>
                            <option value=""></option>
                            <?php
                            $comando3 = "SELECT ID, Unidade FROM unidades";
                                            
                            if($stmt = mysqli_prepare($link, $comando3)){
                                mysqli_stmt_execute($stmt);
                                mysqli_stmt_bind_result($stmt, $id_unidade, $unidade);
                                while(mysqli_stmt_fetch($stmt)){
                                    echo "<option value=\"$id_unidade\">".utf8_encode($unidade)."</option>";   
                                }
                            }
                            ?>
                        </select>
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 15px">
                        <label for="licao">Lição</label>
                        <select class="form-control" id="licao" name="licao" required>
                            
                        </select>
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 15px">
                        <label for="pergunta">Pergunta</label>
                        <textarea class="form-control" name="pergunta" id="" rows="4" placeholder="Digite o enunciado da questão" required></textarea>
                    </div>
                    
                    <div class="form-group" style="margin-bottom: 15px">
                        <label for="resposta">Respostas</label>
                        <input class="form-control" id="resposta" style="margin-bottom: 5px" name="resposta" placeholder="Resposta correta" required>
                        <input class="form-control" name="alternativa1" style="margin-bottom: 5px" placeholder="Alternativa 1" required>
                        <input class="form-control" name="alternativa2" style="margin-bottom: 5px" placeholder="Alternativa 2" required>
                        <input class="form-control" name="alternativa3" placeholder="Alternativa 3" required>
                    </div>
                </div>
                 
                <div id="modal-footer" class="container-fluid">
                        <center>
                            <div class="row col-12" style="padding: 0px">
                                <div id="button-cancel" class="container-fluid col-lg-6 col-12">
                                    <a href="admin_home.php">
                                        <input id="btn-cancel" type="button" value="Cancelar" class="col-12 hvr-shrink">
                                    </a>
                                </div>
                                <div id="button-edit" class="container-fluid col-lg-6 col-12">
                                    <input id="btn-edit" type="submit" value="Cadastrar" name="adicionar" class="col-12 hvr-shrink" onclick="return validar()">
                                </div>
                            </div>
                        </center>
                    </div>
            </form>
        </div>
    </div>

    <script src="js/admin_geral.js"></script>
    <script src="js/admin_cadastra_pergunta.js"></script>
    <script src="js/admin_image.js"></script>
    </body>

</html>
<script>
     $(document).ready(function(){
         $('#unidade').change(function(){
             var unidade_id = $(this).val();
             $.ajax({
                 url:"aj_busca_licao.php",
                 method: "POST",
                 data: {unidadeID:unidade_id},
                 dataType: "text",
                 success: function(data)
                 {
                     $('#licao').html(data);
                 }
             });
         });
     });      
    </script>
    <!--<i class="material-icons">question_answer</i> ESCRITA-->
    <!--<i class="material-icons">hearing</i> AUDIÇÃO-->
    <!--<i class="material-icons">library_books</i> MATERIAL DE APOIO-->
    <!--<i class="material-icons">play_circle_filled</i> VIDEOS-->
    <!--<i class="material-icons">chat</i> chat-->
    <!--<i class="material-icons">contacts</i> LISTA DE AMIGOS-->
