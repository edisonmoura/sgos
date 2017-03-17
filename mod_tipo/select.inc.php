<select required="required" name="id_tipo" class="form-control">
  <option value="">Selecione...</option>
  <?php
  require("../_inc/conexao.inc.php");
  $sql_tipo = "select * from tipo order by nome";
  $query_tipo = pg_query($sql_tipo);
  while($dados_tipo = pg_fetch_assoc($query_tipo)):
  ?>
  <option value="<?php echo $dados_tipo['id_tipo']; ?>"
    <?php
      if(isset($dados) 
        and $dados_tipo['id_tipo'] == $dados['id_tipo'])
      {
        echo " selected ";
      }
    ?>
    >
    <?php echo $dados_tipo['nome']; ?>
  </option>
  <?php endwhile; ?>
</select>
