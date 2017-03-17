<select name="id_secretaria" required="required">
  <option value="">Selecione...</option>
  <?php
  require("../_inc/conexao.inc.php");
  $sql_secretaria = "select * from secretaria order by nome";
  $query_secretaria = pg_query($sql_secretaria);
  while($dados_secretaria = pg_fetch_assoc($query_secretaria)):
  ?>
  <option value="<?php echo $dados_secretaria['id_secretaria']; ?>"
    <?php
      if(isset($dados) 
        and $dados_secretaria['id_secretaria'] == $dados['id_secretaria'])
      {
        echo " selected ";
      }
    ?>
    >
    <?php echo $dados_secretaria['nome']; ?>
  </option>
  <?php endwhile; ?>
</select>
