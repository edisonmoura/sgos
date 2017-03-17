<!DOCTYPE html>
<html lang="en">
<link rel="stylesheet" href="/os/bootstrap-3.3.5-dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="estilo.css">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<script src="/os/js/jquery-2.2.1.min.js"></script>
<title>SGOS-Município de Carambeí</title>
<?php 
	require("_inc/config.inc.php");
	require("_inc/verifica_sessao.inc.php");
	require('_inc/conexao.inc.php');
	if(@$_GET['sair']){
		session_destroy();
		$_SESSION['logado']=null;
		header("Location:mod_login/form.php");
		exit(0);
	}
?>
 <body class="col-md-10 col-md-offset-1">
<ul class="nav nav-pills">
  <li role="presentation" class="active"><a>Bem vindo! <?php echo $_SESSION['nome'] ?></a></li>
  <li class="<?php echo $_SESSION['nivel']; ?>" role="presentation"><a href='mod_secretaria/listar.php'>Secretarias</a></li>
  <li class="<?php echo $_SESSION['nivel']; ?>" role="presentation"><a href="mod_departamento/listar.php">Departamentos</a></li>
  <li class="<?php echo $_SESSION['nivel']; ?>" role="presentation"><a href="mod_tipo/listar.php">Tipos</a></li>
  <li class="<?php echo $_SESSION['nivel']; ?>" role="presentation"><a href="mod_cargo/listar.php">Cargos</a></li>
  <li role="presentation"><a href="mod_os/listar.php">OS</a></li>
  <li class="<?php echo $_SESSION['nivel']; ?>" role="presentation"><a  href="cad_usuario/form.php">Cadastro de Usuario</a></li>
  <li role="presentation"><a href="cad_usuario/altera_senha.php?cod=<?php echo $_SESSION['cod']; ?>">Alterar senha</a></li>
  <li role="presentation"><a  href="?sair=true">Sair</a></li>
</ul>
<?php 
if($_SESSION['nivel']=='admin'){
	$query=pg_query("select  * from os inner join usuario on cod= os.cod_usuario where (data_hora_cancelada, data_hora_finalizada) is null order by prioridade ");
}else{
	$usuario=$_SESSION['cod'];
	$query=pg_query("select * from os inner join usuario on cod= os.cod_usuario where (cod_usuario=$usuario)and(data_hora_cancelada, data_hora_finalizada) is null" );
	?>
	<div  id="comeco" class="container"  >
		
		<p>
			<h1>Começo</h1></br>
			<h3>O SGOS(Sistema Gerenciador de Ordens de Serviço) tem por objetivo
			tornar dinâmico e de forma online a abertura e andamento de ordens
			de serviço referentes ao Departamento de informática da Prefeitura
			Municipal de Carambeí.</h3><br><br>
			<h4>-Para adicionar uma ordem de serviço ou andamento em 
			uma já cadastrada <a class="clique" href="mod_os/form_cadastrar.php">clique aqui</a>.</h4>
		</p>
	</div>
	<?php
}
?>
<h1 class="titulo_index" >ORDENS DE SERVIÇO EM ABERTO</h1>
<table class="table table-hover " border="1" >
<thead title="Ordens de serviço em aberto">
	<td>OS</td>
	<td>Usuario</td>
	<td>Descrição</td>
	<td>Abertura</td>
	<td>Prioridade</td>
	<td>Ação</td>
</thead>
<?php
while ($dados = pg_fetch_assoc($query)):
?>
	<tr>
		
   			<td><a href="mod_os/andamento.php?id_os=<?php echo $dados['id_os']; ?>"><?php echo $dados['id_os']; ?></a></td>
   			<td><?php echo $dados['nome']; echo "<br>".$dados['departamento']; ?></td>
			<td><?php echo $dados['descricao']; ?></td>
			<td><?php echo $dados['data_hora_abertura']; ?></td>
			<td><?php echo $dados['prioridade']; ?></td>
			<?php
			if($_SESSION['nivel']=='admin'){
			?>
				<td><button class="fim botao" os="<?php echo $dados['id_os'];?>" desc="<?php echo $dados['descricao'];?>">Finalizar</button> <button class="cancel botao <?php echo $_SESSION['nivel']; ?>" os="<?php echo $dados['id_os'];?>" desc="<?php echo $dados['descricao'];?>">Cancelar</button></td>
 	   	<?php
 	   	}else{
 	   		?>
 	   			<td><a href="#janela1" rel="modal"><button class="fim2 botao" rel="modal" os="<?php echo $dados['id_os'];?>" desc="<?php echo $dados['descricao'];?>">Finalizar</button></a><a href="mod_os/andamento.php?id_os=<?php echo $dados['id_os']; ?>"><button>Andamento</button></a></td>
 	   		<?php
 	   		}
 	   		?>	
 	   	
    </tr>
<?php endwhile;?>
</table>
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

<input	id ="nome_sessao" type="hidden" value="<?php echo $_SESSION['nome']; ?>">
<script src="/os/bootstrap-3.3.5-dist/js/bootstrap.min.js"></script>
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




