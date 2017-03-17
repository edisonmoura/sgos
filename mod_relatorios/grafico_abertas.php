<?php 
  require('../_inc/menu.inc.php');
  require('../_inc/conexao.inc.php');
  $sql="SELECT COUNT(*) as TOTAL,extract(month from data_hora_abertura) AS MES,
          case extract(month from data_hora_abertura)
          when 1 then 'Janeiro'
          when 2 then 'Fevereiro'
          when 3 then 'MarÃ§o'
          when 4 then 'Abril'
          when 5 then 'Maio'
          when 6 then 'Junho'
          when 7 then 'Julho'
          when 8 then 'Agosto'
          when 9 then 'Setembro'
          when 10 then 'Outubro'
          when 11 then 'Novembro'
          when 12 then 'Dezembro'
          end AS MESDESC FROM os
          GROUP BY MESDESC,MES";
  $query=pg_query($sql);
 ?>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <div id="page-wrapper" style="background-image: url(../assets/img/background_login.jpg);background-repeat:no-repeat;background-size:100% 100%" >
   <div id="page-inner">
    <!--<select id="format-select">
      <option value="">none</option>
      <option value="decimal" selected>decimal</option>
      <option value="scientific">scientific</option>
      <option value="percent">percent</option>
      <option value="currency">currency</option>
      <option value="short">short</option>
      <option value="long">long</option>
    </select>
    !-->
    <div id="number_format_chart">
  </div>
  </div> 
    <script type="text/javascript">
      google.charts.load('current', {packages:['corechart']});
      google.charts.setOnLoadCallback(drawStuff);
        function drawStuff() {
          var data = new google.visualization.DataTable();
          data.addColumn('string', 'Mês');
          data.addColumn('number', 'Quantidade de O.S');
         <?php while($dados=pg_fetch_assoc($query)):?>
          data.addRows([['<?php echo $dados['mesdesc']?>',<?php echo $dados['total']?>]]);
         <?php endwhile; ?>
         var options = {
           title: 'Gráfico de quantidade de O.S por Mês',
           width: 1000,
           height: 600,
           legend: 'none',
           bar: {groupWidth: '95%'},
           vAxis: { gridlines: { count: 8 } }
         };

         var chart = new google.visualization.ColumnChart(document.getElementById('number_format_chart'));
         chart.draw(data, options);

         //document.getElementById('format-select').onchange = function() {
           //options['vAxis']['format'] = this.value;
           chart.draw(data, options);
        // };
      };
    </script>

</script>      
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
    <!-- JQUERY SCRIPTS -->
    <script src="../assets/js/jquery-1.10.2.js"></script>
      <!-- BOOTSTRAP SCRIPTS -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- METISMENU SCRIPTS -->
    <script src="../assets/js/jquery.metisMenu.js"></script>
  <script src="../assets/js/custom.js"></script>