<?php
  require("../_inc/conexao.inc.php"); 
  session_start();
  if($_SERVER['REQUEST_METHOD']=='POST'){
    require("../_inc/conexao.inc.php");
    $login=$_POST['login'];
    $senha=md5($_POST['senha']);
    $query=pg_query("SELECT * FROM usuario WHERE login='$login' AND senha='$senha'");
    if(pg_num_rows($query)){
      $_SESSION=pg_fetch_assoc($query);
      $_SESSION['logado']=true;
      header('location:../index.php');
    }
    else{
      $_SESSION['logado']=false;
      if($_SERVER['REQUEST_METHOD']=='GET'){
      exit(0);
    }
      ?>
        <script>
          alert('Dados de login inválidos!');
        </script>
      <?php
      }
  }
 ?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login SGOS</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page" style="background-image:url(../assets/img/background_login.jpg);background-size: 100% 100%;background-repeat: no-repeat;">
<div class="login-box">
  
  <div class="login-box-body">
    <img src="../assets/img/find_user.png" style="width:150px;height:150px" class="text-center col-xs-offset-3">
    <div class="login-logo">
    <b style="color:black">SGOS<h4>(Sistema Gerenciador de Ordens de Serviço)</h4></b>
  </div>
  <!-- /.login-logo -->
    </br><p class="login-box-msg">Cadastre-se ou inicie sessão</p>

    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Usuario" required="required" name="login">
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Senha" required="required" name="senha">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
        </div>
        <!-- /.col -->
        <div class="col-xs-7 col-xs-offset-1">
          <a href="#">Esqueci minha senha</a><br>
        </div>
        <!-- /.col -->
      </div>
    </form>

    </br><a href="register.php" class="text-center">Cadastre-se</a>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

</body>
</html>
