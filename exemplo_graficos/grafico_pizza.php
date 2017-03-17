<?php
require("../_inc/conexao.inc.php");
ini_set('display_errors','1');
error_reporting(E_ALL);
require("phplot-5.8.0/phplot.php");
// Cria objeto do gráfico passando o tamanho
$grafico = new PHPlot(350,350);
$sql="select s.nome, count(*) from secretaria s inner join departamento d on s.id_secretaria=d.id_secretaria grouip by s.id_secretaria,s.nome";
while($dados_tabela=pg_fetch_assoc($sql)):

$dados = array(
	array[]($dados_tabela['s.nome'],$dados_tabela['count'])
	
);
endwhile;
// Definindo o tipo de gráfico
$grafico->SetPlotType('pie');

// Define o tipo de dados
$grafico->SetDataType('text-data-single');

// Passando os dados para o gráfico
$grafico->SetDataValues($dados);

// Define os títulos do gráfico
$grafico->SetTitle("Alunos e Alunas na Sala");

$grafico->SetDataColors(array('yellow', 'black'));

// Constrói a legenda
foreach ($dados as $dado)
  $grafico->SetLegend(implode(': ', $dado));
$grafico->SetLegendPixels(250,270);

// Desenha o gráfico
$grafico->DrawGraph();
