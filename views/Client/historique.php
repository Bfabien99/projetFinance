<div class="historique">
    <?php if(!empty($historiques)):?>
        <h4><?= $message ?></h4>
        <hr>
        <?php foreach ($historiques as $historique):?>
                <?php if($historique['type'] == 'depot'):?>
                    <div class="alert alert-success">
                        <h2>Dépôt</h2>
                        <p class="dsomme"><?= number_format($historique['somme'],'2',',','.');?> fcfa</p>
                        <p class="date"><?= date('l j M Y, à G : i',strtotime($historique['date']));?></p>
                    </div>
                <?php else:?>
                    <div class="alert alert-info">
                        <h2>Retrait</h2>
                        <p class="rsomme"><?= number_format($historique['somme'],'2',',','.');?> fcfa</p>
                        <p class="date"><?= date('l j M Y, à G : i',strtotime($historique['date']));?></p>
                    </div>
                <?php endif;?>
        <?php endforeach;?>
    <?php endif;?>
</div>