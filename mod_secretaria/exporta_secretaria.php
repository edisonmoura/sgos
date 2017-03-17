<?php 

if($_SERVER['REQUEST_METHOD']=='POST'){
$arquivo_txt=$_POST['arquivo'];
require('../_inc/conexao.inc.php');
$query=pg_query('select * from secretaria');
$arquivo=fopen($arquivo_txt, 'a');
while($dados=pg_fetch_assoc($query)):
	fwrite($arquivo, "$dados[nome]\r\n");
endwhile;
fclose($arquivo);
header("Location:listar.php");
}
 ?>

<form action="" method="post">
Nome do Arquivo:<input type="text" name="arquivo">
	<input type="submit" value="Salvar">
 </form>