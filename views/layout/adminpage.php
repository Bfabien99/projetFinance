<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        html{
            scroll-behavior: smooth;
        }

        *{
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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
        <img src="https://via.placeholder.com/150" alt="" width="50px" height="50px" style="border-radius:50%;">
        <ul>
            <li><a href="">Informations</a></li>
            <li><a href="">Paramètres</a></li>
            <li><a href="">Liste des clients</a></li>
            <li><a href="">Historique</a></li>
            <li><a href="">Déconnexion</a></li>
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
</script>
</html>