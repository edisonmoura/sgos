<select name="id_departamento">
  <option value="">Selecione...</option>
  <?php
  require("../_inc/conexao.inc.php");
  $sql_departamento = "select d.*,s.nome as secretaria from departamento 
    d inner join secretaria s on d.id_secretaria = s.id_secretaria order by nome";
  $query_departamento = pg_query($sql_departamento);
  while($dados_departamento = pg_fetch_assoc($query_departamento)):
  ?>
  <option value="<?php echo $dados_departamento['id_departamento']; ?>"
    <?php
      if(isset($dados) 
        and $dados_departamento['id_departamento'] == $dados['id_departamento'])
      {
        echo " selected ";
      }
    ?>
    >
    <?php echo $dados_departamento['nome']; ?> (<?php echo $dados_departamento['secretaria']; ?>)
  </option>
  <?php endwhile; ?>
</select>
