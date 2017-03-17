<?php
	require("verifica_sessao.inc.php");
    require("config.inc.php");
    require("conexao.inc.php");

	if(@$_GET['sair']){
		session_destroy();
		$_SESSION['logado']=null;
		header("Location:../mod_login/form.php");
		exit(0);
	}
?>	
<html>
<head>
      <meta charset="utf-8" />
      <link rel="shortcut icon" href="../assets/img/find_user.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- BOOTSTRAP STYLES-->
    <link href="../assets/css/bootstrap.css" rel="stylesheet" />
     <!-- FONTAWESOME STYLES-->
    <link href="../assets/css/font-awesome.css" rel="stylesheet" />
        <!-- CUSTOM STYLES-->
    <link href="../assets/css/custom.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="../estilo.css">
     <!-- GOOGLE FONTS-->
   <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
   <script src="../mod_os/jquery-2.2.1.min.js"></script>
   <script src="../mod_os/bootstrap.min.js"></script>
   <script src="../assets/js/jquery-3.1.0.min.js"></script>
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
                <a href="../index.php"><img src="../assets/img/find_user.png" class="user-image img-responsive"/></a>
                <div class="nome_sistema" style="text-align:center;color:white;font-size:20px;font-weight:bold;">SGOS-Município de Carambeí</div>
                <ul class="nav" id="main-menu">
                <li class="text-center">
                    <li class="<?php echo $_SESSION['nivel']; ?>">
                        <a  href="../mod_secretaria/listar.php"><i class="fa fa-desktop fa-3x <?php echo $_SESSION['nivel']; ?>"></i> Secretarias</a>
                    </li>
                    <li class="<?php echo $_SESSION['nivel']; ?>">
                        <a  href="../mod_departamento/listar.php"><i class="fa fa-edit fa-3x <?php echo $_SESSION['nivel']; ?>"></i> Departamentos</a>
                    </li>
                    <li class="<?php echo $_SESSION['nivel']; ?>">
                        <a  href="../mod_tipo/listar.php"><i class="fa fa-edit fa-3x <?php echo $_SESSION['nivel']; ?>"></i> Tipos</a>
                    </li>
                    <li class="<?php echo $_SESSION['nivel']; ?>">
                        <a  href="../mod_cargo/listar.php"><i class="fa fa-edit fa-3x <?php echo $_SESSION['nivel']; ?>"></i> Cargos</a>
                    </li>
                     <li>
                        <a  href="../mod_os/listar.php"><i class="fa fa-edit fa-3x"></i> OS</a>
                    </li>
                    <li class="<?php echo $_SESSION['nivel']; ?>">
                        <a  href="#"><i class="fa fa-bar-chart-o fa-3x"></i> Relatórios<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="../mod_relatorios/grafico_abertas.php">O.S abertas</a>
                            </li>
                        </ul>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="../mod_relatorios/grafico_satisfacao.php">Satisfação do usuário</a>
                            </li>
                        </ul>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="../mod_relatorios/grafico_ranking.php">Ranking de solicitantes</a>
                            </li>
                        </ul>              
                    </li>
                    <li class="<?php echo $_SESSION['nivel']; ?>">
                        <a  href="../cad_usuario/form.php"><i class="fa fa-user fa-3x <?php echo $_SESSION['nivel']; ?>"></i> Cadastro de Usuario</a>
                    </li>
                    <li>
                        <a  href="../cad_usuario/altera_senha.php?cod=<?php echo $_SESSION['cod']; ?>"><i class="fa fa-user fa-3x"></i> Alterar senha</a>
                    </li>
                </ul>              
            </div>
            
        </nav> 
        <!-- /. NAV SIDE  -->
<script src="../assets/js/bootstrap.min.js"></script>
<script type="text/javascript">
	$('.admin').show();
	$('.user').hide();
</script>