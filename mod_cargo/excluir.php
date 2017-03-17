<?php
// Testa se veio o id_cargo
if(!isset($_GET['id_cargo'])){
  // manda o carinha pra listagem 
  header("Location: listar.php");
  // Garante a interrupção da execução do arquivo
  exit(0);
}
// Pega o valor do id_cargo a ser removido
$id_cargo = $_GET['id_cargo'];
// Conecta
require("../_inc/conexao.inc.php");
// Deleta
$query=pg_query("select count(*) as total from cliente where id_cargo=$id_cargo");
$dados2=pg_fetch_assoc($query);
	if($dados2['total']>0){
		echo "Impossível excluír! Existem ".$dados2['total']." clientes cadastrados com este cargo.";
	?>
	<br>
	<a href="listar.php">Listar</a>
	<?php		
	}
	else{
		$dados = pg_query("delete from cargo where id_cargo = $id_cargo");
		// manda o carinha pra listagem 
		header("Location: listar.php");
	}

?>

