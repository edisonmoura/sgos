<?php 
require('../_inc/conexao.inc.php');
$sql="select s.nome, count(*) from secretaria s inner join departamento d on s.id_secretaria=d.id_secretaria group by s.id_secretaria,s.nome";
$query=pg_query($sql);
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Secretaria', 'Quantidade'],
  <?php while($dados=pg_fetch_assoc($query)):?>
          ['<?php echo $dados['nome'];?>',<?php echo $dados['count'];?>],

<?php endwhile;?> 
        ]);

        var options = {
          title: 'Grafico de Pizza - Google'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>
