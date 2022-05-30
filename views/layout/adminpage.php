<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
         @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400;1,500;1,600&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap');

        html{
            scroll-behavior: smooth;
        }

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Poppins, 'Playfair Display';
        }

        body{
            display: flex;
            padding: 5px;
        }

        .navigation{
            width:100%;
            max-width: 300px;
        }

        .container{
            width:100%;
            max-width: 700px;
            margin:0 auto;
        }
    </style>
</head>
<body>
    <div class="navigation">
        <h2>Admin</h2>
        <img src="https://via.placeholder.com/150" alt="" width="50px" height="50px" style="border-radius:50%;">
        <ul>
            <li><a href="">Informations</a></li>
            <li><a href="">Paramètres</a></li>
            <li><a href="">Liste des clients</a></li>
            <li><a href="">Historique</a></li>
            <li><a href="" class="disconnect">Déconnexion</a></li>
        </ul>
    </div>

    <div class="container">
        <?= $content ?>
    </div>
</body>
<script>
    setInterval(function(){
        window.location.reload();
    },3000)

        let deconnect = document.querySelector('.disconnect');

        deconnect.addEventListener('click', function(e){
            e.preventDefault();
            if (confirm("Voulez-vous vraiment vous deconnecter ?") == true) {
                window.location.href = "/projetFinance/admin/logout";
                };
            });
</script>
</html>