<section id="compte">
  <div class="bloc">
      <h2 class="title">COMPTE</h2>
  </div>

  <div class="line"></div>

  <div class="soldes">
    <div class="solde alert alert-warning">
      <h3>Solde ACTUEL</h3>
      <p class="current argent"><?= number_format($customer['solde'],'2',',','.');?> fcfa</p>
    </div>

    <div class="solde alert alert-success">
      <h3>DEPOT TOTAL</h3>
      <p class="argent"><?= number_format($depotTotal,'2',',','.') ?? 0;?> fcfa</p>
    </div>

    <div class="solde alert alert-info">
      <h3>RETRAIT TOTAL</h3>
      <p class="argent"><?= number_format($retraitTotal,'2',',','.') ?? 0;?> fcfa</p>
    </div>
  </div>
  

  <div class="line"></div>

  <div class="info">
    <h3>Informations Personnelles</h3>
    <div class="box"><h2>Nom</h2><p><?=mb_strtoupper($customer['nom'])?></p></div>
    <div class="box"><h2>Prénoms</h2><p><?=mb_strtoupper($customer['prenoms'])?></p></div>
    <div class="box"><h2>Contact</h2><p><?=$customer['contact']?></p></div>
    <div class="box"><h2>Email</h2><p><?=mb_strtolower($customer['email'])?></p></div>
    <div class="box"><h2>Ouvert le</h2><p><?=date("d-m-Y à G:i",strtotime($customer['date_creation']))?></p></div>
    <a href="delete" id="delete">Fermer Le compte</a>
  </div>

  <div class="line"></div>

  <!--Div that will hold the pie chart-->
  <div class="graph" id="bilangraph"></div>
  <div class="graph" id="bandeDiagram"></div>

</section>
<!--Load the AJAX API-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">
  var d = <?= !empty($depotLength) ? count($depotLength):0 ?>;
  var r = <?= !empty($retraitLength) ? count($retraitLength):0 ?>;

  // Load the Visualization API and the corechart package.
  google.charts.load('current', {'packages':['corechart'], 'language': 'fr'});

  // Set a callback to run when the Google Visualization API is loaded.
  google.charts.setOnLoadCallback(drawChart1);
  google.charts.setOnLoadCallback(drawChart);

  // Callback that creates and populates a data table,
  // instantiates the pie chart, passes in the data and
  // draws it.
  function drawChart1() {

    // Create the data table.
    var data = new google.visualization.DataTable();
    data.addColumn('string', 'Topping');
    data.addColumn('number', 'Slices');
    data.addRows([
      ['Depot', d],
      ['Retrait', r],
    ]);

    // Set chart options
    var options = {'title':'Bilan transaction( nombre d\'opérations effectuée)'};

    // Instantiate and draw our chart, passing in some options.
    var chart = new google.visualization.PieChart(document.getElementById('bilangraph'));
    chart.draw(data, options);
  }

  function drawChart() {
    var data = google.visualization.arrayToDataTable([
      ['Year', 'Depot', 'Retrait'],
      <?php foreach($bilans as $historique):?>
        <?php if($historique['type'] == 'depot'):?>
          ['<?=$historique['date']?>', <?=$historique['somme']?>, 0],
        <?php else:?>
          ['<?=$historique['date']?>', 0,<?=$historique['somme']?>],
        <?php endif;?>
      <?php endforeach ?>
    ]);


  var options = {
      
        legend: {position: 'top', maxLines: 3},
        title: 'Dix dernières transactions éffectuées (en Fcfa)',
        subtitle: 'Depot, Retrait',
    };


    var chart = new google.visualization.ColumnChart(document.getElementById('bandeDiagram'));

    chart.draw(data, options);
  }
</script>
<script>
  let supprimer = document.querySelector('#delete');
  supprimer.addEventListener('click', function(e){
      e.preventDefault();
      if (confirm("Voulez-vous vraiment vous supprimer votre compte ? Cette action est irréversible") == true) {
          window.location.href = "/projetFinance/customer/delete";
          };
      });
</script>
