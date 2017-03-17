<?php
require('../_inc/menu.inc.php');
if($_SERVER['REQUEST_METHOD']=='POST')
{
  // Inicia o buffer de saída
  ob_start();
  // requerendo a conexão com o banco
  require("../_inc/conexao.inc.php");
  // Pegar do formulário o nome digitado pelo cliente
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $telefone = $_POST['telefone'];
  $id_departamento = $_POST['select_auto'];
  $id_cargo = $_POST['id_cargo'];
  // Monta a SQL de inserção
  $sql = "INSERT INTO cliente (nome,e_mail,telefone,id_departamento,id_cargo) VALUES ('$nome','$email','$telefone','$id_departamento','$id_cargo')";
  // Executo a Query
  pg_query($sql) or die(pg_last_error());
  // Redireciona para a listagem
  header("Location: listar.php");
}
?>
<form method="post">
  Departamento:<br />
  <?php select_auto('departamento','id_departamento','nome'); ?><br />
  Cargo:</br>
  <?php include('../mod_cargo/select.inc.php'); ?><br />
  Nome:<br />
  <input type="text" name="nome" /><br />
  Email:<br />
  <input type="text" name="email" /><br />
  Telefone:<br />
  <input type="text" name="telefone" /><br />
  <input type="submit" />
</form>
