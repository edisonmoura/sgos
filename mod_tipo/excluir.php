<?php
// Testa se veio o id_tipo
if(!isset($_GET['id_tipo'])){
  // manda o carinha pra listagem 
  header("Location: listar.php");
  // Garante a interrupção da execução do arquivo
  exit(0);
}
// Pega o valor do id_tipo a ser removido
$id_tipo = $_GET['id_tipo'];
// Conecta
require("../_inc/conexao.inc.php");
// Deleta
$dados = pg_query("delete from tipo where id_tipo = $id_tipo");
// manda o carinha pra listagem 
header("Location: listar.php");
?>

