<?php 
	session_start();
	if(!isset($_SESSION['logado'])or!$_SESSION['logado']){
		header('Location: http://carambei.pr.gov.br/os/mod_login/form.php');
		exit(0);
		
	}
?>
