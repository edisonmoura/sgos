<?php 
require ("conexao.inc.php");
function select_auto2($nome_tab,$pk,$coluna){
	$sql="SELECT * FROM $nome_tab order by nome";
	$query=pg_query($sql);
	?>
	<select class="form-control" name="select_auto2" id="" required="required">
		<option value="">Cargos...</option>
		<?php
		while($dados=pg_fetch_assoc($query)):
	?>
		<option value="<?php echo $dados[$coluna]?>"><?php echo $dados[$coluna]?></option>
	<?php 
	endwhile;
	?>
	</select>
	<?php
}
?>
