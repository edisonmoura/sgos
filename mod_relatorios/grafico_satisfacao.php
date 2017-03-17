<?php
require('../_inc/conexao.inc.php');
require('../_inc/menu.inc.php');
$sql="SELECT count(*) as total, satisfacao from os where satisfacao is not null  group by satisfacao";
$query=pg_query($sql);
?>
<html>
  <head>
   <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
   <script type="text/javascript">
      google.charts.load('current', {'packages':['gauge']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Label', 'Value'],
        <?php while($dados=pg_fetch_assoc($query)): 
         if($dados['satisfacao']!=''){ 
        ?>
          ['<?php echo $dados['satisfacao']?>',<?php echo $dados['total']?>],
        <?php }
        endwhile; ?>
        ]);
 
        var options = {
          width: 600, height: 300,
          redFrom: 90, redTo: 100,
          yellowFrom:75, yellowTo: 90,
          minorTicks: 5
        };

        var chart = new google.visualization.Gauge(document.getElementById('chart_div'));

        chart.draw(data, options);

        /*setInterval(function() {
          data.setValue(0, 1, 40 + Math.round(60 * Math.random()));
          chart.draw(data, options);
        }, 13000);
        setInterval(function() {
          data.setValue(1, 1, 40 + Math.round(60 * Math.random()));
          chart.draw(data, options);
        }, 5000);
        setInterval(function() {
          data.setValue(2, 1, 60 + Math.round(20 * Math.random()));
          chart.draw(data, options);
        }, 26000);*/
      }
    </script>
  </head>
  <body>
    <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%" >
      <div id="page-inner">
        <h1 style="margin-left:220px;text-weight:bold;color:rgb(51, 122, 183);">Nível de satisfação dos usuários</h1>
        <div id="chart_div" class="container" style="margin-top:100px;margin-left:180px;"></div>
      </div>
    </div>   
  </body>
</html>
