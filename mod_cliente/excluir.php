<?php
// Testa se veio o id_departamento
if(!isset($_GET['id_departamento'])){
  // manda o carinha pra listagem 
  header("Location: listar.php");
  // Garante a interrupção da execução do arquivo
  exit(0);
}
// Pega o valor do id_departamento a ser removido
$id_cliente = $_GET['id_cliente'];
// Conecta
require("../_inc/conexao.inc.php");
// Deleta
$dados = pg_query("delete from cliente where id_cliente = $id_cliente");
// manda o carinha pra listagem 
header("Location: listar.php");
?>

