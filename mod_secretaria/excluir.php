<?php
// Testa se veio o id_secretaria
if(!isset($_GET['id_secretaria'])){
  // manda o carinha pra listagem 
  header("Location: listar.php");
  // Garante a interrupção da execução do arquivo
  exit(0);
}
// Pega o valor do id_secretaria a ser removido
$id_secretaria = $_GET['id_secretaria'];
// Conecta
require("../_inc/conexao.inc.php");
$dados=pg_query("delete from cliente where id_departamento in (select id_departamento from departamento where id_secretaria=$id_secretaria)");
$dados=pg_query("delete from departamento where id_secretaria=$id_secretaria");
// Deleta
$dados = pg_query("delete from secretaria where id_secretaria = $id_secretaria");
// manda o carinha pra listagem 
header("Location: listar.php");
?>

