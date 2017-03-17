<?php
// Testa se veio o id_os
if(!isset($_GET['id_os'])){
  // manda o carinha pra listagem 
  header("Location: listar.php");
  // Garante a interrupção da execução do arquivo
  exit(0);
}
// Pega o valor do id_os a ser removido
$id_os = $_GET['id_os'];
// Conecta
require("../_inc/conexao.inc.php");
// Deleta
$dados = pg_query("delete from os where id_os = $id_os");
// manda o carinha pra listagem 
header("Location: listar.php");
?>

