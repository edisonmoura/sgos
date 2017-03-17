<?php 
require('../_inc/menu.inc.php');
require('../_inc/conexao.inc.php');
$sql="SELECT  s.nome, count(*) as cont from os 
        inner join usuario u on os.cod_usuario=u.cod
        inner join departamento d on u.departamento=d.nome
        inner join secretaria s on d.id_secretaria=s.id_secretaria
        group by s.nome";
$query=pg_query($sql);
?>

    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Secretaria', 'Quantidade'],
  <?php while($dados=pg_fetch_assoc($query)):?>
          ['<?php echo $dados['nome'];?>',<?php echo $dados['cont'];?>],

<?php endwhile;?> 
        ]);

        var options = {
          title: 'Gráfico - Ranking de solicitantes'
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
  <title>Relatório</title>
 <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%">
  <div id="page-inner">
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </div>
 </div> 
 <!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="../assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../assets/js/jquery.metisMenu.js"></script>
  <script src="../assets/js/custom.js"></script>