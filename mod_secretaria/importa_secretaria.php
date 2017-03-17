<?php 
if($_SERVER['REQUEST_METHOD']=='post'){
	require('../_inc/conexao.inc.php');
	if()
	$arquivo_txt=$_FILES['arquivo']['tmp_name'],'r';
	var_dump($sql);
	$arquivo=fopen($arquivo_txt, 'r');
	while(!feof($arquivo)){
		$linha=trim(fgets($arquivo));
		//if(!$linha) continue;
		$sql="insert into secretaria (nome) values ('$linha')";
		pg_query($sql);
	}
}
 ?>
 <form action="" method="post" enctype="multipart/form-data">
 	 <input type="hidden" name="MAX_FILE_SIZE" value="1000000">
 	<input type="file" name="arquivo">
 	<input type="submit" value="Importar">
 </form>