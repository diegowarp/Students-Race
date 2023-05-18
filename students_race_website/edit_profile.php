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
    <title>Students Race - Change Profile</title>


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
            <div id="icons_perfil" class="hvr-grow icons_menu" style="color: rgba(255,255,255,1); cursor: pointer">
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
            <form action="edit_profile.php" method="POST" enctype="multipart/form-data" id="body" class="animated zoomInDown profile" style="padding:0;overflow-x:hidden;">
                <div id="modal-header" class="container-fluid profile" style="position:sticky;top:0;z-index:3">
                    <p id="text-header" class="profile">
                        My profile
                    </p>
                </div>
                
                <div id="modal-body" class="container-fluid" style="padding-top:0px">
                    <center>
                        <div class="col-12 col-sm-12 col-md-10 col-lg-8" style="padding:0px">
                            <div class="form-group" id="div_name" style="margin-bottom: 15px">
                                <label for="name">Nome</label>
                                <input type="text" class="form-control" id="name" placeholder="Nome" name="nome" style="margin-bottom: 5px" value="<?php echo $nome;?>" required>
                                <input type="text" class="form-control" id="last_name" placeholder="Sobrenome" name="sobrenome" value="<?php echo $sobrenome;?>" required>
                            </div>
                            
                            <div class="form-group" style="margin-bottom: 15px">
                                <label for="birth">Data de nascimento</label>
                                <div class="input-group date">
                                    <input type="text" class="form-control" id="date_birth" placeholder="Data de nascimento" name="datanasc" value="<?php echo date('d/m/Y', $datanasc);?>"required>
                                </div>
                            </div>

                            <div class="form-group" style="margin-bottom: 15px">
                                <label for="state">Estado</label>
                                <select id="state" class="form-control" name="estado"  required>
                                    <option selected><?php echo $estado;?></option>
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
                            <div id="box-img" style="height:0px">
                                <img id="user" name="user" class="img-thumbnail" src="usuarios/<?php echo $foto;?>" alt="...">
                            </div>
                            <div id="user_image_lg" class="col-12">
                                <div class="form-group" style="margin-bottom: 15px">
                                    <label for="user_image" style="display:inherit">Foto de perfil</label>
                                    <input id="user_image" name="user_image" type="file" class="inputfile" onchange="preview();">
                                </div>
                            </div>
                            
                        </div>

                        
                    </center>
                    
                          
                    
                </div>
                
                
                <div id="modal-footer" class="container-fluid" style="background-color: white; padding-top: 0px">
                    
                    <center>
                        <div class="col-12" style="padding: 0px">
                            <div id="button-edit" class="container-fluid col-lg-5 col-md-6 col-sm-8 col-12" style="padding:0px">
                                <input id="btn-edit" type="submit" value="Change my data" name="completa_cadastro" class="col-12 hvr-shrink" onclick="return validar()" style="border-color: rgb(0,0,0); background-color: white; color: black; font-size:1.4em">
                            </div>
                        </div>
                        <div class="col-12" style="padding: 0px; margin-top:5px; margin-bottom:15px">
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
        if(isset($_POST['completa_cadastro'])){
        $nome      = $_POST['nome'];
        $sobrenome = $_POST['sobrenome'];
        
        
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

            $comando = "UPDATE `usuarios` SET `nome` = '$nome', `sobrenome` = '$sobrenome', `datanasc` = '$dataNascimento', `estado` = '$estado', `foto` = '$novo_nome' WHERE ID = '$id_user'";
            
            if(mysqli_query($link, $comando) === TRUE){
               $_SESSION['nome_user'] = $nome;
               $_SESSION['sobrenome_user'] = $sobrenome;
                
               $_SESSION['alert'] = "<div class=\"alert alert-success alert-dismissible\" style=\"margin-right:15px;margin-left:15px\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Dados alterados com sucesso.</div>";
               header('Location: profile.php');
            } 
        
    }else if(empty($_FILES['user_image']['name'])){
         
         $comando = "UPDATE `usuarios` SET `nome` = '$nome', `sobrenome` = '$sobrenome', `datanasc` = '$dataNascimento', `estado` = '$estado', `foto` = '$foto' WHERE ID = '$id_user'";
            
            if(mysqli_query($link, $comando) === TRUE){
               $_SESSION['nome_user'] = $nome;
               $_SESSION['sobrenome_user'] = $sobrenome;
                
               $_SESSION['alert'] = "<div class=\"alert alert-success alert-dismissible\" style=\"margin-right:15px;margin-left:15px\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a>Dados alterados com sucesso.</div>";
               header('Location: profile.php');
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