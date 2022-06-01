<div class="historiques">
    <?php if(!empty($historiques)):?>
        <div class="bloc">
            <h2 class="title">HISTORIQUE</h2>
            <h4><?= $message ?></h4>
        </div>
        <div class="line"></div>
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
    <?php else:?>
        <h3>Aucune transaction effectuée</h3>
    <?php endif;?>
</div>