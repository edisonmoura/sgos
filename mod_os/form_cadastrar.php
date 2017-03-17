<?php
require("../_inc/menu.inc.php");

if($_SERVER['REQUEST_METHOD']=='POST')
{
  // Inicia o buffer de saída
  ob_start();
  // requerendo a conexão com o banco
  require("../_inc/conexao.inc.php");
  // Pegar do formulário o nome digitado pelo os
  $email = $_POST['email'];
  $descricao =nl2br($_POST["descricao"]);
  $descricao=wordwrap($descricao, 75, "<br />", true);
  $prioridade = $_POST['prioridade'];
  $cod_usuario = $_SESSION['cod'];
  $id_tipo = $_POST['id_tipo'];
  // Monta a SQL de inserção
  $sql = "INSERT INTO os (email,descricao,prioridade,cod_usuario,id_tipo) VALUES ('$email','$descricao <br><br>','$prioridade','$cod_usuario','$id_tipo') RETURNING id_os";
  // Executo a Query
  $query=pg_query($sql) or die(pg_last_error());
   //anexo
  if(isset($_FILES['arquivo'])and$_FILES['arquivo']['error']===0){
     // Pega os dados do formulário
     $nome = $_FILES['arquivo']['name'];
     $nome_tmp = $_FILES['arquivo']['tmp_name'];
     $id_os = pg_result($query,0,'id_os');
     // Monta a inserção
     $sql = "INSERT INTO os_anexo (id_os,nome) VALUES ('$id_os','$nome') RETURNING id_registro";
      // Executa a SQL
     $query = pg_query($sql) or die(pg_last_error());
      // Extrair o id inserido
     $id_registro = pg_result($query,0,'id_registro');
     // Salva na pasta anexos
     move_uploaded_file($nome_tmp,'anexos/'.$id_registro);
  }
 else{
    if(isset($_FILES['arquivo'])){
      switch($_FILES['arquivo']['error']){
        case 1:
        case 2:
          echo "ERRO: Arquivo muito grande ({$_FILES['arquivo']['error']})</br>";
          break;
        case 3: 
          echo "ERRO: Upload Interrompido</br>";
          break;
        case 4:
          echo "Ausência de arquivos";
          break;
      }
    }  
  }
  // Redireciona para a listagem
  echo '<script>location.href="../index.php";</script>';
}
?>
  <title>Cadastro de OS</title>
        <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Cadastro de OS</h2>                       
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <form role="form" method="post" enctype="multipart/form-data">
                        <div class="form-group col-md-4 col-md-offset-1">
                            <label class="control-label" for="id_tipo">Tipo</label></br>
                             <?php include("../mod_tipo/select.inc.php"); ?></br>
                            <label class="control-label" for="email">Email</label>
                            <input type="email" class="form-control" id="email" required="required" name="email"></br>
                          <label class="control-label" for="descricao">Descrição</label></br>
                          <textarea  class="form-control" style="resize:none"  name="descricao" id="descricao"/></textarea></br>
                           Anexo:<br>
                            <input  type="hidden" name="MAX_FILE_SIZE" value="1000000">
                            <input  type="file" name="arquivo" /><br />
                            Prioridade:<br />
                              <select  class="form-control" name='prioridade'>
                                <option value='normal'>Normal</option>
                                <option value='alta'>Alta</option>
                                <option value='baixa'>Baixa</option>
                              </select></br>
                        <input type="submit" class="btn btn-primary" value="Cadastrar">
                        </div>
                    </form>
                </div>
        </div>
    </div>
    <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="../assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../assets/js/jquery.metisMenu.js"></script>
           <!-- CUSTOM SCRIPTS -->
    <script src="../assets/js/custom.js"></script>
    <script type="text/javascript">
    $('.admin').show();
    $('.user').hide();
    </script>
   
</body>
</html>