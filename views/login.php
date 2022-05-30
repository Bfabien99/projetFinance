<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <script src="/projetFinance/assets/js/jquery.js"></script>
    <title>Connexion</title>
    <style>
        body{
            background-color: #fff;
            color: black;
            font-family: 'Playfair Display', Poppins, serif;
        }

        .container{
            display: flex;
            flex-direction: column;
            gap: 2em;
            padding: 10px;
            align-items: center;
        }

        .title{
            font-size: 72px;
            text-align: center;
            padding: 1em;
            text-decoration: underline;
            font-weight: 600;
        }

        form{
            width: 100%;
            max-width: 500px;
            margin: auto;
            display: flex;
            flex-direction: column;
            gap: 1em;
            align-items: center;
            box-shadow: 0px 0px 1px #e00d72;
            padding: 15px;
            border-radius: 5px;
            color: #444;
        }

        form h1{
            color: red;
        }

        form .group{
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        form .group input{
            transition: all 0.2s;
            outline: none;
            height: 30px;
            padding: 5px;
            border: 1px solid #444;
            border-radius: 5px;
            color: #e00d72;
        }

        form .group input:focus{
            border: 1px solid #ee1212;
        }

        button{
            text-decoration: none;
            border: none;
            border-radius: 5px;
            padding: 5px;
            min-width: 200px;
            color: white;
            background-image: linear-gradient(to left, #ee1212, #f00031, #ee0049, #e9005f, #e00d72);
        }

        .forget{
            color: #e00d72;
        }

        .back{
            text-decoration: none;
            color: white;
            padding: 5px;
            border-radius: 5px;
            background-color: #0d0c45;
        }

        .line{
            width: 200px;
            height: 2px;
            background-color: #e9005f;
        }
    </style>
</head>
<body>
    <div class="container">

        <div class="block">
            <h1 class="title">X-BANK</h1>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nobis, illum!</p>
        </div>

        <div class="line"></div>

        <form action="" method="post" id="form">

            <h1>Connexion</h1>

            <div id="msg"></div>

            <div class="group">
                <label for="id">Numéro ou Email</label>
                <input type="text" name="identifiant" id="identifiant">
            </div>

            <div class="group">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password">
            </div>

            <a href="/projetFinance/forget" class="forget">Mot de passe oublié ?</a>

            <button type="submit" id="submit">Connecter</button>

        </form>

        <a href="/projetFinance" class="back">Retour</a>

    </div>
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