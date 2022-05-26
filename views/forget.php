<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <script src="/projetFinance/assets/js/jquery.js"></script>
    <title>Forget</title>
</head>
<body>
    <h2>Récupération de mot de passe</h2>
    <form action="" method="post" id="form">
        <div id="msg"></div>
        <div class="group">
            <label for="nom">Nom</label>
            <input type="text" name="nom" id="nom">
        </div>

        <div class="group">
            <label for="prenoms">Prenoms</label>
            <input type="text" name="prenoms" id="prenoms">
        </div>

        <div class="group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
        </div>

        <div class="group">
            <label for="contact">Contact</label>
            <input type="text" name="contact" id="contact">
        </div>

        <button type="submit" id="submit">Envoyer</button>
    </form>
</body>
<script>
    $(document).ready(function()
    {

        $('#form').on('submit',function(e){
            e.preventDefault();
            var nom = $('#nom').val();
            var prenoms = $('#prenoms').val();
            var email = $('#email').val();
            var contact = $('#contact').val();

            $.ajax({
                url: 'ajax/forget.php',
                type: 'POST',
                data: {nom: nom, prenoms: prenoms, email: email, contact: contact},
                success: function(data)
                {
                    if(data){
                        $('#msg').html(data);
                    }
                }
            });

        });

    });
</script>
</html>