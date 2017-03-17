<?php
require("_inc/config.inc.php");
require("_inc/verifica_sessao.inc.php");
require('_inc/conexao.inc.php');

if(@$_GET['sair']){
  session_destroy();
  $_SESSION['logado'] = null;
  header("Location: mod_login/form.php");
  exit(0);
}
?>
<html>
<head>
    <title>SGOS-Município de Carambeí</title>
      <meta charset="utf-8" />
      <link rel="shortcut icon" href="assets/img/find_user.png" type="image/x-icon">
      <title>Inicio</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<!-- BOOTSTRAP STYLES-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
     <!-- MORRIS CHART STYLES-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link rel="stylesheet" href="estilo.css">
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <script src="mod_os/jquery-2.2.1.min.js"></script>
   <script src="mod_os/bootstrap.min.js"></script>
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div 
                style="color: white;
                    padding: 15px 50px 5px 50px;
                    float: right;
                    font-size: 22px;"class="navbar-brand">Bem vindo, <?php echo $_SESSION['login']; ?><br /></div> 
            </div>
            <div
                 style="color: white;
                padding: 15px 50px 5px 50px;
                float: right;
                font-size: 16px;"><a href="?sair=true" class="btn btn-success square-btn-adjust">Sair</a> </div>
        </nav>   
        <!-- /. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <a href="index.php"><img src="assets/img/find_user.png" class="user-image img-responsive"/></a>
                <div class="nome_sistema" style="text-align:center;color:white;font-size:20px;font-weight:bold;">SGOS-Município de Carambeí</div>
                <ul class="nav" id="main-menu">
				    <li class="<?php echo $_SESSION['nivel']; ?>">
                        <a  href="mod_secretaria/listar.php"><i class="fa fa-desktop fa-3x"></i> Secretarias</a>
                    </li>
                    <li class="<?php echo $_SESSION['nivel']; ?>">
                        <a  href="mod_departamento/listar.php"><i class="fa fa-edit fa-3x"></i> Departamentos</a>
                    </li>
                    <li class="<?php echo $_SESSION['nivel']; ?>">
                        <a  href="mod_tipo/listar.php"><i class="fa fa-edit fa-3x"></i> Tipos</a>
                    </li>
                    <li class="<?php echo $_SESSION['nivel']; ?>">
                        <a  href="mod_cargo/listar.php"><i class="fa fa-edit fa-3x"></i> Cargos</a>
                    </li>
                     <li>
                        <a  href="mod_os/listar.php"><i class="fa fa-edit fa-3x"></i> OS</a>
                    </li>
                    <li class="<?php echo $_SESSION['nivel']; ?>">
                        <a  href="#"><i class="fa fa-bar-chart-o fa-3x"></i> Relatórios<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="mod_relatorios/grafico_abertas.php">O.S abertas</a>
                            </li>
                        </ul>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="mod_relatorios/grafico_satisfacao.php">Satisfação do usuário</a>
                            </li>
                        </ul>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="mod_relatorios/grafico_ranking.php">Ranking de solicitantes</a>
                            </li>
                        </ul>              
                    </li>
                    <li class="<?php echo $_SESSION['nivel']; ?>">
                        <a  href="cad_usuario/form.php"><i class="fa fa-user fa-3x"></i> Cadastro de Usuario</a>
                    </li>
                    <li>
                        <a  href="cad_usuario/altera_senha.php?cod=<?php echo $_SESSION['cod']; ?>"><i class="fa fa-user fa-3x"></i> Alterar senha</a>
                    </li>
				</ul>              
            </div>
        </nav>  
        <!-- /. NAV SIDE  -->
         <div id="page-wrapper" style="background-image: url(assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
            <div id="page-inner">             
            <!-- /. PAGE INNER  -->
        <?php 
            if($_SESSION['nivel']=='admin'){
                $query=pg_query("select  * from os inner join usuario on cod= os.cod_usuario where (data_hora_cancelada, data_hora_finalizada) is null order by prioridade ");
            }else{
                $usuario=$_SESSION['cod'];
                $query=pg_query("select * from os inner join usuario on cod= os.cod_usuario where (cod_usuario=$usuario)and(data_hora_cancelada, data_hora_finalizada) is null" );
        ?>
       
                    <div class="row">
                        <div class="col-md-12">
                            <div class="jumbotron">
                                <h1>Começo</h1></br>
                                    <p>O SGOS(Sistema Gerenciador de Ordens de Serviço) tem por objetivo
                                    tornar dinâmico e de forma online a abertura e andamento de ordens
                                    de serviço referentes ao Departamento de informática da Prefeitura
                                    Municipal de Carambeí.</p><br><br>
                                    <h4>-Para adicionar uma ordem de serviço ou andamento em 
                                    uma já cadastrada <a class="clique" href="mod_os/form_cadastrar.php">clique aqui</a>.</h4>
                               <?php }?>
                                <div class="panel-body">
                            <div class="panel panel-default col-md-12">
                                <div class="panel-heading">
                                    <h2>ORDENS DE SERVIÇO EM ABERTO</h2>
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>OS</th>
                                                    <th>Usuario</th>
                                                    <th>Descrição</th>
                                                    <th>Abertura</th>
                                                    <th>Prioridade</th>
                                                    <th>Ação</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        while ($dados = pg_fetch_assoc($query)):
                                                    ?>
                                                    <tr class="odd gradeX">
                                                        <td><a href="mod_os/andamento.php?id_os=<?php echo $dados['id_os']; ?>"><?php echo $dados['id_os']; ?></a></td>
                                                        <td><?php echo $dados['nome']; echo "<br>".$dados['departamento']; ?></td>
                                                        <td><?php echo $dados['descricao']; ?></td>
                                                        <td><?php echo $dados['data_hora_abertura']; ?></td>
                                                        <td><?php echo $dados['prioridade']; ?></td>
                                                        <?php
                                                            if($_SESSION['nivel']=='admin'){
                                                            ?>
                                                                <td><button class="fim botao" os="<?php echo $dados['id_os'];?>" 
                                                                    desc="<?php echo $dados['descricao'];?>">Finalizar</button> 
                                                                    <button class="cancel botao <?php echo $_SESSION['nivel']; ?>" os="<?php echo $dados['id_os'];?>" 
                                                                    desc="<?php echo $dados['descricao'];?>">Cancelar</button></td>
                                                            <?php
                                                            }else{
                                                            ?>
                                                                <td><a href="#janela1" rel="modal"><button class="fim2 botao" rel="modal" os="<?php echo $dados['id_os'];?>"
                                                                desc="<?php echo $dados['descricao'];?>">Finalizar</button>
                                                                </a><a href="mod_os/andamento.php?id_os=<?php echo $dados['id_os']; ?>"><button>Andamento</button></a></td>
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
        </div>
            
<div class="window " id="janela1">
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
<div id="mascara"></div>

    <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
        <script>
            $(document).ready(function () {
                $('#dataTables-example').dataTable();
            });
    </script>
      <!-- CUSTOM SCRIPTS -->
    <script src="assets/js/custom.js"></script>

    
    <script type="text/javascript">
    $('.admin').show();
    $('.user').hide();
    var nome_sessao='<?php echo $_SESSION['nome']; ?>';
    $('.fim').click(function(){
        var motivo;
        motivo=prompt("Informe o motivo da finalização");
        var os=$(this).attr('os');
        var desc=$(this).attr('desc');
        if(motivo===null){
            location.href="index.php";
        }else{
            if(motivo!=''){
                $.get("mod_os/finalizar.php",'fim='+motivo+'&id_os='+os+'&nome='+nome_sessao+'&desc='+desc);
                location.href="index.php";
            }else{
                while(motivo==''){  
                    alert("Informe o motivo da finalização");
                    motivo=prompt("Informe o motivo da finalização");
                    if(motivo!=''&&motivo!=null){
                        $.get("mod_os/finalizar.php",'fim='+motivo+'&id_os='+os+'&nome='+nome_sessao+'&desc='+desc);
                        location.href="index.php";
                    }
                }
            }
        }
        location.href="index.php";  
    });
    $('.cancel').click(function(){
        var motivo;
        motivo=prompt("Informe o motivo do cancelamento");
        var os=$(this).attr('os');
        var desc=$(this).attr('desc');
        if(motivo===null){
            location.href="index.php";
        }else{
            if(motivo!=""){
                $.get("mod_os/cancelar.php",'fim='+motivo+'&id_os='+os+'&nome='+nome_sessao+'&desc='+desc);
                location.href="index.php";
            }else{
                while(motivo==""){  
                    alert("Informe o motivo do cancelamento");
                    motivo=prompt("Informe o motivo do cancelamento");
                    if(motivo!=''&&motivo!=null){
                        $.get("mod_os/cancelar.php",'fim='+motivo+'&id_os='+os+'&nome='+nome_sessao+'&desc='+desc);
                        location.href="index.php";
                    }
                }
            }
        }
        location.href="index.php";  
    });
//modal finalizar com satisfação
$('.fim2').click(function(){
    var motivo=prompt("Informe o motivo da finalização");
    var os=$(this).attr('os');
    var desc=$(this).attr('desc');
    if(motivo===null){
            location.href="index.php";
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
                  $.get("mod_os/finalizar.php",'fim='+motivo+'&id_os='+os+'&nome='+nome_sessao+'&desc='+desc+'&satisfacao='+satisfacao);
                  location.href="index.php";

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
                            $.get("mod_os/finalizar.php",'fim='+motivo+'&id_os='+os+'&nome='+nome_sessao+'&desc='+desc+'&satisfacao='+satisfacao);
                            location.href="index.php";

                        });
                        
                    }
                }
            }
        }
        
});
</script>
   
</body>
</html>
