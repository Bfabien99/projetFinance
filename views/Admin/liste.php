<div id="liste">
<div class="bloc">
        <h2 class="title">LISTE DES CLIENTS</h2>
    </div>
<div class="line"></div>
<form action="" method="post">
    <div class="group"><input type="search" name="search" id="search" placeholder="rechercher un client">
    <button type="submit" id="submit">Reload</button></div>
    
</form>
<?php if(!empty($clients)):?>
    <table>
        <thead>
            <tr>
                <td>Photo</td>
                <td>Nom</td>
                <td>Prenoms</td>
                <td>Solde (Fcfa)</td>
                <td>Action</td>
            </tr>
        </thead>

        <tbody id="tbody">
            <?php foreach($clients as $client):?>
                <tr>
                    <td><img src="/projetFinance/uploads/user/<?=!empty($client['profil_pic']) ? $client['profil_pic']:'profilepic.png' ?>" alt="profilepic" class="pic"></td>
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
                                            <td><img src="/projetFinance/uploads/user/${(datas.profil_pic!="") ? datas.profil_pic:'profilepic.png'}" width="100%" alt="profilepic" class="pic"></td>
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