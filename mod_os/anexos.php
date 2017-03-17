<?php
// Se veio os dados do formulário
if($_SERVER['REQUEST_METHOD']=='POST')
{
  ob_start();
  if(isset($_FILES['arquivo'])and$_FILES['arquivo']['error']===0){
   // Pega os dados do formulário
   $nome = $_FILES['arquivo']['name'];
   $nome_tmp = $_FILES['arquivo']['tmp_name'];
   $id_os = $_POST['id_os'];
   // Monta a inserção
   $sql = "INSERT INTO os_anexo (id_os,nome) VALUES ('$id_os','$nome') RETURNING id_registro";
    // Executa a SQL
   $query = pg_query($sql) or die(pg_last_error());
    // Extrair o id inserido
   $id_registro = pg_result($query,0,'id_registro');
   // Salva na pasta anexos
   move_uploaded_file($nome_tmp,'anexos/'.$id_registro);
   // Redireciona o menino para a listagem
   header("Location: anexos.php?id_os=$id_os");
   exit(0);
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
}
// Se não vier id_os
if(!isset($_GET['id_os'])){
  // Tira o cara daí
  header("Location: listar.php");
  exit(0);
}
// Pega o os do banco que o menino clicou
$id_os = $_GET['id_os'];
// Busca os anexos referentes a OS
$sql = "select * from os_anexo where id_os = $id_os";
$query = pg_query($sql);
?>
<?php while($dados = pg_fetch_assoc($query)): ?>
  <?php echo $dados['nome']; ?>
  <a href='anexos/<?php echo $dados['id_registro']; ?>' 
    download='<?php echo $dados['nome']; ?>' >Download</a>
  <a href='excluir_anexo.php?id_registro=<?php echo $dados['id_registro']; ?>'>Excluir</a><br />
<?php endwhile; ?>
  <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
  <input type="hidden" name="id_os" value="<?php echo $dados_os['id_os']; ?>" />
  <input type="file" name="arquivo" /><br />
 

