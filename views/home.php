<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
    <title>Home</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;0,600;1,400;1,500;1,600&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;1,100;1,200;1,300;1,400;1,500;1,600&display=swap');

        body{
            background-image: linear-gradient(to bottom, #845ec2, #8051cd, #7b42d7, #7630e1, #7012eb);
            color: white;
            font-family: Poppins,'Playfair Display',  serif;
            min-height: 100vh;
        }

        .container{
            display: flex;
            flex-direction: column;
            gap: 2em;
            padding: 10px;
            min-height: 100vh;
        }

        .title{
            font-size: 1.5em;
            text-align: center;
            padding: 1em;
            text-decoration: underline;
            font-weight: 600;
        }

        .link{
            display: flex;
            width: 300px;
            justify-content: space-between;
            align-self: flex-end;
        }

        .link a {
            text-decoration: none;
            color: white;
            padding: 5px;
            border-radius: 6px;
            text-align: center;
        }

        .login{
            transition: all 0.2s;
            background-image: linear-gradient(to right, #f95530, #eb4841, #d93f4d, #c53a56, #af385b);
        }

        .login:hover{
            transition: all 0.2s;
            background-image: linear-gradient(to left, #f95530, #eb4841, #d93f4d, #c53a56, #af385b);
        }

        .signup{
            background-image: linear-gradient(to right, #af385b, #922960, #702162, #4a1d5f, #1b1a57);
        }

        .signup:hover{
            background-image: linear-gradient(to left, #af385b, #922960, #702162, #4a1d5f, #1b1a57);
        }
    </style>
</head>
<body>
    <div class="container">
    <div class="link">
         <a href="login" class="login">Se Connecter</a><a href="inscription" class="signup">Ouvrir un compte</a>
    </div>
    <div class="block">
    <img src="/projetFinance/assets/img/xbank.png" alt="" width="200px" height="200px" style="display: flex;margin:0 auto;border-radius:50%">
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum quas eos eligendi vel, incidunt nesciunt deserunt itaque sunt nostrum voluptatem minima maiores sit soluta corporis maxime qui aliquid. Quod, dolorum.</p>
    </div>
    
    <div class="block">
        <h3 class="title">Pourquoi Choisir XBANK ?</h3>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum quas eos eligendi vel, incidunt nesciunt deserunt itaque sunt nostrum voluptatem minima maiores sit soluta corporis maxime qui aliquid. Quod, dolorum.</p>
    </div>
    </div>
</body>
</html>