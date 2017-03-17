<?php
require('../_inc/menu.inc.php');
// Calcula o offset
$offset = (isset($_GET['pag']))?($_GET['pag']-1) * QTD_POR_PAGINA:0;
// Verifica se veio um nome para pesquisar
if(isset($_GET['nome'])) {
    // Salve o nome de pesquisa
    $nome_pesq = $_GET['nome'];
    // Guarda o nome em um cookie
    setcookie('nome_pesq',$_GET['nome']);
}
else{
    // Se não vier nada pra pesquisar, tenta recuperar um cookie
    $nome_pesq = isset($_COOKIE['nome_pesq'])?$_COOKIE['nome_pesq']:'';
}
// Executa o comando de acordo com a pesquisa e paginação
$query = pg_query("SELECT c.*,ca.nome as cargo,d.nome as departamento,s.nome as secretaria, count(*) over() as total FROM cliente c
                    inner join cargo ca on c.id_cargo = ca.id_cargo
                    inner join departamento d on c.id_departamento = d.id_departamento
                    inner join secretaria s on d.id_secretaria = s.id_secretaria
                    WHERE c.nome ilike '%$nome_pesq%' ORDER BY c.nome limit ".QTD_POR_PAGINA." offset $offset");
?>
<ul class="nav nav-pills">
    <li role="presentation"><a href="form_cadastrar.php">Cadastrar</a></li>
</ul>
<br />
<!-- Formulário de filtragem -->
<form>
    <input type="text" name="nome" value="<?php echo $nome_pesq; ?>" />
    <input type="submit" value="Procurar" />
</form>
<table class="table table-hover">
<?php 
$total = 0;
while ($dados = pg_fetch_assoc($query)):
    $total = $dados['total'];
    ?>
    <tr>
    <p>
        <td><?php echo $dados['nome']; ?>
        (<?php echo $dados['cargo']; ?>
        // em <?php echo $dados['departamento'] ?>
        // na Secretaria <?php echo $dados['secretaria'] ?>)</td>
        <td><a href="form_alterar.php?id_cliente=<?php echo $dados['id_cliente']; ?>">
            Alterar
        </a>
        <a href="excluir.php?id_cliente=<?php echo $dados['id_cliente']; ?>">
            Excluir
        </a></td>
    </p>
    </tr>
<?php endwhile; ?>
</table>
<?php
// Calcula a quantidade de páginas
$paginas = ceil($total / QTD_POR_PAGINA);
// Imprime as páginas
for ($i = 1; $i <= $paginas; $i ++):
    ?>
    <a href="?pag=<?php echo $i; ?>&nome=<?php echo @$nome_pesq; ?>"><?php echo $i ?></a>
    <?php
endfor;
?>


