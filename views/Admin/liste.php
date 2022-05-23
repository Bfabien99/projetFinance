<h2>Liste des clients</h2>
<?php if(!empty($clients)):?>
    <table>
        <thead>
            <tr>
                <td>Nom</td>
                <td>Prenoms</td>
                <td>Solde</td>
                <td>Action</td>
            </tr>
        </thead>

        <tbody>
            <?php foreach($clients as $client):?>
                <tr>
                    <td><?= ucfirst($client["nom"])?></td>
                    <td><?= ucwords($client["prenoms"])?></td>
                    <td><?= $client["solde"]?></td>
                    <td><a href="">voir</a></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
<?php endif;?>