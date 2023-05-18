<?php
	include_once('painel_admin/conexao.php');
	
    $word = $_POST['word'];
	$comando = "SELECT * FROM dicionario WHERE palavra LIKE '%$word%'";
	$resultado_word = mysqli_query($link, $comando);
	
    if(mysqli_num_rows($resultado_word) == 0){
        echo '<script type="text/javascript" src="js/jquery-form.js"></script>';
        ?>
        <script type="text/javascript">
            $(document).ready(function() {
              
                $("#sugestao").ajaxForm({
                    target: '#sugestao',
                    success: function(retorno) {
                        $("#sugestao").html(retorno);
                        $("#sugestao").resetForm();

                    }

                });
            });

        </script>
<?php
        
        echo '<form action="back_envia_sugestao.php" method="POST" id="sugestao">';
        echo "<center><p id=\"word-english\" style=\"padding:0px; margin-bottom:10px\">Sem resultados!</p></center>";
        echo "<div id=\"line\"></div>";
        echo "<center><p id=\"word-example\" style=\"font-size:1.1em; margin-bottom:15px\">Gostaria de enviar a palavra <input class=\"form-control\" type=\"text\" style=\"color: rgb(0,0,0); width: 200px; display: inline-flex; padding:2px; padding-bottom:0px; text-align: center;\" name=\"sugestao\" value=\"$word\"> para ser avaliada e incluída no dicionário pela equipe?</p></center>";
        echo "<div id=\"line\"></div>";
        echo '<input class="col-12 hvr-shrink" id="send" type="submit" value="Enviar">';
        echo '</form>';
    }else{
        while($rows = mysqli_fetch_assoc($resultado_word)){
                
            
                echo "<p id=\"word-english\">".ucfirst(utf8_encode($rows['palavra']))."</p><p id=\"word-port\">".ucfirst($rows['traducao'])."</p><div id=\"word-audio\" class=\"speaker\"><i id=\"audio\" class=\"material-icons\">volume_up</i></div><audio id=\"player\"><source src=\"painel_admin/audios/{$rows['audio']}\" type=\"audio/mp3\" /></audio>
             <div id=\"line\"></div><p id=\"g-class\">Grammatical class:</p><p id=\"word-class\">".$rows['classe']."</p><div id=\"line\"></div><p id=\"definition\">Definition:</p><p id=\"word-definition\">".$rows['definicao']."</p><div id=\"line\"></div><p id=\"example\">Example:</p><p id=\"word-example\">".$rows['exemplo']."</p><script type=\"text/javascript\" src=\"js/audio.js\"></script>";
           
            
			 
		}
    }


		
	
?>
