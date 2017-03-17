<?php
// Conecta
require("../_inc/conexao.inc.php");
// Testa se veio o id_os
if(!isset($_GET['id_os'])){
  // manda o carinha pra listagem 
  header("Location: listar.php");
  // Garante a interrupção da execução do arquivo
  exit(0);
}
// Pega o valor do id_os a ser removido
$id_os = $_GET['id_os'];
$fim=$_GET['fim'];
$nome=$_GET['nome'];
$data=getdate();
$descricao=$_GET['desc'];
$satisfacao=$_GET['satisfacao'];
// Deleta
$dados = pg_query("update os set data_hora_finalizada=now(),descricao='$descricao Finalizada por $nome <br>Data: $data[mday]/$data[mon]/$data[year] Hora: $data[hours]:$data[minutes]<br> motivo: $fim <br><br>',satisfacao='$satisfacao' where id_os = $id_os");
// manda o carinha pra listagem 
header("Location: listar.php");
?>

