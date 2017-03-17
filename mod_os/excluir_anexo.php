<?php
// Testa se veio o id_anexo
if(!isset($_GET['id_registro'])){
  // manda o carinha pra listagem 
  header("Location: listar.php");
  // Garante a interrupção da execução do arquivo
  exit(0);
}
// Pega o valor do id_anexo a ser removido
$id_registro = $_GET['id_registro'];
// Conecta
require("../_inc/conexao.inc.php");
// Recupera a id_os do anexo sendo excluido para redirecionar depois
$query = pg_query("select * from os_anexo where id_registro = $id_registro");
$id_os = pg_result($query,0,'id_os');
// Deleta
pg_query("delete from os_anexo where id_registro = $id_registro RETURNING id_os");
// Deleta realmente o arquivo
unlink("anexos/$id_registro");
// manda o carinha pra listagem 
header("Location: anexos.php?id_os=$id_os");
?>

