<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <script src="/projetFinance/assets/js/jquery.js"></script>
    <title>Customer</title>
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
        <h3>ESPACE CLIENT</h3>
        
        <ul>
            <li><a href="/projetFinance/customer">Accueil</a></li>
            <li><a href="">Historique</a></li>
            <li><a href="">Compte</a></li>
            <li><a href="/projetFinance/customer/deposite">Dépôt</a></li>
            <li><a href="/projetFinance/customer/withdraw">Retrait</a></li>
            <li><a href="">Paramètres</a></li>
            <li><a href="" class="disconnect">Déconnexion</a></li>
        </ul>
    </div>

    <div class="container">
        <?= $content ?>
    </div>
</body>
<script>
    // setInterval(function(){
    //     window.location.reload();
    // },7000)

        let deconnect = document.querySelector('.disconnect');

        deconnect.addEventListener('click', function(e){
            e.preventDefault();
            if (confirm("Voulez-vous vraiment vous deconnecter ?") == true) {
                window.location.href = "/projetFinance/customer/logout";
                };
            });
</script>
</html>