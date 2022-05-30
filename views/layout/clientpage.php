<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
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
            background-color: #fff;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
            color: #ee1212;
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
            /* background-image: linear-gradient(to left, #ee1212, #f00031, #ee0049, #e9005f, #e00d72); */
            padding: 5px;
            border-radius: 5px;
            margin: 0 auto;
            font-size: 1.3em;
        }

        .navigation li a{
            text-decoration: none;
            color: #e00d72;
            
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

        button{
            background-color: tomato;
            color: white;
        }

        /* Index Page */
        .welcome{
            text-transform: uppercase;
            color: #e9005f;
            font-weight: 200;
        }

        .solde h3{
            font-size: 1.3em;
            font-weight: 400;
            text-transform: uppercase;
        }

        .solde .argent{
            font-size: 36px;
            font-weight: 600;
        }

        .solde .current{
            font-size: 46px;
            color: #e9005f;
            text-shadow: 0px 0px 5px #B5B5B5;
        }
        /** fin **/

        form{
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 500px;
            margin:auto;
            align-items: center;
            padding: 10px;
            gap: 1em;
            border-radius: 5px;
            box-shadow: 0px 0px 1px #e00d72;
        }

        form .group{
            align-items: center;
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

        .line{
            width: 200px;
            height: 2px;
            background-color: #e9005f;
            margin: 0 auto;
            margin-top: 5px;
            margin-bottom: 5px;
        }

        .bloc{
            width: 100%;
            text-align: center;
            color: #ee0049;
        }

        .title{
            color: #ee0049 !important;
        }

        /* Compte page */
        #compte{
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #compte .soldes, #compte .info{
            width: 100%;
        }

        #compte .info{
            display: flex;
            flex-direction: column;
            gap: 1em;
        }

        #compte .info h3{
            color: #e00d72;
            text-decoration: underline;
        }

        #compte .info .box{
            display: flex;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
        }

        #compte .info .box h2{
            color: #e9005f;
            font-weight: 200;
            text-decoration: underline;
        }

        #compte .info .box p{
            font-size: 1.1em;
            margin: auto 0;
        }

        #compte .graph{
            width: 100%;
            height: 300px;
            text-align: center;
            margin: 5px;
            overflow-x: auto;
            box-shadow: 0px 0px 1px #a1a1a1;
        }

        /** fin **/

        /* Params page */
        #params{
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 1em;
        }
        /** fin **/
        @media screen and (min-width : 1120px){
            #index{
                display: flex;
                flex-direction: row;
                justify-content: space-around;
                min-width: 900px;
            }
        }

        @media screen and (max-width : 1100px){
            #compte .info .box{
                display: flex;
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="navigation">
        <h3>ESPACE CLIENT</h3>
        <ul>
            <li><i class="bi bi-house-door-fill"></i><a href="/projetFinance/customer">Accueil</a></li>
            <li><i class="bi bi-clock-history"></i><a href="/projetFinance/customer/historical">Historique</a></li>
            <li><i class="bi bi-briefcase"></i><a href="/projetFinance/customer/account">Compte</a></li>
            <li><i class="bi bi-cash-stack"></i><a href="/projetFinance/customer/deposite">Dépôt</a></li>
            <li><i class="bi bi-clipboard2-check"></i><a href="/projetFinance/customer/withdraw">Retrait</a></li>
            <li><i class="bi bi-gear"></i><a href="/projetFinance/customer/settings">Sécurité</a></li>
            <li><i class="bi bi-box-arrow-left"></i><a href="" class="disconnect">Déconnexion</a></li>
        </ul>
        <p>&copy;2022 XBANK</p>
    </div>

    <div class="container">
        <?= $content ?>
    </div>
</body>
<script>
    let deconnect = document.querySelector('.disconnect');

    deconnect.addEventListener('click', function(e){
        e.preventDefault();
        if (confirm("Voulez-vous vraiment vous deconnecter ?") == true) {
            window.location.href = "/projetFinance/customer/logout";
            };
        });
</script>
</html>