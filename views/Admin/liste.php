<div id="liste">
<h2>Liste des clients</h2>
<form action="" method="post">
    <input type="search" name="search" id="search">
    <button type="submit" id="submit">Reload</button>
</form>
<?php if(!empty($clients)):?>
    <table>
        <thead>
            <tr>
                <td>Nom</td>
                <td>Prenoms</td>
                <td>Solde (Fcfa)</td>
                <td>Action</td>
            </tr>
        </thead>

        <tbody id="tbody">
            <?php foreach($clients as $client):?>
                <tr>
                    <td><?= ucfirst($client["nom"])?></td>
                    <td><?= ucwords($client["prenoms"])?></td>
                    <td><?= $client["solde"]?></td>
                    <td><a href="liste/<?= $client["id"]?>">voir</a></td>
                </tr>
            <?php endforeach;?>
        </tbody>
    </table>
<?php else:?>
    <h3>0 client pour l'instant</h3>
<?php endif;?>
</div>
<script>
    $(document).ready(function(){

            $('#submit').on('click',function(e){
                e.preventDefault();
                window.location.reload()
            })


            $('#search').on('keyup',function()
            {
               if(($.trim($('#search').val()) !== "")){
                $.ajax({
                        url: '/projetFinance/ajax/search.php',
                        type: 'POST',
                        data: {search: $('#search').val()},
                        success: function(data)
                        {
                           if(data){
                                $('#tbody').html(" ")
                                console.log(data)
                                data = JSON.parse(data);
                                data.forEach((datas)=>{
                                    console.log(datas)
                                    $('#tbody').append(`
                                        <tr>
                                            <td>${datas.nom}</td>
                                            <td>${datas.prenoms}</td>
                                            <td>${(datas.solde)}</td>
                                            <td><a href='/projetFinance/admin/liste/${datas.id}'>voir</a></td>
                                        </tr>
                                    `)
                                })
                            }
                            else {
                                $('#tbody').html('0 correspondance');
                            }
                        
                        }
                    });
            
                
                
                
                }
            })
        
        
    })
</script>