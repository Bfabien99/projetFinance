<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <script src="/projetFinance/assets/js/jquery.js"></script>
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
            min-width: 100%;
            min-height: 100vh;
        }

        .navigation{
            position: sticky;
            top: 0;
            width:100%;
            height: 100vh;
            max-width: 300px;
            background-image: linear-gradient(to left, #ee1212, #f00031, #ee0049, #e9005f, #e00d72);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: white;
            border: 1px solid #ee0049;
        }

        .navigation h3{
            padding: 10px;
            margin-bottom: 2em;
            text-decoration: underline;
        }

        .navigation ul{
            width: 100%;
            min-height: 350px;
            list-style: none;
            display: flex;
            flex-direction: column;
            justify-content: space-evenly;
            overflow: hidden;
            gap: 1em;
        }

        .navigation ul li {
            transition: all 0.2s;
            width: 80%;
            padding: 5px;
            border-radius: 5px;
            margin: 0 auto;
            font-size: 1.3em;
        }

        .navigation li a{
            text-decoration: none;
            color: #eee;
            text-shadow: 0px 0px 5px #999;
        }

        .navigation li:hover{
            background-image: linear-gradient(to left, #ee1212, #f00031, #ee0049, #e9005f, #e00d72);
            color: white;
            text-align: center;
        }

        .navigation li:hover a{
            color: white;
        }

        .navigation p{
            position: absolute;
            bottom: 10px;
        }

        .container{
            width: calc(100%-300px);
            height: 100vh;
            margin:0 auto;
            display: flex;
            flex-direction: column;
            overflow: auto;
            padding: 5px;
        }

        button,a{
            text-decoration: none;
            border: none;
            border-radius: 5px;
            padding: 5px;
            min-width: 200px;
        }
    </style>
</head>
<body>
    <div class="navigation">
        <h2>Admin</h2>
        <img src="https://via.placeholder.com/150" alt="" width="50px" height="50px" style="border-radius:50%;">
        <ul>
            <li><i class="bi bi-speedometer2"></i><a href="/projetFinance/admin">Dashboard</a></li>
            <li><i class="bi bi-people"></i><a href="/projetFinance/admin/liste">Liste des clients</a></li>
            <li><i class="bi bi-clock-history"></i><a href="/projetFinance/admin/historique">Historique</a></li>
            <li><i class="bi bi-gear"></i><a href="/projetFinance/admin/parametres">Paramètres</a></li>
            <li><i class="bi bi-box-arrow-left"></i><a href="" class="disconnect">Déconnexion</a></li>
        </ul>
    </div>

    <div class="container">
        <?= $content ?>
    </div>
</body>
<script>
    // setInterval(function(){
    //     window.location.reload();
    // },3000)

        let deconnect = document.querySelector('.disconnect');

        deconnect.addEventListener('click', function(){
            e.preventDefault();
            if (confirm("Voulez-vous vraiment vous deconnecter ?") == true) {
                window.location.href = "/projetFinance/admin/logout";
                };
            });
</script>
</html>