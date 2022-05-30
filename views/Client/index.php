<section id="index">
    <div class="top">
        <h3 class="welcome">Bienvenue à vous <?= $datas['nom'] . " " . $datas['prenoms'] ;?></h3>

        <div class="line"></div>

        <div class="solde alert alert-warning">
            <h3>SOLDE</h3>
            <p class="argent current"><?= number_format($datas['solde'],'2',',','.');?> fcfa</p>
        </div>
        <div class="solde alert alert-success">
            <h3>DEPOT TOTAL</h3>
            <p class="argent"><?= number_format($depots,'2',',','.') ?? 0;?> fcfa</p>
        </div>
        <div class="solde alert alert-info">
            <h3>RETRAIT TOTAL</h3>
            <p class="argent"><?= number_format($retraits,'2',',','.') ?? 0;?> fcfa</p>
        </div>

    </div>
   
    <div class="historique">
        <?php if(!empty($historiques)):?>
            <h4>Activité recente</h4>
            <hr>
            <?php foreach ($historiques as $historique):?>
                    <?php if($historique['type'] == 'depot'):?>
                        <div class="solde alert alert-success">
                            <h3>Dépôt</h3>
                            <p class="argent dsomme"><?= number_format($historique['somme'],'2',',','.');?> fcfa</p>
                            <p class="date"><?= date('l j M Y, à G : i',strtotime($historique['date']));?></p>
                        </div>
                    <?php else:?>
                        <div class="solde alert alert-info">
                            <h3>Retrait</h3>
                            <p class="argent rsomme"><?= number_format($historique['somme'],'2',',','.');?> fcfa</p>
                            <p class="date"><?= date('l j M Y, à G : i',strtotime($historique['date']));?></p>
                        </div>
                    <?php endif;?>
            <?php endforeach;?>
        <?php endif;?>
    </div>
</section>
