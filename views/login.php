<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <script src="<?= $_SERVER["REQUEST_URI"] ?>assets/js/jquery.js"></script>
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>
    <form action="" method="post" id="form">
        <div id="msg"></div>
        <div class="group">
             <label for="id">Numéro ou Email</label>
            <input type="text" name="identifiant" id="identifiant">
        </div>
        <div class="group">
             <label for="password">Mot de passe</label>
            <input type="password" name="password" id="password">
        </div>

        <button type="submit" id="submit">Connecter</button>
    </form>
</body>
<script>
    $(document).ready(function()
    {

        $('#form').on('submit',function(e){
            e.preventDefault();
            var identifiant = $('#identifiant').val();
            var password = $('#password').val();

            $.ajax({
                url: 'ajax/login.php',
                type: 'POST',
                data: {identifiant: identifiant, password: password},
                success: function(data)
                {
                    if(data == "client"){
                        window.location.href = "/projetFinance/customer";
                    }
                    else if(data == "admin"){
                        window.location.href = "/projetFinance/admin";
                    }
                    else{
                        $('#msg').html(data);
                        setTimeout(function() {
                            $('#msg').html("");
                        },5000)
                    }
                }
            });

        });

    });
</script>
</html>