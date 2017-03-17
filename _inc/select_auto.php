<?php 
require ("conexao.inc.php");
function select_auto($nome_tab,$pk,$coluna){
	$sql="SELECT * FROM $nome_tab order by nome";
	$query=pg_query($sql);
	?>
	<select class="form-control" name="select_auto" id="" required="required">
		<option value="">Selecione</option>
		<?php
		while($dados=pg_fetch_assoc($query)):
	?>
		<option value="<?php echo $dados[$pk]?>"><?php echo $dados[$coluna]?></option>
	<?php 
	endwhile;
	?>
	</select>
	<?php
}
?>
