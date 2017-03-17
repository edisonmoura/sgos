<?php
require("../_inc/menu.inc.php");
// Calcula o offset
/*$offset = (isset($_GET['pag']))?($_GET['pag']-1) * QTD_POR_PAGINA:0;
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
$query = pg_query("SELECT os.*,u.nome as usuario,d.nome as departamento,s.nome as secretaria,count(*) over() as total 
FROM os
inner join tipo t on t.id_tipo = os.id_tipo
inner join usuario u on os.cod_usuario = u.cod
inner join departamento d on u.departamento = d.nome 
inner join secretaria s on d.id_secretaria = s.id_secretaria
WHERE os.descricao ilike '%$nome_pesq%' ORDER BY os.cod_usuario limit ".QTD_POR_PAGINA." offset $offset");
*/?>
    <title>OS</title>
        <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">
                     <h2>Ordens de Serviço
                        <a href="form_cadastrar.php" class="btn btn-primary" style="float:right;"> Abrir Ordem de Serviço</a></h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-body">
                            <div class="panel panel-default col-md-12">
                                <div class="panel-heading">
                                    Selecione a Ordem de Serviço
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>OS</th>
                                                    <th>Usuario</th>
                                                    <th>Descrição / Situação</th>
                                                    <th>Abertura</th>
                                                    <th>Prioridade</th>
                                                    <th>Opções</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php 
                                                        if($_SESSION['nivel']=='admin'){
                                                            $query=pg_query("select  * from os inner join usuario on cod= os.cod_usuario  order by id_os desc ");
                                                        }else{
                                                            $usuario=$_SESSION['cod'];
                                                            $query=pg_query("select * from os inner join usuario on cod= os.cod_usuario where (cod_usuario=$usuario) order by id_os desc" );
                                                        }
                                                        while ($dados = pg_fetch_assoc($query)):
                                                            $data2 = explode("-", $dados['data_hora_abertura']);
                                                            $data3 = explode(" ", $data2[2]);
                                                            $hora = explode(":", $data3[1]);
                                                            $data_fim = "Dia: ".$data3[0]."/".$data2[1]."/".$data2[0];
                                                            $hora_fim = "Hora:".$hora[0].":".$hora[1];
                                                    ?>
                                                    <tr class="odd gradeX">
                                                            <td><a href="andamento.php?id_os=<?php echo $dados['id_os']; ?>"><?php echo $dados['id_os']; ?></a></td>
                                                            <td><?php echo $dados['nome']; echo "<br>".$dados['departamento']; ?></td>
                                                            <td><?php echo $dados['descricao']; ?></td>
                                                            <td><?php echo $data_fim."</br>".$hora_fim; ?></td>
                                                            <td><?php echo $dados['prioridade']; ?></td>
                                                            <?php
                                                            $status1 = $dados['data_hora_finalizada'];
                                                            $status2 = $dados['data_hora_cancelada'];
                                                            if($status1=="" && $status2==""){
                                                            
                                                                if($_SESSION['nivel']=='admin'){
                                                                    ?>
                                                                    <td><button class="fim botao" os="<?php echo $dados['id_os'];?>"
                                                                    desc="<?php echo $dados['descricao'];?>">Finalizar</button>
                                                                    <button class="cancel botao <?php echo $_SESSION['nivel']; ?>" 
                                                                    os="<?php echo $dados['id_os'];?>" desc="<?php echo $dados['descricao'];?>">
                                                                    Cancelar</button></td>
                                                            <?php
                                                                }else{
                                                            ?>
                                                                    <td><a href="#janela1" rel="modal"><button class="fim2 botao" rel="modal" os="<?php echo $dados['id_os'];?>"
                                                                    desc="<?php echo $dados['descricao'];?>">Finalizar</button></a><a href="andamento.php?id_os=<?php echo $dados['id_os']; ?>">
                                                                    <button>Andamento</button></a></td>
                                                                <?php
                                                                }
                                                                 
                                                            }else{
                                                                ?>
                                                                    <td></td>
                                                                <?php
                                                            }
                                                            ?>       
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
    <div class="window" id="janela1">
    <p>Na sua opinião, como foi o atendimento desta Ordem de serviço?</p>
        <input  type="radio" value="bom"  checked name="satisfacao" >Bom
        <br>
        <input  type="radio" value="medio" name="satisfacao" >Médio
        <br>
        <input  type="radio" value="ruim" name="satisfacao" >Ruim
        <br><br>
        <input class="ok" type="submit" value="Ok">
    </div>
    <!-- mascara para cobrir o site -->  
    <div  id="mascara"></div>

    <input  id ="nome_sessao" type="hidden" value="<?php echo $_SESSION['nome']; ?>">


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
    <script type="text/javascript">
    $('.admin').show();
    $('.user').hide();
    var nome_sessao=$('#nome_sessao').val();
    $('.fim').click(function(){
        var motivo;
        motivo=prompt("Informe o motivo da finalização");
        var os=$(this).attr('os');
        var desc=$(this).attr('desc');
        if(motivo===null){
            location.href="listar.php";
        }else{
            if(motivo!=''){
                $.get("finalizar.php",'fim='+motivo+'&id_os='+os+'&nome='+nome_sessao+'&desc='+desc);
                location.href="listar.php";
            }else{
                while(motivo==''){  
                    alert("Informe o motivo da finalização");
                    motivo=prompt("Informe o motivo da finalização");
                    if(motivo!=''&&motivo!=null){
                        $.get("finalizar.php",'fim='+motivo+'&id_os='+os+'&nome='+nome_sessao+'&desc='+desc);
                        location.href="listar.php";
                    }
                }
            }
        }
        location.href="listar.php";  
    });
    $('.cancel').click(function(){
        var motivo;
        motivo=prompt("Informe o motivo do cancelamento");
        var os=$(this).attr('os');
        var desc=$(this).attr('desc');
        if(motivo===null){
            location.href="listar.php";
        }else{
            if(motivo!=""){
                $.get("cancelar.php",'fim='+motivo+'&id_os='+os+'&nome='+nome_sessao+'&desc='+desc);
                location.href="listar.php";
            }else{
                while(motivo==""){  
                    alert("Informe o motivo do cancelamento");
                    motivo=prompt("Informe o motivo do cancelamento");
                    if(motivo!=''&&motivo!=null){
                        $.get("cancelar.php",'fim='+motivo+'&id_os='+os+'&nome='+nome_sessao+'&desc='+desc);
                        location.href="listar.php";
                    }
                }
            }
        }
        location.href="listar.php";  
    });
//modal finalizar com satisfação
$('.fim2').click(function(){
    var motivo=prompt("Informe o motivo da finalização");
    var os=$(this).attr('os');
    var desc=$(this).attr('desc');
    if(motivo===null){
            location.href="listar.php";
        }else{
            if(motivo!=""){
                $("a[rel=modal]").click( function(ev){
                    ev.preventDefault();
 
                    var id = $(this).attr("href");
 
                    var alturaTela = $(document).height();
                    var larguraTela = $(window).width();
     
                 //colocando o fundo preto
                    $('#mascara').css({'width':larguraTela,'height':alturaTela});
                    $('#mascara').fadeIn(1000); 
                    $('#mascara').fadeTo("slow",0.8);
    
                    var left = ($(window).width() /2) - ( $(id).width() / 2 );
                    var top = ($(window).height() / 2) - ( $(id).height() / 2 );
     
                    $(id).css({'top':top,'left':left});
                    $(id).show();   
                });
                $('.ok').click(function(ev){
                //ev.preventDefault();
                  var satisfacao=document.querySelector('input[name="satisfacao"]:checked').value;
        
                  $("#mascara").hide();
                  $(".window").hide();
                  $.get("finalizar.php",'fim='+motivo+'&id_os='+os+'&nome='+nome_sessao+'&desc='+desc+'&satisfacao='+satisfacao);
                  location.href="listar.php";

                });
                
            }else{
                while(motivo==""){  
                    alert("Informe o motivo da finalização");
                    motivo=prompt("Informe o motivo da finalização");
                    if(motivo!=''&&motivo!=null){
                        $("a[rel=modal]").click( function(ev){
                            ev.preventDefault();
                     
                            var id = $(this).attr("href");
                     
                            var alturaTela = $(document).height();
                            var larguraTela = $(window).width();
                         
                            //colocando o fundo preto
                            $('#mascara').css({'width':larguraTela,'height':alturaTela});
                            $('#mascara').fadeIn(1000); 
                            $('#mascara').fadeTo("slow",0.8);
                     
                            var left = ($(window).width() /2) - ( $(id).width() / 2 );
                            var top = ($(window).height() / 2) - ( $(id).height() / 2 );
                         
                            $(id).css({'top':top,'left':left});
                            $(id).show();   
                        });
                        $('.ok').click(function(ev){
                            //ev.preventDefault();
                            var satisfacao=document.querySelector('input[name="satisfacao"]:checked').value;
                            
                            $("#mascara").hide();
                            $(".window").hide();
                            $.get("finalizar.php",'fim='+motivo+'&id_os='+os+'&nome='+nome_sessao+'&desc='+desc+'&satisfacao='+satisfacao);
                            location.href="listar.php";

                        });
                        
                    }
                }
            }
        }
        
});
    
</script>
</body>
</html>





