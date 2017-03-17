<?php
require("../_inc/menu.inc.php");
// Se veio os dados do formulário
if($_SERVER['REQUEST_METHOD']=='POST')
{
  ob_start();
  // Pega os dados do formulário
  $nome = $_POST['nome'];
  $id_tipo = $_POST['id_tipo'];
  // Monta o update
  $sql = "update tipo set nome='$nome' where id_tipo=$id_tipo ";
  // Executa o tipo
  pg_query($sql);
  // Redireciona o menino para a listagem
  header("Location: listar.php");
  exit(0);
}
// Se não vier id_tipo
if(!isset($_GET['id_tipo'])){
  // Tira o cara daí
  header("Location: listar.php");
  exit(0);
}
// Pega o tipo do banco que o menino clicou
$id_tipo = $_GET['id_tipo'];
// Busca o tipo específico que o menino clicou
$sql = "select * from tipo where id_tipo = $id_tipo";
$dados = pg_fetch_assoc(pg_query($sql));
?>
  <title>Alterar Tipos</title>
        <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Alteração de Tipo</h2>                       
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <form role="form" method="post">
                        <div class="form-group col-md-4 col-md-offset-1">
                            <input type="hidden" name="id_tipo" 
                            value="<?php echo $dados['id_tipo']; ?>" />
                            <label class="control-label" for="nome">Nome</label>
                            <input type="text" class="form-control" id="nome" value="<?php echo $dados['nome']; ?>"
                             required="required" name="nome">
                            </br><input type="submit" class="btn btn-primary" value="Alterar">
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
    
   
</body>
</html>