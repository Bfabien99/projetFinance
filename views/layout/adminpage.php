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

        .box{
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

        #liste{
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 10px;
            gap: 1em;
        }

        #liste table{
            width: 100%;
            border: 1px solid black;
        }

        #liste table tr{
            text-align: center;
        }

        #liste table tr td{
            padding: 5px;
        }

        #liste table tbody tr:nth-child(odd){
            background-color: #ccc;
        }

        #liste .pic{
            width: 100px;
        }

        #show{
            display: flex;
            flex-direction: column;
            width: 100%;
            gap: 1em;
            align-items: center;
        }

        #show div{
            width: 100%;
        }

        #show #info{
            max-width: 500px;
        }

        #show #info .box h3{
            font-weight: 300;
        }

        #show #info .box p{
            font-size: 1.3em;
            font-weight: 600;
        }

        #show .pic{
            display: flex;
            width: 100%;
            max-width: 300px;
            margin: 0 auto;
           border: 1px solid #e00d72;
        }

        #show #soldesClient .soldeactuel h2{
            font-size: 1.3em;
            font-weight: 300;
        }

        #show #soldesClient .soldeactuel P{
            font-size: 1.6em;
            font-weight: 600;
        }

        #show .historiques .solde h3, #historiques .solde h3{
            font-size: 1.3em;
            font-weight: 300;
        }

        #show .historiques .solde .argent, #historiques .solde .argent{
            font-size: 1.7em;
            font-weight: 600;
        }

        #historiques .solde .nom{
            font-weight: 600;
            font-style: italic;
        }

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
                flex-direction: column;
                justify-content: space-around;
                min-width: 900px;
                padding: 5px;
                gap: 1em;
            }
        }

        @media screen and (max-width : 1100px){
            .box{
                display: flex;
                flex-direction: column;
            }
        }
    </style>
</head>
<body>
    <div class="navigation">
        <h2>Admin</h2>
        <img src="/projetFinance/uploads/user/adminpic.png" alt="" width="50px" height="50px" style="border-radius:50%;">
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

        deconnect.addEventListener('click', function(e){
            e.preventDefault();
            if (confirm("Voulez-vous vraiment vous deconnecter ?") == true) {
                window.location.href = "/projetFinance/admin/logout";
                };
            });
</script>
</html>