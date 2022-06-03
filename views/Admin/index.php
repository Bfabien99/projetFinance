<div id="index">
    <div class="soldeTotale">
      <img src="/projetFinance/assets/img/xbank.png" alt="" width="200px" height="200px" style="display:flex;margin:0 auto;">
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
        <div class="line"></div>
        <div class="users">
          <?php if(!empty($clients)):?>
            <h4><?=count($clients)?> recents inscrits</h4>

            <?php foreach($clients as $client):?>
              <div class="content">

                <div class="left">
                  <img src="/projetFinance/uploads/user/<?=!empty($client['profil_pic']) ? $client['profil_pic']:'profilepic.png' ?>" alt="profilepic" class="pic">
                  <p><?=$client['nom']." ".$client['prenoms'] ?></p>
                </div>

                <div class="right">
                  <div class="bloc"><p>Solde</p><p><strong><?=number_format($client['solde'],2,'.',',')?> fcfa</strong></p> <a href="/projetFinance/admin/liste/<?= $client["id"]?>" class="see">voir</a></div>
                </div>

              </div>
            <?php endforeach;?>

          <?php endif?>
        </div>

    </div>

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