<?php
ini_set('display_errors','1');
error_reporting(E_ALL);
require("phplot-5.8.0/phplot.php");
// Cria objeto do gráfico passando o tamanho
$grafico = new PHPlot(1024,768);

$dados = array(
	array('Janeiro','36'),
	array('Fevereiro','2'),
	array('Marco','15'),
	array('Abril','18')

);

// Passando os dados para o gráfico
$grafico->SetDataValues($dados);

// Define os títulos do gráfico
$grafico->SetTitle("Quantidade de Devolucoes");
$grafico->SetXTitle('Mes');
$grafico->SetYTitle('Quantidade');

// Desenha o gráfico
$grafico->DrawGraph();
