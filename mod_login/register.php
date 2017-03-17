<?php
  require('../cad_usuario/select_auto.php');
  require('../_inc/select_auto2.php');
$nome="";
$cpf="";
$email="";
$fone="";
$login="";
$marcado="";
  if($_SERVER['REQUEST_METHOD']=='POST'){
    require('../_inc/conexao.inc.php');
    $nome=$_POST['nome'];
    $cpf=$_POST['cpf'];
    $quebra=explode(".", $cpf);
    $quebra2=explode("-", $quebra[2]);
    $cpf_num=$quebra[0].$quebra[1].$quebra2[0].$quebra2[1];
    $email=$_POST['email'];
    $fone=$_POST['fone'];
    $login=$_POST['login'];
    $senha=md5($_POST['senha']);
    $departamento=$_POST['select_auto'];
    $cargo=$_POST['select_auto2'];
    $query=pg_query("select * from usuario where cpf='$cpf_num'");
    if(pg_num_rows($query)){
      echo '<script type="text/javascript">alert("CPF já cadastrado!! Informe novamente!");</script>';
      $marcado="cpf";
    }else{
      $query=pg_query("select * from usuario where login='$login'");
      if(pg_num_rows($query)){
        echo '<script type="text/javascript">alert("Login já cadastrado!! Informe outro!");</script>';
        $marcado="login";
      }else{
        pg_query("INSERT INTO usuario (nome,cpf,login,senha,departamento,cargo,nivel,email,fone) VALUES ('$nome','$cpf_num','$login','$senha','$departamento','$cargo','user','$email','$fone')");
        echo '<script type="text/javascript">alert("Cadastro efetuado com sucesso!!");location.href="../index.php";</script>';
        
      }
    }
    
  }

 ?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="../assets/img/find_user.png" type="image/x-icon">
  <title>Cadastro</title>
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
  <script type="text/javascript" src="../_inc/jquery-2.2.1.min.js"></script>

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition register-page" style="background-image:url(../assets/img/background_login.jpg);background-repeat:no-repeat; background-size:100% 100%;">
<div class="register-box">
  <div class="register-box-body">
    <img src="../assets/img/find_user.png" style="width:150px;height:150px" class="text-center col-xs-offset-3">
    <div class="register-logo">
    <a href="#"><b>Cadastro</b> de usuário</a>
    </div>
    <form action="#" method="post" name="form1" id="form1">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Nome Completo" name="nome" value="<?php echo $nome;?>" required="required" id="nome">
        <span class="glyphicon glyphicon-user form-control-feedback"</span>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="CPF(apenas numeros)" name="cpf" id="cpf" value="<?php echo $cpf;?>" required="required"
        onblur="javascript: validarCPF(this.value);" onkeypress="javascript: mascara(this, cpf_mask);">
        <span class="glyphicon glyphicon-credit-card form-control-feedback"</span>
      </div>
      <div class="form-group has-feedback">
        <input type="email" class="form-control" placeholder="Email" name="email" value="<?php echo $email;?>" required="required" id="email">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="number" class="form-control" placeholder="Telefone" name="fone" value="<?php echo $fone;?>" required="required" id="fone">
        <span class="glyphicon glyphicon-earphone form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <?php select_auto('departamento','id_departamento','nome'); ?>
      </div>
      <div class="form-group has-feedback">
        <?php select_auto2('cargo','id_cargo','nome'); ?>
      </div>
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="login" name="login" value="<?php echo $login;?>" required="required" id="login">
        <span class="glyphicon glyphicon-user form-control-feedback"</span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Senha" name="senha" required="required" id="senha">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox" required="required"> Eu aceito os <a href="#">termos</a>
            </label>
          </div>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Cadastrar</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
    </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 2.2.3 -->
<script src="plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="bootstrap/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>
<script type="text/javascript">
  //foca no item que ja existe no banco
  //document.getElementById("form1").<?php echo $marcado; ?>.focus();  
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
  
  function validarCPF( cpf ){
  var filtro = /^\d{3}.\d{3}.\d{3}-\d{2}$/i;
  
  if(!filtro.test(cpf))
  {
    window.alert("CPF inválido. Tente novamente.");
    return false;
  }
   
  cpf = remove(cpf, ".");
  cpf = remove(cpf, "-");
  
  if(cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" ||
    cpf == "22222222222" || cpf == "33333333333" || cpf == "44444444444" ||
    cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" ||
    cpf == "88888888888" || cpf == "99999999999")
  {
    window.alert("CPF inválido. Tente novamente.");
    return false;
   }

  soma = 0;
  for(i = 0; i < 9; i++)
  {
    soma += parseInt(cpf.charAt(i)) * (10 - i);
  }
  
  resto = 11 - (soma % 11);
  if(resto == 10 || resto == 11)
  {
    resto = 0;
  }
  if(resto != parseInt(cpf.charAt(9))){
    window.alert("CPF inválido. Tente novamente.");
    return false;
  }
  
  soma = 0;
  for(i = 0; i < 10; i ++)
  {
    soma += parseInt(cpf.charAt(i)) * (11 - i);
  }
  resto = 11 - (soma % 11);
  if(resto == 10 || resto == 11)
  {
    resto = 0;
  }
  
  if(resto != parseInt(cpf.charAt(10))){
    window.alert("CPF inválido. Tente novamente.");
    return false;
  }
  
  return true;
 }
 
function remove(str, sub) {
  i = str.indexOf(sub);
  r = "";
  if (i == -1) return str;
  {
    r += str.substring(0,i) + remove(str.substring(i + sub.length), sub);
  }
  
  return r;
}

/**
   * MASCARA ( mascara(o,f) e execmascara() ) CRIADAS POR ELCIO LUIZ
   * elcio.com.br
   */
function mascara(o,f){
  v_obj=o
  v_fun=f
  setTimeout("execmascara()",1)
}

function execmascara(){
  v_obj.value=v_fun(v_obj.value)
}

function cpf_mask(v){
  v=v.replace(/\D/g,"")                 //Remove tudo o que não é dígito
  v=v.replace(/(\d{3})(\d)/,"$1.$2")    //Coloca ponto entre o terceiro e o quarto dígitos
  v=v.replace(/(\d{3})(\d)/,"$1.$2")    //Coloca ponto entre o setimo e o oitava dígitos
  v=v.replace(/(\d{3})(\d)/,"$1-$2")   //Coloca ponto entre o decimoprimeiro e o decimosegundo dígitos
  return v
}
</script>
</body>
</html>
