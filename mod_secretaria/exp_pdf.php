<?php 
require('../_inc/dompdf/dompdf_config.inc.php');
require('../_inc/conexao.inc.php');
ob_start();
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
$query = pg_query("SELECT * FROM secretaria WHERE nome ilike '%$nome_pesq%' ORDER BY nome");
 
 ?>
 <html>
 	<head>
 		<title>Relatório de Segretarias</title>
 		<meta charset="utf-8">
 		<style type="text/css">
			body{
				background-image: url(../images/logoapagado.png);
				color:blue;
				font-family: sans-serif;
			}
			h1{
				color:blue;
				text-align: center;
			}
			img{
				float:right;
			}
 		</style>
 	</head>
 	<body>
 		<img src="../images/logo.png" height="142" width="145" alt="logo_carambei">
 		<h1>Prefeitura Municipal de Carambeí</h1>
 		<table>
 			<thead>
 				<tr>
 					<td>
 						Nome da Secretaria
 					</td>
 				</tr>
 			</thead>
 			<?php while($dados=pg_fetch_assoc($query)):?>
 			<tr>
 				<td>
					<?php 
						echo $dados['nome'];
					?> 				
 				</td>
 			</tr>
 		<?php endwhile;?>
 		</table>
 	</body>
 </html>
 <?php 
$html=ob_get_clean();
$dompdf=new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper('a4','portraite');
$dompdf->render();
$dompdf->stream('secretarias.pdf');
