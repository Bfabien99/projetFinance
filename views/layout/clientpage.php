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
            min-width: 100%;
            min-height: 100vh;
        }

        .navigation{
            position: sticky;
            top: 0;
            width:100%;
            height: 100vh;
            max-width: 300px;
            background-color: #333;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #fff;
        }

        .navigation h3{
            padding: 10px;
            margin-bottom: 2em;
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
            width: 100%;
            background-color: blue;
            text-align: center;
            padding: 5px;
        }

        .navigation li a{
            text-decoration: none;
            color: white;
        }

        .navigation p{
            position: absolute;
            bottom: 10px;
        }

        .container{
            width:100%;
            max-width: 700px;
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

        button{
            background-color: tomato;
            color: white;
        }

        form{
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 500px;
            margin:auto;
            align-items: center;
            padding: 10px;
            gap: 1em;
            border: 1px solid ;
            border-radius: 5px;
        }

        form .group{
            align-items: center;
            width: 100%;
            display: flex;
            flex-direction: column;
        }

        form .group input{
            outline: none;
            border: 1px solid tomato;
            max-width: 300px;
            padding: 5px;
            border-radius: 5px;
        }

        #delete{
            color: white;
            background-color: red;
            text-align: center;
        }

        .info{
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1em;
        }

        .info .box{
            width: 50%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }


    </style>
</head>
<body>
    <div class="navigation">
        <h3>ESPACE CLIENT</h3>
        <ul>
            <li><a href="/projetFinance/customer">Accueil</a></li>
            <li><a href="/projetFinance/customer/historical">Historique</a></li>
            <li><a href="/projetFinance/customer/account">Compte</a></li>
            <li><a href="/projetFinance/customer/deposite">Dépôt</a></li>
            <li><a href="/projetFinance/customer/withdraw">Retrait</a></li>
            <li><a href="/projetFinance/customer/settings">Sécurité</a></li>
            <li><a href="" class="disconnect">Déconnexion</a></li>
        </ul>
        <p>&copy;2022 XBANK</p>
    </div>

    <div class="container">
        <?= $content ?>
    </div>
</body>
<script>
    // setInterval(function(){
    //     window.location.reload();
    // },2000)

        let deconnect = document.querySelector('.disconnect');

        deconnect.addEventListener('click', function(e){
            e.preventDefault();
            if (confirm("Voulez-vous vraiment vous deconnecter ?") == true) {
                window.location.href = "/projetFinance/customer/logout";
                };
            });
</script>
</html>