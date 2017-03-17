<?php
// Conecta no banco
require("../_inc/menu.inc.php");
// Se veio os dados do formulário
if($_SERVER['REQUEST_METHOD']=='POST')
{
  ob_start();
  // Pega os dados do formulário
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $telefone = $_POST['telefone'];
  $id_cargo = $_POST['id_cargo'];
  $id_departamento = $_POST['id_departamento'];
  $id_cliente = $_POST['id_cliente'];
  // Monta o update
  $sql = "update cliente set nome='$nome',email='$email',telefone='$telefone',id_departamento='$id_departamento',id_cargo='$id_cargo' where id_cliente=$id_cliente ";
  // Executa o departamento
  pg_query($sql);
  // Redireciona o menino para a listagem
  header("Location: listar.php");
  exit(0);
}
// Se não vier id_departamento
if(!isset($_GET['id_cliente'])){
  // Tira o cara daí
  header("Location: listar.php");
  exit(0);
}
// Pega o departamento do banco que o menino clicou
$id_cliente = $_GET['id_cliente'];
// Busca o departamento específico que o menino clicou
$sql = "select * from cliente where id_cliente = $id_cliente";
$dados = pg_fetch_assoc(pg_query($sql));
?>
<form method="post">
  <input type="hidden" name="id_cliente" 
    value="<?php echo $dados['id_cliente']; ?>" />
  Departamento:<br />
  <?php include("../mod_departamento/select.inc.php"); ?><br />
  Cargo:<br />
  <?php include("../mod_cargo/select.inc.php"); ?><br />
  Nome:<br />  <input type="text" name="nome" 
       value="<?php echo $dados['nome']; ?>" /></br>
  Email:<br />  <input type="text" name="nome" 
      value="<?php echo $dados['email']; ?>" /></br>
  Telefone:<br />  <input type="text" name="nome" 
      value="<?php echo $dados['telefone']; ?>" /></br>
  <input type="submit" />
</form>
