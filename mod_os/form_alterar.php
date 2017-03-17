<?php
require('../_inc/menu.inc.php');
// Se veio os dados do formulário
if($_SERVER['REQUEST_METHOD']=='POST')
{
  ob_start();
  // Pega os dados do formulário
  $nome = $_POST['nome'];
  $descricao = $_POST['descricao'];
  $prioridade = $_POST['prioridade'];
  $id_cliente = $_POST['id_cliente'];
  $id_tipo = $_POST['id_tipo'];
  $id_os = $_POST['id_os'];
  // Monta o update
  $sql = "update os set nome='$nome',descricao='$descricao',prioridade='$prioridade',
  id_cliente='$id_cliente',id_tipo='$id_tipo' where id_os=$id_os ";
  // Executa o os
  pg_query($sql) or die(pg_last_error());
  // Redireciona o menino para a listagem
  header("Location: listar.php");
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
?>
<title>Alterar OS</title>
<form method="post">
  <input type="hidden" name="id_os" value="<?php echo $dados['id_os']; ?>" />
  Tipo:<br />
  <?php include("../mod_tipo/select.inc.php"); ?><br />
  OS:<br />
  <input type="text" readonly name="os" value="<?php echo $dados['id_os']; ?>" /><br />
  Descrição:<br />
  <textarea name="descricao" /><?php echo $dados['descricao']; ?></textarea><br />
  Prioridade:<br />
  <select name='prioridade'>
    <option value='normal' 
    <?php if($dados['prioridade']=='normal') echo 'selected'; ?>
    >Normal</option>
    <option value='alta' 
    <?php if($dados['prioridade']=='alta') echo 'selected'; ?>
    >Alta</option>
    <option value='baixa' 
    <?php if($dados['prioridade']=='baixa') echo 'selected'; ?>
    >Baixa</option>
  </select>
  <br />
  <input type="submit" />
</form>
