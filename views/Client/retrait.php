<div class="bloc">
      <h2 class="title">TRANSACTION</h2>
  </div>
<form action="" method="post" id="form">
    <h1 class="title">FAIRE UN RETRAIT</h1>
    <div id="msg"></div>
    <div class="group">
        <label for="label">Montant à retirer</label>
        <input type="text" name="montant" id="montant" placeholder="Entrer un montant">
    </div>
    <button type="submit" id="submit">Retrait</button>
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
            $('#msg').append("<img src ='/projetFinance/assets/img/loading.gif' width='100%' style='display:flex;margin:0 auto;'/>")
            $.ajax({
                url: '/projetFinance/ajax/retrait.php',
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