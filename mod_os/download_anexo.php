<?php
// Conecta no banco
require("../_inc/conexao.inc.php");
// Se não vier id_anexo
if(!isset($_GET['id_anexo'])){
  // Tira o cara daí
  header("Location: listar.php");
  exit(0);
}
// Pega o os do banco que o menino clicou
$id_anexo = $_GET['id_anexo'];
// Busca o os específico que o menino clicou
$sql = "select * from os_anexo where id_anexo = $id_anexo";
$dados = pg_fetch_assoc(pg_query($sql));
header
