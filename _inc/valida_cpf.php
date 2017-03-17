
<?php 
function valida_cpf($cpf){
	$cont=10;
	$soma1=0;
	$soma2=0;
	for($i=0;$i<=8;$i++){
		$soma1=$soma1+($cpf[$i]*$cont);
		$cont--;
	}
	$mod_soma=$soma1%11;
	$dig1=11-$mod_soma;
	if($dig1>9){
		$dig1=0;
	}
	if($cpf[9]==$dig1){
		$cont=11;
		for($i=0;$i<=9;$i++){
			$soma2=$soma2+($cpf[$i]*$cont);
			$cont--;
		}
		$mod_soma2=$soma2%11;
		$dig2=11-$mod_soma2;
		if($dig2>9){
		$dig2=0;
		}
		if($cpf[10]==$dig2){
		return 0;
		}
		return 1;
	}
	else{
		return 1;
	}	
}	

  
 