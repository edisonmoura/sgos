<?php
require("../_inc/menu.inc.php");
// Executa o comando de acordo com a pesquisa e paginação
$query = pg_query("SELECT * FROM cargo ORDER BY nome");
?>
    <title>Cargos</title>
       <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Cargos
                        <a href="form_cadastrar.php" class="btn btn-primary" style="float:right"> Cadastrar Novo Cargo</a></h2>
                        </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-body">
                            <div class="panel panel-default col-md-12">
                                <div class="panel-heading">
                                    Selecione o Cargo
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Cargo</th>
                                                    <th>Opções</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        while ($dados = pg_fetch_assoc($query)):
                                                    ?>
                                                    <tr class="odd gradeX">
                                                        <td><?php echo $dados['nome']; ?></td>
                                                        <td>
                                                            <a class="btn btn-default" href="form_alterar.php?id_cargo=<?php echo $dados['id_cargo']; ?>">
                                                                Alterar</a>
                                                            <a class="btn btn-default" href="excluir.php?id_cargo=<?php echo $dados['id_cargo']; ?>">
                                                                Excluir</a>
                                                        </td>       
                                                    </tr>
                                                    <?php endwhile; ?>
                                                </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


     <!-- /. WRAPPER  -->
    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="../assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="../assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="../assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
      <!-- CUSTOM SCRIPTS -->
    <script src="../assets/js/custom.js"></script>
    
   
</body>
</html>
    <?php
    while ($dados = pg_fetch_assoc($query)):
        $total = $dados['total'];
        ?>
    <tr>
        <p>
        <td><?php echo $dados['nome']; ?></td>
        <td><a class="glyphicon glyphicon-pencil"href=">
            Alterar
        </a>        
        <a class="glyphicon glyphicon-trash" href=">
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


