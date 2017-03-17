<?php
require("../_inc/menu.inc.php");
$status="";
$os=$_GET['id_os'];
$sql="SELECT * from os where id_os=$os";
$dados2 = pg_fetch_assoc(pg_query($sql));
if($dados2['data_hora_finalizada']!=""||$dados2['data_hora_cancelada']!=""){
  $status="hidden";
}
// Se veio os dados do formulário
if($_SERVER['REQUEST_METHOD']=='POST')
{
  ob_start();
  // Pega os dados do formulário
  $nome=$_SESSION['nome'];
  $data=getdate();
  $andamento = nl2br($_POST['andamento']);
  $andamento=wordwrap($andamento, 75, "<br />", true);
  $id_tipo = $_POST['id_tipo'];
  $id_os = $_POST['id_os'];
  $andamentos=$_POST['andamentos'];
  // Monta o update
  $sql = "update os set andamento=' $andamentos Andamento por: $nome <br>Data: $data[mday]/$data[mon]/$data[year] Hora: $data[hours]:$data[minutes]<br>$andamento <br><br>',id_tipo='$id_tipo' where id_os=$id_os ";
  // Executa o os
  pg_query($sql) or die(pg_last_error());
  
  //anexos
  if(isset($_FILES['arquivo'])and$_FILES['arquivo']['error']===0){
   // Pega os dados do formulário
   $nome = $_FILES['arquivo']['name'];
   $nome_tmp = $_FILES['arquivo']['tmp_name'];
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
  // Redireciona o menino para a listagem
  header("Location: ../index.php");
  exit(0);
}
// Se não vier id_os
if(!isset($_GET['id_os'])){
  // Tira o cara daí
  header("Location: listar.php");
  exit(0);
}
// Pega o os do banco que o menino clicou
$id_os = $_GET['id_os'];
// Busca o os específico que o menino clicou
$sql = "select * from os where id_os = $id_os";
$dados = pg_fetch_assoc(pg_query($sql));

$sql = "select * from os_anexo where id_os = $id_os";
$query = pg_query($sql);
?>
<div id="page-wrapper" >
            <div id="page-inner col-md-12">
                <div class="row">
                    <div class="col-md-10">
                     <h2>Inclusão de Andamento<span style="float:right;">Andamentos</span></h2>          
                    </div>
                </div>
                <!-- /. ROW  -->
                <div class="row col-md-12 img-thumbnail">
                    <form role="form" method="post" enctype="multipart/form-data" class="">
                        <div class="form-group col-md-5">
                          <input type="hidden" class="form-control" name="id_os" value="<?php echo $dados['id_os']; ?>" />
                            <label class="control-label" for="secretaria">Tipo</label></br>
                             <?php include("../mod_tipo/select.inc.php"); ?></br>
                            <label class="control-label" for="os">OS</label>
                            <input type="text" class="form-control" id="os" readonly name="os" class="col-md-2" value="<?php echo $dados['id_os']; ?>" ></br>
                           Anexo:
                           <?php while($dados2 = pg_fetch_assoc($query)): ?>
                              <a href='anexos/<?php echo $dados2['id_registro']; ?>' 
                                download='<?php echo $dados['nome']; ?>' ><?php echo $dados2['nome']; ?></a>
                              <br />
                              <?php endwhile; ?>
                              <div <?php echo $status;?> ><br>
                            <input  type="hidden" name="MAX_FILE_SIZE" value="1000000">
                            <input  type="file" name="arquivo" /><br />
                            Andamento:<br />
                            <textarea class="form-control" name="andamento" required="required"></textarea>
                        <input type="submit" class="btn btn-primary" value="OK">
                        </div>
                      </div>
                      <div class="form-group col-md-5 col-md-offset-2">                          
                          <label class="control-label" for="descricao">Descrição</label></br>
                          <input  type="hidden" name="andamentos"><?php echo $dados['descricao']; ?></input>

                          <label class="control-label" for="andamento">Andamentos</label></br>
                          <input class="form-control" type="hidden" name="andamentos" value="<?php echo $dados['andamento']; ?>">
                          <p readonly name="andamento"><?php echo $dados['andamento']; ?></p>
                </div>
                    </form>
                </div>
          
              </div>
            </div>