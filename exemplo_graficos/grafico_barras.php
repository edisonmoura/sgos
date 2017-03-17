<?php
require("phplot-5.8.0/phplot.php");
// Cria objeto do gráfico passando o tamanho
$grafico = new PHPlot(350,350);

$dados = array(
	array('Meninos','36'),
	array('Meninas','2')
);

// Definindo o tipo de gráfico
$grafico->SetPlotType('bars');

// Passando os dados para o gráfico
$grafico->SetDataValues($dados);

// Define os títulos do gráfico
$grafico->SetTitle("Alunos e Alunas na Sala");
$grafico->SetXTitle('Sexo');
$grafico->SetYTitle('Quantidade');

// Desenha o gráfico
$grafico->DrawGraph();
