<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <script src="/projetFinance/assets/js/jquery.js"></script>
    <title>Forget</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400;1,500;1,600&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap');

        body{
            background-color: #fff;
            color: black;
            font-family: Poppins,'Playfair Display', Poppins, serif;
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
        }

        h2{
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
        <img src="/projetFinance/assets/img/xbank.png" alt="" width="200px" height="200px" style="display: flex;margin:0 auto;border-radius:50%">
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nobis, illum!</p>
        </div>

        <div class="line"></div>

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

        <a href="/projetFinance/login" class="back">Retour</a>
    </div>
    
</body>
<script>
    $(document).ready(function()
    {

        $('#form').on('submit',function(e){
            e.preventDefault();
            $('#msg').append("<img src ='/projetFinance/assets/img/loading.gif' width='100%' style='display:flex;margin:0 auto;'/>")
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