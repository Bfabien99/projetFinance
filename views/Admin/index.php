<div id="index">
    <div class="soldeTotale">
        <div class="soldes">
            <div class="alert alert-warning">
                <h2 class="title">SOLDE</h2>
                <h1 class="somme"><?= number_format($sTotal,2,'.',',')." FCFA" ?? 0 ?></h1>
            </div>
            <div class="alert alert-success">
                <h2 class="title">DEPOT TOTAL</h2>
                <h1 class="somme"><?= number_format($dTotal,2,'.',',')." FCFA" ?? 0 ?></h1>
            </div>
            <div class="alert alert-info">
                <h2 class="title">RETRAIT TOTAL</h2>
                <h1 class="somme"><?= number_format($rTotal,2,'.',',')." FCFA" ?? 0 ?></h1>
            </div>
        </div>
    </div>
    <div class="line"></div>
    <div class="historique">
        <div class="bloc">
            <h2 class="title">Historiques</h2>
        </div>
        <div id="chart_div"></div>
    </div>
</div>

<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<?php if(!empty($historique)):?>
<script>
google.charts.load('current', {packages: ['corechart', 'line']});
google.charts.setOnLoadCallback(drawLineColors);

function drawLineColors() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'X');
      data.addColumn('number', 'depot ');
      data.addColumn('number', 'retrait ');

      data.addRows([
        <?php foreach($historique as $graph):?>
            <?php if($graph['type'] == 'depot'):?>
          ['<?=$graph['date']?>', <?=$graph['somme']?>, 0],
        <?php else:?>
          ['<?=$graph['date']?>', 0,<?=$graph['somme']?>],
        <?php endif;?>
        <?php endforeach;?>
      ]);

      var options = {
        vAxis: {
          title: 'Somme en FCFA'
        },
        'height':800,
        colors: ['#a52714', '#097138']
      };

      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }
</script>
<?php else:?>
    <script>
        document.getElementById('chart_div').innerHTML = "Aucune transaction effectuée"
    </script>
<?php endif?>