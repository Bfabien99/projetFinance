<h1>DEPOT</h1>
<form action="" method="post" id="form">
    <div id="msg"></div>
    <div class="group">
        <label for="label">Montant à déposer</label>
        <input type="text" name="montant" id="montant" placeholder="Entrer un montant">
    </div>
    <button type="submit" id="submit">Depot</button>
</form>
<script>
    $(document).ready(function()
    {   
        $('#montant').on('keydown',function(){
            $('#msg').html(" ");
        })

        $('#form').on('submit',function(e){
            e.preventDefault();
            var montant = $('#montant').val();

            $.ajax({
                url: '/projetFinance/ajax/depot.php',
                type: 'POST',
                data: {montant: montant},
                success: function(data)
                {
                    if(data){
                        $('#msg').html(data);
                        setTimeout(function() {
                            $('#form')[0].reset();
                        },100)
                        
                    }
                }
            });

        });

    });
</script>