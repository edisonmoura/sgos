<?php
// Testa se veio o id_departamento
if(!isset($_GET['id_departamento'])){
  // manda o carinha pra listagem 
  header("Location: listar.php");
  // Garante a interrupção da execução do arquivo
  exit(0);
}
// Pega o valor do id_departamento a ser removido
$id_departamento = $_GET['id_departamento'];
// Conecta
require("../_inc/conexao.inc.php");
// Deleta
$dados = pg_query("delete from departamento where id_departamento = $id_departamento");
// manda o carinha pra listagem 
header("Location: listar.php");
?>

