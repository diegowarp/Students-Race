<?php 
ob_start();
session_start();
include_once("conexao.php"); ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>PAINEL DO ADMINISTRADOR - LOGIN</title>
</head>
       
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
    <!-- Bootstrap -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

    <!-- CSS -->
    <link rel="stylesheet" href="css/admin_geral.css" media="screen">
    <link rel="stylesheet" href="css/admin_forms.css" media="screen">
    <link rel="stylesheet" href="css/admin_login.css" media="screen">
    
    <!-- ANIMATE -->
    <link rel="stylesheet" href="css/animate.min.css">
    
    <!-- HOVER -->
    <link href="css/hover-min.css" rel="stylesheet" media="all">

    <!-- Material Icons - Google -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    
    <script>
        
    </script>
    
<body class="modal-open">
    <div class="modal container-fluid col-12" id="modal-login" role="dialog">
        <div class="modal-dialog modal-lg modal-dialog-centered container-fluid" role="document">
            <form id="login" class="modal-content col-12 animated zoomInDown" action="admin_login.php" method="post">
                <div id="modal-header" class="container-fluid">
                    <p id="text-header">
                        Painel do administrador
                    </p>
                </div>
                <div id="modal-body" class="container-fluid">
                   <div id="message"></div>
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
                        <div class="row col-12" style="padding: 0px">
                            <div id="button-login" class="container-fluid col-12">
                                <input id="btn-login" class="col-12 hvr-grow" type="submit" name="ENTRAR" value="Entrar">
                            </div>
                        </div>
                    </center>
                </div>
            </form>
        </div>
    </div>

    
    <script src="js/admin_geral.js"></script>
    <script src="js/admin_login.js"></script>
    
    <?php
    if(isset($_POST['ENTRAR'])){
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        
        //encripta a senha para comparar no banco
        $senha = hash('sha512', $senha, false); 
        
        //Evita caracteres usados em ataques de SQL Injection simples `OR 1 = 1; #
        $email = preg_replace('/[^[:alnum:]_.-@]/', '', $email);
        
       
         $comando = "SELECT ID, nome FROM administradores WHERE email = '$email' AND senha = '$senha'";
        
         if($stmt = mysqli_prepare($link, $comando)){
            mysqli_stmt_execute($stmt);
            mysqli_stmt_bind_result($stmt, $id_admin, $nome_admin);
            if (mysqli_stmt_fetch($stmt)) {
                  
                    $_SESSION['id_admin'] = $id_admin;
                    $_SESSION['admin'] = $nome_admin;
                
                header('Location: admin_home.php');
            }else{
                echo "<script>$('div#message').html('<div class=\"alert alert-danger alert-dismissible fade show\"><a href=\"#\" class=\"close\" data-dismiss=\"alert\" aria-label=\"close\">&times;</a><strong>Erro!</strong> Email ou senha incorretos.</div>');</script>";
            }
        }
    } 
    ?>

</body>

</html>
