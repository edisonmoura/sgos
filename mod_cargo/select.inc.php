<select name="id_cargo">
  <option value="">Selecione...</option>
  <?php
  require("../_inc/conexao.inc.php");
  $sql_cargo = "select * from cargo order by nome";
  $query_cargo = pg_query($sql_cargo);
  while($dados_cargo = pg_fetch_assoc($query_cargo)):
  ?>
  <option value="<?php echo $dados_cargo['id_cargo']; ?>"
    <?php
      if(isset($dados) 
        and $dados_cargo['id_cargo'] == $dados['id_cargo'])
      {
        echo " selected ";
      }
    ?>
    >
    <?php echo $dados_cargo['nome']; ?>
  </option>
  <?php endwhile; ?>
</select>
