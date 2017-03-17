<?php
require("../_inc/menu.inc.php");
// Se veio os dados do formulário
if($_SERVER['REQUEST_METHOD']=='POST')
{
  ob_start();
  // Pega os dados do formulário
  $nome = $_POST['nome'];
  $id_cargo = $_POST['id_cargo'];
  // Monta o update
  $sql = "update cargo set nome='$nome' where id_cargo=$id_cargo ";
  // Executa o cargo
  pg_query($sql);
  // Redireciona o menino para a listagem
  header("Location: listar.php");
  exit(0);
}
// Se não vier id_cargo
if(!isset($_GET['id_cargo'])){
  // Tira o cara daí
  header("Location: listar.php");
  exit(0);
}
// Pega o cargo do banco que o menino clicou
$id_cargo = $_GET['id_cargo'];
// Busca o cargo específico que o menino clicou
$sql = "select * from cargo where id_cargo = $id_cargo";
$dados = pg_fetch_assoc(pg_query($sql));
?>
        <title>Alterar Cargo</title>
        <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Alteração de Cargo</h2>                       
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row">
                    <form role="form" method="post">
                        <div class="form-group col-md-4 col-md-offset-1">
                            <input type="hidden" name="id_cargo" 
                            value="<?php echo $dados['id_cargo']; ?>" />
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