<select name="id_cliente">
  <option value="">Selecione...</option>
  <?php
  require("../_inc/conexao.inc.php");
  $sql_cliente = "select c.*,d.nome as departamento,s.nome as secretaria from cliente 
    c inner join departamento d on c.id_departamento = d.id_departamento inner join secretaria s on d.id_secretaria = s.id_secretaria order by nome";
  $query_cliente = pg_query($sql_cliente);
  while($dados_cliente = pg_fetch_assoc($query_cliente)):
  ?>
  <option value="<?php echo $dados_cliente['id_cliente']; ?>"
    <?php
      if(isset($dados) 
        and $dados_cliente['id_cliente'] == $dados['id_cliente'])
      {
        echo " selected ";
      }
    ?>
    >
    <?php echo $dados_cliente['nome']; ?> (<?php echo $dados_cliente['departamento']; ?> - <?php echo $dados_cliente['secretaria']; ?>)
  </option>
  <?php endwhile; ?>
</select>