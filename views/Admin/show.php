<div id="show">
    <?php if(!empty($client)):?>
        <div id="info">
            <div class="box"><h3>Nom :</h3> <p><?= $client['nom'] ?></p></div>
            <div class="box"><h3>Prenoms :</h3> <p><?= $client['prenoms'] ?></p></div>
            <div class="box"><h3>Contact :</h3> <p><?= $client['contact'] ?></p></div>
            <div class="box"><h3>Email :</h3> <p><?= $client['email'] ?></p></div>
            <div class="box"><h3>Ouvert le :</h3> <p><?= $client['date_creation'] ?></p></div>
        </div>

        <div class="line"></div>

        <div id="soldesClient">
            <div class="soldeactuel">
                <div class="alert alert-warning">
                    <h2>Solde actuelle</h2>
                    <p><?= number_format($client['solde'],2,'.',',')?> Fcfa</p>
                </div>

                <div class="alert alert-success">
                    <h2>Depot Total</h2>
                    <p><?= number_format($dTotal,2,'.',',')?> Fcfa</p>
                </div>

                <div class="alert alert-success">
                    <h2>Retrait Total</h2>
                    <p><?= number_format($rTotal,2,'.',',')?> Fcfa</p>
                </div>
            </div>
        </div>

        <div class="historiques">
            <?php if(!empty($historiques)):?>
                <h3><?= count($historiques)?> Dernières Transactions</h3>
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
                <h2>Aucune transaction effectuée</h2> 
            <?php endif?>
        </div>
    <?php else:?>
        <h2>Vous avez entré un identifiant incorrect!</h2> 
    <?php endif?>
</div>